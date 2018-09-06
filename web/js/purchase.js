var classPosition;
var classPositionR;
var tbodyPurchaseOrderPositions="";
var tbodyPurchaseOrderStorePositions="";
var tbodyOrderStoreTransactionPositions="";
var tbodyOrderPurchaseIncomingPositions="";
var tbodyOrderPurchaseIncomingPositionsR="";
var tbodyOrderInvoicePositions="";
var tbodyOrderMessagePositions="";
var tbodySourceSupply="";
var tbodySourceSupplyOffer="";
var tbodySourceSupplyGroup="";
var sourceResultsArticle="";
var tbodySourceSupplyArticleMaster="";
var files;

function purchaseInit() {
console.log("purchase.js -> purchaseInit called by mainMeu");
console.log("nothing to do back to mainMeu");
if (orderID>0) {
	indexMenuPurchase("purchaseBookInit",true);
	waitTimeout=setTimeout(function(){ 
		registerMenuPurchase("purchaseOrderInit");	
	},500);
	
}

} // end function mainMenu

function purchaseRequisitionInit() {
	console.log("purchase.js -> purchaseRequisitionInit called by mainMeu");
	console.log("nothing to do back to mainMeu");
	} // end function mainMenu

function purchaseSourceSupplyInit() {
	if (tbodySourceSupply=="") {
		$('#sourceResultsDiv').html($('#sourceResults').html());
		tbodySourceSupply=$('#sourceResultsDiv').html();
	}
	if (tbodySourceSupplyOffer=="") {
		tbodySourceSupplyOffer=$('#sourceResultsOffer').html();
	}

	if (tbodySourceSupplyGroup=="") {
		tbodySourceSupplyGroup=$('#tbodySourceSupplyGroup').html();
	}
	if (sourceResultsArticle=="") {
		sourceResultsArticle=$('#sourceResultsArticle').html();
	}

	if (tbodySourceSupplyArticleMaster=="") {
		tbodySourceSupplyArticleMaster=$('#tbodySourceSupplyArticleMaster').html();
	}
	
	var dialogId=$("form#dialogSourceSupply");
	dialogId.find('input[name="searchButton"]').click(function () {
		purchaseSourceSupplySearch();
	})
	dialogId.find('input[name="searchString"]').change(function () {
		purchaseSourceSupplySearch();
	})

}

function purchaseSourceSupplySearch() {
	var dialogId=$("form#dialogSourceSupply");
	$('#sourceResultsDiv').css("display","table");
	$('#sourceResultsArticleDiv').css("display","none");
	
		var data = {
				"action" : "find",
				"searchString" : dialogId.find('input[name="searchString"]').val()
			};
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
		
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "/purchaseSourceSupplySearch",
				data : data,
				success : function(data) {
					var array_data = getDataContent(data);
					tbodyRows("tbodySourceSupply",tbodySourceSupply,array_data["rowsSourceFirms"]);
					
					for (var i=0;i<array_data["rowsSourceFirms"].length;i++) {
						purchaseSupplyBanner(array_data["rowsSourceFirms"][i].firmID);
						var stringOffer="";
						if (array_data["rowsSourceFirms"][i]["offer"]==undefined)
							array_data["rowsSourceFirms"][i]["offer"]=new Array();
						for (var ii=0;ii<array_data["rowsSourceFirms"][i]["offer"].length;ii++) {
							if (stringOffer!="") stringOffer+="<BR>";
							stringOffer+=array_data["rowsSourceFirms"][i]["offer"][ii].name;
						}
						$('#tbodySourceSupplyOffer'+array_data["rowsSourceFirms"][i].firmID).html(stringOffer);
					}
					$('#sourceResultsDiv').css({"display":"block","height":"400","overflow":"auto"});
					//purchaseSupplyArticles(326);
				}
			});
		
}
function purchaseSupplyBanner(firmID) {
	var data={
			"kind": "logo",
			"firmID": firmID,
			"timestamp": new Date().getTime()
	}
	
	data=JSON.stringify(data);
	$('#imageLogo'+firmID).attr('src',"/getFirmFile?data="+data);
	
}	

