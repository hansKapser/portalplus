function pqGridObj(gridId,rowGrid,funcDblClick='') {

	var customRarray=new Array();
	var dialogModel=new Array();
	
	eval(funcDblClick);
	
	function customRenderer( ui ) {
		return (eval(customRarray[ui.dataIndx]))
		};
	
var Grid=JSON.parse(JSON.stringify(rowGrid));	

if (Grid.dialogModel!="") {
	dialogModel=JSON.parse(Grid.dialogModel);
	
	for (var i=0;i<dialogModel.length;i++) {
		 $(dialogModel[i].divId).dialog({
				width : dialogModel[i].dialogBox.width,
				modal : dialogModel[i].dialogBox.modal,
				open : function() {
					$(".ui-dialog").position({
						of : "#gridPostinBox"
					});
				},
				autoOpen : false
			});

	}

}

var obj = JSON.parse(Grid.objGrid);

Grid.toolbar=Grid.toolbar.replace(/(\r\n\t|\n|\r\t)/gm,"");
obj.toolbar = JSON.parse('{'+Grid.toolbar+'}');

for (var i=0;i<obj.toolbar.items.length;i++) 
		obj.toolbar.items[i].listeners[0].click=eval(obj.toolbar.items[i].listeners[0].click)

Grid.colModel = Grid.colModel.replace(/(\r\n\t|\n|\r\t)/gm,"");

colModel=JSON.parse(Grid.colModel);

for (i=0;i<colModel.length;i++) {

	if (colModel[i].render!=undefined && colModel[i].render!='') {
		customRarray[colModel[i].dataIndx]=colModel[i].render;
		colModel[i].render=function(ui) {
			return (customRenderer(ui))
			}
	}
}

obj.colModel = colModel;


obj.dataModel = JSON.parse(Grid.dataModel);
obj.dataModel.data = array_data[obj.dataModel.data];

if (Grid.groupModel!="") 
	obj.groupModel = JSON.parse(Grid.groupModel);

$grid = $(gridId).pqGrid(obj);

$(gridId).pqGrid({
	rowDblClick : function(event, ui) {
		
		
		if (funcDblClick=='') {
			_editRow();
		} else {
			eval(funcDblClick);	
		}
		
	}
	
});


// $grid.pqGrid( "option", "colModel", colModel );

$grid.pqGrid("showLoading");
/*
 * defined in table system_grid
 */



if (obj.dataModel.data.length > 0) {
	// load from_company dropdowns.
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

	// $grid.pqGrid("refreshDataAndView");
}

$grid.pqGrid("hideLoading");

	function _editRow () {
		console.log("hier we are");
		var rowIndx = _getRowIndx();

		if (rowIndx == null) 
			return;

			var row = $grid.pqGrid('getRowData', {
				rowIndx : rowIndx
			});

			console.log(row);
			console.log(dialogModel[0].dialogId);
			dialogId=$(dialogModel[0].dialogId);
			dialogInit(dialogId,row);
			
			var array=new Array();

			/* initSelect
			 * defined in p17_system_grid -> dialogModel.select
			 */
			
			if (dialogModel[0].editDialog.select!=undefined && dialogModel[0].editDialog.select!="") {
			var arrayA=new Array();
			var ai=-1;
			var oai=-1;
			
			for (var i=0;i<dialogModel[0].editDialog.select.length;i++) {
				
				if (dialogModel[0].editDialog.select[i].autocomplete==1) {
					arrayA[++ai]=dialogModel[0].editDialog.select[i];			
				} else {
					array[++oai]=dialogModel[0].editDialog.select[i];
				}
			}

			if (arrayA.length>0)
				dialogInitAutocomplete(dialogId,arrayA);
			
			if (array.length>0)
				dialogInitSelect(dialogId,array);
			}

			/* initSelect
			 * defined in p17_system_grid -> dialogModel.change
			*/
			console.log(dialogModel[0].editDialog.change);	
			if (dialogModel[0].editDialog.change!=undefined && dialogModel[0].editDialog.change!="") {
				for (var i=0;i<dialogModel[0].editDialog.change.length;i++) {
			
			/* fieldID
			 * @todo: check for checkbox as well as radio
			 */
					var field=dialogModel[0].editDialog.change[i].field;
					if (dialogId.find('select[name="'+dialogModel[0].editDialog.change[i].field+'"]')!="undefined")
						var fieldID=dialogId.find('select[name="'+dialogModel[0].editDialog.change[i].field+'"]');
					if (dialogId.find('input[name="'+dialogModel[0].editDialog.change[i].field+'"]')!="undefined")
						var fieldID=dialogId.find('select[name="'+dialogModel[0].editDialog.change[i].field+'"]');
					var udfFunction=dialogModel[0].editDialog.change[i].udfFunction;
					
					fieldID.change(function() {
						eval(udfFunction);
					});

					
				}
			}
			

			dialogInit(dialogId,row);

			$(dialogModel[0].divId).dialog(
					{
						title : dialogModel[0].editDialog.title,
						buttons : {
							Update : function() {
								
								var row = dialogGetRow(dialogId);
								$grid.pqGrid('updateRow', {
									rowIndx : rowIndx,
									row : row,
									checkEditable : false
								});
								
								dialogModel[0].editDialog.postSave!=undefined 
										&& dialogModel[0].editDialog.postSave!="" 
											? postSave=dialogModel[0].editDialog.postSave
											: postSave='';
										
								dialogSave(dialogId,row.id,postSave)

								$(this).dialog("close");
							},
							Cancel : function() {
								$(this).dialog("close");
							}
						}
					}).dialog("open");


	}

	function _getRowIndx() {
		if ($grid==undefined || $grid=="") return;
		
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
	
return ($grid);
	
}

function getRowIndx() {
	if ($grid==undefined || $grid=="") return;
	
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

