var $gridClassReorder;
var $gridClassMaster;
var tbodyStoreTransactions="";
var tbodyStoreTransactionsOrder="";
var tbodyStoreOrderPositions="";

function storeInit() {
registerMenuStore('storeListInit')
} // end function mainMenu


function registerMenuStore(modul) {
	console.log("function store.js -> registerMenuStore: "+modul);
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

					
					$('div.contentStore').html(content);
					var jsModul=modul+"()";
					eval(jsModul);
				}
			});
		
	} // end registerMenuarticleMaster

function storeListInit() {
	console.log("function storeListInit");
	$gridClassMaster=undefined;
	if (tbodyStoreTransactions=="") 
		tbodyStoreTransactions=$('#tbodyStoreTransactions').html();
	if (tbodyStoreTransactionsOrder=="") 
		tbodyStoreTransactionsOrder=$('#tbodyStoreTransactionsOrder').html();
	if (tbodyStoreOrderPositions=="") 
		tbodyStoreOrderPositions=$('#tbodyStoreOrderPositions').html();
	
	var rowGrid=isGridContent("storeListInit");
	console.log(_gridContent);
	
		dialogObj=
		{
			"divId": "#dialogArticleDiv",
		    "dialogId" : "form#dialogStore",
			"gridId": "#gridArticle",
			"dialogBox": {
					"width": "600",
					"modal": true,
					"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
			   "dialogId" : "form#dialogStore"
				   }
		}
		
	$gridClassMaster= new _myGrid("#gridStoreMaster",rowGrid,dialogObj);


}

function storeListEntry() {
	//console.log($gridClass);
	if ($gridClass==undefined) {
		return;
	} else {
		console.log("jetzt möchte ich sehen was undefined?");
		//console.log($gridClassMaster);
	}
	
	var rowIndx=$gridClass._getRowIndx();
	
	var row = $gridClass.$grid.pqGrid('getRowData', {
		rowIndx : rowIndx
	});
	
	console.log("rowIndx");
	console.log(rowIndx);

}

function storeListMasterSelect() {
console.log("storeListMasterSelect");
$('#storeTransactions').html($('#storeTransactionsArticle').html());

if ($gridClassMaster==undefined || $gridClassMaster=="") return;

var arr = $gridClassMaster.$grid.pqGrid("selection", {
	type : 'row',
	method : 'getSelection'
});
if (arr && arr.length > 0) {
	rowIndx=arr[0].rowIndx;
} else {
	return null;
}

	
	if (rowIndx == null) 
		return;

		var row = $gridClassMaster.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});


		dialogId=dialogId=$("form#dialogStoreTransactions");
		dialogId.find('input[name="article_id"]').val(row.article_id);
		dialogId.find('input[name="variation1_id"]').val(row.variation1_id);
		dialogId.find('input[name="variation2_id"]').val(row.variation2_id);

		storeTransactionsArticle();
		
		
		return;
	
}

function changeStoreView(id,kind,division="E") {
	if (kind=="A") {
		$('#storeTransactions').html($('#storeTransactionsArticle').html());
		storeTransactionsArticle();
	} else {
		$('#storeTransactions').html($('#storeTransactionsOrder').html());
		storeTransactionsOrder(id,division);
	}
}

function storeTransactionsArticle() {
	
	var dialogId=dialogId=$("form#dialogStoreTransactions");
	var article_id=dialogId.find('input[name="article_id"]').val();
	var variation1_id=dialogId.find('input[name="variation1_id"]').val();
	var variation2_id=dialogId.find('input[name="variation2_id"]').val();

	var data = $.param(
			{"data" : JSON.stringify(
				{"article_id" : article_id,
					"variation1_id" : variation1_id,
					"variation2_id" : variation2_id,}
			)}
		);

modul="/storeGetArticleTransactions";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	console.log(arrayData);
	console.log(arrayData["rowsArticleStore"]);
	console.log(tbodyStoreTransactions);
	var rows=arrayData["rowsArticleStore"]
	
	for (var i=0;i<rows.length;i++) {
		if (rows[i].article_id==article_id 
				&& rows[i].variation1_id==variation1_id
				&& rows[i].variation2_id==variation2_id) {
		var row=rows[i];
		break;
		}
	}
	rows=arrayData["rowsOwnVariationSpec"];
	for (i=0;i<rows.length;i++) {
		if (rows[i].article_id==article_id 
				&& rows[i].variation1_id==variation1_id
				&& rows[i].variation2_id==variation2_id) {
		row.variation=rows[i].variation1;
			if (rows[i].variation2!="")
				row.variation+=", "+rows[i].variation2;
		break;
		}
	}
	
	row.totalConsumption=germanDezimal(arrayData["rowStatistic"].totalConsumption);
	row.monthlyConsumption=germanDezimal(arrayData["rowStatistic"].monthlyConsumption);
	row.turnoverRatio=germanDezimal(arrayData["rowStatistic"].turnoverRatio);
	row.totalConsumptionA=germanDezimal(arrayData["rowStatistic"].totalConsumptionA);
	row.monthlyConsumptionA=germanDezimal(arrayData["rowStatistic"].monthlyConsumptionA);
	row.turnoverRatioA=germanDezimal(arrayData["rowStatistic"].turnoverRatioA);
	
	dialogInit(dialogId,row);
	
	tbodyRows('tbodyStoreTransactions',tbodyStoreTransactions,arrayData["rowsStore"]);
	if (arrayData["rowsArticleStore"].length>=12) {
		$('#storeTransactions').find('thead').css("width","calc( 100% - 0.8em )");	
	} else {
		$('#storeTransactions').find('thead').css("width","calc( 100% - 0em )");
	}
	
} // end ajax success

}); // end ajax

	return;
}

