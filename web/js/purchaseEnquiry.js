var $gridEnquiry;


function purchaseEnquiryInit() {
	registerMenuPurchase('purchaseEnquiryListInit')
	} // end function mainMenu

function purchaseEnquiryListInit() {
	console.log("function purchaseEnquiryListInit");
	console.log(array_data["rowsPurchaseEnquiry"]);	
	$("#dialogEnquiryDiv").dialog({
		width : 850,
		modal : true,
		open : function() {
			$(".ui-dialog").position({
				of : "#gridEnquiry"
			});
		},
		autoOpen : false
	});
	
	//ticketDocuments in base.html
	$("#ticketDocuments").dialog({
		width : 850,
		modal : true,
		open : function() {
			$(".ui-dialog").position({
				of : "#gridEnquiry"
			});
		},
		autoOpen : false
	});



	var Grid=JSON.parse(JSON.stringify(array_data["rowGrid"]));	
	var obj = JSON.parse(Grid.objGrid);

	Grid.toolbar=Grid.toolbar.replace(/(\r\n\t|\n|\r\t)/gm,"");
	obj.toolbar = JSON.parse('{'+Grid.toolbar+'}');
	
	for (var i=0;i<obj.toolbar.items.length;i++) 
			obj.toolbar.items[i].listeners[0].click=eval(obj.toolbar.items[i].listeners[0].click)

	Grid.colModel = Grid.colModel.replace(/(\r\n\t|\n|\r\t)/gm,"");
	console.log("Grid.colModel");
	console.log(Grid.colModel);
	
	var colModel=JSON.parse(Grid.colModel);


	for (var i=0;i<colModel.length;i++) {
		if (colModel[i].render!=undefined && colModel[i].render!="") {

			var render=colModel[i].render;
			colModel[i].render=function(ui) {
				return (eval(render));}			
		}

	}

	obj.colModel = colModel;
	
	var dataModel = JSON.parse(Grid.dataModel);
	obj.dataModel = dataModel;
	obj.dataModel.data = array_data[dataModel.data];
	

	$grid = $("#gridEnquiry").pqGrid(obj);
		$("#gridEnquiry").pqGrid({
			rowDblClick : function(event, ui) {
				editRow();
			}
		});

		$grid.pqGrid("showLoading");
		if (array_data["rowsPurchaseEnquiry"].length > 0) {
			
			for (var i=0;i<colModel.length;i++) {
				if (colModel[i].filter!=undefined && colModel[i].filter!="") {
					var column = $grid.pqGrid("getColumn", {
						dataIndx : colModel[i].dataIndx
					});
				var filter = column.filter;
					filter.cache = null;
					filter.options = $grid.pqGrid("getData", {
						dataIndx : [ colModel[i].dataIndx ]
					});
	
				}
			}

			$grid.pqGrid("refreshDataAndView");
		}
		
		$grid.pqGrid("hideLoading");

		var dialogId = $("form#dialogEnquiry");


		// edit Row
		function editRow() {

			var rowIndx = getRowIndx();

			if (rowIndx == null) 
				return;

				var row = $grid.pqGrid('getRowData', {
					rowIndx : rowIndx
				});

				orderID=row.orderID;
				var dialogId = $("form#dialogEnquiry");
				registerMenuPurchase('purchaseEnquiryOrderInit');
				
				
							
		} // editRow

		function addRow() {

				var dialogId = $("form#dialogEnquiry");
				dialogId.find('input[name="id"]').val(-1);
				
				

				/* set all input values to NULL
				 * 
				 */
				dialogId.find("input").val("");
				dialogId.find('input[name="date"]').val(today);
				
				
				dialogId.find('input[type=file]').on('change', prepareUpload);
				
				dialogId.find("select[name='division']").change(function() {
					changeEnquiry(dialogId,'division', this.value);
				});

				dialogId.find("select[name='voucher']").change(function() {
					changeEnquiry(dialogId,'voucher', this.value);
				});

				dialogId.find("select[name='voucherNoInternal']").change(function() {
					changeEnquiry(dialogId,'voucherNoInternal', this.value);
				});

				changeEnquiry(dialogId,'division', 'E');
				//dialogId.find('select[name="voucherNoInternal"]').find('option').remove().end();
				dialogId.find('input[name="from_company"]').focus();
				
				$("#dialogEnquiryDiv").dialog(
						{
							title : "* neuer Eintrag *",
							buttons : {
								Add : function() {
									
									
									var row = dialogGetRow(dialogId);
									
									if (checkFirmID(row.from_company)<0)
										return;
									var newRow = $grid.pqGrid('addRow', {
										rowData : row
									});
									
									dialogSave(dialogId,-1,"purchaseEnquirySave","purchaseEnquirySavePost(array_data['row'])");

									$(this).dialog("close");
								},
								Cancel : function() {
									$(this).dialog("close");
								}
							}
						}).dialog("open");
			
		} // addRow

		function deleteRow() {
			if (confirm('delete, are you sure?')) {
				var rowIndx = getRowIndx();
				if (rowIndx != null) {
					var row = $grid.pqGrid('getRowData', {
						rowIndx : rowIndx
					});
					var dialogId = $("form#dialogEnquiry");
					dialogDeleteId(dialogId,row.id,"purchaseEnquiryDelete",'');
					$grid.pqGrid("deleteRow", {
						rowIndx : rowIndx
					});
					$grid.pqGrid("setSelection", {
						rowIndx : rowIndx
					});

				}
			}
		}

		function getRowIndx() {
			var arr = $grid.pqGrid("selection", {
				type : 'row',
				method : 'getSelection'
			});
			if (arr && arr.length > 0) {
				return arr[0].rowIndx;
			} else {
				alert("Select a row.");
				return null;
			}
		}

}