function purchaseSupplyArticles(firmID) {
	$('#sourceResultsArticleDiv').css({"display":"block","height":"500","overflow":"auto"});
	
	//$('#sourceResultsArticle').css("display","table");
	var data = {
			"action" : "find",
			"supplier_firmID" : firmID
		};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "/purchaseGetArticles",
			data : data,
			success : function(data) {
				var arrayData = getDataContent(data);
				$('#sourceResultsArticle').html(sourceResultsArticle);
				tbodyRows("tbodySourceSupplyGroup",tbodySourceSupplyGroup,array_data["rowsArticleGroups"],false);
				$('#sourceResultsArticle').html($("#tbodySourceSupplyGroup").html());
				stringArticles="";
				for (var i=0;i<array_data["rowsArticleGroups"].length;i++) {
					var stringArticles="";
					stringArticles=purchaseSupplyArticlesEntries(array_data["rowsArticleGroups"][i].group_id);				
					$('#sourceResultsArticleList'+array_data["rowsArticleGroups"][i].group_id).html(stringArticles);
				
				}

				$('#sourceResultsArticleDiv').html($('#sourceResultsArticle').html());
				//$('#sourceResultsArticleDiv').css("display","table");
				$('#sourceResultsArticleDiv').css({"display":"block","height":"500","overflow":"auto"});
				
			}
		});
	
	
	
}

function purchaseSupplyArticlesEntries(group_id) {
	var stringArticles="";
	var arrayArticles=new Array();
	var z=-1;
	for (var ii=0;ii<array_data["rowsArticle"].length;ii++) {
		if (array_data["rowsArticle"][ii].group_id==group_id) {
			z++;
			arrayArticles[z]=new Array();
			arrayArticles[z]=array_data["rowsArticle"][ii];							
		}
	}
	
	stringArticles=tbodyRows("tbodySourceSupplyArticleMaster",tbodySourceSupplyArticleMaster,arrayArticles,false);
	return (stringArticles);
}

function purchaseSupplyMark(string) {
	//var dialogId=$("form#dialogSourceSupply");
	//var searchString=dialogId.find('input[name="searchString"]').val();
	//var mark="<span style='color:#fff'>"+searchString+"</span>";	
	//string=string.replace(searchString,mark);
	
	return string;
}

function purchaseEnquiryInit() {
	console.log("purchase.js -> purchaseEnquiryInit called by mainMeu");
	console.log("nothing to do back to mainMeu");
	} // end function mainMenu

function registerMenuPurchase(modul) {
	console.log("function purchase.js -> registerMenuPurchase: "+modul);
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
						"orderID" : orderID,
						"isHTML" : isHTML
					}
				)}
			);


		switch (modul) {
		default:
			//console.log(modul);
			//console.log(parameter)
			break;
		
		} // end switch modul
		
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "/"+modul,
				data : data,
				success : function(data) {
					array_data = getDataContent(data);

					if (content==undefined) {
						content=array_data["html"];
						var len=_htmlContent.length;
						_htmlContent[len]=new Array();
						_htmlContent[len].modul=modul;
						_htmlContent[len].content=content;
					}
					
					$('div.contentPurchase').html(content);
					var jsModul=modul+"()";
					eval(jsModul);
				}
			});
		
	} // end registerMenupurchaseMaster
function purchaseBookIconMenuControl(item) {
	$('#purchaseBookIconMenu').css("display","none");
	switch (item) {
	case "voucher":
		ticketFiles(array_data["rowPurchaseOrder"].ticketID);
		break;
	case "catalogue":
		showCatalogue(array_data["rowPurchaseOrder"].supplier_firmID);
		//showCatalogue(326);
		break;
	case "print":
		purchaseBookDialogPrint();
		break;
	case "email":
		purchaseBookDialogEmail();
		break;
	case "exam":
		purchaseBookDialogExam();
		break;
	case "bank":
		purchaseBookDialogBank();
		break;
	}
}

function purchaseRequisitionIconMenuControl(item) {
	
	switch (item) {
	case "voucher":
		ticketFiles(array_data["rowPurchaseOrder"].ticketID);
		break;
	case "catalogue":
		showCatalogue(array_data["rowPurchaseOrder"].supplier_firmID);
		//showCatalogue(326);
		break;
	case "print":
		purchaseBookDialogPrint();
		break;
	case "email":
		purchaseBookDialogEmail();
		break;
	case "exam":
		purchaseBookDialogExam();
		break;
	}
}

function purchaseEnquiryIconMenuControl(item) {
	
	switch (item) {
	case "voucher":
		ticketFiles(array_data["rowPurchaseOrder"].ticketID);
		break;
	case "catalogue":
		showCatalogue(array_data["rowPurchaseOrder"].supplier_firmID);
		//showCatalogue(326);
		break;
	case "print":
		purchaseBookDialogPrint();
		break;
	case "email":
		purchaseBookDialogEmail();
		break;
	case "exam":
		purchaseBookDialogExam();
		break;
	}
}

