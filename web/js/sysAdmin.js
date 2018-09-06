/* mainMenu
 * get all menu-calls 
 * 1st parameter: modul 
 * 2nd parameter: optional parameter as array
 * 	structure of 2nd parameter: key => value
 * fetch via ajax content
 * calls [modulInit]-function 
 * 
 */ 
var $gridClass;

function sysAdminInit() {
// registerMenuStore('storeListInit')
console.log('nothing to do at calling sysAdminInit')
} // end function mainMenu
function sysAdminChangeFirmInit() {
	console.log("function sysAdminGridInit");
	var dialogId = $("form#dialogChangeFirm");
	var array= [
           {
	     		"field": "company",
		        "label" : "company",
		        "value" : "company",
		        "autocomplete": 1,
		        "rows": array_data['rowsFirms']
	        }
			];
	dialogInitSelect(dialogId,array);
	dialogId.find('input[name="change"]').click(function () {
			dialogSave(dialogId,1,'sysAdminChangeFirm');
		})

}

function sysAdminNewFirmsInit() {
	console.log("function sysAdminNewFirmsInit");
	$gridClass=undefined;		

	var rowGrid=isGridContent("sysAdminNewFirmsInit");
	
	dialogObj=
	{
		"divId": "#dialogNewFirmDiv",
        "dialogId" : "form#dialogNewFirm",
		"gridId": "#gridNewFirms",
		"popup": true,
		"dialogBox": {
			"width": "850",
			"modal": true,
			"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogNewFirm",
		   "phpSaveModul" :"/sysAdminNewFirmsSave",
		   "postSave" : "sysAdminNewFirmDelete()",
		   "select": [
	            {
		     		"field": "BICP",
			        "label" : "name",
			        "value" : "BIC",	       
			        "rows": array_data['rowsBanks'],
			        "blank": {
			        	"label": "--- select ---",
			        	"value": ""
			        }
		        }
				]
	        },
	    "deleteDialog": {
	    	"dialogId" : "form#dialogNewFirm",
	  	   	"field" : "firmID",
	  	   	"modul" : "/sysAdminNewFirmsDelete"
		        }

		}
	
		$gridClass = new _myGrid("#gridNewFirms",rowGrid,dialogObj);

}

function sysAdminNewFirmDelete() {
	$gridClass.deleteRow();
	return;
}

function sysAdminGridInit() {
	console.log("function sysAdminGridInit");
	$gridClass=undefined;		
	/*
	 * pqGridObj @see: standard.js prepares obj from mysql-table p17_system_grid
	 * pqGridObj(gridId,rowGrid,rowsData);
	 */
	var rowGrid=isGridContent("sysAdminGridInit");
	dialogObj=
	{
		"divId": "#dialogSysAdminGridDiv",
        "dialogId" : "form#dialogSysAdminGrid",
		"gridId": "#gridSysAdminGrid",
		"funcDblClick": "gridEditRow()",
		"popup": false,
		"dialogBox": {
			"width": "850",
			"modal": true,
			"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogSysAdminGrid"
	        }
		}
	
		

		$gridClass = new _myGrid("#gridSysAdminGrid",rowGrid,dialogObj);
		
		var dialogId = $("form#dialogSysAdminGrid");
		dialogId.find('select[name="field"]').change(function () {
			var field=this.value;
			var rowIndx = $gridClass._getRowIndx();
			var row = $gridClass.$grid.pqGrid('getRowData', {
				rowIndx : rowIndx
			});
			dialogId.find('textarea[name="content"]').html(eval("row."+field));
			if (field=="colModel") {
				dialogId.find('textarea[name="content"]').attr("cols","40");
				
			arraySelect = [ 
				{
					"field": "gridFieldList",
					"rows": row.fieldList,
					"label": 'FieldLabel',
					"value": 'Field'
				}
				];
				console.log(row.fieldList);
				dialogInitSelect(dialogId,arraySelect);
				$('#gridFieldListTd').css("display","table");
				areaId="gridContent";
				dialogId.find('select[name="gridFieldList"]').dblclick(function() {
					var value=this.value;
					for (var i=0;i<row.fieldList.length;i++) {
						if (row.fieldList[i].Field==value) {
							var FieldType=row.fieldList[i].Type;
							break;
						}
					}
					var type="string";

					var string='{"title" : "'+value+'",\n';
					string+='"dataIndx" : "'+value+'",\n';

					if (FieldType.indexOf('int')>=0) {
						type="integer";
						width=50;
					}
						
					if (FieldType.indexOf('varchar')>=0) {
						type="string";
						width=100;
					}
						
					if (FieldType.indexOf('date')>=0) {
						type="string";
						width=80;
						string+='"render" : "dateSql2German(ui.data[ui.rowIndx].'+value+')",\n';

					}
											
					if (FieldType.indexOf('decimal')>=0) {
						type="string";
						width=80;
						string+='"render" : "germanDezimal(ui.data[ui.rowIndx].'+value+')",\n';
					}
					
					string+='"dataType" : "'+type+'",\n';
					string+='"width" : "'+width+'",\n';
					string+='"hidden" : false\n';
					string+="},";
					
					insertAtCaret(areaId,string);
					});
			} else {
				dialogId.find('textarea[name="content"]').attr("cols","80");
				$('#gridFieldListTd').css("display","none");
			}

		})
			
		dialogId.find('input[name="save"]').click(function () {
			dialogSave(dialogId,1,'sysAdminGridSave','gridRefresh()')
		})

}

