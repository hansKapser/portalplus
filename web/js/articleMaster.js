var $gridClass;
var files;

function articleMasterInit() {
	registerMenuArticle('articleMasterListInit')
	} // end function mainMenu

function articleMasterListInit() {
	console.log("function articleMasterListInit");
	console.log(_htmlContent);
	$gridClass=undefined;
	var rowGrid=isGridContent("articleMasterListInit");
	dialogObj=
	{
		"divId": "#dialogArticleDiv",
	    "dialogId" : "form#dialogArticle",
		"gridId": "#gridArticle",
		"dialogBox": {
				"width": "1000",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogArticle",
		   "udfInit" : "changeCategory(dialogId,'init',row)",
		   "srcImage" :
			   {
			   "htmlId" : "#imageArticle",
			   "url" : "/getArticleFile"
			   },
		   "select": [
	            {
	          		"field": "group_id",
			        "label" : "name",
			        "value" : "id",	       
			        "rows": array_data['rowsGroups']
			    },
	            {
          		"field": "variation1_group_id",
		        "label" : "name",
		        "value" : "variation_group_id",	       
		        "rows": array_data['rowsCategories'],
		        "blank" : {"label" : '',"value" : ''}
		        },
	            {
	          		"field": "variation2_group_id",
			        "label" : "name",
			        "value" : "variation_group_id",	       
			        "rows": array_data['rowsCategories'],
			        "blank" : {"label" : '',"value" : ''}
			    },
		        {
	            "field": "vat_id",
			    "label" : "name",
			    "value" : "vat_id",	       
			    "rows": array_data['rowsVAT']
			    }
               ],
	           "change": [
	               {
	               "field" : "variation1_group_id",
	               "udf"   : "changeCategory(dialogId,this,row)"
	               },
	               {
	               "field" : "variation2_group_id",
	               "udf"   : "changeCategory(dialogId,this,row)"
	               }
	               ]
	        }
	}


$gridClass= new _myGrid("#gridArticle",rowGrid,dialogObj);
var dialogId = $("form#dialogArticle");
dialogId.find('input[type=file]').on('change', prepareUpload);

}


function changeCategory(dialogId,pField,row=new Array()) {
	console.log(pField);
	
		if (pField=="init") {
			var field="variation1_group_id";
			var value=row.variation1_group_id;
		} else {
			var field=pField.name;
			var value=pField.value;		
		}

			var array=new Array();
			array[0]={};
			if (field=="variation1_group_id") {
				array[0].field='variation1_id';	
				if (value>=0 && value!='') {
					array[0].filter='rows[i].variation_group_id=='+value;
				} else {
					array[0].filter='1==2';
				}
			} else {
				array[0].field='variation2_id';
				if (value>=0 && value!='') {
					array[0].filter='rows[i].variation_group_id=='+value;
				} else {
					array[0].filter='1==2';
				}
					
			}
			
			array[0].rows=array_data["rowsVariations"];
			array[0].label='name';
			array[0].value='id';
			
		
			dialogInitSelect(dialogId,array);	
			
			if (pField=="init") {
				var field="variation2_group_id";
				var value=row.variation2_group_id;
			
			array[0].field='variation2_id';
			if (value>=0 && value!='') {
				array[0].filter='rows[i].variation_group_id=='+value;
			} else {
				array[0].filter='1==2';
			}
			array[0].rows=array_data["rowsVariations"];
			array[0].label='name';
			array[0].value='id';
			dialogInitSelect(dialogId,array);	
			}
			
}

function articleMasterSavePost() {
	$gridArticle.pqGrid("refreshDataAndView");
	return;
}

function prepareUpload(event) {
	files = event.target.files;
}

function articleMasterImageUpload() {
	var dialogId = $("form#dialogArticle");
	var id=dialogId.find('input[name="id"]').val();	
	if (id<=0) {
		alert("erst den Artikel speichern, upload funktioniert nur über edit");
		return;
	}

	if (files == undefined)
		return;
	
	var dialogId = $("form#dialogArticle");
	var id=dialogId.find('input[name="id"]').val();	
	var variation1_id=dialogId.find('select[name="variation1_id"]').val();
	var variation2_id=dialogId.find('select[name="variation2_id"]').val();
	var data = new FormData();
	data.append('file', files[0]);
	data.append('id', id);
	data.append('variation1_id', variation1_id);
	data.append('variation2_id', variation2_id);
	
	$.ajax({
		url : 'uploadArticleImageFile',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
					var data={
							"id": id,
							"variation1_id" : variation1_id,
							"variation2_id" : variation2_id,
							"firmID": _session.firmID,
							"timestamp": new Date().getTime()
					}
					
						data=JSON.stringify(data);
						$('#imageArticle').attr('src',"/getArticleFile?data="+data);
					}
	})

}

