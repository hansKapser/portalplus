var orderID=-1;
var classPosition;
var tbodyOrderPositions="";
var tbodyOrderStorePositions="";
var tbodyOrderStoreTransactionPositions="";
var tbodyOrderDispatchPositions="";
var tbodyOrderReceiptPositions="";
var tbodyOrderCreditPositions="";
var tbodyOrderPackagePositions="";
var tbodyOrderInvoicePositions="";
var tbodyOrderMessagePositions="";

function sellingInit() {
console.log("selling.js -> sellingInit called by mainMeu");
console.log("nothing to do back to mainMeu");

if (orderID>0) {
	indexMenuSelling("sellingBookInit",true);
	setTimeout(function(){
		registerMenuSelling("sellingOrderInit");
	},500);
}

} // end function mainMenu


function registerMenuSelling(registerModul) {
	console.log("function selling.js -> registerMenuSelling: "+registerModul);

		switch (registerModul) {
		default:
			// console.log(modul);
			// console.log(parameter)
			break;
		
		} // end switch modul
		var data = {
				"action" : "init",
				"orderID" : orderID
			};
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
		
			$.ajax({
				type : "POST",
				dataType : "json",
				url : "/"+registerModul,
				data : data,
				success : function(data) {
					array_data = getDataContent(data);
					content=array_data["html"];
					console.log("div.contentSelling'");
					
					$('div.contentSelling').html(content);
					var jsModul=registerModul+"()";
					eval(jsModul);
				}
			});
		
	} // end registerMenusellingMaster

function sellingBookIconMenuControl(item) {
	$('#sellingBookIconMenu').css("display","none");
	
	switch (item) {
	case "voucher":
		ticketFiles(array_data["rowSellingOrder"].ticketID);
		break;
	case "catalogue":
		showCatalogue(_session.firmID);
		// showCatalogue(326);
		break;
	case "print":
		sellingBookDialogPrint();
		break;
	case "email":
		sellingBookDialogEmail();
		break;
	case "exam":
		sellingBookDialogExam();
		break;
	}
}

function sellingKKIconMenuControl(item) {
	
	switch (item) {
	case "voucher":
		ticketFiles(array_data["rowSellingOrder"].ticketID);
		break;
	case "catalogue":
		showCatalogue(array_data["rowSellingOrder"].supplier_firmID);
		// showCatalogue(326);
		break;
	case "print":
		sellingBookDialogPrint();
		break;
	case "email":
		sellingBookDialogEmail();
		break;
	case "exam":
		sellingBookDialogExam();
		break;
	}
}

