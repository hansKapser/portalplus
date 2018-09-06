/* bookingDialog.js
* functions for booking
*/
var tbodyJournal="";
var tbodyOPList="";
var tbodyAccounts="";
var actualBA="KF";
var focusField;

function dialogBookingInitKF() {
	actualBA="KF";
	$('#bookingJournalKF').html($('#dialogBookingDivJournal').html());
	
	dialogBId=$("form#dialogBookingKF");
	dialogBId.find("select[name='BA']").val('KF');
	dialogBId.find("input[name='orderID']").val(orderID);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	
	dialogBId=$("form#dialogBookingKF");
	dialogBId.find("input[name='datum']").datepicker(datepickerGerman);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="haben"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});
	
	dialogBId.find('input[name="soll0"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});
	
	dialogBId.find('input[name="haben"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});
	
	
	var array=new Array();
	array[0]={};
	array[0].field='vat_id';
	array[0].rows=array_data["rowsVAT"];
	array[0].label='name';
	array[0].value='vat_id';
	array[0].filter='rows[i].UV=="V"';
	
	for (var i=0;i<3;i++) {
		array[0].field='vat_id'+i;
		dialogInitSelect(dialogBId,array);
		dialogBId.find('input[name="soll'+i+'"]').keyup(function(event) {
			if (event.which == 113)
				dialogBookingKeyUp(this);
		});
	}
	
	dialogBId.find('input[name="save"]').click(function(){
		dialogBId=$("form#dialogBookingKF");
		dialogSave(dialogBId,-1,"dialogBookingSave","dialogBookingKFSavePost(array_data)");
	})
	
	if (tbodyJournal=="")
		tbodyJournal=$('#tbodyJournal').html();
	
	html=tbodyRows("tbodyJournal",tbodyJournal,array_data["rowsJournal"],"",false);
	$('#bookingJournalKF').find('#tbodyJournal').html(html);
	$('#bookingJournalKF').find('#tbodyJournal').find('tr:odd').css( "background-color", "#ddd" );
	
}

function dialogBookingKFSavePost(rows) {
	dialogBId=$("form#dialogBookingKF");
	dialogBId.find('input').val('');
	dialogBId.find('input[name="OPID"]').val(-1);
	dialogBId.find('input[name="ID"]').val(-1);
}

function dialogBookingInitKZ() {
	
	actualBA="KZ";
	$('#bookingJournalKZ').html($('#dialogBookingDivJournal').html());
	
	dialogBId=$("form#dialogBookingKZ");
	dialogBId.find("select[name='BA']").val('KZ');
	dialogBId.find("input[name='orderID']").val(orderID);
	
	dialogBId.find("input[name='datum']").datepicker(datepickerGerman);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="soll"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="haben"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});
	
	dialogBId.find('input[name="soll"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});

	dialogBId.find('input[name="haben"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});
	
	dialogBId.find('input[name="save"]').click(function(){
		dialogBId=$("form#dialogBookingKZ");
		if (dialogBId.find('input[name="datum"]').val()=='')
			return (alert('Datum eingeben'));
		if (dialogBId.find('input[name="soll"]').val()=='')
			return (alert('Soll eingeben'));
		if (dialogBId.find('input[name="haben"]').val()=='')
			return (alert('Haben eingeben'));
		if (dialogBId.find('input[name="beleg"]').val()=='')
			return (alert('Beleg eingeben'));
		if (dialogBId.find('input[name="betrag"]').val()==0)
			return (alert('Betrag eingeben'));
		if (dialogBId.find('input[name="OPID"]').val()<=0)
			return (alert('offenen Posten auswählen'));
		
		dialogSave(dialogBId,-1,"dialogBookingSave","dialogBookingKZSavePost(array_data)");
	})
	
	if (tbodyJournal=="")
		tbodyJournal=$('#tbodyJournal').html();
	
	html=tbodyRows("tbodyJournal",tbodyJournal,array_data["rowsJournal"],"",false);
	$('#bookingJournalKZ').find('#tbodyJournal').html(html);
	$('#bookingJournalKZ').find('#tbodyJournal').find('tr:odd').css( "background-color", "#ddd" );

	if (tbodyOPList=="")
		tbodyOPList=$('#tbodyOPList').html();
	
	var filter="rows[i].rest!=0";
	html=tbodyRows("tbodyOPList",tbodyOPList,array_data["rowsOP"],filter,false);
	console.log(html);
	$('#tbodyOPList').html(html);
	$('#tbodyOPList').find('tr:odd').css( "background-color", "#ddd" );

}

function dialogBookingKZSavePost(rows) {
	dialogBId=$("form#dialogBookingKZ");
	dialogBId.find('input').val('');
	dialogBId.find('input[name="OPID"]').val(-1);
	dialogBId.find('input[name="ID"]').val(-1);
}

function dialogBookingInitDF() {
	actualBA="DF";
	$('#bookingJournalDF').html($('#dialogBookingDivJournal').html());
	
	dialogBId=$("form#dialogBookingDF");
	dialogBId.find("select[name='BA']").val('DF');
	dialogBId.find("input[name='orderID']").val(orderID);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	
	dialogBId=$("form#dialogBookingDF");
	dialogBId.find("input[name='datum']").datepicker(datepickerGerman);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="soll"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});
	
	dialogBId.find('input[name="soll"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});
	
	
	var array=new Array();
	array[0]={};
	array[0].field='vat_id';
	array[0].rows=array_data["rowsVAT"];
	array[0].label='name';
	array[0].value='vat_id';
	array[0].filter='rows[i].UV=="U"';
	
	for (var i=0;i<3;i++) {
		array[0].field='vat_id'+i;
		dialogInitSelect(dialogBId,array);
		dialogBId.find('input[name="soll'+i+'"]').keyup(function(event) {
			if (event.which == 113)
				dialogBookingKeyUp(this);
		});
	}
	
	dialogBId.find('input[name="save"]').click(function(){
		dialogBId=$("form#dialogBookingDF");
		dialogSave(dialogBId,-1,"dialogBookingSave","dialogBookingDFSavePost(array_data)");
	})
	
	if (tbodyJournal=="")
		tbodyJournal=$('#tbodyJournal').html();
	
	html=tbodyRows("tbodyJournal",tbodyJournal,array_data["rowsJournal"],"",false);
	$('#bookingJournalDF').find('#tbodyJournal').html(html);
	$('#bookingJournalDF').find('#tbodyJournal').find('tr:odd').css( "background-color", "#ddd" );
	
}

