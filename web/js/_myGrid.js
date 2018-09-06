// "render" : "dateSql2German(ui.data[ui.rowIndx].date)",
var customRarray=new Array();

var $GRID;
var _rowGrid;
class _myGrid {
	
	
	  constructor(gridId,rowGrid,dialogObj="") {
		/*
		 * make rowGrid public in this class
		 */
		_rowGrid=rowGrid;
		var funcDblClick="";
		var funcAddClick="";
		var funcDeleteClick="";

		this.dialogModel=new Array();
		
		this.Grid=JSON.parse(JSON.stringify(rowGrid));	
		jsonParseError(this.Grid.dialogModel,"dialogModel");
		if (this.Grid.dialogModel!="") {
			jsonParseError(this.Grid.dialogModel,"dialogModel");
			this.dialogModel=JSON.parse(this.Grid.dialogModel);
		}
			
		
		if (this.Grid.dialogBoxes!="") {
			jsonParseError(this.Grid.dataBoxes,"dataBoxes");
			this.dialogBoxes=JSON.parse(this.Grid.dialogBoxes);
			for (var i=0;i<this.dialogBoxes.length;i++) 
				$(this.dialogBoxes[i].divId).dialog(this.dialogBoxes[i].dialogBox);
		}

		
		if (dialogObj.popup==undefined)
			dialogObj.popup=true;
		if (dialogObj.toolbarFilter==undefined)
			dialogObj.toolbarFilter='';

		this.dialogModel=dialogObj;
		jsonParseError(this.Grid.objGrid,"objGrid");
		this.obj = JSON.parse(this.Grid.objGrid);

		this.Grid.toolbar=this.Grid.toolbar.replace(/(\r\n\t|\n|\r\t)/gm,"");
		
		
		if (this.Grid.toolbar.indexOf("{")!=0) 
			this.Grid.toolbar='{'+this.Grid.toolbar+'}';
		
		jsonParseError(this.Grid.toolbar,"toolbar");
		var toolbar = JSON.parse(this.Grid.toolbar);
		
		var z=-1;
		this.obj.toolbar={};
		this.obj.toolbar.items=new Array();
		if (toolbar.items!=undefined) {
		for (var i=0;i<toolbar.items.length;i++) {
			if (toolbar.items[i].status<=_session.status 
					|| toolbar.items[i].status==undefined) {
				this.obj.toolbar.items[++z]=toolbar.items[i];
				
				
				if (toolbar.items[i].type=="select") {					
					/* change-function
					 * pqGrid overhands by itself the evt-Informations
					 * udf=toolbar.items[i].listeners[0].onchange;
					 */
					var options=eval(toolbar.items[i].options)
					var string="[";
					
					for (var ii=0;ii<options.length;ii++) {
						if (string!="[")
							string+=",";
						string+='{"'+options[ii].value+'" : "'+options[ii].label+'"}';
					}
					string+=']';
					//this.Grid.toolbar
					this.obj.toolbar.items[z].options = JSON.parse(string);
					this.obj.toolbar.items[z].type=toolbar.items[i].type;
					this.obj.toolbar.items[z].listeners= [{ 'change': this.toolbarFilter}];
					//udfFilter=toolbar.items[i].change;
					
				} else {
					
					if (toolbar.items[i].label=="Add" || toolbar.items[i].alias=="Add") {
						if (toolbar.items[i].listeners[0].click!="this.addRow") {
							funcAddClick=toolbar.items[i].listeners[0].click;
							this.funcAddClick=funcAddClick;							
						} else {
							funcAddClick="";
							this.funcAddClick="";
						}
						dialogObj.funcAddClick=funcAddClick;
						this.obj.toolbar.items[z].listeners[0].click="this.addRow";
					}

					if (toolbar.items[i].label=="Delete") {
						//toolbar.items[i].listeners[0].click!="this.addRow"
						if (toolbar.items[i].listeners[0].click!="this.deleteRow") {
							funcDeleteClick=toolbar.items[i].listeners[0].click;
							this.funcDeleteClick=funcDeleteClick;
							
						} else {
							funcDeleteClick="";
							this.funcDeleteClick="";
							
						}
						dialogObj.funcDeleteClick=funcDeleteClick;
						this.obj.toolbar.items[z].listeners[0].click="this.deleteRow";
					}
						
					if (toolbar.items[i].label=="Edit")
						if (toolbar.items[i].listeners[0].click!="this.editRow") {
							funcDblClick=toolbar.items[i].listeners[0].click;
							this.funcDblClick=funcDblClick;
						} else {
							funcDblClick="";
							this.funcDblClick="";
						}
							
					this.obj.toolbar.items[z].listeners[0].click=eval(toolbar.items[i].listeners[0].click);
					
				}
			}
		}
		} // endif toolbar defined	
		this.Grid.colModel = this.Grid.colModel.replace(/(\r\n\t|\n|\r\t)/gm,"");
		jsonParseError(this.Grid.colModel,"colModel");
		this.colModel=JSON.parse(this.Grid.colModel);

		for (i=0;i<this.colModel.length;i++) {

			if (this.colModel[i].render!=undefined && this.colModel[i].render!='') {
				customRarray[this.colModel[i].dataIndx]=this.colModel[i].render;
				this.colModel[i].render=function(ui) {
					return (_customRenderer(ui))
					}
			}
		}

		this.obj.colModel = this.colModel;

		
		jsonParseError(this.Grid.dataModel,"dataModel");
		
		this.obj.dataModel = JSON.parse(this.Grid.dataModel);
		
		if (array_data[this.obj.dataModel.data]==undefined) {
			alert("index: "+this.obj.dataModel.data+"\n" +
					"array_data[this.obj.dataModel.data]"+" undefined\n"+
					"should come from ListInit\n"+
					"check Controller ListInit or system_grid dataModel");
		}
		this.obj.dataModel.data = array_data[this.obj.dataModel.data];

		if (this.Grid.groupModel!="") 
			this.obj.groupModel = JSON.parse(this.Grid.groupModel);

		
		$grid = $(gridId).pqGrid(this.obj);
		this.$grid=$grid;
		
		
		$grid.pqGrid("showLoading");
		var thisObj=this;
		$grid.keyup(function (evt,ui) {
			if (evt.originalEvent.code=="ArrowDown") {
				if (thisObj._getRowIndx()==null) 
					$grid.pqGrid( "setSelection", {rowIndx:0} );
			}
			if (evt.originalEvent.code=="Enter") {
				if (thisObj._getRowIndx()!=null) 
					thisObj.editRow();
			}
			
		})

		$(gridId).pqGrid({
			
			rowDblClick : function(event, ui) {
				thisObj.editRow();
				if (funcDblClick=='') {
					thisObj.editRow();
				} else {
					eval(funcDblClick);	
				}
				
			}
			
		});

		// at least get filters
		if (this.obj.dataModel.data.length>0) {
			
			for (var i=0;i<this.colModel.length;i++) {
				if (this.colModel[i].filter!=undefined && this.colModel[i].filter!="") {
					var column = $grid.pqGrid("getColumn", {
						dataIndx : this.colModel[i].dataIndx
					});
				var filter = column.filter;
					filter.cache = null;
					filter.options = $grid.pqGrid("getData", {
						dataIndx : [ this.colModel[i].dataIndx ]
					});
					
					/* german Date in List
					 * @todo
					if (filter.options[0].date!=undefined) {
						for (var ii=0;ii<filter.options.length;ii++)
							filter.options[ii].date=dateSql2German(filter.options[ii].date);
					}
					*/
				}
			}

			$grid.pqGrid("refreshDataAndView");
		}

		$grid.pqGrid("hideLoading");
		  
	  } // end constructor
	  

