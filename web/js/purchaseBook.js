var $gridClass;

function purchaseBookInit() {
	registerMenuPurchase('purchaseBookListInit')
	} // end function mainMenu

function purchaseBookListInit() {
	
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerPurchaseBookList').css('text-decoration','underline');
	$('#navtabs').find('#registerPurchaseBookList').css('color','blue');
	
	$gridClass="";
	console.log("function purchaseBookListInit");
	dialogObj=
	{
		"divId": "#dialogPurchaseBookDiv",
	    "dialogId" : "form#dialogPurchaseBook",
		"gridId": "#gridPurchaseBook",
		"toolbarFilter": "purchaseBookToolbarFilter(value)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogPurchaseBook"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogPurchaseBook",
	  		   "field" : "orderID",
			   "modul" : "/purchaseBookListDelete"
		        }
	}
if (orderID>0) {
	
} else {
	$gridClass= new _myGrid("#gridPurchaseBook",array_data["rowGrid"],dialogObj);	
}

}

function purchaseBookToolbarFilter(value) {
	
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value}
			)}
		);

modul="/purchaseBookChangeData";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	$gridClass.obj.dataModel.data=arrayData["rowsPurchaseBook"];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax

	
	
	
}

function purchaseBookListEdit() {
if ($gridClass==undefined || $gridClass=="") return;
	
	var rowIndx = $gridClass._getRowIndx();

	if (rowIndx == null) 
		return;

		var row = $gridClass.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});

		orderID=row.orderID;
		
		registerMenuPurchase("purchaseOrderInit");
		
	
}

function sellingBookAdd() {
	orderID=-1;
	registerMenuSelling('sellingOrderInit');
}