function purchaseBookAdd() {
	orderID=-1;
	registerMenuPurchase('purchaseOrderInit');
}

function purchaseOrderInit() {
	
	
	var string=$('#baseOrderPositions').html();
	string=string.replace("[OrderPurchase]","PurchaseOrder");
	string=string.replace("[color]","#00ff00");
	while ($('#basePurchaseOrderPositionsDiv').html()=="")
		$('#basePurchaseOrderPositionsDiv').html(string);

	$('#baseTotalSumDiv').html($('#baseTotalSum').html());
	var y = $('#navtabs').width();
	
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerPurchaseOrder').css('text-decoration','underline');
	$('#navtabs').find('#registerPurchaseOrder').css('color','blue');
	
	workflowStatusChecked(array_data["rowPurchaseOrder"].workflowStatus);

	var dialogId=$("form#dialogPurchaseOrder");
	arraySelect = [ 
		{
			"field": "supplier_company",
			"rows": array_data["rowsFirms"],
			"autocomplete": 1,
			"label": "company",
			"value": "company"
		}
		]
	dialogId.find('input[name="supplier_company"]').change( function() {
		var dialogId=$("form#dialogPurchaseOrder");
		purchaseOrderNewGetArticles(dialogId);
	})
	dialogInitSelect(dialogId,arraySelect);
	
	if (array_data["rowPurchaseOrder"].orderID!=undefined) {
		console.log("bestehender Auftrag");
		supplier_firmID=array_data["rowPurchaseOrder"].supplier_firmID;
		dialogId.find('input[name="orderID"]').val(array_data["rowPurchaseOrder"].orderID);
		dialogInit(dialogId,array_data["rowPurchaseOrder"]);
	} else {
		console.log("neu");
		supplier_firmID=-1;
		dialogId.find('input[name="orderID"]').val(-1);
		dialogId.find("input[name='date']").datepicker(datepickerGerman);
	}
	

	dialogId.find("input[name='saveOrder']").click(function () {
		var dialogId=$("form#dialogPurchaseOrder");	
		var workflowStatus=array_data["rowPurchaseOrder"].workflowStatus;
		workflowStatusChecked(workflowStatus+",BE");
		phpModul="/purchaseOrderSave";
			postFunction="";
			dialogSave(dialogId,orderID,phpModul,postFunction)
			});
	$('#newVoucherNo').html("("+array_data["newVoucherNo"]+")")
	totalSum(dialogId,array_data["rowsPurchaseOrderPositions"]);

	var dialogId=$("form#dialogPurchaseOrderPositions");
	var obj={};
	obj.dialogId=dialogId;
	obj.htmlId="tbodyPurchaseOrderPositions";
	obj.orderID=orderID;
	obj.phpModulSave="purchaseOrderPositionSave";
	obj.postFunction="purchaseOrderPositionSavePost()";
	obj.firmID=supplier_firmID;
	obj.tbody=$('#tbodyPurchaseOrderPositions').html();
	obj.rowsPositions=array_data["rowsPurchaseOrderPositions"];
	/* get following to array by fetchin order-data
	 * 
	 */
	obj.rowsArticle=array_data["rowsArticle"];
	obj.rowsVariation=array_data["rowsVariation"];
	obj.rowsVariationSpec=array_data["rowsVariationSpec"];
	obj.rowsVAT=array_data["rowsVAT"];
	setTimeout(function() {
		  // load complete htmlDivs
		classPosition = new _Position(obj);
		classPosition.sayHi();
		}, 1000);


}

