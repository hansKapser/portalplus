var rowsWBTime=new Array();
var tbodyWBTime='';

var rowsProducts=new Array();
var tbodyProducts='';

/**
 * files needed as public for upload in postin
 */
var files;

function managementCompanyMasterInit() {
registerMenuManagementCompanyMaster('managementCompanyMasterAddressInit')
} // end function mainMenu

function registerMenuManagementCompanyMaster(modul) {
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
					
				}

				$('div.contentCompanyMaster').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end registerMenuManagementCompanyMaster

function managementCompanyMasterAddressInit() {
	$('#_company').html(array_data["rowOwnFirm"].company);
	dialogInit($("form#dialog-address"),array_data["rowOwnFirm"]);
	var dialogID=$("form#dialog-address");
	dialogID.find('input[type=file]').on('change', prepareUpload);
	rowsWBTime=array_data['rowsWBTime'];
	
	var data={
			"kind": "logo",
			"firmID": _session.firmID,
			"timestamp": new Date().getTime()
	}
	data=JSON.stringify(data);
	
	
	$('#imageLogo').attr('src',"/getFirmFile?data="+data);
	
	if (tbodyWBTime=='') 
		tbodyWBTime=$('#rowsWBTime').html();
	tbodyRows('rowsWBTime',tbodyWBTime,rowsWBTime);

}

function managementCompanyMasterProductsInit() {
	$('#_company').html(array_data["rowOwnFirm"].company);
	dialogInit($("form#dialog-products"),array_data["rowOwnFirm"]);
	rowsProducts=array_data['rowsProducts'];
	if (tbodyProducts=='') 
		tbodyProducts=$('#rowsProducts').html();
	tbodyRows('rowsProducts',tbodyProducts,rowsProducts);
}

function managementCompanyMasterPurchaseInit() {
	$('#_company').html(array_data["rowOwnFirm"].company);
	dialogInit($("form#dialog-purchase"),array_data["rowOwnFirm"]);
}

function managementCompanyMasterSellingInit() {
	$('#_company').html(array_data["rowOwnFirm"].company);
	var dialogId=$("form#dialog-selling");
	//dialogId.find('select[name="termPayment"]').append(new Option('- offen -', 0));
	for (var i = 0; i < rowsTermPayment.length; i++) {
		var value=rowsTermPayment[i].id;
		var name=rowsTermPayment[i].discount_days+" Tg. "+
				rowsTermPayment[i].discount+"% Sk., "+
				rowsTermPayment[i].net_days+" Tg. netto";
		
		dialogId.find('select[name="termPayment"]').append(
				new Option(name, value));
	}
	
	if (array_data["rowOwnFirm"].catalogue == 1) {
		var catalogueLink = '<a href=javascript:showCatalogue('
				+ _session.firmID + ')>Katalog</a>';
		dialogId.find('#viewCatalogue').html(catalogueLink);
	}

	$("#dialogCatalogue").dialog({
		width : 800,
		height : 500,
		modal : true,
		autoOpen : false
	});

	dialogInit($("form#dialog-selling"),array_data["rowOwnFirm"]);
}

function managementCompanyMasterAccountancyInit() {
	$('#_company').html(array_data["rowOwnFirm"].company);
	dialogInit($("form#dialog-accountancy"),array_data["rowOwnFirm"]);
}

function addressSaveRecord() {
	var dialogId=$("form#dialog-address");
	var postFunction="";
	dialogSave(dialogId,id,'managementCompanyMasterAddressSave',postFunction);
return;
}

function WBTimeEditRecord(id) {
	var dialogId=$("form#dialog-address");
	dialogEdit(dialogId,id,'id',array_data['rowsWBTime']);
}

function WBTimeDeleteRecord(id) {
	var dialogId=$("form#dialog-Address");
	var postFunction="rowsWBTime=array_data['rowsWBTime'];"
		postFunction+="tbodyRows('rowsWBTime',tbodyWBTime,rowsWBTime)";		
	dialogDeleteId(dialogId,id,'managementCompanyMasterWBTimeDelete',postFunction);
}