function sellingOrderInit() {
	var y = $('#navtabs').width();
	
	$('#li_icon_menu').css('right', 10);
	$('#sellingBookIconMenu').css('right', 500);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('#'+this.id).css('text-decoration','underline');
		
	});
	
	workflowStatusChecked(array_data["rowSellingOrder"].workflowStatus);

	var string=$('#baseOrderPositions').html();
	string=string.replace("[OrderPurchase]","Order");
	string=string.replace("[color]","#ff0000");
	$('#baseOrderPositionsDiv').html(string);
	
	$('#baseTotalSumDiv').html($('#baseTotalSum').html());

	
	var dialogId=$("form#dialogSellingOrder");
	arraySelect = [ 
		{
			"field": "customer_company",
			"rows": array_data["rowsFirms"],
			"autocomplete": 1,
			"label": "company",
			"value": "company"
		}
		]
	
	dialogId.find('input[name="customer_company"]').change( function() {
		var dialogId=$("form#dialogSellingOrder");
		sellingOrderNewGet(dialogId);
	})

	dialogInitSelect(dialogId,arraySelect);
	
	if (array_data["rowSellingOrder"].orderID!=undefined) {
		console.log("bestehender Auftrag");
		supplier_firmID=array_data["rowSellingOrder"].supplier_firmID;
		dialogId.find('input[name="orderID"]').val(array_data["rowSellingOrder"].orderID);
		dialogInit(dialogId,array_data["rowSellingOrder"]);
	} else {
		console.log("neu");
		supplier_firmID=-1;
		dialogId.find('input[name="orderID"]').val(-1);
		dialogId.find("input[name='date']").datepicker(datepickerGerman);
	}
	

	dialogId.find("input[name='saveOrder']").click(function () {
		var dialogId=$("form#dialogSellingOrder");	
		var workflowStatus=array_data["rowSellingOrder"].workflowStatus;
		workflowStatusChecked(workflowStatus+",AB");
		phpModul="/sellingOrderSave";
			postFunction="";
			dialogSave(dialogId,orderID,phpModul,postFunction)
			});
	$('#newVoucherNo').html("("+array_data["newVoucherNo"]+")")

	var dialogId=$("form#dialogSellingOrder");
	dialogInit(dialogId,array_data["rowSellingOrder"]);
	totalSum(dialogId,array_data["rowsOrderPositions"]);
	
	var dialogId=$("form#dialogSellingOrderPositions");
	var obj={};
	obj.dialogId=dialogId;
	obj.htmlId="tbodyOrderPositions";
	obj.orderID=orderID;
	obj.phpModulSave="sellingOrderPositionSave";
	obj.firmID=_session.firmID;
	obj.tbody=$('#tbodyOrderPositions').html();
	obj.rowsPositions=array_data["rowsOrderPositions"];
	/*
	 * get following to array by fetchin order-data
	 * 
	 */
	obj.rowsArticle=array_data["rowsOwnArticle"];
	obj.rowsVariation=array_data["rowsOwnVariation"];
	obj.rowsVariationSpec=array_data["rowsOwnVariationSpec"];
	obj.rowsVAT=array_data["rowsVAT"];
	setTimeout(function() {
		  // load complete htmlDivs
		classPosition = new _Position(obj);
		classPosition.sayHi();
		}, 1000);

}

function sellingOrderStoreInit() {
// var dialogId=$("form#dialogSellingOrderPositions");
	$('#dialogStoreDiv').html($('#storeHW').html());
	
		for (var i=0;i<array_data["rowsOrderPositions"].length;i++) {
			var id=array_data["rowsOrderPositions"][i].id;
			var stockR=0;
			var stockO=0;
			for (var ii=0;ii<array_data["rowsStockTransactionS"].length;ii++) {
				if (array_data["rowsStockTransactionS"][ii].positionID==array_data["rowsOrderPositions"][i].id) {
					if (array_data["rowsStockTransactionS"][ii].transaction=='R' 
						&& array_data["rowsStockTransactionS"][ii].quantity==array_data["rowsOrderPositions"][i].quantity)
						stockR=1;
					if (array_data["rowsStockTransactionS"][ii].transaction=='R' 
						&& array_data["rowsStockTransactionS"][ii].quantity!=array_data["rowsOrderPositions"][i].quantity)
						stockR=-1;
					if (array_data["rowsStockTransactionS"][ii].transaction=='O' 
						&& array_data["rowsStockTransactionS"][ii].quantity==array_data["rowsOrderPositions"][i].quantity)
						stockO=1;
					if (array_data["rowsStockTransactionS"][ii].transaction=='O' 
						&& array_data["rowsStockTransactionS"][ii].quantity!=array_data["rowsOrderPositions"][i].quantity)
						stockO=-1;
					
				}
			}
			
			array_data["rowsOrderPositions"][i].stockR=stockR;
			array_data["rowsOrderPositions"][i].stockO=stockO;
		}
	
		
	if (tbodyOrderStorePositions=="")
		tbodyOrderStorePositions=$("#tbodyOrderStorePositions").html();
	tbodyRows("tbodyOrderStorePositions",tbodyOrderStorePositions,array_data["rowsOrderPositions"]);
	
	if (tbodyOrderStoreTransactionPositions=="")
		tbodyOrderStoreTransactionPositions=$("#tbodyOrderStoreTransactionPositions").html();
	tbodyRows("tbodyOrderStoreTransactionPositions",tbodyOrderStoreTransactionPositions,array_data["rowsStockTransaction"]);

}