function purchaseOrderNewGetArticles(dialogId) {
	//var dialogId=$("form#dialogPurchaseOrder");
	console.log(dialogId);
	supplier_company=dialogId.find('input[name="supplier_company"]').val();
	
	var data = {
			"supplier_company" : supplier_company
		};

		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
	console.log(data);	
		$.ajax({
			type : "POST",
			url : '/purchaseGetArticles',
			dataType : "json",
			data : data,
			success : function(data) {
					var array = getDataContent(data);
					supplier_firmID=array_data["rowsArticle"][0].firmID;
					classPosition.firmID=supplier_firmID;
					console.log(array_data["rowsFirmsComplete"]);
					for (var i=0;i<array_data["rowsFirmsComplete"].length;i++) {
						if (array_data["rowsFirmsComplete"][i].firmID==supplier_firmID) {
							console.log(array_data["rowsFirmsComplete"][i]);
							dialogInit(dialogId,array_data["rowsFirmsComplete"][i]);
							break;
						}
					}
					classPosition.rowsArticle=array_data["rowsArticle"];
					classPosition.rowsVariation=array_data["rowsVariation"];
					classPosition.rowsVariationSpec=array_data["rowsVariationSpec"];
					rowsArticle=array_data["rowsArticle"];
					rowsArticleFilter="S";
					var autoCompleteArticle=new Array();
					var a=-1;
					for (var i = 0; i < rowsArticle.length; i++) {
						
						if (rowsArticleFilter=='' 
							|| rowsArticleFilter==rowsArticle[i].kind) {
						autoCompleteArticle[++a] = {
							'value' : rowsArticle[i].article_code,
							'label' : rowsArticle[i].article_code+" "+rowsArticle[i].name
						}
						}
					}
					classPosition.autoCompleteArticle=autoCompleteArticle;
					classPosition.dialogId.find('input[name="article_code"]').autocomplete({
						source : classPosition.autoCompleteArticle,
						minLength : 0
					});

					classPosition.sayHi();
			}
		});
	
}

function purchaseOrderPositionSavePost() {
	console.log(array_data["rows"]);
	
	if (orderID>1) return;
		
	orderID=array_data["rows"][0].orderID;
	
	var dialogId=$("form#dialogPurchaseOrder");
	dialogId.find('input[name="orderID"]').val(orderID);
	alert(dialogId.find('input[name="orderID"]').val());
	phpModul="/purchaseOrderSave";
	postFunction="";
	dialogSave(dialogId,orderID,phpModul,postFunction)
}

function purchaseOrderStoreInit() {
//	var dialogId=$("form#dialogPurchaseOrderPositions");
	
	
	if (tbodyPurchaseOrderStorePositions=="")
		tbodyPurchaseOrderStorePositions=$("#tbodyPurchaseOrderStorePositions").html();
	tbodyRows("tbodyPurchaseOrderStorePositions",tbodyPurchaseOrderStorePositions,array_data["rowsPurchaseOrderPositions"]);
	
	var ownArticle=false;
	for (var i=0;i<array_data["rowsOwnArticle"].length;i++) {
		if (array_data["rowsPurchaseOrderPositions"][0].article_id==array_data["rowsOwnArticle"][i].id) {
			ownArticle=true;
			break;
		}
	}
	//purchaseOrderStoreBooking
	if (ownArticle) {
		if (tbodyOrderStoreTransactionPositions=="")
			tbodyOrderStoreTransactionPositions=$("#tbodyOrderStoreTransactionPositions").html();
		tbodyRows("tbodyOrderStoreTransactionPositions",tbodyOrderStoreTransactionPositions,array_data["rowsStockTransaction"]);
		$('#purchaseOrderStoreBooking').css("display","table");
	} else {
		$('#purchaseOrderStoreBooking').css("display","none");
	}
}

function purchaseOrderIncomingInit() {
//	var dialogId=$("form#dialogPurchaseOrderPositions");
	/*
	if (tbodyOrderIncomingPositions=="")
		tbodyOrderIncomingPositions=$("#tbodyPurchaseOrderStorePositions").html();
	tbodyRows("tbodyPurchaseOrderStorePositions",tbodyOrderIncomingPositions,array_data["rowsPurchaseOrderPositions"]);
	*/
	
	var dialogId=$("form#dialogPurchaseOrderIncoming");
	dialogInit(dialogId,array_data["rowPurchaseOrder"]);
	var supplier_firmID=array_data["rowPurchaseOrder"].supplier_firmID;
	dialogId.find('input[name="orderID"]').val(orderID);
	var dialogId=$("form#dialogPurchaseOrderPositions");
	//array_data["rowPurchaseOrder"].supplier_firmID,

	var obj= {
			"className" : "classPosition",
			"dialogId" : dialogId,
			"htmlId" : "tbodyPurchaseOrderIncomingPositions",
			"orderID" : orderID,
			"phpModulSave" : 'purchaseOrderIncomingPositionSave',
			"firmID" : supplier_firmID, 
			"tbody" : $('#tbodyPurchaseOrderIncomingPositions').html(),
			"rowsPositions" : array_data["rowsPurchaseOrderPositions"],
			"dataRowsName": "rowsPurchaseOrderPositions",
			"rowsArticleFilter": "",
			"rowsArticle" : array_data["rowsArticle"],
			"rowsVariation" : array_data["rowsVariation"],
			"rowsVariationSpec" : array_data["rowsVariationSpec"],
			"rowsVAT" : array_data["rowsVAT"]
	}
	/* postFunction
	 * if not defined => _refresh
	 */
	// , "postFunction" : "purchaseOrderIncomingPostR()"

	classPosition = new _Position(obj);
	classPosition.sayHi();

	var dialogId=$("form#dialogPurchaseOrderPositionsR");
	dialogId.find('input[name="orderID"]').val(orderID);
	//array_data["rowPurchaseOrder"].supplier_firmID,

	var obj= {
			"className" : "classPositionR",
			"dialogId" : dialogId,
			"htmlId" : "tbodyPurchaseOrderIncomingPositionsR",
			"orderID" : orderID,
			"phpModulSave" : "purchaseOrderIncomingPositionSaveR",
			"firmID" : supplier_firmID, 
			"tbody" : $('#tbodyPurchaseOrderIncomingPositionsR').html(),
			"rowsPositions" : array_data["rowsPurchaseOrderPositionsR"],
			"dataRowsName": "rowsPurchaseOrderPositionsR",
			"rowsArticleFilter": "",
			"rowsArticle" : array_data["rowsArticle"],
			"rowsVariation" : array_data["rowsVariation"],
			"rowsVariationSpec" : array_data["rowsVariationSpec"],
			"rowsVAT" : array_data["rowsVAT"]		
	}
	/* postFunction
	 * if not defined => _refresh
	 */
	// , "postFunction" : "purchaseOrderIncomingPostR()"
		
	classPositionR = new _Position(obj);
	classPositionR.sayHi();

}