	  _getRowIndx() {
			if ($grid==undefined || $grid=="") return;
			
			var arr = $grid.pqGrid("selection", {
				type : 'row',
				method : 'getSelection'
			});
			if (arr && arr.length > 0) {
				return arr[0].rowIndx;
			} else {
				//alert("Select a row.");
				return null;
			}
		}

	    toolbarFilter(evt,ui) {
	    	
	    	var value=evt.currentTarget.value;
	    	var name=evt.currentTarget.name;
	    	if (dialogObj.toolbarFilter!=undefined 
	    			&& dialogObj.toolbarFilter!='')
	    		if (dialogObj.filterDialog==undefined)
	    			alert("define filterDialog @see: accountancyOverview.js");
	    		dialogObj.toolbarFilter=dialogObj.toolbarFilter.replace("value","value,"+JSON.stringify(dialogObj.filterDialog));
	    		eval(dialogObj.toolbarFilter);
	    }
	    
	    addRow () {
	    	/*
	    	if (this.funcAddClick!=undefined)
	    		funcAddClick=this.funcAddClick;
	    	if (funcAddClick!=undefined)
	    		funcAddClick=funcAddClick;
	    	*/
	    	var funcAddClick=dialogObj.funcAddClick;
	    	
	    	if (funcAddClick=="this.addRow") {
	    		// use same definition as edit
	    		_standardEdit();
	    	} else {
	    		eval(funcAddClick);	
	    	}
	    	
	    	
	    }