function sellingOrderDispatchInit() {
// var dialogId=$("form#dialogSellingOrderPositions");

	if (tbodyOrderDispatchPositions=="")
		tbodyOrderDispatchPositions=$("#tbodyOrderDispatchPositions").html();
	tbodyRows("tbodyOrderDispatchPositions",tbodyOrderDispatchPositions,array_data["rowsOrderPositions"]);
	
	var dialogId=$("form#dialogSellingOrderDispatch");
	dialogInit(dialogId,array_data["rowSellingOrder"]);
	$('#_orderNo').html(array_data["rowSellingOrder"].orderNo);
	
	var array=new Array();
	array[0]=new Array();
	array[0]={
			"rows" : array_data["rowsPostFees"],
			"field" : "DHL_packets1",
			"label" : "name",
			"value" : "id"
	};
	array[1]=new Array();
	array[1]={
			"rows" : array_data["rowsPostFees"],
			"field" : "DHL_packets2",
			"label" : "name",
			"value" : "id"
	};
	array[2]=new Array();
	array[2]={
			"rows" : array_data["rowsPostFees"],
			"field" : "DHL_packets3",
			"label" : "name",
			"value" : "id"
	};
	
	dialogInitSelect(dialogId,array);
	
	var rowsDHLPositions=array_data["rowsOrderDHLPositions"];
	var z=0;
	for (var i=0;i<rowsDHLPositions.length;i++) {
		z++;
		dialogId.find('input[name="DHL_quantity'+z+'"]').val(rowsDHLPositions[i].quantity);
		dialogId.find('select[name="DHL_packets'+z+'"]').val(rowsDHLPositions[i].DHL_id);
	}
	
	dialogId.find('input[type=radio][name="dispatchMeans"][value="'+array_data["rowSellingOrder"].dispatch+'"]').prop('checked', true);
	
	sellingOrderDispatchCost();
	
	dialogId.find('input[name="DHL_quantity1"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	dialogId.find('input[name="DHL_quantity2"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	dialogId.find('input[name="DHL_quantity3"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	dialogId.find('select[name="DHL_packets1"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	dialogId.find('select[name="DHL_packets2"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	dialogId.find('select[name="DHL_packets3"]').change(function() {
		sellingOrderDispatchDHLCost(this);
	})
	
	dialogId.find('input[type="radio"][name="dispatchMeans"]').change(function() {
		var dialogId=$("form#dialogSellingOrderDispatch");
		if( dialogId.find(this).is(":checked") ){ // check if the radio is checked
            var radioValue = dialogId.find(this).val(); // retrieve the value
            dialogId.find('input[name="dispatch"]').val(radioValue);
            dialogId.find('input[name="shippingCosts"]').val($('#'+radioValue+'_cost_total').html());
        }
			
		
	})
	
	dialogId.find('input[name="saveDispatch"]').click(function() {
		var dialogId=$("form#dialogSellingOrderDispatch");
		var modul="sellingOrderDispatchSave";
		dialogSave(dialogId,orderID,modul);
	})
	
	var dialogId=$("form#dialogOrderPackagePositions");
	dialogId.find('input[name="orderID"]').val(orderID);
	
	var obj= {
			"className" : "classPosition",
			"dialogId" : dialogId,
			"htmlId" : "tbodyOrderPackagePositions",
			"orderID" : orderID,
			"phpModulSave" : "sellingOrderPackagePositionSave",
			"firmID" : _session.firmID, 
			"tbody" : $('#tbodyOrderPackagePositions').html(),
			"rowsPositions" : array_data["rowsOrderPackagePositions"],
			"dataRowsName": "rowsOrderPackagePositions",
			"rowsArticle" : array_data["rowsOwnArticle"],
			"rowsArticleFilter": "P",
			"rowsVariation" : array_data["rowsOwnVariation"],
			"rowsVariationSpec" : array_data["rowsOwnVariationSpec"],
			"rowsVAT" : array_data["rowsVAT"],
			"postFunction" : "sellingOrderPackingCost()"
			
	}

	classPosition = new _Position(obj);
	classPosition.sayHi();

}


function sellingOrderPackingCost() {
	var dialogId=$("form#dialogSellingOrderDispatch");
	var packingCost=0;
	var sum_weight=0;
	var rows=array_data["rowsOrderPackagePositions"];
	
	for (var i=0;i<rows.length;i++) {
	packingCost+=string2number(rows[i].price);
	sum_weight+=string2number(rows[i].gross_weight);
	}
	
	
	dialogId.find('input[name="packingCost"]').val(germanDezimal(packingCost));
	dialogId.find('input[name="sum_weight"]').val(germanDezimal(sum_weight));
	array_data["rowSellingOrder"].packingCost=germanDezimal(packingCost);
	array_data["rowSellingOrder"].sum_weight=germanDezimal(sum_weight);
	
	sellingOrderDispatchCost();
	
}

function sellingOrderDispatchDHLCost(field) {
	var dialogId=$("form#dialogSellingOrderDispatch");
	var total=0;
	for (var pi=1;pi<4;pi++) {
		
		var id=dialogId.find('select[name="DHL_packets'+pi+'"]').val();
		var quantity=string2number(dialogId.find('input[name="DHL_quantity'+pi+'"]').val());
		
		for (var i=0;i<array_data["rowsPostFees"].length;i++) {
			if (array_data["rowsPostFees"][i].id==id) {
				var price=string2number(array_data["rowsPostFees"][i].price);
				total+=quantity*price;
				$('#DHL_price'+pi).html(germanDezimal(quantity*price));
				break;
			}
		
		}
		
	}
	
	$('#DHL_cost_total').html(germanDezimal(total));
}

function sellingOrderDispatchCost(postFunction='') {
	var dialogId=$("form#dialogSellingOrderDispatch");
	var km=dialogId.find('input[name="km"]').val();
	var sum_weight=dialogId.find('input[name="sum_weight"]').val();
	
	var data = {
			"orderID" : orderID,
			"km" : km,
			"sum_weight" : sum_weight
		};
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data = $.param(data);
		
		$.ajax({
			type : "POST",
			url : '/sellingOrderDispatchCost',
			dataType : "json",
			data : data,
			success : function(data) {
					var array = getDataContent(data);
					var rowLKW=array["rowDispatchCostLKW"];
					var rowBaySped=array["rowDispatchCostBaySped"];
					$('#truck_cost_km').html(germanDezimal(rowLKW["truck_cost_km"]));
					$('#truck_cost_km_total').html(germanDezimal(rowLKW["truck_cost_km_total"]));
					$('#truck_cost_insurance').html(germanDezimal(rowLKW["truck_cost_insurance"]));
					$('#truck_cost_netValue').html(germanDezimal(rowLKW["truck_cost_netValue"]/100));
					$('#truck_cost_insurance_total').html(germanDezimal(
							Math.round(
							rowLKW["truck_cost_insurance_total"]*100
							)/100
							));
					$('#truck_cost_total').html(germanDezimal(
							Math.round(
									rowLKW["truck_cost_total"]*100
									)/100
							));
					
					
					$('#baySped_cost_freightage').html(germanDezimal(rowBaySped["baySped_cost_freightage"]));
					$('#baySped_cost_papers').html(germanDezimal(rowBaySped["baySped_cost_papers"]));
					$('#baySped_cost_SVR_percentage').html(germanDezimal(rowBaySped["baySped_cost_SVR_percentage"]));
					$('#baySped_cost_SVR').html(germanDezimal(
							Math.round(
							rowBaySped["baySped_cost_SVR"]*100
							)/100
							));
					
					$('#baySped_cost_netValue').html(germanDezimal(rowBaySped["baySped_cost_netValue"]/100));
					$('#baySped_cost_carriage_home').html(germanDezimal(rowBaySped["baySped_cost_carriage_home"]));
					$('#baySped_cost_total').html(germanDezimal(rowBaySped["baySped_cost_total"]));
					
					if (postFunction!='')
						eval(postFunction);
			} // end ajax success

		}); // end ajax


	
}

function sellingOrderReceiptInit() {
	console.log("init Receipt");
console.log(array_data["rowsOrderPositions"]);

		if (tbodyOrderReceiptPositions=="")
			tbodyOrderReceiptPositions=$("#tbodyOrderReceiptPositions").html();
		tbodyRows("tbodyOrderReceiptPositions",tbodyOrderReceiptPositions,array_data["rowsOrderPositions"]);
		
		var dialogId=$("form#dialogSellingOrderReceipt");
		dialogInit(dialogId,array_data["rowSellingOrder"]);
		
		
		dialogId.find('input[name="saveReceipt"]').click(function() {
			var dialogId=$("form#dialogSellingOrderReceipt");
			var modul="sellingOrderReceiptSave";
			dialogSave(dialogId,orderID,modul);
		})
		
		var dialogId=$("form#dialogOrderCreditPositions");
		dialogId.find('input[name="orderID"]').val(orderID);
		
		var obj= {
				"division" : "V",
				"className" : "classPosition",
				"dialogId" : dialogId,
				"htmlId" : "tbodyOrderCreditPositions",
				"orderID" : orderID,
				"phpModulSave" : "sellingOrderCreditPositionSave",
				"firmID" : _session.firmID, 
				"tbody" : $('#tbodyOrderCreditPositions').html(),
				"rowsPositions" : array_data["rowsOrderCreditPositions"],
				"dataRowsName": "rowsOrderCreditPositions",
				"rowsArticle" : array_data["rowsOwnArticle"],
				"rowsArticleFilter": "",
				"rowsVariation" : array_data["rowsOwnVariation"],
				"rowsVariationSpec" : array_data["rowsOwnVariationSpec"],
				"rowsVAT" : array_data["rowsVAT"]
				
		}

		classPosition = new _Position(obj);
		classPosition.sayHi();

	}

function sellingOrderInvoiceInit() {
	console.log(array_data);
	
	$('#_invoiceDiv').html($('#invoiceDiv').html());
	$('#_totalDiv').html($('#totalDiv').html());
	$('#_positionsDiv').html($('#positionsDiv').html());
	
	if (tbodyOrderInvoicePositions=="")
		tbodyOrderInvoicePositions=$("#tbodyOrderInvoicePositions").html();
	tbodyRows("tbodyOrderInvoicePositions",tbodyOrderInvoicePositions,array_data["rowsOrderPositions"]);
	
	var dialogId=$("form#dialogSellingOrderInvoice");
	dialogInitSelectTermPayment(dialogId);
	
	dialogId.find('input[name="saveInvoice"]').click(function() {
		var dialogId=$("form#dialogSellingOrderInvoice");
		var modul="sellingOrderInvoiceSave";
		dialogSave(dialogId,orderID,modul);
	})

	
	dialogInit(dialogId,array_data["rowSellingOrder"]);	
	console.log(array_data["rowsOrderPositions"]);
	totalSum(dialogId,array_data["rowsOrderPositions"]);
	
}

function sellingOrderBookingInit() {
// var dialogId=$("form#dialogSellingOrderPositions");
	if (tbodyOrderInvoicePositions=="")
		tbodyOrderInvoicePositions=$("#tbodyOrderPositions").html();
	tbodyRows("tbodyOrderPositions",tbodyOrderInvoicePositions,array_data["rowsOrderPositions"]);
	var dialogId=$("form#dialogSellingOrderBooking");
	dialogInitSelectTermPayment(dialogId);
	dialogInit(dialogId,array_data["rowSellingOrder"]);
	
	for (var i=0;i<array_data["rowsOrderPositions"].length;i++) 
		dialogInit(dialogId,array_data["rowsOrderPositions"][i]);
	totalSum(dialogId,array_data["rowsOrderPositions"]);
	
	$("#dialogBookingAccountFindDiv").dialog({
		width : 800,
		height : 400,
		modal : true,
		autoOpen : false
	});

	$('#baseTotalSumDiv').html($('#baseTotalSum').html());
	$('#bookingMask').html($('#dialogBookingDivDF').html());
	dialogBookingInitDF();
	
}

function sellingOrderMessagesInit() {
	
	var dialogId=$("form#dialogSellingOrderMessages");
	dialogInit(dialogId,array_data["rowSellingOrder"]);

	var dialogId=$("form#dialogSellingOrderMessages");
	dialogId.find("input[name='date']").datepicker(datepickerGerman);
	
	dialogId.find("input[name='newMessage']").click(function () {
		sellingOrderMessagesNew();
	});
	
	dialogId.find("input[name='saveMessage']").click(function () {
		var modul="sellingOrderMessagesSave";
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

function sellingOrderMessagesDelete(id) {
	var dialogId=$("form#dialogSellingOrderMessages");
	var modul="sellingOrderMessagesDelete";
	var postFunction='tbodyRows("tbodyOrderMessagePositions",tbodyOrderMessagePositions,array_data["rowsMessages"])';
	dialogDeleteId(dialogId,id,modul,postFunction)
}

function sellingOrderMessagesEdit(id) {
	var dialogId=$("form#dialogSellingOrderMessages");
	for (var i=0;i<array_data["rowsMessages"].length;i++) {
		if (array_data["rowsMessages"][i].id==id) {
			var row=array_data["rowsMessages"][i];
			break;
		}
	}
	dialogInit(dialogId,row);
}

function sellingOrderMessagesNew() {
	var dialogId=$("form#dialogSellingOrderMessages");
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

function sellingOrderStoreChange() {
	var dialogId=$('#dialogSellingOrderStore');
	var store=dialogId.find("select[name='storeSelect']").val();
	$('#dialogStoreDiv').html($('#'+store).html());
	return;
}

function sellingPosition2stock(id,postFunction='') {
	/**
	 * id is id ob selling_positions
	 */
	var dialogId=$('#dialogSellingOrderStore');
	dialogId.find('input[name="id"]').val(-1);
	var rowsPositions=array_data["rowsOrderPositions"];
	
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
		url : '/sellingOrderStoreGetStock',
		dataType : "json",
		data : data,
		success : function(data) {
				var array_temp = getDataContent(data);
				rowsStock = array_temp['rowsStock'];
				var store = array_temp['store'];
				dialogId.find("select[name='storeSelect']").val(store);
				dialogId.find("input[name='positionID']").val(id);
				sellingOrderStoreChange(store);
				
				var rowsPositions=array_data["rowsOrderPositions"];
				for (var i = 0; i < rowsPositions.length; i++) {
					if (rowsPositions[i].id == id) {
						dialogInit($("#dialogSellingOrderStore"),rowsPositions[i]);
						
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
						
						$('#disponibleQuantity').html('aktuell: ' + disponible);
						$('#realQuantity').html('aktuell: ' + real);

						break;
					}
				}
				if (postFunction!='')
					eval(postFunction);
		} // end ajax success

	}); // end ajax


	$('select[name="transaction"]').focus();
	return;
}

function sellingOrderStoreTransactionEdit(id) {
	var dialogId=$("form#dialogSellingOrderStore");
	dialogId.find('input[name="id"]').val(id);
	
	var data = {
			"id" : id
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
					//var dialogId=$("form#dialogSellingOrder");
					
					dialogId.find('select[name="transaction"]').val(row.transaction);
					
					
			}
		});
}

function sellingOrderStoreTransactionSave() {
	var dialogId=$('#dialogSellingOrderStore');
	
	disponible=string2number($('#disponibleQuantity').html().replace('aktuell: ',''));
	real=string2number($('#realQuantity').html().replace('aktuell: ',''));
	
	var transaction=dialogId.find('select[name="transaction"]').val();
	var quantity=string2number(dialogId.find('input[name="quantity"]').val());
	var disponible_quantity=string2number(dialogId.find('input[name="disponible_quantity"]').val());
	var real_quantity=string2number(dialogId.find('input[name="real_quantity"]').val());
	var OK=0;
	
	if (transaction=='R' 
		&& disponible-quantity==disponible_quantity
		&& real==real_quantity
		||
		transaction=='O' 
			&& disponible_quantity==disponible
			&& real-quantity==real_quantity) {
		var OK=1;
	}
	
	
		if (real-quantity<0) {
			if (confirm("Mit Minusbeständen arbeiten, war einmal :-)\nSoll eine Nachbestellung ausgelöst werden?")) {
				alert("nachbestellen");
				return;
			} else {
				alert("... dann kann der Auftrag nicht ausgeführt werden");
				return;
			}
		}
	
		dialogId.find('input[name="OK"]').val(OK);
		dialogId.find('input[name="orderID"]').val(orderID);
		
		var id=-1;
		var modul='/sellingOrderStoreSave';
		var postFunction='sellingOrderStoreInit()';
		dialogSave(dialogId,id,modul,postFunction);
}

function sellingOrderInvoiceSave() {
	var dialogId=$('#dialogSellingOrderInvoice');
	var modul="sellingOrderInvoiceSave";
	
	dialogSave(dialogId,orderID,modul);
	return;
}

function sellingBookDialogPrint(sendEmail=0) {
	
	dialogId=$('form#dialogSellingPrint');
	dialogId.find('input[name="orderID"]').val(orderID);

	var data = {
			"action" : "init",
			"orderID" : orderID
		};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	modul="/sellingPrintPrepare"
		$.ajax({
			type : "POST",
			dataType : "json",
			url : modul,
			data : data,
			success : function(data) {
				var arrayData = getDataContent(data);
				console.log(arrayData);
				var workflowStatus=arrayData["workflowStatus"];
				var messages=arrayData["rowsSellingMessages"];
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
							"rows": arrayData["rowsSellingMessages"],
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
					$("#sellingSendAttachmentDiv").css("display","none");
					$("#dialogSellingPrintDiv").dialog(
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
					$("#sellingSendAttachmentDiv").css("display","table");
					files="";
					dialogId.find('input[type=file]').val('');
					$('input[type=file]').on('change', prepareUpload);
					$("#dialogSellingPrintDiv").dialog(
							{
								title : "Druckvorschau orderID# "+orderID,
								width: 1000,
								height: 450,
								buttons : {
									Close : function() {
										$(this).dialog("close");
									},
									Send : function() {
											sellingBookDialogPrintPreview(1);
										}									
									}
							}).dialog("open");					
				}	
			} // end ajax success
			}) // end ajax
}

function sellingBookDialogPrintPreview(sendEmail=0) {
	var dialogId=$('form#dialogSellingPrint');
	var orderID=dialogId.find('input[name="orderID"]').val();
	var GB=dialogId.find('select[name="cb_GB"]').val();
	var printForm=dialogId.find('select[name="printForm"]').val();
	var printLang=dialogId.find('select[name="printLang"]').val();
	console.log(files);
	
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

	
	var modul="sellingPrint";
	var postFunction='';
	
		
		
		if (sendEmail==1) {
			/* dialogSave
			 * handle sending E-Mail by dialogSave
			 * dialogSave collect files
			 * data are overhanded, for dialogSave no need
			 * call purchsePrint via ajax
			 */
			id=orderID;
			modul="/sellingPrint";
			postFunction='';
			dialogSave(dialogId,id,modul,postFunction,data);
		} else {
			data=JSON.stringify(data);
			$('#previewFileSellingPrint').attr('src',"/sellingPrint?data="+data);
		}

}

function sellingBookDialogEmail() {
	/* sellingBookDialogPrint(sendEmail=0)
	 * @see: sellingBookDialogPrint with parameter 1=sendEmail
	 */
	sellingBookDialogPrint(1)
}

function sellingBookDialogExam() {
	
	$("#dialogSellingExamDiv").dialog(
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

function sellingOrderNewGet(dialogId) {
	customer_company=dialogId.find('input[name="customer_company"]').val();
	for (var i=0;i<array_data["rowsFirmsComplete"].length;i++) {
		if (array_data["rowsFirmsComplete"][i].company==customer_company) {
			dialogInit(dialogId,array_data["rowsFirmsComplete"][i]);
			break;
		}
	}
return;
}