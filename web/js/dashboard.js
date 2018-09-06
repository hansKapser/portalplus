/**
 * _session: _session-parameter _session["user"] _session["user_name"]
 * _session["company"] _session["email"] _session["userID"] _session["status"]
 * _session["status_name"] _session["profileID"] _session["profile_name"]
 * _session["class_name"] _session["team_name"] _session["hiddenmenu"]
 * 
 * @see: ./login.php
 */

var loadData=false;
var loadDataUser=false;
var loadDataArticle=false;
var loadDataAccountancy=false;
var loadTask=false;
var loadPinboard=false;
var loadCalendar=false;
var loadIMAP=false;
var calendarWindow;

var _session = new Array;
var _htmlContent= new Array();
var _gridContent= new Array();

var _modalTickets;
/**
 * data of dashboard_init data={"label":"content":} data -> hash array
 * array_data
 * 
 * @see: standard.js -> getDataContent()
 */
var array_data = new Array;

/**
 * rowsCalendar raw-data of calendar
 */
var rowsCalendar = new Array;

/**
 * rowsTickets raw-data of tickets
 */
var rowsTickets = new Array;

/**
 * for post in rowsFirms rowsVoucher
 */
var rowsFirms = new Array;
var autoCompleteFirms = new Array;
var rowsVoucher = new Array;
/**
 * rowsUser rowsTeam for manager
 */
var rowsUser = new Array;
var rowsTeam = new Array;

/**
 * rowsIMAP contains imap-inbox rowsPE contains uid from IMAP in p17_postbook_in
 * 
 */
var rowsIMAP = new Array;
var rowsPE = new Array;

/**
 * dataTicket array containing purchases or orders temp
 */
var dataTicket = new Array;

/**
 * files needed as public for upload in postin
 */
var files;

/**
 * mailI index of selected mail in IAMP area
 */
var mailI;

/**
 * html get innerHTML from dashboard <tbody id=..>
 */

var htmlCalendar = "";
var htmlIMAP = "";
var htmlPersonal = "";
var htmlTeam = "";
var htmlUser = "";
var htmlOpen = "";
var htmlTicketsRows = "";

var tbodyIMAP = "";
var tbodyPinboard = "";
var tbodyTickets = "";

/**
 * arrayJSession tempObject save userID leaving dashboard
 */

/* ticketID is actual ticketID used by direct call e.g. called by dashboard
 * 
 */
var ticketID=-1;
var emailAccount=1;


/*
 * $("#popup-email").dialog({ width : 500, height : 500, modal : true, autoOpen :
 * false }); $("#popup-posteingang").dialog({ width : 1200, modal : true,
 * autoOpen : false });
 * 
 * $("#popup-imapFolder").dialog({ width : 600, modal : true, autoOpen : false
 * });
 * 
 * $("#ticket-file").dialog({ width: 1200, height: 700, modal: true, open:
 * function () { $(".ui-dialog").position({ of: "#grid" }); }, autoOpen: false
 * });
 * 
 */
var VATrate=0.19;
var arrayJSession = new Array();

var dashboardMainContent="";

$(function() {
//alert('start dashboard');
	/*
	{ url: 'web/js/dashboard.js',key: ''},
	{ url: 'web/js/pqgrid.min.js',key: ''},
	{ url: 'web/js/pqgrid.min.js', key: 'pqgrid'},
		{ url: 'web/css/jquery-ui.min.css', key: 'jquery-ui.css'},
		{ url: 'web/css/jquery.ui.dialog-collapse.css', key: 'collaps.css'},
		{ url: 'web/css/pqgrid.min.css',key: 'pggrid.css'},
		{ url: 'web/css/pqgrid.office.css',key: 'pqoffice.css'},
		{ url: 'web/js/tinymce/skins/lightgray/skin.min.css',key: 'tinymce.css'},
		{ url: 'web/js/jquery-ui.min.js',key: 'jquery.ui'},
		{ url: 'web/js/jquery.ui.dialog-collapse.js', key: 'jquery.ui'},
	 
	basket.clear();
	basket.require(
		{ url: 'web/js/tinymce.min.js', key: 'tinymce'},
		{ url: 'web/js/tinymce/tinymce.min.js',key: 'tinymce'},
		{ url: 'web/js/mainMenu.js',key: 'mainMenu'},
		{ url: 'web/js/management.js', key: 'management'},
		{ url: 'web/js/managementCompanyMaster.js', key: 'managementCompanyMaster'},
		{ url: 'web/js/managementFirms.js', key: 'managementFirms'},
		{ url: 'web/js/managementUser.js', key: 'managementUser'},
		{ url: 'web/js/managementPost.js', key: 'managementPost'},
		{ url: 'web/js/article.js', key: 'article'},
		{ url: 'web/js/store.js', key: 'store'},
		{ url: 'web/js/purchase.js', key: 'purchase'},
		{ url: 'web/js/purchaseBook.js', key: 'purchaseBook'},
		{ url: 'web/js/purchaseRequisition.js', key: 'purchaseRequisition'},
		{ url: 'web/js/purchaseKK.js', key: 'purchaseKK'},
		{ url: 'web/js/purchaseEnquiry.js', key: 'purchaseEnquiry'},
		{ url: 'web/js/selling.js', key: 'selling'},
		{ url: 'web/js/sellingBook.js', key: 'sellingBook'},
		{ url: 'web/js/accountancy.js', key: 'accountancy'},
		{ url: 'web/js/accountancyAccounts.js', key: 'accountancyAccounts'},
		{ url: 'web/js/accountancyOverview.js', key: 'accountancyOverview'},
		{ url: 'web/js/bookingDialog.js', key: 'bookingDialog'},
		{ url: 'web/js/sysAdmin.js', key: 'sysAdmin'},
		{ url: 'web/js/standard.js', key: 'standard'},
		{ url: 'web/js/_class.files.js', key: '_class.files'},
		{ url: 'web/js/_myGrid.js', key: '_myGrid'},
		{ url: 'web/images/logo_uebw.png',key: 'logo.png'},
		{ url: 'web/images/ajax-loader.gif',key: 'loader.gif'},
		{ url: 'web/images/icon_logout.png',key: 'logout.png'},
		{ url: 'web/images/icon_menu.png',key: 'menu.png'},
		{ url: 'web/images/help.gif',key: 'help.gif'}
		)
	*/	

	 $("#dialogPurchaseBookDiv").keypress(function(e){
		 alert(e.keyCode);
	     /*
		 if((e.keyCode ? e.keyCode : e.which) == 163){
	       alert("Exclude the £ sign"); 
	       return false;
	     }
	     */
	   });
	dashboardInit();
});

