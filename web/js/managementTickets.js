var $grid;

function managementTicketsInit() {
registerMenuManagementTickets('managementTicketsListInit')
} // end function mainMenu

function registerMenuManagementTickets(registerModul) {

	switch (registerModul) {
	default:
		//console.log(modul);
		//console.log(parameter)
		break;
	
	} // end switch modul
	var data = {
			"action" : "init"
		};

		$.ajax({
			type : "POST",
			dataType : "json",
			url : "/"+registerModul,
			async: true,
			data : JSON.stringify(data),
			success : function(data) {
				array_data = getDataContent(data);
				content=array_data["html"];
				$('div.contentTickets').html(content);
				var jsModul=registerModul+"()";
				eval(jsModul);
			}
		});
	
} // end registerMenumanagementTickets

function managementTicketsListInit() {
	dialogObj=
	{
		"divId": "#dialogTicketsDiv",
	    "dialogId" : "form#dialogTickets",
		"gridId": "#gridTickets",
		"dialogBox": {
				"width": "1000",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogTickets",
		   "select": [
	            {
          		"field": "userID",
		        "groupField" : "class_name",
		        "label" : "user_name",
		        "value" : "userID",	       
		        "rows": array_data['rowsUser']
		        },
		        {
	            "field": "teamID",
			    "label" : "name",
			    "value" : "id",	       
			    "rows": array_data['rowsTeam']
			    }
               ]
	        }
	}

$gridClass= new _myGrid("#gridTickets",array_data["rowGrid"],dialogObj);

}

function ticketsToolbarFilter(value) {
	
	var data = $.param(
			{"data" : JSON.stringify(
				{"year" : value}
			)}
		);

modul="/managementTicketsChangeData";
$.ajax({
type : "POST",
url : modul,
dataType : "json",
data : data,
success : function(data) {
	var arrayData = getDataContent(data);
	$gridClass.obj.dataModel.data=arrayData["rowsTickets"];
	$gridClass._refreshDataAndView();
} // end ajax success

}); // end ajax
}
