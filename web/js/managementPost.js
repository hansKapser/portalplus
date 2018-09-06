
function managementPostinInit() {
	registerMenuManagementPostin('managementPostinBoxInit')
} // end function mainMenu

function registerMenuManagementPostin(modul) {
	console.log("registerMenuManagementPostin with: "+modul);
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

				
				$('div.contentPostin').html(content);
				var jsModul=modul+"()";
				
				eval(jsModul);
			},
			 error: function(xhr, status, text) {
			        console.log(text);
			    }
		});
	
} // end registerMenuManagementCompanyMaster

/*
 * managementPostinBox managementPostinBoxInit: contains as obj-function:
 * editRow addRow deleteRow changePostinBox ( form-fields) showDocuments:
 * getTicketID @see: standard.js ticketFiles prepareUpload(event) for upload
 * files to p17_files managementPostinFileUpload() do file-upload
 * managementPostinBoxSavePost(row) postblock-function after saving @see:
 * standard.js dialogSave refresh rows optional upload file
 */

 function managementPostinBoxInit() {

	/*
	 * pqGridObj @see: standard.js prepares obj from mysql-table p17_system_grid
	 * pqGridObj(gridId,rowGrid,rowsData);
	 */
	
	
	/*
	 * dialogObj can also be stored in table p17_system_grid:dialogModel to get
	 * more overview let's define the dialogModel here
	 */
	 var rowGrid=isGridContent("managementPostinBoxInit");
	dialogObj=
		{
			"divId": "#dialogPostinBoxDiv",
	        "dialogId" : "form#dialogPostinBox",
			"gridId": "#gridPostinBox",
			"toolbarFilter": "postinToolbarFilter(value,dialogObj)",
			"dialogBox": {
				"width": "850",
				"modal": true,
				"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
			   "dialogId" : "form#dialogPostinBox",
			   "udfInit" : "changePostinBox(dialogId,'init',row)",
			   "select": [
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
	               ],
	           "change": [
	               {
	               "field" : "division",
	               "udf"   : "changePostinBox(dialogId,this,row)"
	               },
	               {
	               "field" : "voucherNoInternal",
	               "udf"   : "changePostinBox(dialogId,this,row)"
	               }
	               ]
		        },
				 "filterDialog": {
					 "modul" : "/accountancyChangeData",
					 "table" : "p17_postbook_in",
					 "field" : "date",
					 "rowsName" : "rowsPostin"
				 }
		}
	
	$gridClass= new _myGrid("#gridPostinBox",rowGrid,dialogObj);

		

} // end managementPostinBoxInit

  
function changePostinBox(dialogId,pField,row=new Array()) {
	if (pField=="init") {
		var field="division";
		var value=row.division;
	} else {
		var field=pField.name;
		var value=pField.value;		
	}
	
	
	switch (field) {
	case "from_company":
		var from_company=value;
		var from_firmID=-1;
		
		from_firmID=checkFirmID(value,true);

		if (from_firmID==-1) { 
		
		} else {
			var division=dialogId.find('select[name="division"]').val();
			getVouchersInternal(dialogId,from_firmID,division);
		}
		break;
		

	case "division":
		var array=new Array();
		array[0]= {
			"field": "voucher",
			"rows": array_data['rowsVoucher'],
			"label": "voucher",
			"value": "voucher",
			"filter" : 'rows[i].division=="'+value+'"'
			};
		
		dialogInitSelect(dialogId,array);
		if (row.firmID==undefined) {
			console.log("undefined");
			var from_company=dialogId.find('input[name="from_company"]').val();
			console.log("from_company "+from_company);
			
			from_firmID=checkFirmID(from_company,true);
			
			row= {
					"from_firmID":from_firmID,
					"ticketID": -1
			}
			
		} else {
			console.log("row defined");
			console.log(row);	
		}
		
		console.log("nach dem Spiel");
		console.log(row);
		getVouchersInternal(dialogId,row.from_firmID,value,row.ticketID);
		
		break;
		
	case "voucherNoInternal":
		
		dialogId.find("input[name='ticketID']").val(value);
		var rowsTickets=array_data["rowsTickets"];
		
		for (var i=0;i<rowsTickets.length;i++) {
			if (rowsTickets[i].ticketID==value) {
				dialogId.find("select[name='userID']").val(rowsTickets[i].userID);
				dialogId.find("select[name='teamID']").val(rowsTickets[i].teamID);
				break;
			}
		}
		break;
	}
}

