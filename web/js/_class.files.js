/*******************************************************************************
 * not realy a class only a collection of functions for file-handle
 */

var arrayFiles=new Array;
var arrayFilesLocal=new Array;
 
function dialogFiles(ticketID, elementID) {
	first_i = -1;

	if (arguments.length < 2)
		elementID = "ticket-file";

	var data = {
		"content" : "init",
		"ticketID" : ticketID
	};

	data = $.param(data);
	if (_session.IPlocal!=="") {
		var phpModul="http://"+_session.IPlocal+"/portal17/files_local_get.php?callback=?";
			$.ajax({
                type: 'GET',
				data : data,
				url: phpModul,
                dataType: 'jsonp',
				callback: 'jsonCallback',
                success: function (data) {
					var array_data = getDataContent(data);
					arrayFiles = array_data["arrayFiles"];
                },
                jsonp: 'jsonp',
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
					}
                });
	}
	
	$.ajax({
		url : '../../get_files.php',
		type : "POST",
		dataType : "json",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			if (_session.IPlocal!="") {
			} else {
				arrayFiles = array_data["arrayFiles"];
			}
			console.log(arrayFiles);
			arrayInternalFiles = array_data["arrayInternalFiles"];

			
			$('input[type=file]').on('change', prepareUpload);
			first_i = -1;
			if (arrayFiles.length > 0)
				first_i = trDialogFiles(ticketID);

			/*
			 * arrayInternalFiles not realy "files" can be printed on the fly
			 */

			if (arrayInternalFiles.length > 0)
				first_i = trDialogInternalFiles(ticketID);

			var uploadit_button = '<a href=javascript:uploadit(' + ticketID
					+ ')>uploadit</a>';
			$("#uploadit_button").html(uploadit_button);
			$("#" + elementID).dialog('option', 'title',
					'Belege zum Ticket: #' + ticketID)
			$("#" + elementID).dialog("open");

			if (first_i >= 0 && arrayFiles.length > 0)
				showFile(arrayFiles[first_i].id);
		}
	})

	return;

}

function jsonCallback(json){
  console.log(json);
}

function trDialogFiles(ticketID) {
	var trString = '<table>';
	var num = 0;
	for (var i = 0; i < arrayFiles.length; i++) {
		// if (arrayFiles[i].ticketID==ticketID) {
		if (num == 0)
			first_i = i;
		num++;
		var file_i = i;

		trString += '<tr><td><a href=javascript:showFile(' + arrayFiles[i].id
				+ ')>' + arrayFiles[i].name.replace(/%20/g, ' ') + "</a></td>";
		trString += "<td>" + dateSql2German(arrayFiles[i].date) + "</td>";
		var numSize = Math.round(arrayFiles[i].size / 1024);
		trString += "<td>" + numSize + "k</td>";
		trString += "<td>" + arrayFiles[i].type + "</td>";
		trString += '<td><a href=javascript:deleFile('
				+ arrayFiles[i].id
				+ ','
				+ arrayFiles[i].ticketID
				+ ')><div><span class="ui-icon ui-icon-trash"></span></div></a></td>';
		trString += '<td><a href=javascript:moveFile('
				+ arrayFiles[i].id
				+ ','
				+ arrayFiles[i].ticketID
				+ ')><div><span class="ui-icon ui-icon-folder-open"></span></div></a></td>';
		trString += "</tr>";
		// }
	}

	trString += '</table>';
	$("#tr_ticket-files").html(trString);
	return (first_i);
}

function trDialogInternalFiles(ticketID) {

	var trString = '<table>';
	var num = 0;
	for (var i = 0; i < arrayInternalFiles.length; i++) {
		// if (arrayFiles[i].ticketID==ticketID) {
		if (num == 0)
			first_i = i;
		num++;
		var file_i = i;

		trString += '<tr><td><a href=javascript:showInternalFile(' + i + ')>'
				+ arrayInternalFiles[i].type.replace(/%20/g, ' ') + "</a></td>";
		trString += "<td>" + dateSql2German(arrayInternalFiles[i].date)
				+ "</td>";
		trString += "<td>" + arrayInternalFiles[i].voucherNo + "</td>";
		if (arrayInternalFiles[i].sent != "") {
			trString += "<td>"
					+ "<span class='ui-icon ui-icon-mail-closed'></span> "
					+ dateSql2German(arrayInternalFiles[i].sent) + "</td>";
		} else {
			trString += "<td></td>";
		}
		trString += "</tr>";
		// }
	}

	trString += '</table>';

	$("#tr_internal-files").html(trString);
	return (first_i);
}