function insertAtCaret(areaId, text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var caretPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0, caretPos);
    var back = (txtarea.value).substring(txtarea.selectionEnd, txtarea.value.length);
    alert(scrollPos);
    
    txtarea.value = front + text + back;
    caretPos = caretPos + text.length;
    txtarea.selectionStart = caretPos;
    txtarea.selectionEnd = caretPos;
    txtarea.focus();
    txtarea.scrollTop = scrollPos;
}

function gridRefresh() {
	console.log("refresh");
	console.log(array_data["rowsGrid"]);
	$gridClass.$grid.pqGrid( "option", "dataModel", { data: array_data["rowsGrid"]} );
	$gridClass.$grid.pqGrid("refreshDataAndView");
}

// edit Row
function gridEditRow() {

	if ($gridClass==undefined) return;
	
	var rowIndx = $gridClass._getRowIndx();
		
	if (rowIndx == null) 
		return;

		var row = $gridClass.$grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});
		
		var dialogId = $("form#dialogSysAdminGrid");
		var field=dialogId.find('select[name="field"]').val();
	
		// dialogId.find('textarea[name="content"]').html(eval("row."+field));
		dialogId.find('#gridContent').html(eval("row."+field));
		// console.log(dialogId.find('textarea[name="content"]').html());
		dialogId.find('input[name="id"]').val(row.id);
	
} // editRow

function gridAddRow() {

		var dialogId = $("form#dialogSysAdminGrid");
		dialogId.find('input[name="id"]').val(-1);
	

		/*
		 * set all input values to NULL
		 * 
		 */
			
} // addRow


function sysAdminPrintTemplatesInit() {
	console.log("function sysAdminPrintTemplatesInit");
	$gridClass=undefined;		
	/*
	 * pqGridObj @see: standard.js prepares obj from mysql-table p17_system_grid
	 * pqGridObj(gridId,rowGrid,rowsData);
	 */
	var rowGrid=isGridContent("sysAdminPrintTemplatesInit");
	dialogObj=
	{
		"divId": "#dialogSysAdminPrintTemplatesDiv",
        "dialogId" : "form#dialogSysAdminPrintTemplates",
		"gridId": "#gridSysAdminPrintTemplates",
		"funcDblClick": "printTemplateEditRow()",
		"popup": false,
		"dialogBox": {
			"width": "850",
			"modal": true,
			"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogSysAdminPrintTemplates"
	        }
		}
	
		

		$gridClass = new _myGrid("#gridSysAdminPrintTemplates",rowGrid,dialogObj);
		
		var dialogId = $("form#dialogTemplates");
			
		dialogId.find('input[name="save"]').click(function () {
			dialogSave(dialogId,1,'sysAdminPrintTemplatesSave','templatesRefresh()')
		})
		
		dialogId.find('select[name="lang"]').change(function () {
			var dialogId = $("form#dialogTemplates");
			var lang=this.value;
			var rowIndx = $gridClass._getRowIndx();
			var row = $gridClass.$grid.pqGrid('getRowData', {
				rowIndx : rowIndx
			});
			
			var field="row.contentText_"+lang;
				dialogId.find('textarea[name="content"]').html(eval(field));
			console.log(dialogId.find('textarea[name="content"]').html());
		});


}

function templatesRefresh() {
	console.log("refresh");
	$grid.pqGrid( "option", "dataModel", { data: array_data["rows"]} );
	$grid.pqGrid("refreshDataAndView");
}

// edit Row
function templatesEditRow() {
	
	if ($gridClass==undefined) return;
	var rowIndx = $gridClass._getRowIndx();

	if (rowIndx == null) 
		return;

		var row = $grid.pqGrid('getRowData', {
			rowIndx : rowIndx
		});
		
		var dialogId = $("form#dialogTemplates");
		dialogInit(dialogId,row);
		var lang=dialogId.find('select[name="lang"]').val();
		var field="row.contentText_"+lang;
		dialogId.find('textarea[name="content"]').html(eval(field));
			
		
	
} // editRow

function templatesAddRow() {

		var dialogId = $("form#dialogTemplates");
		dialogId.find('input[name="id"]').val(-1);
	

		/*
		 * set all input values to NULL
		 * 
		 */
			
} // addRow

function templatesDeleteRow() {
	if (confirm('delete, are you sure?')) {
		var rowIndx = getRowIndx();
		if (rowIndx != null) {
			var row = $grid.pqGrid('getRowData', {
				rowIndx : rowIndx
			});
			var dialogId = $("form#dialogTemplates");
			dialogDeleteId(dialogId,row.id,"sysAdminPrintTemplatesDelete",'');
			$grid.pqGrid("deleteRow", {
				rowIndx : rowIndx
			});
			$grid.pqGrid("setSelection", {
				rowIndx : rowIndx
			});

		}
	}
}

function sysAdminMigrationDatabaseInit() {
	alert("databaseInit");
	dialogId=$("form#sysAdminMigration");
	dialogId.find('input[name="save"]').click(function () {
		dialogSave(dialogId,1,'sysAdminMigrationDoIt');
	})

}