function dashboardInit() {
/*
 * @todo: refresh array_data
 * setInterval(dashboardRefreshIMAP, 60000);
 */
	setInterval(function(){ updateClock(); }, 60000);
	
	
	$("#dialogDashboardPinboardDiv").dialog({
		width : 600,
		modal : true,
		autoOpen : false
	});

	$("#dialogDashboardEmailDiv").dialog({
		width : 600,
		height: 400,
		modal : true,
		autoOpen : false
	});
	
	$("#dialogDashboardEmailPostinDiv").dialog({
		width : 1200,
		modal : true,
		autoOpen : false
	});

	$("#dialogDashboardEmailMoveDiv").dialog({
		width : 600,
		modal : true,
		autoOpen : false
	});
	
	$("#dialogDashboardEmailReplyDiv").dialog({
		width : 600,
		modal : true,
		autoOpen : false
	});
	
	$("#dialogDashboardEmailAttachmentDiv").dialog({
		width : 1000,
		modal : true,
		autoOpen : false
	});

	$("#dialogDashboardCalendarDiv").dialog({
		width : 1000,
		height: 500,
		modal : true,
		autoOpen : false
	});

	
	
	$("#dialogDashboardPinboardViewDiv").dialog({
		width : 600,
		modal : true,
		autoOpen : false
	});
	
	$("#ticketDocuments").dialog({
		width : 850,
		modal : true,
		open : function() {
			$(".ui-dialog").position({
				of : "#gridPostinBox"
			});
		},
		autoOpen : false
	});

	$("#dialogHelp").dialog({
		width : 850,
		modal : true,
		autoOpen : false
	});


	var data = {
		"action" : "init"
	};

	$.ajax({
		type : "POST",
		dataType : "json",
		url : "/dashboardInit",
		data : JSON.stringify(data),
		success : function(data) {

			array_data = getDataContent(data);

			_session = array_data["session"];
			rowsCalendar = array_data["rowsCalendar"]
			rowsTickets = array_data["rowsTickets"];
			rowsUser = array_data["rowsUser"];
			rowsTeam = array_data["rowsTeam"];
			rowsFirms = array_data["rowsFirms"];
			rowFirm = array_data["rowsFirm"];
			for (var i = 0; i < rowsFirms.length; i++) {
				autoCompleteFirms[i] = {
					'value' : rowsFirms[i].company,
					'label' : rowsFirms[i].company
				};
			}

			rowsVoucher = array_data["rowsVoucher"];
			dashboardDataUser();
			dashboardData();
			dashboardDataArticle();
			dashboardDataAccountancy();
			dashboardTask();
			pinBoard();
			calendarTable();
			getIMAP();
			var arrTemp = document.cookie.split(';');
			for (var i = 0; i < arrTemp.length; i++) {
				if (arrTemp[i].indexOf('dashboard') >= 0) {
					arrTemp = arrTemp[i].split('=');
					arrayJSession = JSON.parse(arrTemp[1]);
					break;
				}
			}

			if (_session.status > 1) {
				var $frm = $("form#dialog-teacher");
			} else {
				var $frm = $("form#dialog-student");
			}

			if (arrayJSession == undefined)
				arrayJSession.userID != _session.userID;

			showAccount(_session);
			//getOwnBanner();

			/*
			 * show Account @see: standard.js first all menus are hidden
			 * depending from profile -> menu
			 */
			//showMenu();
			intervalId = setInterval(stopTimeout, 1000);
			waitTimeout=setTimeout(function(){ 
				dashboardMainContent=$('#mainContent').html();
				var string="";
				$('#ajax-loader').css("display","none");
					if (!loadTask 
						 || !loadData
						 || !loadPinboard  
						 ||	!loadIMAP 
						 || !loadCalendar ) 
					{
						if (!loadData)
							string+="Data not loaded\n";
						if (!loadIMAP)
							string+="IMAP not loaded\n";
						if (!loadCalendar)
							string+="Calendar not loaded\n";
						if (!loadTask)
							string+="Task not loaded\n";
						if (!loadPinboard)
							string+="Pinboard not loaded\n";
						
					alert("waiting 5 secondons for loading dashboard.\nThis should be enough.\nsomething wents wrong!\n"+string);	
					}
					
			}, 10000);
			
			
			

		} // end ajax success

	}); // end ajax
}

function stopTimeout() {
	if (loadData
			&& loadDataUser
			&& loadDataArticle
			&& loadDataAccountancy
			&& loadIMAP
			&& loadCalendar
			&& loadTask
			&& loadPinboard
			) {
		$('#ajax-loader').css("display","none");
		dashboardMainContent=$('#mainContent').html();
		clearTimeout(waitTimeout);
		clearInterval(intervalId);
	}
}
function showDashboard() {
	
	$('#mainContent').html(dashboardMainContent);
	
	$('#modalTickets').html(_modalTickets);
	if (_session.status>=2) {
		$('#dashboardTicketsDialogDiv').html($('#dashboardTicketsDialogTeacher').html());
	} else {
		$('#dashboardTicketsDialogDiv').html($('#dashboardTicketsDialogStudent').html());
	}
	$('#dashboardTicketsRowsUser').html('');
	$('#dashboardTicketsRowsTeam').html('');
	string=$('#dashboardTicketsUser').html();
	string+=$('#dashboardTicketsTeam').html();
	
	$('#dashboardTicketsContent').html(string);

			dashboardTask();
			pinBoard();
			calendarTable();

	
		return;
}

function dashboardRefreshCalendar() {
	//alert("refreshCalendar");
	$('#ajax-loader').css("display","table");	
	calendarTable();
	setTimeout(function(){ 
		$('#ajax-loader').css("display","none");
		dashboardMainContent=$('#mainContent').html();
		if (!loadCalendar)
			alert("loading Calendar, something wents wrong");
	},2000);
}