function dialogBookingDFSavePost(rows) {
	
	dialogBId=$("form#dialogBookingDF");
	dialogBId.find('input').val('');
	dialogBId.find('input[name="OPID"]').val(-1);
	dialogBId.find('input[name="ID"]').val(-1);

}

function dialogBookingInitDZ() {
	
	actualBA="DZ";
	$('#bookingJournalDZ').html($('#dialogBookingDivJournal').html());
	
	dialogBId=$("form#dialogBookingDZ");
	dialogBId.find("select[name='BA']").val('DZ');
	dialogBId.find("input[name='orderID']").val(orderID);
	
	dialogBId.find("input[name='datum']").datepicker(datepickerGerman);
	
	dialogBId.find('select[name="BA"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="haben"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});

	dialogBId.find('input[name="soll"]').change(function() {
		dialogBookingChange(dialogBId,this);
	});
	
	dialogBId.find('input[name="soll"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});

	dialogBId.find('input[name="haben"]').keyup(function(event) {
		if (event.which == 113)
			dialogBookingKeyUp(this);
	});
	
	dialogBId.find('input[name="save"]').click(function(){
		dialogBId=$("form#dialogBookingDZ");
		if (dialogBId.find('input[name="datum"]').val()=='')
			return (alert('Datum eingeben'));
		if (dialogBId.find('input[name="soll"]').val()=='')
			return (alert('Soll eingeben'));
		if (dialogBId.find('input[name="haben"]').val()=='')
			return (alert('Haben eingeben'));
		if (dialogBId.find('input[name="beleg"]').val()=='')
			return (alert('Beleg eingeben'));
		if (dialogBId.find('input[name="betrag"]').val()==0)
			return (alert('Betrag eingeben'));
		if (dialogBId.find('input[name="OPID"]').val()<=0)
			return (alert('offenen Posten auswählen'));
		
		dialogSave(dialogBId,-1,"dialogBookingSave","dialogBookingDZSavePost(array_data)");
	})
	
	if (tbodyJournal=="")
		tbodyJournal=$('#tbodyJournal').html();
	
	html=tbodyRows("tbodyJournal",tbodyJournal,array_data["rowsJournal"],"",false);
	$('#bookingJournalDZ').find('#tbodyJournal').html(html);
	$('#bookingJournalDZ').find('#tbodyJournal').find('tr:odd').css( "background-color", "#ddd" );

	if (tbodyOPList=="")
		tbodyOPList=$('#tbodyOPList').html();
	
	var filter="rows[i].rest!=0";
	html=tbodyRows("tbodyOPList",tbodyOPList,array_data["rowsOP"],filter,false);
	console.log(html);
	$('#tbodyOPList').html(html);
	$('#tbodyOPList').find('tr:odd').css( "background-color", "#ddd" );

}

function dialogBookingDZSavePost(rows) {
	dialogBId=$("form#dialogBookingDZ");
	dialogBId.find('input').val('');
	dialogBId.find('input[name="OPID"]').val(-1);
	dialogBId.find('input[name="ID"]').val(-1);
}

function dialogBookingChange(dialogBId,field) {
	if (field.name!="BA") {
		var BA=dialogBId.find('select[name="BA"]').val();	
	} else {
		var BA=field.value;
	}
	
	if (field.name=="BA") {
		$('#bookingMask').html($('#dialogBookingDiv'+BA).html());
		$('#bookingMask').css("display","table");
		if (field.value=="KF")
			dialogBookingInitKF();
		if (field.value=="KZ")
			dialogBookingInitKZ();
		if (field.value=="DF")
			dialogBookingInitKF();
		if (field.value=="DZ")
			dialogBookingInitKZ();
		
		return;
	}
	
	switch (field.name) {
	case "haben":
		if (isCreditor(field.value)) {
			if (BA!='KF') {
				var soll=dialogBId.find('input[name="soll"]').val();
			$('#bookingMask').html($('#dialogBookingDivKF').html());
			dialogBId=$("form#dialogBookingKF")
			dialogBId.find('select[name="BA"]').val('KF');
				dialogBId.find('input[name="haben"]').val(field.value);
				dialogBId.find('input[name="soll0"]').val(soll);
			}
		}
		break;
	case "soll0":
		account2fields(dialogBId,field.value,0);
		break;
	case "soll1":
		account2fields(dialogBId,field.value,1);
		break;
	case "soll2":
		account2fields(dialogBId,field.value,2);
		break;
	}
	
	
	
}

function dialogBookingKeyUp(keyEvent) {
	focusField=keyEvent.name;
	var radios = $('input:radio[name=kontenart]');
	var kontenart=actualBA.substr(0,1);
	
	if (actualBA=="KF" && focusField.substr(0,4)=='soll')
		kontenart="S";

	if (actualBA=="KF" && focusField.substr(0,4)=='habe')
		kontenart="K";

	if (actualBA=="KZ" && focusField.substr(0,4)=='soll')
		kontenart="K";

	if (actualBA=="KZ" && focusField.substr(0,4)=='habe')
		kontenart="S";
	
    if(radios.is(':checked') === false) {
        radios.filter('[value='+kontenart+']').prop('checked', true);
    }
	radios.change(function (){
		dialogBookingAccountFindChange();
	})
	
	switch (actualBA) {
	case "KF":
		if (keyEvent.name=="haben") {
			rows=array_data["rowsPersonenkonten"];
			for (var i=0;i<rows.length;i++) {
				rows[i].konto=rows[i].creditor;
			}
		} else {
			rows=array_data["rowsSachkonten"];
		}
		break;

	case "KZ":
		if (keyEvent.name=="soll") {
			rows=array_data["rowsPersonenkonten"];
			for (var i=0;i<rows.length;i++) {
				rows[i].konto=rows[i].creditor;
			}
		} else {
			rows=array_data["rowsSachkonten"];
		}
		break;

	case "DF":
		if (keyEvent.name=="soll") {
			rows=array_data["rowsPersonenkonten"];
			for (var i=0;i<rows.length;i++) {
				rows[i].konto=rows[i].debitor;
			}
		} else {
			rows=array_data["rowsSachkonten"];
		}
		break;

	case "DZ":
		if (keyEvent.name=="haben") {
			rows=array_data["rowsPersonenkonten"];
			for (var i=0;i<rows.length;i++) {
				rows[i].konto=rows[i].debitor;
			}
		} else {
			rows=array_data["rowsSachkonten"];
		}
		break;

		
	}

	if (tbodyAccounts=="")
		tbodyAccounts=$('#tbodyAccounts').html();

	if (kontenart=='S') {
		tbodyRowsG("tbodyAccounts",tbodyAccounts,rows,"groupName");
	} else {
		tbodyRows("tbodyAccounts",tbodyAccounts,rows);
	}
		

	$("#dialogBookingAccountFindDiv").dialog(
			{
				title : "Kontensuche",
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");

}

function dialogBookingAccountFindChange() {
	var kontenart = $('input[name=kontenart]:checked').val();
	switch (kontenart) {
	case "S":
		var rows=array_data["rowsSachkonten"];
		tbodyRowsG("tbodyAccounts",tbodyAccounts,rows,"groupName");
		break;
	case "K":
		var rows=array_data["rowsPersonenkonten"];
		for (var i=0;i<rows.length;i++) {
			rows[i].konto=rows[i].creditor;
		}
		tbodyRows("tbodyAccounts",tbodyAccounts,rows);
		break;
	case "D":
		var rows=array_data["rowsPersonenkonten"];
		for (var i=0;i<rows.length;i++) {
			rows[i].konto=rows[i].debitor;
		}
		tbodyRows("tbodyAccounts",tbodyAccounts,rows);
		break;
	}
	
}
	


function dialogBookingAccountGet(konto) {
	dialogBId=$("form#dialogBooking"+actualBA);
	dialogBId.find('input[name="'+focusField+'"]').val(konto);
	$("#dialogBookingAccountFindDiv").dialog("close");
}

function dialogBookingDelete(journalID) {
	var dialogId=$("form#dialogBooking"+actualBA);
	var modul="dialogBookingDelete";
	var postFunction="dialogBookingDeletePost()";
	dialogDeleteId(dialogId,journalID,modul,postFunction);
}

function dialogBookingDeletePost() {
	dialogBookingInitKF();
}

function dialogBookingGetOP(ID,isChecked) {
	dialogBId=$("form#dialogBookingKZ");
	if (isChecked) {
		dialogBId.find('input[name="OPID"]').val(ID);
		alert(ID);
		var rowsOP=array_data["rowsOP"];
		for (var i=0;i<rowsOP.length;i++) {
			if (rowsOP[i].ID==ID) {
				dialogBId.find('input[name="text"]').val('Ausgl. '+rowsOP[i].op_nummer);
				dialogBId.find('input[name="betrag"]').val(germanDezimal(rowsOP[i].zahlungsbetrag));
				dialogBId.find('input[name="skontobetrag"]').val(germanDezimal(rowsOP[i].skontobetrag));
				//dialogBId.find('input[name="soll"]').val(rowsOP[i].kontonummer);
				break;
			}
		}
		
		
	} else {
		dialogBId.find('#input[name="OPID"]').val(-1);
	}
}

function dialogBookingJournal2Fields(rowsJournal,rowsJournalOP) {
	var ba=rowsJournal[0].ba;
	var dialogBId=$("form#dialogBooking"+actualBA);
	console.log(ba+" actualBA "+actualBA)
	if (ba!=actualBA) {
		var field={
				"name" : "BA",
				"value": ba
		}
		dialogBookingChange(dialogBId,field);
	}
		
	
	var dialogId=$("form#dialogBooking"+ba);
	switch (ba) {
	case 'KF':
		var total=0;
		var betrag0=rowsJournal[0].betrag;
		var ID="";
		for (var i=0;i<rowsJournal.length;i++) {
			if (ID!="")
				ID+=',';
			ID+=rowsJournal[i].ID;
			total+=string2number(rowsJournal[i].betrag);
		}
		
		var row=rowsJournal[0];
		row.betrag=germanDezimal(number2String(total));
		row.ID=ID;
		dialogInit(dialogId,row);
		
		rowsJournal[0].betrag=betrag0;
		
		for (var i=0;i<rowsJournal.length;i++) {
			
			dialogId.find('input[name="soll'+i+'"]').val(rowsJournal[i].soll);
			dialogId.find('input[name="betrag'+i+'"]').val(germanDezimal(rowsJournal[i].betrag));
			dialogId.find('input[name="text'+i+'"]').val(rowsJournal[i].text);
			dialogId.find('select[name="vat_id'+i+'"]').val(rowsJournal[i].steuerzeile);
			dialogId.find('select[name="BN'+i+'"]').val(rowsJournal[i].BN);
		}
		break;
	case 'KZ':
		var row=rowsJournal[0];
		dialogInit(dialogId,row);
		console.log("vorher");
		console.log(tbodyOPList);
		if (tbodyOPList=="")
			tbodyOPList=$('#tbodyOPList').html();
		console.log("nachher");
		console.log(tbodyOPList);
		
		var filter="1==1";
		// last Parameter insert=true
		html=tbodyRows("tbodyOPList",tbodyOPList,rowsJournalOP,filter,true);
			dialogId.find('input[name="cb_'+rowsJournalOP[0].ID+'"]').prop("checked",true);
			dialogId.find('input[name="OPID"]').val(rowsJournalOP[0].ID);
		break;
		
	case 'DF':
		var total=0;
		var betrag0=rowsJournal[0].betrag;
		var ID="";
		for (var i=0;i<rowsJournal.length;i++) {
			if (ID!="")
				ID+=',';
			ID+=rowsJournal[i].ID;
			total+=string2number(rowsJournal[i].betrag);
		}
		
		var row=rowsJournal[0];
		row.betrag=germanDezimal(number2String(total));
		row.ID=ID;

		dialogInit(dialogId,row);
		
		rowsJournal[0].betrag=betrag0;
		
		for (var i=0;i<rowsJournal.length;i++) {
			console.log(rowsJournal[i].vat_id);
			dialogId.find('input[name="haben'+i+'"]').val(rowsJournal[i].haben);
			dialogId.find('input[name="betrag'+i+'"]').val(germanDezimal(rowsJournal[i].betrag));
			dialogId.find('input[name="text'+i+'"]').val(rowsJournal[i].text);
			dialogId.find('select[name="vat_id'+i+'"]').val(rowsJournal[i].steuerzeile);
			dialogId.find('select[name="BN'+i+'"]').val('B');
		}
		break;
		
	}
}


function dialogBookingEdit(journalID) {
	var data = {
			"action" : "init",
			"journalID" : journalID
		};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "/getBookingJournal",
			data : data,
			success : function(data) {
				var arrayJournal = getDataContent(data);
				dialogBookingJournal2Fields(arrayJournal["rowsJournalE"],arrayJournal["rowsJournalEOP"]);
			}
		});
	
}

function isCreditor(value) {
	if (value.substr(0,1)=='4' && value.length>4)
		return (true);
}

function account2fields(dialogBId,account,line) {
	
	console.log(array_data);
	
	for (var i=0;i<array_data["rowsSachkonten"].length;i++) {
		if (array_data["rowsSachkonten"][i].konto==account) {
			var vat_id=array_data["rowsSachkonten"][i].vat_id;
			dialogBId.find('select[name="vat_id'+line+'"]').val(vat_id);
			break;
		}
	}
}