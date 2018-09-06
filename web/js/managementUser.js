var register="Address";
var $grid;

var rowsWBTime=new Array();
var tbodyWBTime='';

var rowsProducts=new Array();
var tbodyProducts='';

var rowsArticles=new Array();
var tbodyArticles='';

function managementUserInit() {
registerMenuManagementUser('managementUserListInit')
} // end function mainMenu

function registerMenuManagementUser(modul) {
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

				$('div.contentUser').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end registerMenumanagementUser

function managementUserListInit() {
	var rowGrid=isGridContent("managementUserListInit");
	dialogObj=
	{
		"divId": "#dialogUserDiv",
	    "dialogId" : "form#dialogUser",
		"gridId": "#gridUser",
		"dialogBox": {
				"width": "850",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogUser",
		   "udfInit" : "changeUser(dialogId,'init',row)",
		   "select": [
	            {
          		"field": "firmID",
		        "label" : "company",
		        "value" : "firmID",	       
		        "rows": array_data['rowsSchoolFirms']
		        },
		        {
	            "field": "teamID",
			    "label" : "name",
			    "value" : "id",	       
			    "rows": array_data['rowsFirmTeams']
			    },
			    {
		        "field": "classID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsFirmClasses']
				},
			    {
			    "field": "profileID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsProfiles']
				}
               ],
           "change": [
               {
               "field" : "firmID",
               "udf"   : "changeUser(dialogId,this,row)"
               }
               ]
	        }
	}

$gridClass= new _myGrid("#gridUser",rowGrid,dialogObj);
	
}

function managementUserSavePost(row,rowIndx) {
	$grid.pqGrid('updateRow', {
		rowIndx : rowIndx,
		row : row,
		checkEditable : false
	});
	$grid.pqGrid("refreshDataAndView");
}

function managementUserClassesInit() {
	var rowGrid=isGridContent("managementUserClassesInit");
	dialogObj=
	{
		"divId": "#dialogUserClassesDiv",
	    "dialogId" : "form#dialogUserClasses",
		"gridId": "#gridUserClasses",
		"dialogBox": {
				"width": "800",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogUserClasses",
		   "udfInit" : "changeUser(dialogId,'init',row)",
		   "select": [
	            {
          		"field": "firmID",
		        "label" : "company",
		        "value" : "firmID",	       
		        "rows": array_data['rowsSchoolFirms']
		        },
		        {
	            "field": "teamID",
			    "label" : "name",
			    "value" : "id",	       
			    "rows": array_data['rowsFirmTeams']
			    },
			    {
		        "field": "classID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsFirmClasses']
				},
			    {
			    "field": "profileID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsProfiles']
				}
               ],
           "change": [
               {
               "field" : "firmID",
               "udf"   : "changeUser(dialogId,this,row)"
               }
               ]
	        }
	}

$gridClass= new _myGrid("#gridUserClasses",rowGrid,dialogObj);
	
}

function managementUserTeamsInit() {
	var rowGrid=isGridContent("managementUserTeamsInit");
	dialogObj=
	{
		"divId": "#dialogUserTeamsDiv",
	    "dialogId" : "form#dialogUserTeams",
		"gridId": "#gridUserTeams",
		"dialogBox": {
				"width": "800",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogUserTeams",
		   "udfInit" : "changeUser(dialogId,'init',row)",
		   "select": [
	            {
          		"field": "firmID",
		        "label" : "company",
		        "value" : "firmID",	       
		        "rows": array_data['rowsSchoolFirms']
		        },
		        {
	            "field": "teamID",
			    "label" : "name",
			    "value" : "id",	       
			    "rows": array_data['rowsFirmTeams']
			    },
			    {
		        "field": "classID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsFirmClasses']
				},
			    {
			    "field": "profileID",
				"label" : "name",
				"value" : "id",	       
				"rows": array_data['rowsProfiles']
				}
               ],
           "change": [
               {
               "field" : "firmID",
               "udf"   : "changeUser(dialogId,this,row)"
               }
               ]
	        }
	}

$gridClass= new _myGrid("#gridUserTeams",rowGrid,dialogObj);

}


function changeUser(dialogId,pField,row=new Array()) {
	if (pField=="init") {
		var field="firmID";
		var value=row.firmID;
	} else {
		var field=pField.name;
		var value=pField.value;		
	}

	
	switch (field) {
	case "firmID":
		modul="/managementUserGetFirm"
		var data = {
			"firmID":value
		};
		
		var data = {
			"data" : JSON.stringify(data)
		};
	
		data = $.param(data);
		$.ajax({
			type : "POST",
			dataType : "json",
			url : modul,
			dataType : "json",
			data : data,
			success : function(data) {
				var array_data = getDataContent(data);
				var array= [
				        {
			            "field": "teamID",
					    "label" : "name",
					    "value" : "id",	       
					    "rows": array_data['rowsFirmTeams']
					    },
					    {
				        "field": "classID",
						"label" : "name",
						"value" : "id",	       
						"rows": array_data['rowsFirmClasses']
						}
		               ]									
				dialogInitSelect(dialogId,array)
					
			} // end ajax success

		}); // end ajax
		
		break;
	}
	
}