function showDocuments() {
	console.log("showDocuments sollte noch nicht aufgerufen werden");
	var dialogId = $("form#dialogPostinBox");
	var ticketID=dialogId.find("input[name='ticketID']").val();
	ticketFiles(ticketID);
}

function prepareUpload(event) {
	files = event.target.files;
}

function managementPostinFileUpload() {
	var dialogId=$("form#dialogPostinBox");
	var ticketID=dialogId.find("input[name='ticketID']").val();
	dialogId.find("input[name='file']").val('');
	ticketFileUpload('',ticketID);
}

function managementPostinBoxSavePost(row) {
	var newRow = $grid.pqGrid('addRow', {
		rowData : row
	});
	$grid.pqGrid("refreshDataAndView");
	
	var dialogId = $("form#dialogPostinBox");
	ticketFileUpload('',row.ticketID,dialogId);
	
}

/*
 * end managementPostinBox
 */

/*
 * managementPostinVoucher
 * 
 */

function getVouchersInternal(dialogId,from_firmID,division,ticketID=-1) {
	if (from_firmID==undefined || division==undefined) {
		console.log("undefined firmID: "+from_firmID+" division: "+division);
		return;
	}
		
	
	var data = $.param(
					{"data" : JSON.stringify(
						{"from_firmID" : from_firmID,"division" : division}
					)}
				);
	
	modul="/ticketsGetByDivision";
	$.ajax({
		type : "POST",
		url : modul,
		dataType : "json",
		data : data,
		success : function(data) {
			var arrayData = getDataContent(data);
			
			var array=new Array();
			array[0]= {
				"field": "voucherNoInternal",
				"rows": arrayData["rowsTickets"],
				"label": '{dateSql2German(rows[i].date)+" "+rows[i].voucherNoInternal}',
				"value": "ticketID",
				"blank" : {
					"label" : "* neu *",
					"value" : -1
					}
				};
			dialogInitSelect(dialogId,array);
			
			if (ticketID<0 && arrayData["rowsTickets"].length>0) {
				ticketID=arrayData["rowsTickets"][0].ticketID;
			}
			var userID=-1;
			var teamID=-1;
			for (var i=0;i<arrayData["rowsTickets"].length;i++) {
				if (arrayData["rowsTickets"][0].ticketID==ticketID) {
					userID=arrayData["rowsTickets"][0].userID;
					teamID=arrayData["rowsTickets"][0].teamID;
				}
			}
			
			if (ticketID>0)
				dialogId.find('input[name="ticketID"]').val(ticketID);
				dialogId.find('select[name="voucherNoInternal"]').val(ticketID);
				dialogId.find('select[name="userID"]').val(userID);
				dialogId.find('select[name="teamID"]').val(teamID);
			
		} // end ajax success

	}); // end ajax
return;
}

function postinToolbarFilter(value) {
	alert(value+" "+"jetzt sind wir da wo wir hingehören");
	console.log($gridClass);
	// console.log($gridClass.obj.dataModel.data);
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value}
			)}
		);

modul="/managementPostinChangeData";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	$gridClass.obj.dataModel.data=arrayData["rowsPostin"];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax

	
	
	
}