function dashboardRefreshIMAP() {
	//alert("refreshIMAP");
	$('#ajax-loader').css("display","table");
	loadIMAP=false;
	getIMAP();
	setTimeout(function(){ 
		$('#ajax-loader').css("display","none");	
		dashboardMainContent=$('#mainContent').html();
		if (!loadIMAP)
			alert("loading IMAP, something wents wrong");
	},3000);
}
function dashboardRefreshTask() {
	//alert("refreshTask");
	$('#ajax-loader').css("display","table");	
	dashboardTask();
	setTimeout(function(){ 
		$('#ajax-loader').css("display","none");	
		dashboardMainContent=$('#mainContent').html();
	},2000);

}
function dashboardRefreshPinBoard() {
	//alert("refreshPinboard");
	$('#ajax-loader').css("display","table");	
	pinBoard();
	setTimeout(function(){ 
		$('#ajax-loader').css("display","none");	
		dashboardMainContent=$('#mainContent').html();
	},2000);

}

function dashboardData() {
	$.ajax({
		url : 'dashboardDataInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			array_data = getDataContent(data);
			loadData=true;
		}
	})
	
}

function dashboardDataArticle() {
	$.ajax({
		url : 'dashboardDataArticleInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			array_data = getDataContent(data);
			loadDataArticle=true;
		}
	})
	
}

function dashboardDataUser() {
	$.ajax({
		url : 'dashboardDataUserInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			array_data = getDataContent(data);
			loadDataUser=true;
		}
	})
	
}

function dashboardDataAccountancy() {
	$.ajax({
		url : 'dashboardDataAccountancyInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			array_data = getDataContent(data);
			loadDataAccountancy=true;
		}
	})
	
}

function dashboardTask() {

	$.ajax({
		url : 'dashboardTasksInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			array_data = getDataContent(data);
			_modalTickets=$('#modalTickets').html();
			
			
			if (_session.status>=2) {
				$('#dashboardTicketsDialogDiv').html($('#dashboardTicketsDialogTeacher').html());
			} else {
				$('#dashboardTicketsDialogDiv').html($('#dashboardTicketsDialogStudent').html());
			}
			

			string=$('#dashboardTicketsUser').html();
			string+=$('#dashboardTicketsTeam').html();
			
			$('#dashboardTicketsContent').html(string);
			
			stringRows=$('#dashboardTicketsRows').html();
			$('#dashboardTicketsRowsUser').html(stringRows);
			$('#dashboardTicketsRowsTeam').html(stringRows);
			$('#dashboardTicketsRowsFirms').html(stringRows);
			
			
				
				
			var arraySelect = [
				{
				"field":"teamID",
				"rows":array_data["rowsTicketTeam"],
				"label":"name",
				"value":"id",
				"blank": {"label":"-- select --","value":""}
				},
				{
				"field":"firmID",
				"rows":array_data["rowsTicketFirms"],
				"label":"company",
				"value":"firmID",
				"filter": "_session.status>=2 ? 1==1 : row.userID==_session.userID || row.teamID==_session.teamID",
				"blank": {"label":"-- select --","value":""}
				},
				{
				"field":"userID",
				"rows":array_data["rowsTicketUser"],
				"label":"user_name",
				"value":"userID",
				"groupField":"class_name"
				}
				]

			dialogId=$('form#dashboardTicketsDialog');
			
			dialogInitSelect(dialogId,arraySelect);
			
			dialogId.find('select[name="userID"]').val(_session.userID);
			dialogId.find('select[name="teamID"]').val(_session.teamID);
			dashboardTaskTickets();
			
		}
	})

	
}

function dashboardTaskTickets() {
	stringRows=$('#dashboardTicketsRows').html();
	
	if (tbodyTickets=="") {
		var divId=$('#dashboardTicketsRows');
		tbodyTickets=divId.find('#tbodyTickets').html();
	}
	
	var htmlId="tbodyTickets";
	var dialogId=$('form#dashboardTicketsDialog');
	if (_session.status>1) {
	var userID=dialogId.find('select[name="userID"]').val();
	var teamID=dialogId.find('select[name="teamID"]').val();
	} else {
		var userID=_session.userID;
		var teamID=_session.teamID;
	}
	
	
	var firmID=dialogId.find('select[name="firmID"]').val();
	var filter="rows[i].userID=="+userID;
	tbodyUser=tbodyRows(htmlId,tbodyTickets,array_data["rowsTickets"],filter,false);
	
	
	var filter="rows[i].teamID=="+teamID+" && rows[i].userID!="+userID;
	tbodyTeam=tbodyRows(htmlId,tbodyTickets,array_data["rowsTickets"],filter,false);
	
	$('#dashboardTicketsRowsUser').html(tbodyUser);
	$('#dashboardTicketsRowsTeam').html(tbodyTeam);
	loadTask=true;
	
}

function dashboardTaskChange(pField) {
	var field=pField.name;
	var value=pField.value;
	if (tbodyTickets=="") {
		var divId=$('#dashboardTicketsRows');
		tbodyTickets=divId.find('#tbodyTickets').html();
	}
	
	
	var htmlId="tbodyTickets";
	
	switch (field) {
	case "teamID":
		var filter="rows[i].teamID=="+value;
		var tbodyTeam=tbodyRows(htmlId,tbodyTickets,array_data["rowsTickets"],filter,false);
		tbodyTeam="<table>"+tbodyTeam+"</table>";
		
		string=$('#dashboardTicketsTeam').html();
		$('#dashboardTicketsContent').html(string);
		$('#dashboardTicketsContent').find('#dashboardTicketsRowsTeam').html(tbodyTeam);
		break;
	case "userID":
		var filter="rows[i].userID=="+value;
		var tbodyUser=tbodyRows(htmlId,tbodyTickets,array_data["rowsTickets"],filter,false);
		tbodyUser="<table>"+tbodyUser+"</table>";
		
		string=$('#dashboardTicketsUser').html();
		$('#dashboardTicketsContent').html(string);
		$('#dashboardTicketsContent').find('#dashboardTicketsRowsUser').html(tbodyUser);
		break;
	case "firmID":
		var filter="rows[i].from_firmID=="+value;
		var tbodyFirms=tbodyRows(htmlId,tbodyTickets,array_data["rowsTickets"],filter,false);
		tbodyFirms="<table>"+tbodyFirms+"</table>";
		
		string=$('#dashboardTicketsFirms').html();
		$('#dashboardTicketsContent').html(string);
		$('#dashboardTicketsContent').find('#dashboardTicketsRowsFirms').html(tbodyFirms);
		break;
		
	}
	
}

