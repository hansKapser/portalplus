var orderID=-1;
var tbodyReorderPositions="";
var tbodystoreReorderPositions="";
var files;
var classPosition;

var $gridReorder;


function storeReorderInit() {
	registerMenuStore('storeReorderListInit')
	} // end function mainMenu

function storeReorderListInit() {
	$gridClass=undefined;
	console.log("function storeReorderListInit");
	console.log(array_data["rowsStoreReorder"]);	
	$("#dialogReorderDiv").dialog({
		width : 850,
		modal : false,
		open : function() {
			$(".ui-dialog").position({
				of : "#gridReorder"
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
				of : "#gridReorder"
			});
		},
		autoOpen : false
	});

	dialogObj=
	{
		"divId": "#dialogReorderDiv",
		"modal" : false,
	    "dialogId" : "form#dialogReorder",
		"gridId": "#gridReorder",
		"toolbarFilter": "storeReorderToolbarFilter(value)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogReorder"
	        },
		"deleteDialog": {
			"dialogId" : "form#dialogReorder",
	  		"field" : "orderID",
			"modul" : "/storeReorderDelete"
		        }
	}

$gridClass= new _myGrid("#gridReorder",array_data["rowGrid"],dialogObj);
}

