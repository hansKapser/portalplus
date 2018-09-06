var $gridClass;
var orderID;

function sellingBookInit() {
	registerMenuSelling('sellingBookListInit')
	} // end function mainMenu

function sellingBookListInit() {
	$gridClass=undefined;
	console.log("function sellingBookListInit");
	dialogObj=
	{
		"divId": "#dialogSellingBookDiv",
	    "dialogId" : "form#dialogSellingBook",
	    "toolbarFilter": "purchaseBookToolbarFilter(value)",
		"gridId": "#gridSellingBook",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"toolbarFilter" : "sellingBookToolbarFilter(name,value)",
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogSellingBook"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogSellingBook",
	  		   "field" : "orderID",
			   "modul" : "/sellingBookListDelete"
		        }
	}
	if (orderID>0) {
		
	} else {
		$gridClass= new _myGrid("#gridSellingBook",array_data["rowGrid"],dialogObj);
	}
}

function sellingBookListEdit() {
if ($gridClass==undefined || $gridClass=="") return;
	
	var rowIndx = $gridClass._getRowIndx();

	if (rowIndx == null) 
		return;

		var row = $gridClass.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});

		orderID=row.orderID;
		console.log(orderID);
		
		registerMenuSelling("sellingOrderInit");
		
	
}

function sellingBookToolbarFilter(name,value) {
	console.log(name+" "+value);
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value}
			)}
		);

modul="/sellingBookListChangeData";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	$gridClass.obj.dataModel.data=arrayData["rowsSellingBook"];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax

	
	
	
}
