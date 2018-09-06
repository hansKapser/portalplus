var register="Address";
var rowsWBTime=new Array();
var tbodyWBTime='';

var rowsProducts=new Array();
var tbodyProducts='';

var rowsArticles=new Array();
var tbodyArticles='';

var $gridClass;

function managementFirmsInit() {
registerMenuManagementFirms('managementFirmsListInit')
} // end function mainMenu

function registerMenuManagementFirms(modul) {
	content=isHtmlContent(modul);
	
	var isHTML=false;
	if (content!=undefined) 
		isHTML=true;

		switch (modul) {
		default:
			//console.log(modul);
			//console.log(parameter)
			break;
		
		} // end switch modul
		var data = $.param(
				{"data" : JSON.stringify(
					{
						"action" : "init",
						"isHTML" : isHTML
					}
				)}
			);

		$.ajax({
			type : "POST",
			dataType : "json",
			url : "/"+modul,
			async: true,
			data : data,
			success : function(data) {
				array_data = getDataContent(data);
				if (content==undefined) {
					content=array_data["html"];
					var len=_htmlContent.length;
					_htmlContent[len]=new Array();
					_htmlContent[len].modul=modul;
					_htmlContent[len].content=content;
					var len=_gridContent.length;
					_gridContent[len]=new Array();
					_gridContent[len].modul=modul;
					_gridContent[len].content=array_data["rowGrid"];

					
				}

				$('div.contentFirms').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end registerMenumanagementFirms

function managementFirmsListInit() {
	$gridClass=undefined;
	var rowGrid=isGridContent("managementFirmsListInit");
	
	dialogObj=
	{
		"divId": "#dialogFirmsDiv",
        "dialogId" : "form#dialogFirms",
		"gridId": "#gridFirms",
		"dialogBox": {
			"width": "700",
			"modal": true,
			"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
  		   "width": "700",
		   "dialogId" : "form#dialogFirms",
		   "udfInit" : "changeFirms(dialogId,'init',row)"
	}
	}

$gridClass= new _myGrid("#gridFirms",rowGrid,dialogObj);



}


function managementFirmsAddressInit() {
	var register="Address";
	$("#dialogFirmsFakturaDiv").css("display","none");
	$("#dialogFirmsProductsDiv").css("display","none");

	dialogId=$("#dialogFirms");
	
	var arr = $grid.pqGrid("selection", {
		type : 'row',
		method : 'getSelection'
	});

	var rowIndx=arr[0].rowIndx;

	var row = $grid.pqGrid('getRowData', {
		rowIndx : rowIndx
	});

	
	var data = {
			"action" : "init",
			"firmID" : row.firmID
		};
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	modul="/managementFirmsAddressInit";
	data = $.param(data);
	
		$.ajax({
			type : "POST",
			dataType : "json",
			url : modul,
			dataType : "json",
			data : data,
			success : function(data) {
				
				var array_data = getDataContent(data);
				
				if (tbodyWBTime=='') 
					tbodyWBTime=$('#rowsWBTime').html();
				rowsWBTime=array_data['rowsWBTime'];				
				string=tbodyRows('rowsWBTime',tbodyWBTime,rowsWBTime);

				$("#dialogFirmsRegisterDiv").html($("#dialogFirms"+register+"Div").html());
				dialogInit(dialogId,array_data["rowFirm"]);
				dialogId.find('input[name="company"]').val(row.company);	

			}
		});

} // editRow

function managementFirmsProductsInit() {
	var register="Products";
	$("#dialogFirmsAddressDiv").css("display","none");
	$("#dialogFirmsFakturaDiv").css("display","none");
	dialogId=$("#dialogFirms");
	
		var arr = $grid.pqGrid("selection", {
			type : 'row',
			method : 'getSelection'
		});
	
		var rowIndx=arr[0].rowIndx;

	
		var row = $grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});

		
		
		
		var data = {
				"action" : "init",
				"firmID" : row.firmID
			};
		
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
		modul="/managementFirmsProductsInit";
		
			$.ajax({
				type : "POST",
				dataType : "json",
				url : modul,
				dataType : "json",
				data : data,
				success : function(data) {
					var array_data = getDataContent(data);
					console.log(array_data);
					if (tbodyProducts=='') 
						tbodyProducts=$('#rowsProducts').html();		
					if (tbodyArticles=='') 
						tbodyArticles=$('#rowsArticles').html();		
					string=tbodyRows('rowsProducts',tbodyProducts,array_data['rowsProducts']);
					string=tbodyRowsG('rowsArticles',tbodyArticles,array_data['rowsArticles'],"groupName");
					$("#dialogFirmsRegisterDiv").html($("#dialogFirms"+register+"Div").html());
					dialogId.find('input[name="company"]').val(row.company);
				}
			});

	
} // editRow

function managementFirmsFakturaInit() {
	var register="Faktura";
	$("#dialogFirmsAddressDiv").css("display","none");
	$("#dialogFirmsProductsDiv").css("display","none");
	
	var dialogId = $("form#dialogFirms");
	
		var arr = $grid.pqGrid("selection", {
			type : 'row',
			method : 'getSelection'
		});
		var rowIndx=arr[0].rowIndx;
		var row = $grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});
		
		var data = {
				"action" : "init",
				"firmID" : row.firmID
			};
		
		var data = {
				"data" : JSON.stringify(data)
			};
		modul="/managementFirmsFakturaInit";
		data = $.param(data);
		
			$.ajax({
				type : "POST",
				dataType : "json",
				url : modul,
				dataType : "json",
				data : data,
				success : function(data) {
					var array_data = getDataContent(data);
					var rowsTermPayment=array_data["rowsTermPayment"];
					
					$("#dialogFirmsRegisterDiv").html($("#dialogFirms"+register+"Div").html());
					
					for (var i = 0; i < rowsTermPayment.length; i++) {
						var value=rowsTermPayment[i].id;
						var name=rowsTermPayment[i].discount_days+" Tg. "+
								rowsTermPayment[i].discount+"% Sk., "+
								rowsTermPayment[i].net_days+" Tg. netto";
						
						dialogId.find('select[name="D_termPayment"]').append(
								new Option(name, value));
					}

					dialogInit(dialogId,array_data["rowDebitor"]);
					dialogInit(dialogId,array_data["rowCreditor"]);
					dialogId.find('input[name="company"]').val(row.company);	

				}
			});
	
} // editRowF