function showFile(id,modul="file_show.php",divId="dialog-file") {

	var srcString = '<div><iframe id="frame" style="width:100%; height:600px;">iframe</iframe></div>';

	$("#"+divId).html(srcString);
	if (_session.IPlocal!=="") {
	url="http://"+_session.IPlocal+"/portal17/file_local_show.php?id="+id+"&firmID="+_session.firmID;
	} else {
	url = "../../classes/"+modul+"?id=" + id;
	}
	$("#frame").attr("src", url);

	return;
}

function showInternalFile(i) {
	var lang = "de";
	var id = arrayInternalFiles[i].id;
	var ticketID = arrayInternalFiles[i].ticketID;
	var type = arrayInternalFiles[i].type;
	var division = arrayInternalFiles[i].division;

	if (division == "E") {
		switch (type) {
		case "Anfrage":
			var orderID = -1;
			var requestID = id;
			var pForm = "AN";
			break;
		case "Bedarfsmeldung":
			var orderID = -1;
			var requestID = id;
			var pForm = "BM";
			break;
		case "Bestellung":
			var requestID = -1;
			var orderID = id;
			var pForm = "BE";
			break;
		}
		url = "../../print_bestellung.php?orderID=" + orderID + "&requestID="
				+ requestID + "&ticketID=" + ticketID + "&lang=" + lang
				+ "&pForm=" + pForm;
	} else {
		var requestID = -1;
		switch (type) {
		case "Auftragsbestätigung":
			var orderID = id;
			var pForm = "AB";
			break;
		case "Lieferschein":
			var orderID = id;
			var pForm = "LS:WV:BBP:ES";
			break;
		case "Rechnung":
			var orderID = id;
			var pForm = "AR";
			break;
		}
		url = "../../print_auftrag.php?orderID=" + orderID + "&requestID="
				+ requestID + "&ticketID=" + ticketID + "&lang=" + lang
				+ "&pForm=" + pForm;
	}

	console.log(url);

	var srcString = '<div><iframe id="frame" style="width:100%; height:600px;">iframe</iframe></div>';
	$("#dialog-file").html(srcString);

	$("#frame").attr("src", url);

	return;
}

function showFirmFile(id) {
	var srcString = '<div><iframe id="frame" style="width:100%; height:600px;"></iframe></div>';
	// $("#dialog").css({width:1000});
	$("#dialog-file").html(srcString);
	url = "../../classes/fileFirm_show.php?id=" + id;
	$("#frame").attr("src", url);
	return;
}

function showOfferFile(ticketID) {
	var srcString = '<div><iframe id="frame" style="width:100%; height:600px;"></iframe></div>';
	$("#dialog-file").html(srcString);
	url = "../../classes/fileOffer_show.php?ticketID=" + ticketID;
	$("#frame").attr("src", url);
	return;
}

function prepareUpload(event) {
	files = event.target.files;
}

function uploadit(ticketID) {

	if (files == undefined)
		return;
	
	
	var pdata = new FormData();
	pdata.append('file', files[0]);
	pdata.append('ticketID', ticketID);
	pdata.append('firmID', _session.firmID);
	
	//pdata = $.param(pdata);
	if (_session.IPlocal!=="") {
		var phpModul="http://"+_session.IPlocal+"/portal17/file_local_upload.php";
		var jsonType= 'json';
		var type='POST';
	} else {
		var phpModul="../../file_upload.php";
		var jsonType= 'json';
		var type='POST';
	}
	//enctype: 'multipart/form-data'
	$.ajax({
		url : phpModul,
		data : pdata,
		type : type,
		dataType : jsonType,
		contentType: false, // for upload binary data
		processData: false, // for upload binary data
		success : function(pdata) {
			var array_data = getDataContent(pdata);
			arrayFiles = array_data["rowsFiles"];
			trDialogFiles(ticketID);
		},
		error : function(jqXHR,textStatus,errorThrown ) {
			
			dialogFiles(ticketID);
		}
	})
}

function uploadit_artikelstamm(article_id, variation1_id, variation2_id) {

	if (files == undefined)
		return;
	var data = new FormData();
	data.append('file', files[0]);
	data.append('article_id', article_id);
	data.append('variation1_id', variation1_id);
	data.append('variation2_id', variation2_id);

	$.ajax({
		url : '../../file_upload_artikelstamm.php',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			// var array_data=getDataContent(data);
			alert("image uploaded");
		}
	})

}

