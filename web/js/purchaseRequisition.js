var orderID=-1;
var tbodyPurchaseOrderPositions="";
var tbodyPurchaseRequisitionOrderPositions="";
var files;
var classPosition;

var $gridRequisition;


function purchaseRequisitionInit() {
	registerMenuPurchase('purchaseRequisitionListInit');
	} // end function mainMenu

function purchaseRequisitionListInit() {
	$gridClass=undefined;

	$("#dialogRequisitionDiv").dialog({
		width : 850,
		modal : true,
		open : function() {
			$(".ui-dialog").position({
				of : "#gridRequisition"
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
				of : "#gridRequisition"
			});
		},
		autoOpen : false
	});



	$gridClass="";
	
	dialogObj=
	{
		"divId": "#dialogRequisitionDiv",
	    "dialogId" : "form#dialogRequisition",
		"gridId": "#gridRequisition",
		"toolbarFilter": "purchaseRequisitionToolbarFilter(value)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogRequisition"
	        },
		"deleteDialog": {
			"dialogId" : "form#dialogRequisition",
	  		"field" : "orderID",
			"modul" : "/purchaseRequisitionDelete"
		        }
	}

$gridClass= new _myGrid("#gridRequisition",array_data["rowGrid"],dialogObj);
}

function purchaseRequisitionOrderInit() {
	$gridClass=undefined;
	
	$('#baseTotalSumDiv').html($('#baseTotalSum').html());
	var y = $('#navtabs').width();
	
	$('#li_icon_menu').css('right', 10);
	
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerPurchaseRequisitionOrder').css('text-decoration','underline');
	$('#navtabs').find('#registerPurchaseRequisitionOrder').css('color','blue');
	
	workflowStatusChecked(array_data["rowPurchaseOrder"].workflowStatus);
	
	var dialogId=$("form#dialogPurchaseRequisitionOrder");
	/*
	 * @todo: personalize purchaseRequests
	 */
	
	arraySelect = [ 
		{
			"field": "supplier_company",
			"rows": array_data["rowsFirms"],
			"autocomplete": 1,
			"label": "company",
			"value": "company"
		},
		{
		    "field": "userID",
		    "groupField" : "class_name",
			"label" : "user_name",
			"value" : "userID",	       
			"rows": array_data["rowsUser"]
		}
		/*,
		{
	        "field": "teamID",
			"label" : "name",
			"value" : "id",	       
			"rows": array_data["rowsTeam"],
			"blank": {
				"label":"-select-",
				"value":""
			}
		},
		{
		    "field": "classID",
			"label" : "name",
			"value" : "id",	       
			"rows": array_data["rowsClass"],
			"blank": {
				"label":"-select-",
				"value":""
			}
		}
		*/
		]


	dialogInitSelect(dialogId,arraySelect);
	$supplier_firmID=-1;
	if (array_data["rowPurchaseOrder"].orderID!=undefined) {
		console.log("bestehender Auftrag");
		supplier_firmID=array_data["rowPurchaseOrder"].supplier_firmID;
		dialogId.find('input[name="supplier_firmID"]').val(supplier_firmID);
		dialogId.find('input[name="orderID"]').val(array_data["rowPurchaseOrder"].orderID);
		dialogInit(dialogId,array_data["rowPurchaseOrder"]);
	} else {
		console.log("neu");
		supplier_firmID=-1;
		dialogId.find('input[name="orderID"]').val(-1);
		dialogId.find('input[name="supplier_company"]').change( function() {
			dialogId=$("form#dialogPurchaseRequisitionOrder");
			purchaseOrderNewGetArticles(dialogId);
		});
		
		
		dialogId.find("input[name='date']").datepicker(datepickerGerman);
	}
	
	dialogId.find("input[name='saveOrder']").click(function () {
	var dialogId=$("form#dialogPurchaseRequisitionOrder");	
		phpModul="/purchaseRequisitionOrderSave";
			postFunction="";
			dialogSave(dialogId,orderID,phpModul,postFunction)
			});
	
	var dialogId=$("form#dialogPurchaseRequisitionOrderPositions");
	var obj={};
	obj.dialogId=dialogId;
	obj.htmlId="tbodyPurchaseRequisitionOrderPositions";
	obj.orderID=orderID;
	obj.phpModulSave="purchaseRequisitionOrderPositionSave";
	obj.postFunction="purchaseRequisitionOrderPositionSavePost()";
	obj.firmID=supplier_firmID;
	obj.tbody=$('#tbodyPurchaseRequisitionOrderPositions').html();
	obj.rowsPositions=array_data["rowsOrderPositions"];
	/* get following to array by fetchin order-data
	 * 
	 */
	obj.rowsArticle=array_data["rowsArticle"];
	obj.rowsVariation=array_data["rowsVariation"];
	obj.rowsVariationSpec=array_data["rowsVariationSpec"];
	obj.rowsVAT=array_data["rowsVAT"];
	classPosition = new _Position(obj);
	classPosition.sayHi();
	totalSum(dialogId,array_data["rowsOrderPositions"]);

}

function purchaseRequisitionOrderPositionSavePost() {
	console.log(array_data["rows"]);
	
	if (orderID>1) return;
		
	orderID=array_data["rows"][0].orderID;
	
	var dialogId=$("form#dialogPurchaseRequisitionOrder");
	dialogId.find('input[name="orderID"]').val(orderID);
	alert(dialogId.find('input[name="orderID"]').val());
	phpModul="/purchaseRequisitionOrderSave";
	postFunction="";
	dialogSave(dialogId,orderID,phpModul,postFunction)
}

function purchaseRequisitionToolbarFilter(value) {
	
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value}
			)}
		);

modul="/purchaseRequisitionChangeData";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	$gridClass.obj.dataModel.data=arrayData["rowsPurchaseOrder"];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax

}

function purchaseRequisitionListEdit() {
if ($gridClass==undefined || $gridClass=="") return;
	
	var rowIndx = $gridClass._getRowIndx();

	if (rowIndx == null) 
		return;

		var row = $gridClass.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});

		orderID=row.orderID;
		
		registerMenuPurchase("purchaseRequisitionOrderInit");
		
	
}


function purchaseRequisitionAdd() {
	orderID=-1;
	registerMenuPurchase('purchaseRequisitionOrderInit');
}