function managementFirmsFakturaSaveRecord() {
	var dialogId = $("form#dialogFirms");
	var modul="/managementFirmsFakturaSave";
	var id='';
	dialogSave(dialogId,id,modul);
	return;
}


function firmsEditRow() {
	
	if ($gridClass==undefined) return;
	
	var rowIndx = $gridClass._getRowIndx();

	if (rowIndx == null) 
		return;

		var row = $gridClass.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});

		
		var dialogId = $("form#dialogFirms");
		managementFirmsAddressInit();
		
		//$("#dialogFirms"+register+"Div").css("display","table");
		//$("#dialogFirmsRegisterDiv").html($("#dialogFirms"+register+"Div").html());
		$("#dialogFirmsDiv").dialog(
				{
					title : "Firmendaten (#" + row.firmID + ")",
					buttons : {
						Close : function() {
							$(this).dialog("close");
						}
					}
				}).dialog("open");
	
} // editRow

function firmsAddRow() {
	var dialogId = $("form#dialogFirmsNew");
	
	//$("#dialogFirms"+register+"Div").css("display","table");
	//$("#dialogFirmsRegisterDiv").html($("#dialogFirms"+register+"Div").html());
	
	var array=new Array();
		array=[
           {
     		"field": "BICP",
	        "label" : "name",
	        "value" : "BIC",	       
	        "rows": array_data['rowsBanks'],
	        "blank": {
	        	"label": "--- select ---",
	        	"value": ""
	        }
	        }
           ];

	dialogInitSelect(dialogId,array);
	
	$("#dialogFirmsNewDiv").dialog(
			{
				width: 800,
				title : "Antrag auf neue Firma",
				buttons : {
					Close : function() {
						$(this).dialog("close");
					},
					Save : function() {
						var id=-1;
						var modul="/managementFirmsNewFirmSave";
						dialogSave(dialogId,id,modul);
						$(this).dialog("close");
					}
				}
			}).dialog("open");

	return;
}