function managementPostinVoucherInit() {
	/*
	*/
	// ticketDocuments in base.html

	/*
	 * pqGridObj @see: standard.js prepares obj from mysql-table p17_system_grid
	 * pqGridObj(gridId,rowGrid,rowsData);
	 */
	
	
	/*
	 * dialogObj can also be stored in table p17_system_grid:dialogModel to get
	 * more overview let's define the dialogModel here
	 */
	
	dialogObj=
		{
			"divId": "#dialogPostinVoucherDiv",
	        "dialogId" : "form#dialogPostinVoucher",
			"gridId": "#gridPostinVoucher",
			"dialogBox": {
				"width": 400,
				"modal": true,
				"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
			   "dialogId" : "form#dialogPostinVoucher",
			   "select": [
					{
					"field": "division",
					"rows": array_data['rowsDivisions'],
					"label": "name",
					"value": "division"
					}
	               ]
		        },
		}
	
	$gridClass= new _myGrid("#gridPostinVoucher",array_data["rowGrid"],dialogObj);

		

} // end managementPostinVoucherInit


function managementPostoutInit() {
	registerMenuManagementPostout('managementPostoutBoxInit')
} // end function mainMenu

function registerMenuManagementPostout(modul) {
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

				
				$('div.contentPostout').html(content);
				var jsModul=modul+"()";
				
				eval(jsModul);
			},
			 error: function(xhr, status, text) {
			        console.log(text);
			    }
		});
	
} // end registerMenuManagementCompanyMaster

function managementPostoutBoxInit() {
	/*
	*/
	// ticketDocuments in base.html
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


	/*
	 * pqGridObj @see: standard.js prepares obj from mysql-table p17_system_grid
	 * pqGridObj(gridId,rowGrid,rowsData);
	 */
	
	
	/*
	 * dialogObj can also be stored in table p17_system_grid:dialogModel to get
	 * more overview let's define the dialogModel here
	 */
	var rowGrid=isGridContent("managementPostoutBoxInit");
	dialogObj=
		{
			"divId": "#dialogPostoutBoxDiv",
	        "dialogId" : "form#dialogPostoutBox",
			"gridId": "#gridPostoutBox",
			"dialogBox": {
				"width": 400,
				"modal": true,
				"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
			   "dialogId" : "form#dialogPostoutBox",
			   "udfInit" : "changePostoutBox(dialogId,'init',row)",
			   "select": [
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
	               ],
		           "change": [
		               {
		               "field" : "division",
		               "udf"   : "changePostoutBox(dialogId,this,row)"
		               },
		               {
		               "field" : "voucherNoInternal",
		               "udf"   : "changePostoutBox(dialogId,this,row)"
		               }
		               ]
		        }
		}
	
	$gridClass= new _myGrid("#gridPostoutBox",rowGrid,dialogObj);

		

} // end managementPostoutBoxInit


function changePostoutBox(dialogId,pField,row=new Array()) {
	if (pField=="init") {
		var field="division";
		var value=row.division;
	} else {
		var field=pField.name;
		var value=pField.value;		
	}
	
	
	switch (field) {
	case "division":
		var array=new Array();
		array[0]= {
			"field": "voucher",
			"rows": array_data['rowsVoucher'],
			"label": "voucher",
			"value": "voucher",
			"filter" : 'rows[i].division=="'+value+'"'
			};
		
		dialogInitSelect(dialogId,array);
		
		if (row.from_firmID==undefined) {
			
			var from_company=dialogId.find('input[name="from_company"]').val();
			from_firmID=checkFirmID(from_company,false);			
			row={
					"from_firmID":from_firmID,
					"ticketID": -1
			}
		}
		
		getVouchersInternal(dialogId,row.from_firmID,value,row.ticketID);
		
		break;
		
	case "voucherNoInternal":
		
		console.log(dialogId.find("input[name='ticketID']").val());
		var rowsTickets=array_data["rowsTickets"];
		
		for (var i=0;i<rowsTickets.length;i++) {
			if (rowsTickets[i].ticketID==value) {
				dialogId.find("select[name='userID']").val(rowsTickets[i].userID);
				dialogId.find("select[name='teamID']").val(rowsTickets[i].teamID);
				break;
			}
		}
		break;
	}
}