function articleMasterDataSheetUpload() {
	var dialogId = $("form#dialogArticle");
	var id=dialogId.find('input[name="id"]').val();	
	if (id<=0) {
		alert("erst den Artikel speichern, upload funktioniert nur über edit");
		return;
	}
	
		if (files == undefined)
			return;
		
		var variation1_id=dialogId.find('select[name="variation1_id"]').val();
		var variation2_id=dialogId.find('select[name="variation2_id"]').val();
		var data = new FormData();
		data.append('file', files[0]);
		data.append('id', id);
		data.append('variation1_id', variation1_id);
		data.append('variation2_id', variation2_id);
		
		$.ajax({
			url : 'uploadArticleDataSheetFile',
			data : data,
			type : 'POST',
			processData : false,
			contentType : false,
			success : function(data) {
						var data={
								"id": id,
								"variation1_id" : variation1_id,
								"variation2_id" : variation2_id,
								"firmID": _session.firmID,
								"timestamp": new Date().getTime()
						}
						
							data=JSON.stringify(data);
							url="<a href=javascript:articleDataSheetView()>Datenblatt</a>";
							$('#articleDataSheet').html(url);
						}
		})

}

function articleDataSheetView() {
	var dialogId = $("form#dialogArticle");
	var id=dialogId.find('input[name="id"]').val();	

	$("#articleDataSheetDiv").dialog(
			{
				title : "Datenblatt (#"+id+")",
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");	

	$("#articleDataSheetDiv").css({
		height : 500
	});
	var srcString = '<div><iframe id="frameDataSheet" style="width:100%; height:450px;" frameBorder=0></iframe></div>';
	$("#srcDataSheet").html(srcString);
	var dialogId = $("form#dialogArticle");
	var id=dialogId.find('input[name="id"]').val();	
	
	var data={
			"id": id
	}

	data=JSON.stringify(data);
	$('#frameDataSheet').attr('src',"/getDataSheetFile?data="+data);
	
	
}

function articleGroupsListInit() {
	var rowGrid=isGridContent("articleGroupsListInit");
	$gridClass=undefined;
		dialogObj=
		{
			"divId": "#dialogArticleGroupsDiv",
		    "dialogId" : "form#dialogArticleGroups",
			"gridId": "#gridArticleGroups",
			"dialogBox": {
					"width": "500",
					"modal": true,
					"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
	  		   "phpSaveModul" : "/articleGroupsSave",
			   "dialogId" : "form#dialogArticleGroups"
		        },
			"deleteDialog": {
				"dialogId" : "form#dialogArticleGroups",
				"field" : "id",
				"modul" : "/articleGroupsDelete"
				}
		}

$gridClass= new _myGrid("#gridArticleGroups",rowGrid,dialogObj);
				
}

function articleCategoriesListInit() {
	$gridClass=undefined;
	var rowGrid=isGridContent("articleCategoriesListInit");

		dialogObj=
		{
			"divId": "#dialogArticleCategoriesDiv",
		    "dialogId" : "form#dialogArticleCategories",
			"gridId": "#gridArticleCategories",
			"dialogBox": {
					"width": "500",
					"modal": true,
					"autoopen": false
			},
			"editDialog": {
	  		   "title" : "Edit Record",
	  		   "phpSaveModul" : "/articleCategoriesSave",
			   "dialogId" : "form#dialogArticleCategories"
		        },
			"deleteDialog": {
				"dialogId" : "form#dialogArticleCategories",
				"field" : "id",
				"modul" : "/articleCategoriesDelete"
			        }
		}

$gridClass= new _myGrid("#gridArticleCategories",rowGrid,dialogObj);
}

function articleVariationsListInit() {
	var rowGrid=isGridContent("articleVariationsListInit");
	$gridClass=undefined;
	dialogObj=
	{
		"divId": "#dialogArticleVariationsDiv",
	    "dialogId" : "form#dialogArticleVariations",
		"gridId": "#gridArticleVariations",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
				},
		"editDialog": {
  		   "title" : "Edit Record",
  		   "phpSaveModul" : "/articleVariationsSave",
		   "dialogId" : "form#dialogArticleVariations",
		   		"select": [
	            	{
	            		"field": "variation_group_id",
	            		"label"	: "name",
	            		"value" : "variation_group_id",	       
	            		"rows": array_data["rowsCategories"],
	            		"blank" : {"label" : "","value" : ""}
	            	}
	            	]
	     		},
	     "deleteDialog": {
			"dialogId" : "form#dialogArticleVariations",
			"field" : "id",
			"modul" : "/articleVariationsDelete"
		 		}
	        
	}

$gridClass= new _myGrid("#gridArticleVariations",rowGrid,dialogObj);
	

}