	    deleteRow () {
	    	var funcDeleteClick=dialogObj.funcDeleteClick;
			if (this._getRowIndx==undefined) {
				var arr = $grid.pqGrid("selection", {
					type : 'row',
					method : 'getSelection'
				});
				if (arr && arr.length > 0) 
					var rowIndx=arr[0].rowIndx;
				
			} else {
				var rowIndx = this._getRowIndx();	
			}
			
			
			if (rowIndx == null) 
				return;

				var row = $grid.pqGrid('getRowData', {
					rowIndx : rowIndx
				});
			
	    	
			//funcDeleteClick=dialogObj.funcDeleteClick;
			if (funcDeleteClick!="") {
	    		eval(funcDeleteClick);	
				$grid.pqGrid("deleteRow", {
					rowIndx : rowIndx
				});
	    	} else {
    			/*
    			 * @todo: automatical delete
    			 */
	    		this.dialogModel=dialogObj;
	    		
	    		
	    		if (this.dialogModel.deleteDialog==undefined) {
	    			alert('programer define a deleteDialog in overhanded dialogModel!\nexample in purchaseBook.js')
	    			return;
	    		} else {
	    			
	    			var field=this.dialogModel.deleteDialog.field;
	    			console.log(this.dialogModel.deleteDialog.field);
	    			var id=eval('row.'+field);
	    			
	    			var dialogId=$(this.dialogModel.deleteDialog.dialogId);
	    			var modul=this.dialogModel.deleteDialog.modul;
	    			var postFunction="";
	    			
	    			if (dialogDeleteId(dialogId,id,modul,postFunction)) {
						$grid.pqGrid("deleteRow", {
							rowIndx : rowIndx
						});	    				
	    			}

	    		}
	    	}
	    	
	    	
	    }

	    editRow () {
			if (this._getRowIndx==undefined) {
				var arr = $grid.pqGrid("selection", {
					type : 'row',
					method : 'getSelection'
				});
				if (arr && arr.length > 0) 
					var rowIndx=arr[0].rowIndx;
				
			} else {
				var rowIndx = this._getRowIndx();	
			}
			
			
			if (rowIndx == null) 
				return;

				var row = $grid.pqGrid('getRowData', {
					rowIndx : rowIndx
				});

				if (this.funcDblClick!=undefined && this.funcDblClick!="") {
					eval(this.funcDblClick);
				} else {
					_standardEdit(row,rowIndx);
				}

				

		}
	  
		_refreshDataAndView() {
			alert("hier in _refreshDataAndView");
			$grid.pqGrid('option', "dataModel", this.obj.dataModel)
			$grid.pqGrid("refreshDataAndView");
		}
		
		
} // end class

function _customRenderer( ui ) {
	return (eval(customRarray[ui.dataIndx]))
	};