function storeTransactionsOrder(orderID,division) {
	
	dialogId=dialogId=$("form#dialogStoreTransactions");
	
	var data = $.param(
			{"data" : JSON.stringify(
				{"orderID" : orderID,
				"division" : division}
			)}
		);

modul="/storeGetOrderTransactions";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	console.log(arrayData);
	
	var rowOrder=arrayData["rowOrder"];
	var rowOrderPositions=arrayData["rowsOrderPositions"];
		
	dialogInit(dialogId,rowOrder);
	if (division=="E") {
		$('#titleOrderPositionsTr').css('background-color','#95fa97');	
	} else {
		$('#titleOrderPositionsTr').css('background-color','#faae8d');
	}
	
	
	tbodyRows('tbodyStoreTransactionsOrder',tbodyStoreTransactionsOrder,arrayData["rowsStore"]);
	tbodyRows('tbodyStoreOrderPositions',tbodyStoreOrderPositions,arrayData["rowsOrderPositions"]);
	
	
	
	if (arrayData["rowsStore"].length>=12) {
		$('#storeTransactions').find('thead').css("width","calc( 100% - 0.8em )");	
	} else {
		$('#storeTransactions').find('thead').css("width","calc( 100% - 0em )");
	}
	
} // end ajax success

}); // end ajax

	return;
}

function storeTransactionDelete(id,view) {
	dialogId=dialogId=$("form#dialogStoreTransactions");
	phpModul="/storeTransactionDelete";
	postFunction='storeTransactionDeletePost("'+view+'")';
	dialogDeleteId(dialogId,id,phpModul,postFunction);
	return;
}

function storeTransactionDeletePost(view) {
	
	if (view=="A") {
		storeTransactionsArticle();
	} else {
		storeTransactionsArticle();	
	}
return;
}

function storeReorderListInit() {
	$gridClassReorder=undefined;
	console.log("function storeReorderListInit");
	
	var rowGrid=isGridContent("storeReorderListInit");
	
	$("#dialogReorderDiv").dialog({
		width : 1000,
		modal : true,
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
	    "dialogId" : "form#dialogReorder",
		"gridId": "#gridReorder",
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
console.log(array_data);
$gridClassReorder= new _myGrid("#gridReorder",rowGrid,dialogObj);
}

function storeReorderListEdit() {
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


	function storeReorderAdd() {
		/*
		 * call purchaseRequisition
		 
		htmlPurchase="$htmlContent=file_get_contents ( './templates/de/purchase.html');"
			mainMenu("purchaseInit");
			indexMenuPurchase('purchaseRequisitionInit',false);
			registerMenuPurchase('purchaseRequisitionOrderInit');
		or open popup
		*/
		var data = $.param(
				{"data" : JSON.stringify(
					{"orderID" : -1,
					"division" : 'E'}
				)}
			);

	modul="/storeReorderRequisition";
	$.ajax({
	type : "POST",
	url : modul,
	dataType : "json",
	data : data,
	success : function(data) {
		var arrayData = getDataContent(data);
		array_data["rowsArticle"]=array_data["rowsOwnArticle"];
		array_data["rowsOrderPositions"]=new Array();
		$('#dialogReorderDiv').html(arrayData["html"]);
		purchaseRequisitionOrderInit();
		$('#dialogReorderDiv').css("display","table");
		$('#dialogReorderDiv').dialog(
				{
                    height: 500,
					title : "Nachbestellung",
					buttons : {
						Close : function() {
							$(this).dialog("close");
						}
					}
				}).dialog("open");

	}
	});
		
	}