function purchaseOrderIncomingPositionSave() {
	alert('positionSave');
	classPosition._savePostition();
	/*
	var dialogId=$("form#dialogPurchaseOrderPositions");
	var postFunction="";
	var phpModul="/purchaseOrderIncomingPositionSave";
	dialogSave(dialogId,-1,phpModul,postFunction);
	*/
return;

}
function purchaseOrderIncomingPositionRSave() {
	alert('positionRSave');
	classPositionR._savePostition();
	/*
	var dialogId=$("form#dialogPurchaseOrderPositionsR");
	var postFunction="";
	var phpModul="/purchaseOrderIncomingPositionSaveR";
	dialogSave(dialogId,-1,phpModul,postFunction);
	*/
}

function purchaseOrderIncomingPost() {
	alert("post");
}

function purchaseOrderIncomingPostR() {
	alert("postR");
}
function purchaseOrderInvoiceInit() {
	$('#baseTotalSumDiv').html($('#baseTotalSum').html());
//	var dialogId=$("form#dialogPurchaseOrderPositions");
	if (tbodyOrderInvoicePositions=="")
		tbodyOrderInvoicePositions=$("#tbodyPurchaseOrderPositions").html();
	tbodyRows("tbodyPurchaseOrderPositions",tbodyOrderInvoicePositions,array_data["rowsPurchaseOrderPositions"]);
	var dialogId=$("form#dialogPurchaseOrderInvoice");
	dialogInit(dialogId,array_data["rowPurchaseOrder"]);
	for (var i=0;i<array_data["rowsPurchaseOrderPositions"].length;i++) 
		dialogInit(dialogId,array_data["rowsPurchaseOrderPositions"][i]);
	totalSum(dialogId,array_data["rowsPurchaseOrderPositions"]);
}

function purchaseOrderBookingInit() {
//	var dialogId=$("form#dialogPurchaseOrderPositions");
	$('#baseTotalSumDiv').html($('#baseTotalSum').html());
	
	if (tbodyOrderInvoicePositions=="")
		tbodyOrderInvoicePositions=$("#tbodyPurchaseOrderPositions").html();
	tbodyRows("tbodyPurchaseOrderPositions",tbodyOrderInvoicePositions,array_data["rowsPurchaseOrderPositions"]);
	
	var dialogId=$("form#dialogPurchaseOrderBooking");
	$('#paymentInfo').html(array_data["rowPaymentInfo"]);
	dialogInit(dialogId,array_data["rowPurchaseOrder"]);

	totalSum(dialogId,array_data["rowsPurchaseOrderPositions"]);
	
	$("#dialogBookingAccountFindDiv").dialog({
		width : 800,
		height : 400,
		modal : true,
		autoOpen : false
	});

	
	$('#bookingMask').html($('#dialogBookingDivKF').html());
	dialogBookingInitKF();
	
}