function deleFile(id, ticketID) {

	if (!confirm('löschen? Sind Sie sicher?'))
		return;
	var data = {
		"id" : id,
		"firmID" : _session.firmID
	};

	if (_session.IPlocal!=="") {
		var phpModul="http://"+_session.IPlocal+"/portal17/file_local_delete.php?callback=?";
		var jsonType= 'jsonp';
	} else {
		var phpModul='../../file_delete.php';
		var jsonType= 'json';
	}

	
	$.ajax({
		url : phpModul, 
		data : data, 
		type : 'GET',
		dataType : jsonType,
		success : function(data) {
			var array_data = getDataContent(data);
			arrayFiles = array_data["rowsFiles"];
			trDialogFiles(ticketID);
		}
	})

}

function moveFile(id, ticketID) {
	var $frm = $("form#dialog-file-move");
	$("#ticket-file-move").dialog({
		title : "Move File",
		buttons : {

			Cancel : function() {
				$(this).dialog("close");
			},
			move : function() {
				// update row.
				var row = {};

				row.oldTicketID = $frm.find("input[name='oldTicketID']").val();
				row.newTicketID = $frm.find("input[name='newTicketID']").val();
				console.log(row.oldTicketID + " " + row.newTicketID);

				var data = new FormData();
				data.append('id', id);
				data.append('oldTicketID', row.oldTicketID);
				data.append('newTicketID', row.newTicketID);

				$.ajax({
					url : '../../file_move_it.php', // Wohin soll die Datei

					data : data,
					type : 'POST',
					processData : false,
					contentType : false,
					success : function(data) {
						var array_data = getDataContent(JSON.parse(data));
						arrayFiles = array_data["files"];
						trDialogFiles(ticketID);
					}
				})

				$(this).dialog("close");
			}
		}
	}).dialog("open");

	var data = {
		"content" : "init",
		"ticketID" : ticketID
	};

	data = $.param(data);

	$.ajax({
		url : '../../file_move_init.php',
		type : "POST",
		dataType : "json",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			var rowsFirms = array_data["rowsFirms"];
			var rowCompany = array_data["rowCompany"];

			var rowsOrder = array_data["rowsOrder"];

			autoCompleteFirms = new Array;
			for (var i = 0; i < rowsFirms.length; i++) {
				autoCompleteFirms[i] = {
					'value' : rowsFirms[i].company,
					'label' : rowsFirms[i].company
				};
			}

			var $frm = $("form#dialog-file-move");
			$frm.find('input[name="company"]').val(rowCompany[0].company);
			$frm.find('input[name="company"]').change(function() {
				moveFileChange();
			});
			$frm.find('select[name="division"]').change(function() {
				moveFileChange();
			});
			$frm.find('input[name="company"]').autocomplete({
				source : autoCompleteFirms,
				minLength : 0
			});

			$frm.find('input[name="oldTicketID"]').val(ticketID);
			trMovePositions(rowsOrder);
		}

	})
	return;
}

function moveFileChange() {
	var $frm = $("form#dialog-file-move");
	var division = $frm.find('select[name="division"]').val();
	var company = $frm.find('input[name="company"]').val();
	console.log(division + " " + company);
	var data = {
		"company" : company,
		"division" : division
	};

	$.ajax({
		url : '../../file_move_getOrders.php',
		type : 'POST',
		dataType : "json",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			var rowsOrder = array_data["rowsOrder"];
			trMovePositions(rowsOrder);
		}
	})

}

function trMovePositions(rows) {
	var string = "";
	string += "<table>";
	string += "<tr style='background-color:#cccccc;'>";
	string += "<td>ticketID#</td>";
	string += "<td>Bestelldatum</td>";
	string += "<td>Bestellnummer</td>";
	string += "<td>user</td>";
	string += "</tr>";

	for (var i = 0; i < rows.length; i++) {
		string += '<tr onclick=javascript:$(\'input[name="newTicketID"]\').val('
				+ rows[i].ticketID + ')>';
		string += "<td>";
		string += rows[i].ticketID;
		string += "</td>";

		string += "<td>";
		string += dateSql2German(rows[i].purchaseDate);
		string += "</td>";
		string += "<td>";
		string += rows[i].purchaseNo;
		string += "</td>";
		string += "<td>";
		string += rows[i].user;
		string += "</td>";
		string += "</tr>";

	}
	string += "</table>";
	$("#ticketPositions").html(string);
}

function dialogCatalogue(firmID) {
	$('#icon_menu').css('visibility', 'hidden');

	$("#dialog-catalogue").dialog("open");

	var srcString = '<div><iframe id="frame" style="width:100%; height:500px;">iframe</iframe></div>';
	$("#dialog-catalogue").html(srcString);
	url = "../../classes/fileFirm_show.php?kind=catalogue&firmID=" + firmID;

	$("#frame").attr("src", url);

	return;
}