function callTicket(id,division='E') {
	ticketID=id;
	
	for (var i=0;i<array_data["rowsTickets"].length;i++) {
		if (array_data["rowsTickets"][i]["ticketID"]==id) {
			division=array_data["rowsTickets"][i].division;
			break;
		}
	}
	
	var data = {};
	data["ticketID"] = ticketID;
	data["division"] = division;

	var data = {
		"data" : JSON.stringify(data)
	};

	data = $.param(data);

	$.ajax({
		url : 'dashboardTasksGetOrderIDfromTicketID',
		type : "POST",
		dataType : "json",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			orderID=array_data["row"].orderID;
			
			if (division=='E') {
				//htmlPurchase="$htmlContent=file_get_contents ( './templates/de/purchase.html');"
					mainMenu("purchaseInit");
					//indexMenuPurchase('purchaseBookInit',false);
					//registerMenuPurchase('purchaseOrderInit');				
			} else {
				//htmlSelling="$htmlContent=file_get_contents ( './templates/de/selling.html');"
					mainMenu("sellingInit");
					//indexMenuSelling('sellingBookInit',false);
					//registerMenuSelling('sellingOrderInit');				
			}

		}
	})
	
}

function pinBoard() {
	if (tbodyPinboard == "")
		tbodyPinboard = $('#tbodyPinboard').html();
	if (_session.status==4)
		$('#pinBoardNew').css('visibility',"visible");
	
	$.ajax({
		url : 'dashboardPinboardInit',
		data : '',
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			var array = getDataContent(data);
			array_data["rowsPinboard"]=array["rowsPinboard"];
			dialogId = $('#dialogDashboardPinboard');
			dialogId.find("input[name='file']").val('');
			tbodyRows('tbodyPinboard', tbodyPinboard,
					array_data["rowsPinboard"]);
			$('#loadingPinboard').css("display", "none");
			$('#tbodyPinboard').css("display", "table");
			loadPinboard=true;
		}
	})

	return;
}

function pinBoardView(id) {
	dialogId = $('#dialogDashboardPinboard');
	dialogId.find('input[name="file"]').val('');
	$('input[type=file]').on('change', prepareUpload);
	dialogId.find('input[name="id"]').val(id);
	dialogId.find("input[name='savePinboard']").click(function () {
		dialogSave(dialogId, id,
		"dashboardPinboardSave","pinBoard()");
		$("#dialogDashboardPinboardDiv").dialog("close");
	});
		
	for (var i = 0; i < array_data["rowsPinboard"].length; i++) {
		if (array_data["rowsPinboard"][i].id == id) {
			var row = array_data["rowsPinboard"][i];
			break;
		}
	}

	if (_session.status == 4) {


		if (id == -1) {
			dialogId.find('input').val('');
			dialogId.find('textarea').val('');
			dialogId.find('input[name="date"]').val(today);
			dialogId.find('input[name="author"]').val(_session.user);
			dialogId.find("input[name='id']").val(id);
			dialogId.find('input[name="subject"]').focus();
			tinymce.init({
			    selector: '#messagePinboard',
			    custom_ui_selector: '.tinySave',
			    menubar: false,
			    width: 500
			  });

		} else {
			dialogInit(dialogId, row);
			tinymce.init({
			    selector: '#messagePinboard',
			    custom_ui_selector: '.tinySave',
			    menubar: false,
			    width: 500
			  });

		}

		$("#dialogDashboardPinboardDiv")
				.dialog(
						{
							title : "Mitteilungen der Zentrale ",
							buttons : {
								Close : function() {
									$(this).dialog("close");
								},
								Delete : function() {
									dialogDeleteId(dialogId, id,
											"dashboardPinboardDelete",
											"pinBoard()");
									$(this).dialog("close");
								}
								}
						}).dialog("open");
	} else {
		// sessionstatus
		htmlId = $('#dialogDashboardPinboardViewDiv');
		if (row.isDocument==1) {
			row.attachment="<a href=javascript:dashboardPinboardFileView()>"+row.name+"<a>";
		} else {
			row.attachment="";
		}
		innerHTMLInit(htmlId, row);

		$("#dialogDashboardPinboardViewDiv").dialog({
			title : "Mitteilungen der Zentrale ",
			buttons : {
				Close : function() {
					$(this).dialog("close");
				}
			}
		}).dialog("open");

	}
}

function dashboardPinboardUploadFile() {
	dialogId = $('#dialogDashboardPinboard');
	id=dialogId.find('input[name="id"]').val();
	alert(id);
	
	if (files == undefined)
		return;
	var data = new FormData();
	data.append('file', files[0]);
	data.append('id', id);

	$.ajax({
		url : 'uploadPinboardFile',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			var array = getDataContent(data);
			dialogId.find("input[name='file']").val('');
		}
	})

}

function dashboardPinboardFileView() {
	dialogId = $('#dialogDashboardPinboard');
	var id=dialogId.find('input[name="id"]').val();
	var divDialogId="fileView";
	var modul="getPinboardFile";
	fileViewNew(id,divDialogId,modul);
	return;
}

function getIMAP() {
	dialogId = $('form#dialogDashboardIMAP');
	var rowsEmailAccounts=new Array();
	rowsEmailAccounts[0]=new Array();
	rowsEmailAccounts[0].id=1;
	rowsEmailAccounts[0].name=array_data["rowFirm"].email;
	rowsEmailAccounts[1]=new Array();
	rowsEmailAccounts[1].id=2;
	rowsEmailAccounts[1].name=array_data["rowFirm"].email2;
	
				var array=new Array();
				array[0]={};
				array[0].field='emailAccount';
				array[0].rows=rowsEmailAccounts;
				array[0].label='name';
				array[0].value='id';
				
				dialogInitSelect(dialogId,array);	
				dialogId.find('select[name="emailAccount"]').change(
						function () {
							dashboardChangeIMAP();
						});
				
				dashboardChangeIMAP();

	return;
}

function dashboardChangeIMAP() {
	var dialogId = $('form#dialogDashboardIMAP');
	if (tbodyIMAP=="")
		tbodyIMAP = $('#tbodyIMAP').html();
	
	var emailAccount=dialogId.find('select[name="emailAccount"]').val();
	
	var data = {
			"action" : "init",
			"emailAccount" : emailAccount
		};
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	$('#loadingIMAP').css("display", "table");
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "/dashboardImap",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			
			rowsIMAP = array_data["rowsIMAP"];
			rowsPE = array_data["rowsPE"];
			tbodyRows('tbodyIMAP', tbodyIMAP, rowsIMAP);
			$('#loadingIMAP').css("display", "none");
			$('#tbodyIMAP').css("display", "table");
			dashboardImapPostinChecked(rowsPE);

		}
	})
	
	
}