function purchaseOrderMessagesInit() {
	
	var dialogId=$("form#dialogPurchaseOrderMessages");
	dialogInit(dialogId,array_data["rowPurchaseOrder"]);

	var dialogId=$("form#dialogPurchaseOrderMessages");
	dialogId.find("input[name='date']").datepicker(datepickerGerman);
	
	dialogId.find("input[name='newMessage']").click(function () {
		purchaseOrderMessagesNew();
	});
	
	dialogId.find("input[name='saveMessage']").click(function () {
		var modul="purchaseOrderMessagesSave";
		var postFunction='tbodyRows("tbodyOrderMessagePositions",tbodyOrderMessagePositions,array_data["rowsMessages"])';
		dialogSave(dialogId,id,modul,postFunction);
	});
	
	dialogId.find("select[name='kind']").change(function() {
			var kind=this.value;
			for (var i=0;i<array_data["rowsTextmodules"].length;i++) {
				if (array_data["rowsTextmodules"][i].kind==kind
						&& array_data["rowsTextmodules"][i].division=="E") {
					dialogId.find("textarea[name='message']").val(array_data["rowsTextmodules"][i].content);
					break;
				}
			}
		
		});
	
	var kind=dialogId.find("select[name='kind']").val();
	
	for (var i=0;i<array_data["rowsTextmodules"].length;i++) {
		if (array_data["rowsTextmodules"][i].kind==kind
				&& array_data["rowsTextmodules"][i].division=="E") {
			dialogId.find("textarea[name='message']").val(array_data["rowsTextmodules"][i].content);
			break;
		}
	}
	
	if (tbodyOrderMessagePositions=="")
		tbodyOrderMessagePositions=$("#tbodyOrderMessagePositions").html();
	tbodyRows("tbodyOrderMessagePositions",tbodyOrderMessagePositions,array_data["rowsMessages"]);
}

function purchaseOrderMessagesDelete(id) {
	var dialogId=$("form#dialogPurchaseOrderMessages");
	var modul="purchaseOrderMessagesDelete";
	var postFunction='tbodyRows("tbodyOrderMessagePositions",tbodyOrderMessagePositions,array_data["rowsMessages"])';
	dialogDeleteId(dialogId,id,modul,postFunction)
}

function purchaseOrderMessagesEdit(id) {
	var dialogId=$("form#dialogPurchaseOrderMessages");
	for (var i=0;i<array_data["rowsMessages"].length;i++) {
		if (array_data["rowsMessages"][i].id==id) {
			var row=array_data["rowsMessages"][i];
			break;
		}
	}
	dialogInit(dialogId,row);
}

function purchaseOrderMessagesNew() {
	var dialogId=$("form#dialogPurchaseOrderMessages");
	dialogId.find('input[name="id"]').val(-1);
	
	dialogId.find('input[name="date"]').val('');
	dialogId.find('input[name="subject"]').val('');
	dialogId.find('input[name="post_out_date"]').val('');
	
	dialogId.find('select[name="kind"]').val('GB');
	var kind=dialogId.find("select[name='kind']").val();
	
	for (var i=0;i<array_data["rowsTextmodules"].length;i++) {
		if (array_data["rowsTextmodules"][i].kind==kind
				&& array_data["rowsTextmodules"][i].division=="E") {
			dialogId.find("textarea[name='message']").val(array_data["rowsTextmodules"][i].content);
			break;
		}
	}
	
	
}

function purchaseOrderStoreChange() {
	var dialogId=$('#dialogPurchaseOrderStore');
	var store=dialogId.find("select[name='storeSelect']").val();
	$('#dialogStoreDiv').html($('#'+store).html());
	return;
}

