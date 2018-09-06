var $grid;

function managementExamInit() {
registerMenuManagementExam('managementExamListInit')
} // end function mainMenu

function registerMenuManagementExam(registerModul) {

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
				$('div.contentExam').html(content);
				var jsModul=registerModul+"()";
				eval(jsModul);
			}
		});
	
} // end registerMenuexam

function managementExamListInit() {
	dialogObj=
	{
		"divId": "#dialogExamDiv",
	    "dialogId" : "form#dialogExam",
		"gridId": "#gridExam",
		"dialogBox": {
				"width": "1000",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogExam",
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

$gridClass= new _myGrid("#gridExam",array_data["rowGrid"],dialogObj);

}