function calendarTable() {
	var string = "";
	// first call it's empty now get it
	if (htmlCalendar == "") {
		htmlCalendar = $("#calendar").html();
	}

	var data = {
			"action" : "init",
		};
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	$('#loadingIMAP').css("display", "table");
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "/dashboardCalendarInit",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			var template = "";
			rowsCalendar=array_data["rowsCalendar"];
			for (var i = 0; i < rowsCalendar.length; i++) {
				if (rowsCalendar[i].categoryID == 1 || rowsCalendar[i].categoryID == 2)
					group = 'Z';
				if (rowsCalendar[i].categoryID == 3 || rowsCalendar[i].categoryID == 4)
					group = 'F';
				if (rowsCalendar[i].categoryID == 5)
					group = 'P';

				template = htmlCalendar;
				while (template.indexOf("[group]") != -1)
					template = template.replace("[group]", group);
				while (template.indexOf("[start]") != -1)
					template = template.replace("[start]",
							dateSql2German(rowsCalendar[i].start.substring(0, 10)));
				while (template.indexOf("[title]") != -1)
					template = template.replace("[title]", rowsCalendar[i].title);
				while (template.indexOf("[ticketID]") != -1) {
					if (rowsCalendar[i].ticketID > 0) {
						var url = '<a href=javascript:dialogFiles('
								+ rowsCalendar[i].ticketID
								+ ')><div><span class="ui-icon ui-icon-document"></span></div></a>';
						template = template.replace("[ticketID]", url);
					} else {
						template = template.replace("[ticketID]", '');
					}
				}
				string += template;
			}

			$('#calendar').html(string);
			loadCalendar=true;
			

		}
	})
	

	return;

}

function goEurobank() {
	// calendarInit();
	var url="http://www.eurobank.online/login/";
	//console.log(calendarWindow);
	
	
	if (calendarWindow!=undefined)
		calendarWindow.close();
	eurobankWindow = window.open(url,'myWindow', "width=1100, height=600,location=no,menubar=no,titlebar=no");
	
}

function showCalendar() {
	// calendarInit();
	var url="/web/calendar/calendar.php?userID="+_session.userID+"&status="+_session.status+"&firmID="+_session.firmID;
	//console.log(calendarWindow);
	
	
	if (calendarWindow!=undefined)
		calendarWindow.close();
	calendarWindow = window.open(url,'myWindow', "width=1100, height=600,location=no,menubar=no,titlebar=no");
	/*
	
	var data = {
			"action" : "init",
		};
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	$('#loadingIMAP').css("display", "table");
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "/dashboardCalendarTemplate",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			string=array_data["html"];
			console.log(string);
			string="'"+string+"'";
			$('#dialogDashboardCalendarDiv').html(string);
			$("#dialogDashboardCalendarDiv").dialog({
				title : "Kalender ",
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");

		}
	})
	*/

	
}
function verkauf(ticketID, voucher) {
	window.location.href = "../../html/de/verkauf.php?ticketID=" + ticketID
			+ "&voucher=" + escape(voucher);
	return;
}

function einkauf(ticketID, voucher) {
	document.cookie = "dashboard=123";
	if (voucher == "Bedarfsmeldung")
		voucher = "Materialanforderung";
	window.location.href = "../../html/de/einkauf.php?ticketID=" + ticketID
			+ "&voucher=" + escape(voucher);
	return;
}

function dialogEmail(i) {
}

function dashboardPosteingang() {

	for (ii = 0; ii < rowsPE.length; ii++) {
		if (rowsPE[ii].uid == rowsIMAP[mailI].uid) {
			alert('IMAP-ID: ' + rowsIMAP[mailI].uid
					+ ' Email wurde bereits im Posteingang erfasst');
			return;
		}
	}

	/*
	 * before opening the postin-dialog, get mail_attachment
	 */

	var stringAttachments = $('#mail_attachment').html();
	stringAttachments = stringAttachments.replace(/_blank/g, "frame-print");
	$("#popup-posteingang").dialog(
			{
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	//$("#popup-posteingang").dialog("open");

	var date = dateSql2German(dateJS2Sql(rowsIMAP[mailI].date));
	var sender = rowsIMAP[mailI].from;
	sender = sender.substring(0, sender.indexOf('<') - 1);

	var $frm = $("form#dialog-posteingang");
	$("#mail_attachments").html(stringAttachments);
	$frm.find("input[name='date']").val(date);
	$frm.find("input[name='from_company']").val(sender);

	if (isExternalCompany(sender))
		$frm.find("input[name='from_company']").val('');

	$frm.find("input[name='sender_company']").val(sender);

	// remove older data, set to empty
	$frm.find("input[name='voucher']").val('');
	$frm.find("input[name='voucherNo']").val('');
	$frm.find("input[name='voucherDate']").val('');
	$frm.find("select[name='voucherNoInternal']").val('');
	$frm.find("input[name='ticketID']").val('');
	$frm.find("select[name='division']").val('');

	$frm.find("input[name='date']").datepicker(datepickerGerman);
	$frm.find("input[name='voucherDate']").datepicker(datepickerGerman);

	$frm.find("select[name='division']").change(function() {
		changePosteingang('division', this.value);
	});

	$frm.find("input[name='voucherNoInternal']").change(function() {
		changePosteingang('voucherNoInternal', this.value);
	});

	$frm.find("input[name='voucherNo']").change(function() {
		changePosteingang('voucherNo', this.value);
	});

	$frm.find("select[name='voucherNoInternal']").change(function() {
		changePosteingang('voucherNoInternal', this.value);
	});

	$frm.find('input[name="from_company"]').autocomplete({
		source : autoCompleteFirms,
		minLength : 0
	});
	$frm.find('input[name="supplier_company"]').autocomplete({
		source : autoCompleteFirms,
		minLength : 0
	});

	var url = '../../dashboard_imap_attachment.php?id=' + mailI;
	var srcString = '<div><iframe name=frame-print id="frame-print" src="'
			+ url
			+ '"  style="width:100%" height="500">not available</iframe></div>';

	$frm.find("#attachment").html(srcString);

	return;
}

function dashboardPosteingang_save() {
	var $frm = $("form#dialog-posteingang");

	var row = {};
	row.email_number = mailI;
	row.email = $frm.find("input[name='email']").val();
	row.date = $frm.find("input[name='date']").val();
	row.from_company = $frm.find("input[name='from_company']").val();
	row.sender_company = $frm.find("input[name='sender_company']").val();
	row.voucher = $frm.find("select[name='voucher']").val();
	row.voucherNo = $frm.find("input[name='voucherNo']").val();
	row.voucherDate = $frm.find("input[name='voucherDate']").val();
	row.division = $frm.find("select[name='division']").val();

	row.ticketID = $frm.find("input[name='ticketID']").val();

	row.voucherNoInternal = $frm.find("input[name='voucherNoInternal']").val();
	row.userID = $frm.find("select[name='userID']").val();
	row.teamID = $frm.find("select[name='teamID']").val();

	if ($frm.find("input[name='email']").prop('checked')) {
		row.email = '1';
	} else {
		row.email = '0';
	}

	phpModul = "../../dashboard_posteingang_add.php";

	from_firmID = -1;

	for (var i = 0; i < rowsFirms.length; i++) {
		if (rowsFirms[i].company == row.from_company) {
			from_firmID = rowsFirms[i].firmID;
			break;
		}
	}

	if (from_firmID == -1) {
		alert(row.from_company + " nicht im Firmenstamm gefunden");
		$frm.find("input[name='from_company']").val('');
		$frm.find("input[name='from_company']").focus();
		return;
	} else {
		row.from_firmID = from_firmID;
	}

	row.uid = rowsIMAP[mailI].uid;
	var data = {
		"action" : "update",
		"data" : JSON.stringify(row)
	};

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			rowsPE = array_data["rowsPE"];
			imapTable();
		} // end ajax success

	}); // end ajax

	return;
}