function purchasePosition2stock(id,postFunction='') {
	/**
	 * id is id ob purchase_positions
	 */
	var dialogId=$('#dialogPurchaseOrderStore');
	dialogId.find('input[name="positionID"]').val(id);
	dialogId.find('input[name="orderID"]').val(orderID);
	var rowsPositions=array_data["rowsPurchaseOrderPositions"];
	
	var variation1_id = 0;
	var variation2_id = 0;
	for (var i = 0; i < rowsPositions.length; i++) {
		if (rowsPositions[i].id == id) {
			rowPosition = rowsPositions[i];
			article_id = rowsPositions[i].article_id;
			variation1_id = rowsPositions[i].variation1_id;
			variation2_id = rowsPositions[i].variation2_id;
			break;
		}
	}

	var data = {
		"orderID" : orderID,
		"article_id" : article_id,
		"variation1_id" : variation1_id,
		"variation2_id" : variation2_id
	};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	$.ajax({
		type : "POST",
		url : '/purchaseOrderStoreGetStock',
		dataType : "json",
		data : data,
		success : function(data) {
				var array_temp = getDataContent(data);
				rowsStock = array_temp['rowsStock'];
				var store = array_temp['store'];
				dialogId.find("select[name='storeSelect']").val(store);
				purchaseOrderStoreChange(store);
				
				var rowsPositions=array_data["rowsPurchaseOrderPositions"];
				for (var i = 0; i < rowsPositions.length; i++) {
					if (rowsPositions[i].id == id) {
						dialogInit($("#dialogPurchaseOrderStore"),rowsPositions[i]);
						
						var disponible = 0;
						var real = 0;
						for (var i = 0; i < rowsStock.length; i++) {
							switch (rowsStock[i]['transaction']) {

							case "I":
								disponible += parseFloat(rowsStock[i]['sum'])
								real += parseFloat(rowsStock[i]['sum'])
								break;
							case "O":
								// disponible+=parseFloat(rowsStock[i]['sum'])
								real -= parseFloat(rowsStock[i]['sum'])
								break;
							case "R":
								disponible -= parseFloat(rowsStock[i]['sum'])
								// real-=parseFloat(rowsStock[i]['sum'])
								break;
							case "P":
								// disponible+=parseFloat(rowsStock[i]['sum'])
								// real-=parseFloat(rowsStock[i]['sum'])
								break;

							}
						}
						
						$('#disponibleQuantity').html('(' + disponible + ')');
						$('#realQuantity').html('(' + real + ')');
						dialogId.find('input[name="disponible"]').val(disponible);
						dialogId.find('input[name="real"]').val(real);

						break;
					}
				}
				if (postFunction!='')
					eval(postFunction);
		} // end ajax success

	}); // end ajax


	dialogId.find("select[value='storeAssets']").attr('disabled', 'disabled');
	dialogId.find("select[value='storePackage']").attr('disabled', 'disabled');
	dialogId.find("select[value='storeOther']").attr('disabled', 'disabled');
	$('select[name="transaction"]').focus();
	return;
}

function purchaseOrderStoreTransactionEdit(id) {
	var dialogId=$("form#dialogPurchaseOrderStore");
	dialogId.find('input[name="id"]').val(id);
	alert("aber hallo");
	var data = {
			"id" : id,
			"division" : "E"
		};

		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
		
		$.ajax({
			type : "POST",
			url : '/storeGetTransaction',
			dataType : "json",
			data : data,
			success : function(data) {
					var array = getDataContent(data);
					var row=array["rowStoreTransaction"];
					dialogId.find('select[name="transaction"]').val(row.transaction);
					
					
			}
		});
}

function purchaseOrderStoreTransactionSave() {
	var dialogId=$('#dialogPurchaseOrderStore');
	var modul="purchaseOrderStoreSave";
	
	var postFunction='tbodyRows("tbodyPurchaseOrderStorePositions",tbodyPurchaseOrderStorePositions,array_data["rowsPurchaseOrderPositions"])';
	
	dialogSave(dialogId,id,modul,postFunction);
	
	//alert(dialogId.find("select[name='storeSelect']").val());
}

function purchaseOrderInvoiceSave() {
	var dialogId=$('#dialogPurchaseOrderInvoice');
	var modul="purchaseOrderInvoiceSave";
	//alert(orderID);
	dialogSave(dialogId,orderID,modul);
	return;
}

