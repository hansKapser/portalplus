var $gridClass;

function accountancyInit() {
console.log("accountancy.js -> accountancyInit called by mainMeu");

$("#dialogAccountancyPrintDiv").dialog({
	width : 1000,
	modal : false,
	autoOpen : false
});

} // end function mainMenu

function accountancyAccountsInit() {
	console.log("accountancy.js -> accountancyImpersonalAccountsInit called by mainMeu");
	//console.log("nothing to do back to mainMeu");
	registerMenuAccountancy('accountancyImpersonalAccountsListInit');
	} // end function mainMenu

function accountancyOverviewInit() {
	registerMenuAccountancy('accountancyOverviewJournalListInit');
	} // end function mainMenu

function accountancyBankInit() {
	registerMenuAccountancy('accountancyBankJournalListInit');
	} // end function mainMenu

function registerMenuAccountancy(registerModul) {
	console.log("function accountancy.js -> registerMenuAccountancy: "+registerModul);

		switch (registerModul) {
		default:
			//console.log(modul);
			//console.log(parameter)
			break;
		
		} // end switch modul
		var data=$.param(
				{"data" : JSON.stringify(
					{"action" : "init"})
				});

			$.ajax({
				type : "POST",
				dataType : "json",
				url : "/"+registerModul,
				async: true,
				data : data,
				success : function(data) {
					array_data = getDataContent(data);
					content=array_data["html"];
					
					$('div.contentAccountancy').html(content);
					var jsModul=registerModul+"()";
					eval(jsModul);
				}
			});
		
	} // end registerMenuaccountancyMaster

function accountancyIconMenuControl(item) {
	$('#accountancyIconMenu').css("display","none");
	
	switch (item) {
	case "print":
		accountancyDialogPrint();
		break;
	case "email":
		accountancyDialogEmail();
		break;
	}
}
function accountancyDialogPrint(printForm='',sendEmail=0) {
	var dialogId=$('form#dialogAccountancyPrint');
	var printForm=dialogId.find('select[name="accountancyPrintFormSelect"]').val();
	
	console.log($('#navtabs'));
	
	$('#dialogAccountancyPrintDiv').css("display","table");
	
	dialogId.find('select[name="accountancyPrintFormSelect"]').change(function () {
		accountancyDialogPrint(this.value);
	});
	
	row={
			"dateFrom":"",
			"dateTo":""
	}
	
	
	$('#accountancyPrintFormDiv').html($('#accountancyPrint'+printForm).html());

	dialogId.find("input[name='dateFrom']").datepicker(datepickerGerman);
	dialogId.find("input[name='dateTo']").datepicker(datepickerGerman);
	var arraySelect = [ 
		{
		    "field": "userID",
		    "groupField" : "class_name",
			"label" : "user_name",
			"value" : "userID",	       
			"rows": array_data["rowsUser"]
		},
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
		*/
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
		
		]

		dialogInitSelect(dialogId,arraySelect);
		dialogId.find('select[name="userID"]').val(_session.userID);
		
		dialogId.find('input[name="printButton"]').click( function () {
			accountancyPrintPreview(sendEmail);
		});
		
	$("#dialogAccountancyPrintDiv").dialog({
		title : "Auswertungen",
		buttons : {
			Close : function() {
				$(this).dialog("close");
			}
		}
	}).dialog("open");
	
}
function accountancyPrintPreview(sendEmail=0) {

	var dialogId=$('form#dialogAccountancyPrint');
	var printForm=dialogId.find('select[name="accountancyPrintFormSelect"]').val();

	var data={
			"timestamp": new Date().getTime()
	}
	
	var modul="accountancy"+printForm+"Print";
	var postFunction='';
	data=JSON.stringify(data);
	var url=modul+"?data="+data;
	console.log(url);
	$('#previewFileAccountancy').attr('src',url);

}

function accountancyTkonten(journalID=-1) {
	if ($gridClass==undefined || $gridClass=="") {
		return;
	} else {
		console.log($gridClassMaster);
	}
	
	var rowIndx=$gridClass._getRowIndx();
	
	var row = $gridClass.$grid.pqGrid('getRowData', {
		rowIndx : rowIndx
	});
	
	console.log("rowIndx");
	console.log(rowIndx);
	console.log(row);

	alert("T-Konten so ist es recht");
}

function accountancyToolbarFilter(value,filterDialog) {
	console.log(filterDialog);
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value,
				"field" : 	filterDialog.field,
				"table" : 	filterDialog.table,
				"rowsName": filterDialog.rowsName}
			)}
		);

modul=filterDialog.modul;
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	console.log(array_data["rowsBalance"]);
	$gridClass.obj.dataModel.data=arrayData[filterDialog.rowsName];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax
}

function accountancyEurobankListInit() {
	console.log("function accountancyEurobankListInit");

	$gridClass=undefined;
	var rowGrid=isGridContent("accountancyEurobankList");
	dialogObj=
	{
		"divId": "#dialogEurobankDiv",
	    "dialogId" : "form#dialogEurobank",
		"gridId": "#gridEurobank",
		"dialogBox": {
				"width": "1000",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogEurobank",
		   "udfInit" : "changeCategory(dialogId,'init',row)",
	        }
	}


$gridClass= new _myGrid("#gridEurobank",rowGrid,dialogObj);

}