function WBTimeSaveRecord() {
	var dialogId=$("form#dialog-address");

	var postFunction="rowsWBTime=array_data['rowsWBTime'];"
		postFunction+="tbodyRows('rowsWBTime',tbodyWBTime,rowsWBTime)";

	dialogSave(dialogId,id,'managementCompanyMasterWBTimeSave',postFunction);
	dialogId.find('select[name="dow"]').val(1);
	dialogId.find('input[name="bt_from"]').val('');
	dialogId.find('input[name="bt_to"]').val('');
	dialogId.find("#buttonESC").css('visibility','hidden');
}

function WBTimeESC() {
	var dialogId=$("form#dialog-address");
	dialogId.find('input[name="id"]').val(-1);
	dialogId.find('select[name="dow"]').val(1);
	dialogId.find('input[name="bt_from"]').val('');
	dialogId.find('input[name="bt_to"]').val('');
	dialogId.find("#buttonESC").css('visibility','hidden');

	var postFunction="rowsWBTime=array_data['rowsWBTime'];"
		postFunction+="tbodyRows('rowsProducts',tbodyWBTime,rowsWBTime)";

	dialogSave(dialogId,id,'managementCompanyMasterWBTimeSave',postFunction);
	dialogId.find('input[name="name"]').val('');
	dialogId.find('input[name="id"]').val(-1);
}


function productsEditRecord(id) {
	var dialogId=$("form#dialog-products");
	dialogEdit(dialogId,id,'id',array_data['rowsProducts']);
}

function productsDeleteRecord(id) {
	var dialogId=$("form#dialog-products");
	var postFunction="rowsProducts=array_data['rowsProducts'];"
		postFunction+="tbodyRows('rowsProducts',tbodyProducts,rowsProducts)";		
	dialogDeleteId(dialogId,id,'managementCompanyMasterProductsDelete',postFunction);
}

function productsSaveRecord() {
	var dialogId=$("form#dialog-products");
	var id=dialogId.find('input[name="id"]').val();
	if (id!=-1) {
		for (var i=0;i<rowsProducts.length;i++) {
			if (rowsProducts[i].id==id)
				rowsProducts[i].name=dialogId.find('input[name="name"]').val();
		}	
	}

	var postFunction="rowsProducts=array_data['rowsProducts'];"
		postFunction+="tbodyRows('rowsProducts',tbodyProducts,rowsProducts)";

	dialogSave(dialogId,id,'managementCompanyMasterProductsSave',postFunction);
	dialogId.find('input[name="name"]').val('');
	dialogId.find('input[name="id"]').val(-1);
}

function sellingSaveRecord() {
	var dialogId=$("form#dialog-selling");
	postFunction="rowOwnFirm=array_data['rowOwnFirm'];"
	dialogSave(dialogId,id,'managementCompanyMasterSellingSave',postFunction);
return;
}

function accountancySaveRecord() {
	var dialogId=$("form#dialog-accountancy");
	postFunction="rowOwnFirm=array_data['rowOwnFirm'];"
	dialogSave(dialogId,id,'managementCompanyMasterSellingSave',postFunction);
return;
}

function dialogEdit(frmDialog,id,field,rows) {
	frmDialog.find("input[name='buttonSave']").val('update');
	frmDialog.find("#buttonESC").css('visibility','visible');
	for (var i=0;i<rows.length;i++) {
		if (eval('rows[i].'+field) == id)
			dialogInit(frmDialog,rows[i])
	}
}




function managementCompanyMasterAddressUpload() {

	if (files == undefined)
		return;
	var data = new FormData();
	data.append('file', files[0]);
	data.append('kind', 'logo');
	
	$.ajax({
		url : 'uploadFirmFile',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
					var data={
							"kind": "logo",
							"firmID": _session.firmID,
							"timestamp": new Date().getTime()
					}
					
						data=JSON.stringify(data);
						$('#imageLogo').attr('src',"/getFirmFile?data="+data);
					}
	})

}

function managementCompanyMasterSellingUpload() {

	if (files == undefined)
		return;
	var data = new FormData();
	data.append('file', files[0]);
	data.append('kind', 'catalogue');
	
	$.ajax({
		url : 'uploadFirmFile',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			var catalogueLink = '<a href=javascript:show_catalogue()>Katalog</a>';
			$('#viewCatalogue').html(catalogueLink);
		}
		})

}