function emailMove() {
	var i = mailI;

	phpModul = "../../dashboard_imap_folder.php";
	var data = {
		"action" : "getFolder"
	};

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);

			var stringFolder = array_data["html"];

			$("#imapFolder").html(stringFolder);

		} // end ajax success

	}); // end ajax

	return;
}

function emailMoveIt(folder) {

	phpModul = "../../dashboard_imap_move2folder.php";
	var data = {
		"action" : "move",
		"mailI" : mailI,
		"folder" : escape(folder)
	};

	data = $.param(data);

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			alert('verschoben');
			$("#popup-imapFolder").dialog("close");
			$("#popup-email").dialog("close");
			getIMAP();
		} // end ajax success

	}); // end ajax

}

function emailAnswer() {

	var receiver = $("#mail_sender").html();
	var subject = $("#mail_subject").html();
	subject = 'RE: ' + subject;
	var body = $("#mail_body").html();
	body = '....\n' + body;
	body = '<textarea rows="10" cols="40" id=message>' + body + '</textarea>';
	var mail_send_button = '<a href=javascript:emailAnswerSend()>senden</a>';
	var attachment = '<input type=file id=attachmentFile>'
	$("#mail_sender").html('uns');
	$("#mail_receiver").html(receiver);
	$("#mail_subject").html(subject);
	$("#mail_attachment").html(attachment);
	$("#mail_body").html(body);
	$("#mail_send_button").html(mail_send_button);
	$('#icon_menu').css('visibility', 'hidden');
	$('input[type=file]').on('change', prepareUpload);
}

function emailAnswerSend() {
	var data = new FormData(); // das ist unser Daten-Objekt ...

	if (files != undefined) {
		data.append('file', files[0]); // ... an die wir unsere Datei anhängen
	}

	data.append('from', 'uns');
	data.append('to', $("#mail_receiver").html());
	data.append('subject', $("#mail_subject").html());
	data.append('message', $('input[type=textarea]').val());

	$.ajax({
		url : '../../dashboard_email_send.php',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			var array_data = getDataContent(data);
			alert('E-Mail sent');
		}
	})

}

function dashboardPostinShowDocuments() {
	var dialogId = $("form#dialogDashboardEmailPostin");
	var ticketID = dialogId.find('select[name="voucherNoInternal"]').val();
	ticketFiles(ticketID);
	return;
}

function isExternalCompany(sender) {
	is = false;
	if (sender.toUpperCase(sender).indexOf("BAYSPED GMBH") >= 0)
		is = true;

	return (is);
}

function saveSessionDashboard() {
	var arrayJSession = {};
	if (_session.status > 1) {
		var $frm = $("form#dialog-teacher");
		arrayJSession["userID"] = $frm.find('select[name="userID"]').val();
	} else {
		var $frm = $("form#dialog-student");
	}

	arrayJSession["firmID"] = $frm.find('select[name="firmID"]').val();
	document.cookie = "dashboard=" + JSON.stringify(arrayJSession);
}