function _standardEdit(row=undefined,rowIndx=undefined) {
	
		this.dialogModel=dialogObj;
		dialogId=$(this.dialogModel.dialogId);
		console.log("_standardEdit");
		console.log(dialogObj);
		
		var array=new Array();

		/* initSelect
		 * defined in p17_system_grid -> dialogModel.select
		 */
		
		if (this.dialogModel.editDialog.select!=undefined && this.dialogModel.editDialog.select!="") {
		var arrayA=new Array();
		var arrayG=new Array();
		var ai=-1;
		var oai=-1;
		var gai=-1;
		
		for (var i=0;i<this.dialogModel.editDialog.select.length;i++) {
			if (this.dialogModel.editDialog.select[i].groupField!=undefined) {
				arrayG[++gai]=this.dialogModel.editDialog.select[i];
			} else {
				if (this.dialogModel.editDialog.select[i].autocomplete==1) {
					arrayA[++ai]=this.dialogModel.editDialog.select[i];			
				} else {
					array[++oai]=this.dialogModel.editDialog.select[i];
				}
			}
		}
		
		if (arrayA.length>0)
			dialogInitAutocomplete(dialogId,arrayA);
		
		if (arrayG.length>0)
			dialogInitSelectG(dialogId,arrayG);
		
		if (array.length>0)
			dialogInitSelect(dialogId,array);
		}

		/* fieldChanges
		 * defined in p17_system_grid -> dialogModel.change
		*/
			
		if (this.dialogModel.editDialog.change!=undefined && this.dialogModel.editDialog.change!="") {
			for (var i=0;i<this.dialogModel.editDialog.change.length;i++) {
		
		/* fieldID
		 * @todo: check for checkbox as well as radio
		 */
				var field=this.dialogModel.editDialog.change[i].field;
				if (dialogId.find('select[name="'+this.dialogModel.editDialog.change[i].field+'"]')!="undefined")
					var fieldID=dialogId.find('select[name="'+this.dialogModel.editDialog.change[i].field+'"]');
				if (dialogId.find('input[name="'+this.dialogModel.editDialog.change[i].field+'"]')!="undefined")
					var fieldID=dialogId.find('select[name="'+this.dialogModel.editDialog.change[i].field+'"]');
				var udf=this.dialogModel.editDialog.change[i].udf;
				//console.log(field+" "+udf);
				fieldID.change(function() {
					eval(udf);
				});

				
			}
		}
		
		if (row!=undefined) {
			dialogInit(dialogId,row);	
		}
		
		if (this.dialogModel.editDialog.udfInit!=undefined)
			eval(this.dialogModel.editDialog.udfInit);
		
		if (this.dialogModel.editDialog.srcImage!=undefined) {
			var data={
					"id": row.id,
					"firmID": _session.firmID,
					"timestamp": new Date().getTime()
			}
			
			data=JSON.stringify(data);
			$(this.dialogModel.editDialog.srcImage.htmlId).attr('src',this.dialogModel.editDialog.srcImage.url+"?data="+data);
			
		}

		if (this.dialogModel.popup) {
			title=this.dialogModel.editDialog.title;
			if (row==undefined) 
				title="Add Row";
		phpSaveModul=this.dialogModel.editDialog.phpSaveModul;
		console.log(this.dialogModel.editDialog);
		if (this.dialogModel.dialogBox.width!=undefined) {
			var width=this.dialogModel.dialogBox.width;
		} else {
			if (this.dialogModel.editDialog.width!=undefined) {
			var width=this.dialogModel.editDialog.width;
		} else {
			var width=500;
		}
		}
		
		$(this.dialogModel.divId).dialog(
				{
					title : title,
					width: width,
					modal: false,
					buttons : {
						Update : function() {
							
							var row = dialogGetRow(dialogId);
							
							if (rowIndx==undefined) {
								$grid.pqGrid('addRow', {
									row : row,
									checkEditable : false
								});
								this.dialogModel=dialogObj;
								this.dialogModel.editDialog.postSave!=undefined 
								&& this.dialogModel.editDialog.postSave!="" 
									? postSave=this.dialogModel.editDialog.postSave
									: postSave='';
						if (phpSaveModul==undefined) {
							alert('define a phpSaveModul in grid -> editDialog!');
						}
						
						
						dialogSave(dialogId,-1,phpSaveModul,postSave)
								
							} else {
								$grid.pqGrid('updateRow', {
									rowIndx : rowIndx,
									row : row,
									checkEditable : false
								});
								this.dialogModel=dialogObj;
								this.dialogModel.editDialog.postSave!=undefined 
								&& this.dialogModel.editDialog.postSave!="" 
									? postSave=this.dialogModel.editDialog.postSave
									: postSave='';
								if (phpSaveModul==undefined) {
									alert('define a phpSaveModul!');
								}
								
								
								dialogSave(dialogId,row.id,phpSaveModul,postSave)
								
							}
							
							

							$(this).dialog("close");
						},
						
						Cancel : function() {
							$(this).dialog("close");
						}
					}
				}).dialog("open");
		} else {
			alert("ohne PopUp");
		}// endif dialogModel.popup

	}

function jsonParseError(string,obj) {
var ret=true;
if(string) {
    try {
        a = JSON.parse(string);
        ret=true;
    } catch(e) {
        alert(obj+"\n"+e); // error in the above string (in this case, yes)!
        ret=false;
    }

}
return (ret);
}