function purchaseBookDialogPrint(sendEmail=0) {
	
	dialogId=$('form#dialogPurchasePrint');
	dialogId.find('input[name="orderID"]').val(orderID);
	
	var data = {
			"action" : "init",
			"orderID" : orderID
		};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	modul="/purchasePrintPrepare"
		$.ajax({
			type : "POST",
			dataType : "json",
			url : modul,
			data : data,
			success : function(data) {
				var arrayData = getDataContent(data);
				var workflowStatus=arrayData["workflowStatus"];
				var messages=arrayData["rowsPurchaseMessages"];
				var array=workflowStatus.split(',');
				
				dialogId.find('input[type=checkbox]').each(function() {     
				    var name=this.name;
				    dialogId.find('input[name="'+name+'"]').attr("disabled", true);
				    })
				    
				    if (_session.status==4) {
				    	dialogId.find('input[name="_debug"]').removeAttr("disabled");
				    	$('#_debugId').css("display","table");
				    }
				    	
				for (var i=0;i<array.length;i++) {
					var field="cb_"+array[i];
					dialogId.find('input[name="'+field+'"]').removeAttr("disabled");
				}
				arraySelect = [ 
					{
						"field": "cb_GB",
						"rows": arrayData["rowsPurchaseMessages"],
						"label": "subject",
						"value": "id",
						"blank": {
							"label":"--- select ---",
							"value":-1
						}
					}
					]
				dialogInitSelect(dialogId,arraySelect);
				
				if (sendEmail==0) {
					$("#purchaseSendAttachmentDiv").css("display","none");
					$("#dialogPurchasePrintDiv").dialog(
							{
								title : "Druckvorschau orderID# "+orderID,
								width: 1000,
								height: 450,
								buttons : {
									Close : function() {
										$(this).dialog("close");
									}
								}
							}).dialog("open");

				} else {
					$("#purchaseSendAttachmentDiv").css("display","table");
					files="";
					dialogId.find('input[type=file]').val('');
					$('input[type=file]').on('change', prepareUpload);
					$("#dialogPurchasePrintDiv").dialog(
							{
								title : "Druckvorschau orderID# "+orderID,
								width: 1000,
								height: 450,
								buttons : {
									Close : function() {
										$(this).dialog("close");
									},
									Send : function() {
											purchaseBookDialogPrintPreview(1);
										}									
									}
							}).dialog("open");					
				}	
			} // end ajax success
			}) // end ajax
}

function purchaseBookDialogPrintPreview(sendEmail=0) {
	var dialogId=$('form#dialogPurchasePrint');
	var orderID=dialogId.find('input[name="orderID"]').val();
	var GB=dialogId.find('select[name="cb_GB"]').val();
	var printForm=dialogId.find('select[name="printForm"]').val();
	var printLang=dialogId.find('select[name="printLang"]').val();

	var data={
			"orderID": orderID,
			"cb_GB" : GB,
			"printForm" : printForm,
			"printLang" : printLang,
			"sendEmail" : sendEmail,
			"timestamp": new Date().getTime()
	}

	dialogId.find('input[type=checkbox]').each(function () {
		if (this.checked) {
			data[this.name]=1;
		} else {
			data[this.name]=0;
		}
	});

	
	var modul="purchasePrint";
	var postFunction='';
	
		
		
		if (sendEmail==1) {
			/* dialogSave
			 * handle sending E-Mail by dialogSave
			 * dialogSave collect files
			 * data are overhanded, for dialogSave no need
			 * call purchsePrint via ajax
			 */
			id=orderID;
			modul="/purchasePrint";
			postFunction='';
			dialogSave(dialogId,id,modul,postFunction,data);
		} else {
			data=JSON.stringify(data);
			$('#previewFilePurchasePrint').attr('src',"/purchasePrint?data="+data);
		}

}

function purchaseBookDialogEmail() {
	/* purchaseBookDialogPrint(sendEmail=0)
	 * @see: purchaseBookDialogPrint with parameter 1=sendEmail
	 */
	purchaseBookDialogPrint(1)
}

function purchaseBookDialogExam() {
	
	$("#dialogPurchaseExamDiv").dialog(
			{
				title : "Exam aus orderID# "+orderID,
				width: 1000,
				height: 300,
				buttons : { 
					Save : function () {
						alert("save and close");
						$(this).dialog("close");
					},
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	

	var srcString = '<div><iframe id="frame" style="width:100%; height:450px;" frameBorder=0></iframe></div>';
	$("#srcPrint").html(srcString);
}

function purchaseBookDialogBank() {
	
	var row=array_data["rowPurchaseOrder"];
	var invoiceDate=dateSql2German(row.invoiceDate);
	var title="Transactionen mit "+row.supplier_company+" seit: "+invoiceDate;
	$("#dialogPurchaseBankDiv").dialog(
			{
				title : title,
				width: 700,
				height: 300,
				buttons : { 
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	

	
	var string="";
	var supplier_firmID=array_data["rowPurchaseOrder"].supplier_firmID;
	var data = {
			"senderFirmID" : _session.firmID,
			"remitteeFirmID" : supplier_firmID,
			"dateFrom" : array_data["rowPurchaseOrder"].invoiceDate
		};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	var htmlId=$("#dialogPurchaseBankJournalRows");
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "/accountancyBankTransactionsFirm",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			var htmlId=$('#dialogPurchaseBankJournalRows');
			var tbody=htmlId.html();
			tbodyRows('dialogPurchaseBankJournalRows',tbody,array_data["rowsTransactions"]);
		}
	});
	
}