function dashboardDialogEmail(uid) {
	//alert(uid);

	var $frm = $("form#dialogDashboardEmail");

	/*
	$("#mail_sender").html(rowsIMAP[i].from);
	$("#mail_receiver").html('uns');
	$("#mail_subject").html(rowsIMAP[i].subject);
	*/
	$("#mail_attachment").html('');
	$("#mail_body").html('');
	
	for (var i=0;i<rowsIMAP.length;i++) {
		if (rowsIMAP[i].uid==uid)
			break;
	}
	
	$("#mail_date").html(rowsIMAP[i].date);
	$("#mail_sender").html(rowsIMAP[i].from);
	$("#mail_receiver").html('uns');
	$("#mail_subject").html(rowsIMAP[i].subject);
	
	
	//$("#dialogDashboardEmailDiv").dialog("open");
	$("#dialogDashboardEmailDiv").dialog(
			{
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");


	var data = {
		"action" : "init",
		"uid" : uid
	};
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data=$.param(data);
	
	$.ajax({
				type : "POST",
				dataType : "json",
				url : "/dashboardImapMessage",
				data : data,
				success : function(data) {
					$("#ajax-loading").hide();
					var array_temp = getDataContent(data);
					var message = array_temp['rowMessage'];
					var attachments = array_temp['rowFiles'];
					//console.log(message);
					//console.log(attachments);

					if (attachments.length == 0) {
						var url_attachment = '';
					} else {
						var url_attachment = "";
						
						for (var i = 0; i < attachments.length; i++) {
							if (url_attachment!="")
								url_attachment+="<BR>";
							url_attachment += 
								"<a href=javascript:showAttachment("
									+uid+",'"
									+escape(attachments[i].filename)+"')>"+
								    escape(attachments[i].filename)+"</a>";
						}
					}

					//console.log("url: "+url_attachment);
					
					//console.log(url_attachment);
					$("#mail_body").css("white-space", "pre-wrap");
					$("#mail_attachment").html(url_attachment);
					$("#mail_body").html(message);

				}
			})
	
			var dialogId = $("form#dialogDashboardEmailPostin");
			
			/* input uid hidden field in form
			 * in case of postin
			 */
			dialogId.find('input[name="uid"]').val(uid);

	return;

}

function dashboardImapPostinCheck(mailbox=false,postFunction="") {
	if (mailbox) {
		dashboardChangeIMAP();
	} else {
		var data = {};
		data["mailbox"] = mailbox

		var data = {
			"data" : JSON.stringify(data)
		};

		data = $.param(data);

		$.ajax({
			url : 'dashboardImapPostinCheck',
			type : "POST",
			dataType : "json",
			data : data,
			success : function(data) {
				var array_data = getDataContent(data);
				dashboardImapPostinChecked(array_data["rowsPE"]);
				
				if (postFunction!="")
					eval(postFunction);
			}
		})		
	}

}

function dashboardImapPostinChecked(rowsPE) {
	for (var i=0;i<rowsPE.length;i++) {
		var tdId="#isPE"+rowsPE[i].uid;
		$(tdId).css("display","table");
	}
	
	loadIMAP=true;
}

function dashboardImapPostin() {
	
	var dialogId = $("form#dialogDashboardEmailPostin");
	
	/* input uid hidden field in form
	 * in case of postin
	 */
	uid=dialogId.find('input[name="uid"]').val();

	
	
	var rowsIMAP = array_data['rowsIMAP'];
	for (var i=0;i<rowsIMAP.length;i++) {
		if (rowsIMAP[i].uid==uid)
			break;
	}
	
	dialogId.find("input").val('');
	
	var array = new Array();
	
	arraySelect = [ 
		{
			"field": "division",
			"rows": array_data['rowsDivisions'],
			"label": "name",
			"value": "division"
		},
		{
			"field": "voucher",
			"rows": array_data['rowsVoucher'],
			"label": "voucher",
			"value": "voucher"
		},
	    {
	  		"field": "from_company",
		    "autocomplete": 1,
	        "label" : "company",
	        "value" : "company",	       
	        "rows": array_data['rowsFirms']
	    },
        {
            "field": "teamID",
		    "label" : "name",
		    "value" : "id",	       
		    "rows": array_data['rowsTeam']
		},
		{
	        "field": "userID",
	        "groupField" : "class_name",
			"label" : "user_name",
			"value" : "userID",	       
			"rows": array_data['rowsUser']
		}
		]
	
	
	dialogInitSelect(dialogId,arraySelect);
	dialogId.find("input[name='ticketID']").val(-1);
	
	rowsIMAP[i].date=dateIMAP2German(rowsIMAP[i].date);
	rowsIMAP[i].from_company = rowsIMAP[i].from.substring(0, rowsIMAP[i].from.indexOf('<') - 1);
	rowsIMAP[i].sender_company=rowsIMAP[i].from_company;
	
	
	dialogInit(dialogId,rowsIMAP[i]);
	dialogId.find("input[name='date']").datepicker(datepickerGerman);
	dialogId.find("input[name='voucherDate']").datepicker(datepickerGerman);

	
	
	/* changePostinBox
	 * @see: managementPost.js
	 */

	dialogId.find('select[name="division"]').change(
			function () {
				changePostinBox(dialogId,this);
			});

	dialogId.find('input[name="from_company"]').change(
			function () {
				changePostinBox(dialogId,this);
			});
	dialogId.find('select[name="voucherNoInternal"]').change(
			function () {
				changePostinBox(dialogId,this);
			});

	var field={
			"name" : "division",
			"value": "E"
	}
	
	changePostinBox(dialogId,field);
	
	var message = array_data['rowMessage'];
	var attachments = array_data['rowFiles'];
	if (attachments.length == 0) {
		var url_attachment = '';
	} else {
		var url_attachment = "";
		
		for (var i = 0; i < attachments.length; i++) {
			if (url_attachment!="")
				url_attachment+="<BR>";
			url_attachment += 
				'<a href=javascript:showAttachment('
					+uid+','
					+'"'+escape(attachments[i].filename)+'"'+','
					+'"dialogDashboardEmailPostinDiv")>'
					+escape(attachments[i].filename)+"</a>";
		}
	}
	
	$("#mail_attachments").html(url_attachment);
	
	if (url_attachment=='') {
		$("#srcAttachment").css("white-space", "pre-wrap");
		$("#srcAttachment").html(message);
		dialogId.find("input[name='saveMessage']").prop("checked", true);
	} else {
		dialogId.find("input[name='saveMessage']").prop("checked", false);
		showAttachment(uid,attachments[0].filename,"dialogDashboardEmailPostinDiv");
	}
	dialogId.find("input[name='savePostin']").click(function () {
		dashboardImapPostinSave();
	});
	
	//$("#dialogDashboardEmailPostinDiv").dialog("open");
	$("#dialogDashboardEmailPostinDiv").dialog(
			{
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");

	return;
}
function dashboardImapPostinSave() {
	var dialogId = $("form#dialogDashboardEmailPostin");
	var postFunction="";
	var id=dialogId.find("input[name='ticketID']").val();
	var modul="/dashboardImapPostinSave";
	dialogSave(dialogId,id,modul,postFunction) 
}
function dashboardImapReply() {
	//$("#dialogDashboardEmailReplyDiv").dialog("open");
	$("#dialogDashboardEmailReplyDiv").dialog(
			{
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");

	var dialogId = $("form#dialogDashboardEmailPostin");
	
	uid=dialogId.find('input[name="uid"]').val();

	for (var i=0;i<rowsIMAP.length;i++) {
		if (rowsIMAP[i].uid==uid)
			break;
	}
	
	var dialogId = $("form#dialogDashboardEmailReply");
	dialogId.find("input[name='sendEmail']").click(function () {
		dashboardImapReplySend();
	});
	files='';
	dialogId.find("input[name='file']").val('');
	$('input[type=file]').on('change', prepareUpload);
	
	var sender=$("#mail_sender").html();
	if (sender.indexOf('<')>=0) {
		sender = sender.substring(0, sender.indexOf('<') - 1);
		if (checkFirmID(sender,false)<0)
			sender=rowsIMAP[i].from;
	}
	
	var body=$("#mail_body").html();
	body="<BR><BR><hr>Ihre Nachricht:<BR>vom: "
		+rowsIMAP[i].date+"<BR><BR>"
		+body;
	dialogId.find('input[name="mailReceiver"]').val(sender);
	dialogId.find('input[name="mailSubject"]').val('Re: '+rowsIMAP[i].subject);
	dialogId.find('textarea[name="mailMessage"]').val(body);
	arraySelect = [ 
	    {
	  		"field": "mailReceiver",
		    "autocomplete": 1,
	        "label" : "company",
	        "value" : "company",	       
	        "rows": array_data['rowsFirms']
	    }
	    ]
	dialogInitSelect(dialogId,arraySelect);
	
	tinymce.init({
	    selector: '#mailMessage',
	    custom_ui_selector: '.tinySave',
	    menubar: false,
	    width: 500
	  });
	
}

function dashboardImapReplySend() {
	
	var dialogId = $("form#dialogDashboardEmailPostin");
	uid=dialogId.find('input[name="uid"]').val();
	
	var dialogId = $("form#dialogDashboardEmailReply");
	var postFunction="";
	var id=dialogId.find("input[name='ticketID']").val();
	var modul="/dashboardImapReplySend";
	dialogSave(dialogId,uid,modul,postFunction); 
	
}

function dashboardImapMove() {
	
	//$("#dialogDashboardEmailMoveDiv").dialog("open");
	$("#dialogDashboardEmailMoveDiv").dialog(
			{
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");

	phpModul = "/dashboardImapFolders";
	var data = {
			"action" : "init",
		};
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data=$.param(data);

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
						
			arraySelect = [ 
				{
			        "field": "ImapFolders",
			        "groupField" : "group",
					"label" : "label",
					"value" : "value",	       
					"rows": array_data['rowsFolders']
				}
				];
			
			var dialogId = $("form#dialogDashboardEmailMove");
			
			dialogInitSelectG(dialogId,arraySelect);
			dialogId.find('input[name="movePostin"]').click(function() {
				dashboardImapMoveIt();
			})
			
			var dialogId = $("form#dialogDashboardEmailPostin");
			
			uid=dialogId.find('input[name="uid"]').val();

			for (var i=0;i<rowsIMAP.length;i++) {
				if (rowsIMAP[i].uid==uid)
					break;
			}
			
			$("#moveDate").html(rowsIMAP[i].date);
			$("#moveSender").html(rowsIMAP[i].from);
			$("#moveSubject").html(rowsIMAP[i].subject);

		} // end ajax success

	}); // end ajax

}
function dashboardImapMoveIt() {
	
	var dialogId = $("form#dialogDashboardEmailPostin");	
	var uid=dialogId.find('input[name="uid"]').val();
	
	var dialogId = $("form#dialogDashboardEmailMove");
	var folder=dialogId.find('select[name="ImapFolders"]').val();
	
	phpModul = "/dashboardImapFoldersMove";
	var data = {
			"action" : "move",
			"uid": uid,
			"folder": folder
		};
		var data = {
				"data" : JSON.stringify(data)
			};
		
		data=$.param(data);

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			//$("#dialogDashboardEmailPostinDiv").dialog("close");
			$("#dialogDashboardEmailMoveDiv").dialog("close");
			

			for (var i=0;i<array_data["rowsIMAP"].length;i++) {
				if (array_data["rowsIMAP"][i].uid==uid)
					break;
			}
			
			array_data["rowsIMAP"].splice(i, 1);
			
			tbodyRows('tbodyIMAP', tbodyIMAP, array_data["rowsIMAP"]);
			//$('#loadingIMAP').css("display", "none");
			//$('#tbodyIMAP').css("display", "table");
			dashboardImapPostinChecked(array_data["rowsPE"]);

			
		} // end ajax success

	}); // end ajax

}

function showAttachment(uid,fileName,divId='') {
	if (divId=='') {
	divId=$("#dialogDashboardEmailAttachmentDiv");
	$("#dialogDashboardEmailAttachmentDiv").dialog(
			{
				title : "Attachment# "+uid,
				width: 1200,
				height: 400,
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	} else {
		divId=$('#'+divId);
	}

	var srcString = '<div><iframe id="frame" style="width:100%; height:450px;" frameBorder=0></iframe></div>';
	divId.find("#srcAttachment").html(srcString);
	var data={
			"uid": uid,
			"filename" : fileName,
			"timestamp": new Date().getTime()
	}
	data=JSON.stringify(data);
	divId.find('#frame').attr('src',"/dashboardImapAttachmentShow?data="+data);
	
}

function requestPermission() {
	if (!('serviceWorker' in navigator)) { 
		  alert("Service Worker isn't supported on this browser, disable or hide UI.");		  
		} else {
			alert("service worker is running");
		}

		if (!('PushManager' in window)) { 
		  alert("Push isn't supported on this browser, disable or hide UI."); 
		  return; 
		} else {
			alert("push is supported");
		}
		//requestPermission();
		//subscribeUserToPush()
	
	  return new Promise(function(resolve, reject) {
	    const permissionResult = Notification.requestPermission(function(result) {
	      // Handling deprecated version with callback.
	      resolve(result);
	    });

	    if (permissionResult) {
	      permissionResult.then(resolve, reject);
	    }
	  })
	  .then(function(permissionResult) {
	    if (permissionResult !== 'granted') {
	      throw new Error('Permission not granted.');
	    }
	  });
	}

function subscribeUserToPush() {
	  return navigator.serviceWorker.register('service-worker.js')
	  .then(function(registration) {
	    var subscribeOptions = {
	      userVisibleOnly: true,
	      applicationServerKey: btoa(
	        'BEl62iUYgUivxIkv69yViEuiBIa-Ib9-SkvMeAtA3LFgDzkrxZJjSgSnfckjBJuBkr3qBUYIHBQFLXYp5Nksh8U'
	      )
	    };

	    return registration.pushManager.subscribe(subscribeOptions);
	  })
	  .then(function(pushSubscription) {
	    
	    return pushSubscription;
	  });
	}

