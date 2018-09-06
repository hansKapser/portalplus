// standard.js
var VATrate=19;
var VATrateReduced=7;

	var tbodyTicketFiles='';
	var tbodyTicketFilesInternal='';

	var your_dates=new Array;
	var arrayFiles=new Array;

	var array_data=new Array;
	
	var datepickerGerman={
            numberOfMonths : 1,
            showButtonPanel : false,
			showWeek: true,
			weekHeader: 'KW',
            dateFormat : "dd.mm.yy",
			monthNames: ['Januar','Februar','März','April','Mai','Juni',
			'Juli','August','September','Oktober','November','Dezember'],
			monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
			'Jul','Aug','Sep','Okt','Nov','Dez'],
			dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
			dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
			dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
			onClose: function () {$(this).focus()},
			beforeShowDay: function(date) {
				// check if date is in your array of dates
				if($.inArray(date, your_dates)) {
				// if it is return the following.
				return [true, 'css-class-to-highlight', '"'+date+'"'];
				} else {
				// default
				
				return [true, '', ''];
				}
			}
	}
		var datum = new Date();
		var today = ('0' + datum.getDate()).slice(-2)+ "." + ('0' + (datum.getMonth()+1)).slice(-2)+"." + datum.getFullYear();

/**
 * init_session definition of array:
 * 
 * @see: standard.js hide menu get _session array via ajax show session
 *       information top-left of screen show menu dependig on profile in
 *       _session array
 */

function init_session() {
	hideMenu();
	phpModul="../../session_init.php";
	var data = {
      "content": "init"
    };
    $.ajax({
      type: "POST",
      dataType: "json",
      url: phpModul, 
      data: data,
      success: function(data) {
		var temp_data=getDataContent(data);
		_session=temp_data["session"];
		showAccount(_session);
		showMenu();
	  } // end ajax success

    });  // end ajax
return;
}


		function dateSql2German(date) {
			
		if (date==null) return ('');
		time='';
			
		if (date=='undefined') return ('');
		
		if (date.length>10) {
			time=date.substring(11);
			time=' '+time.substring(0,5);
			date=date.substring(0,10);
		}

		if (date.indexOf('-')<0) return (date);
		if (date=='0000-00-00') return ('');
		if (date=='') return ('');
		if (date==null) return ('');
		if (date.length>10)  date=date.substring(0,10);
		
		var arr_temp = date.split("-"); 
		if (arr_temp.length==3) {
			date=arr_temp[2]+'.'+arr_temp[1]+'.'+arr_temp[0];
		}
		return (date+time);
	}

	function dateIMAP2German(date) {
		var minusDay=0;
		if (date.substr(6, 1) == ' ') minusDay=1;
		var date = date.substr(5, 2-minusDay) + '.'
				+ cMonth2Num(date.substr(8-minusDay, 3)) + '.'
				+ date.substr(12-minusDay, 4)
		return (date);
	}
	function cMonth2Num(string) {

switch (string.substr(0,3)) {
	case "Jan":
	num='01';
	break;
	case "Feb":
	num='02';
	break;
	case "Mar":
	num='03';
	break;
	case "Apr":
	num='03';
	break;
	case "May":
	num='05';
	break;
	case "Jun":
	num='06';
	break;
	case "Jul":
	num='07';
	break;
	case "Aug":
	num='08';
	break;
	case "Sep":
	num='09';
	break;
	case "Oct":
	num='10';
	break;
	case "Nov":
	num='11';
	break;
	case "Dec":
	num='12';
	break;
}
	
	return (num);
}

function cdow(dow) {
	var rueck='';
	
	switch (dow) {
		case 1:
		rueck="Montag";
		break;
		case 2:
		rueck="Dienstag";
		break;
		case 3:
		rueck="Mittwoch";
		break;
		case 4:
		rueck="Donnerstag";
		break;
		case 5:
		rueck="Freitag";
		break;
		case 6:
		rueck="Samstag";
		break;
		case 7:
		rueck="Sonntag";
		break;
		default:
		rueck="";
		break;
		
	}
	
	return (rueck);
}
	function dateJS2Sql(d) {
	
	var date=new Date(d);

	var day = date.getDate();
	if (day<10) day='0'+day;
	var month = date.getMonth();
	month=month+1;
	if (month<10) month='0'+month;
	var year = date.getFullYear();
	
	var hours=strzero(date.getHours()-2,2);
	var minutes=strzero(date.getMinutes(),2);
	return year + '-' + month + '-' + day+' '+hours+':'+minutes;
}

/**
 * getDataContent get data asl JSON from an ajax-reuest mybe rows of a select
 * are NULL: in this case the array is initialized by an empty array: new
 * Array() special return: mysqlError
 * 
 * @see: ./classes/_db_classe.php -> _db_php5/_db_php7 -> _db_query(parameter)
 *       untimely ends with return: array["mysqlError"] special return: success
 * @see: called function by ajax if return["success"] is defined ->
 *       alert($success)
 * @todo: store return[] into variables
 * @todo: return to calling function true or false
 */

	function getDataContent(data) {
		
		var array=new Array;
		$.each( data, function( ) {
	
		if (this.label=="sessionLogout") {					
			// unescape for JssonResonse send an sometimes escaped strings
			string=JSON.parse(this.content);
			// string=unescape(JSON.parse(this.content));
			string=string.replace('\n','<BR>');
			$("#_message").html(string);
			$("#errorMessage").dialog({
			title : "errorMessage",
			buttons : {
				Close : function() {
					top.location.href='/portal17/index';
				}
			}
		}).dialog("open");
			
		return;
		}

			
		if (this.label=="mysqlError") {
			var sessionString="";
			$.each( _session, function(index,value) {
			if (index!="menu") {
			if (sessionString!="") sessionString+="; ";
			sessionString+=index+" => "+value;
			}
			});

			var now = new Date(); 
			var string="Firma: "+_session.firmID+" "+_session.company+"<br>";
			string+="user: "+_session.userID+" "+_session.user+"<BR>";
			string+="<hr>"+sessionString+"<HR>";
			string+="Datum: "+now+"<BR>";
			string+="<BR>";
						
			string+=JSON.parse(this.content);
			string=string.replace('\n','<BR>');
			$("#_message").html(string);
			$("#errorMessage").dialog("open");
		}

		
			if (this.content==null || this.content=="null" || this.content=="") {
				array[ this.label ]=new Array();
			} else {
				array[ this.label ]=JSON.parse(this.content);
			}
			
			if (array[ this.label ]==null) 
				array[ this.label ]=new Array();
		});
		
		if (array["success"]!=null) {
			if (array["success"]!="") alert(array["success"]);
		}
		
		for (var key in array){	
		    if (array.hasOwnProperty(key)) {

			arr_temp=array[key];
			var string="key=arr_temp";
			}
			}
			
		storePublicArrayData(array);
		
		return (array_data);
	}
	
	function storePublicArrayData(array) {
		/*
		 * array_data has a public as well as specific part
		 * 
		 */
		for (var key in array) {
				array_data[key]=array[key];
		}
		
	}
	
	function showAccount(_session) {
	var today = ('0' + datum.getDate()).slice(-2)+ "." + ('0' + (datum.getMonth()+1)).slice(-2)+"." + datum.getFullYear();
	var kw="15";
	$('#greeting_name').html('Hallo '+_session.user_name);
	  var string='<table>';
	  string+='<tr>';
	  string+="<td style='text-align:right;' class=fieldname>Benutzer:</td>";
	  if (_session.isExam==1) {
	  string+="<td style='color: #ff0000;text-align:left;'>";
	  string+=_session.user+'&nbsp;'+'(Prüfung)';
	  } else {
	  string+="<td style='text-align:left;'>";
	  string+=_session.user; // +'&nbsp;';
	  }
	  string+='</td>';
	  string+='<td><a href=../../logout.php><img src=web/images/icon_logout.png></a></td>';
	  string+='</tr>';
	  string+='<tr>';
	  string+="<td style='text-align:right;' class=fieldname>Firma: </td>";
	  string+="<td colspan=2 style='text-align:left;'>";
	  string+=_session.company;
	  string+='</td>';
	  string+='</tr>';
	  string+='<tr>';
	  string+="<td style='text-align:right;' class=fieldname>Status/Profil: </td>";
	  string+="<td colspan=2 style='text-align:left;'>";
	  string+=_session.status+'/'+_session.profile_name;
	  string+='</td>';
	  string+='</tr>';
	  string+='<tr>';
	  string+="<td style='text-align:right;' class=fieldname>Klasse/Team:</td>";
	  string+="<td colspan=2 style='text-align:left;'>";
	  string+=_session.class_name+'/'+_session.team_name;
	  string+='</td>';
	  string+='</tr>';
	  /*
		 * string+='<tr>'; string+="<td style='text-align:right;' class=fieldname>Datum/KW:</td>";
		 * string+="<td colspan=2 style='text-align:left;'>";
		 * string+=today+'/'+kw; string+='</td>'; string+='</tr>';
		 */
	  string+='</table>';
	  
	  $('#account').html(string);
	
		return;
	}
	
	
	function hideMenu () {
		
	$('#navdashboard li').each(function() {     
		$(this).hide();
	});
	$('#navmenu li').each(function() { 
		$(this).hide();
	});
	$('#navtabs li').each(function() {     
		$(this).hide();
	});

	}
	

	function showMenu() {
		
		var arrayMenu=_session["menu"]
		var arrayHidden=_session["hiddenMenu"].split(',');
	
		$('#navdashboard li').each(function() {  
		id=-1;
		for (var ii=0;ii<arrayMenu.length;ii++) {
			if ($(this).attr('id')==arrayMenu[ii]["menu"]) {
				if (arrayHidden.indexOf(arrayMenu[ii]["id"])<0 
					&& _session.status>=arrayMenu[ii].status) {
						$(this).show();
						// $(this).css("display","table");
					}
					
			}
		}
		});

		$('#navmenu li').each(function() {  
		
		if ($(this).attr('id')==undefined) {
				$(this).show();
		} else {
		for (var ii=0;ii<arrayMenu.length;ii++) {
			if ($(this).attr('id')==arrayMenu[ii]["menu"]) {
	
				if (arrayHidden.indexOf(arrayMenu[ii]["id"])<0 
					&& _session.status>=arrayMenu[ii].status) { 
						$(this).show();
					} else {
						$(this).hide();
					}
			}
		}
		}
		});
		
		$('#navtabs li').each(function() {  
		id=-1;
		for (var ii=0;ii<arrayMenu.length;ii++) {
					
			if ($(this).attr('id')==arrayMenu[ii]["menu"]) {
				
				if (arrayHidden.indexOf(arrayMenu[ii]["id"])<0 
					&& _session.status>=arrayMenu[ii].status) {
						$(this).show();
					} else {
						$(this).hide();
					}
					
			}
		}
		});

		/*
		 * getMenu write <li id= to p17_menu @todo: stop this modul completed
		 * the implementation after getMenu you have to login newly for menu
		 * structure is read by login
		 */
		getMenu();
		return;
		
	}

	
	function getMenu() {
	var rows=new Array;
	
	$('#navdashboard li').each(function() {     
	rows.push($(this).attr('id'));
	});

	$('#navmenu li').each(function() {     
	rows.push($(this).attr('id'));
	});

	$( "#navtabs li" ).each(function() {
	rows.push($(this).attr('id'));
	});

	
	
			phpModul = "dashboardMenuUpdate";
			var data = {
				"action" : "update",
				"data" : JSON.stringify(rows)
			};
		data = $.param(data);

		$.ajax({
			type : "POST",
			dataType : "json",
			url : phpModul,
			data : data,
			success : function(data) {
				var array_data=getDataContent(data);
			} // end ajax success

		}); // end ajax

	return;
	}

	function showIconMenu(pmenu) {
		if (arguments.length<1) pmenu='icon_menu';
	
	if ($('#'+pmenu).css('visibility')=='visible') {
		$('#'+pmenu).css('visibility','hidden');	  
	} else {
		var y=window.innerWidth;
		$('#'+pmenu).css('right',10);
		$('#'+pmenu).css('visibility','visible');	  
		$('#'+pmenu ).menu();
	}
	return;
	} ;


function germanDezimal(x) {
	if (x==undefined) return('');
	if (x=='0.00') return('');
	if (x=='0') return('');
	var fixed=2;
	if (!isNaN(x)) x=parseFloat(x);
	return(x.toLocaleString('de-DE', { minimumFractionDigits: fixed }));

}


function comma2dot(x) {
	if (x=='' || x==undefined) return(0);
	if (x.indexOf(".")<0 && x.indexOf(",")<0) return (x);
	if (x.indexOf(".")>=0 && x.indexOf(",")<0) return (x);
	if (x.indexOf(".")< x.indexOf(",")) {
		x=x.replace(".","");
		x=x.replace(",",".");
	} else {
		x=x.replace(".","");
	}
	
	return(x);

	}


function cent2euro(value) {
	if (value==0) return ('');
	var x=value/100;
	var fixed=2;
	x.toFixed(fixed); 
	return(x.toLocaleString('de-DE', { minimumFractionDigits: fixed }));
}

function string2number(string) {
	string=comma2dot(string);
	switch (typeof string) {
	case "string":
		return (parseFloat(string));
		break;
	default:
		return (string);
	
	}
}


function number2String(string) {
		return (germanDezimal(string.toString()));	
}


function sqlDateSkip(mysql_string,days) {
var msProTag = 86400000;
	date=sqlDate2js(mysql_string);
	date.setTime(date.getTime() + days * msProTag);
return date;
}

function sqlDate2js(mysql_string)
{ 
   var t, date = null;

   if( typeof mysql_string === 'string' )
   {
      t = mysql_string.split(/[- :]/);

      // when t[3], t[4] and t[5] are missing they defaults to zero
      date = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);          
   }



 var day = date.getDate();
 var month = date.getMonth()+1;
 var year = date.getFullYear();

 return date;   
}
	function selectOptGroup($frm,selectObj,delimiter) {
	var arrayLines=new Array;
	
	$frm.find("select[name='userID']").find('option').each(function()
		{
			if (arrayLines.indexOf($(this).text())==-1) arrayLines.push($(this).text());		
		});
		
		arrayLines.sort();
		categories=new Array;
		group="";
		
		for (var i=0;i<arrayLines.length;i++) {
			var arrayLine=arrayLines[i].split(delimiter);
			
			if (arrayLine[0]!=group) {
				// new group
				
				var index=categories.length;
				categories[index]=new Array;
				categories[index]["label"]=arrayLine[0];
				group=arrayLine[0];
				sub=new Array;
						for (var ii=i;ii<arrayLines.length;ii++) {
							var arrayLine=arrayLines[ii].split(delimiter);
							if (arrayLine[0]==group) {
							indexSub=sub.length;
							sub[indexSub]=new Array;
							sub[indexSub]["label"]=arrayLine[1];
							sub[indexSub]["value"]=arrayLine[2];
							} else {
								break;
							}
						}
			categories[index]["sub"]=sub;	
			} 
		}
		
	$frm.find('select[name="userID"]').empty();
    $.each(categories, function (index) {
            var optgroup = $('<optgroup style="font-size:10">');
            optgroup.attr('label',categories[index].label);

			for (var i=0;i<categories[index].sub.length;i++) {
				   var option = $("<option style='font-size:10;'></option>");
				   option.val(categories[index]["sub"][i].value);
				   option.text(categories[index]["sub"][i].label);
                optgroup.append(option);
			}

			 $frm.find('select[name="userID"]').append(optgroup);

         });
		 }
		 


function getAbsoluteY(elm){
   var y = 0;
   if (elm && typeof elm.offsetParent != "undefined") {
     while (elm && typeof elm.offsetRight== "number") {
       y += elm.offsetRight;
       elm = elm.offsetParent;
     }
   }
y=window.innerWidth;
   alert(y);
}


function tab_workflow_check(workflowStatus) {
if (workflowStatus==undefined) {
	alert("workflowStatus not defined");
	return;
}

var _wf_array=workflowStatus.split(',');
for (var i=0;i<_wf_array.length;i++) {
	var string=_wf_array[i];
	$('#_wf_'+string).attr("class", "ui-icon ui-icon-check");
}
return;
}

function workflowStatus(firmID,ticketID) {
	var array=new Array();
	
	phpModul="../../workflowStatus.php";
		var data = {
		"action": "status",
		"firmID": firmID,
		"ticketID": ticketID
		};
		
	data=$.param(data);
	
    $.ajax({
      type: "POST",
      dataType: "json",
      url: phpModul, 
      data: data,
      success: function(data) {
		
		var array=getDataContent(data);
		
		array_wfS=array["workflowStatus"];
				$('#_wfS_post_in_date').html(dateSql2German(array_wfS["post_in_date"]));
				$('#_wfS_ticketID').html(array_wfS["ticketID"]);
				$('#_wfS_orderNo').html(array_wfS["orderNo"]);
				$('#_wfS_orderDate').html(dateSql2German(array_wfS["orderDate"]));
				$('#_wfS_dispatch').html(array_wfS["dispatch"]);
				$('#_wfS_dispatchDate').html(dateSql2German(array_wfS["dispatchDate"]));
				$('#_wfS_invoiceNo').html(array_wfS["invoiceNo"]);
				$('#_wfS_invoiceDate').html(dateSql2German(array_wfS["invoiceDate"]));
				

	  } // end ajax success

    });  // end ajax

}

function strzero(string,num) {
	string=string.toString();
	var len=string.length;
	if (len<num) {
	var zero='0';
	var left=zero.repeat(num-len);
	string=left+string;
	}
		
	return (string);
}

function br2JS (string) {
	var regex = /<br\s*[\/]?>/gi;
	return(string.replace(regex, "\n"));
}

function isEmpty(obj) {
	if (obj===null) return true;
    var type=typeof obj;
	if (type!='object' && type!='string') alert('standard type: '+type);
	switch (type) {
	case "object":
	for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            return false;
    }
	break;
	case "string":
		if (obj!='') 
			return false;
	break;
	}
    return true;
}


/*******************************************************************************
 * Standard-funtions for order
 */
function standard_saveOrder(phpModul,$frm) {
	if (arguments.length==0) {
		alert("at least one parameter: phpModul");
		return;
	}
	
	if (arguments.length==1) $frm = $("form#dialog-auftragserfassung");	

	var data = {
    "action": "save",
	"orderID": orderID,
	"ticketID": ticketID
    };

	// enable disabled fields for serialize doesn't catch them

    data = $('#dialog-auftragserfassung').serialize() + "&" + $.param(data);
	// include unchecked checkboxes. use filter to only include unchecked boxes.

	$frm.find('input[type=checkbox]').each(function() {     
    if (!this.checked) {
        data += '&'+this.name+'=0';
    } else {
		data += '&'+this.name+'=1';
	}	
	});


    $.ajax({
      type: "POST",
      dataType: "json",
      url: phpModul, 
      data: data ,
      success: function(data) {
		alert('saved '+phpModul);		  
		var array = getDataContent(data);
		rowOrder = array["rowOrder"];
	  } // end ajax sucess
	  }) // ende ajax
	  
	return
}

	
/*******************************************************************************
 * end standard article function
 */

function standard_changeUser(ifield,pform) {
var $frm = $("form#"+pform);	

	switch (ifield) {
		case "classID":
				var classID = $frm.find("select[name='classID']").val();
				$frm.find('select[name="teamID"]').find('option').remove().end();
				$frm.find('select[name="teamID"]').append( new Option('---select---',0) );
				$frm.find('select[name="userID"]').find('option').remove().end();
				$frm.find('select[name="userID"]').append( new Option('---select---',0) );
				var array_teamID=new Array;
				for (i=0;i<rowsUser.length;i++) {
					if (rowsUser[i].classID==classID || classID==0) {
						if (array_teamID.indexOf(rowsUser[i].teamID)<0) {
						array_teamID.push(rowsUser[i].teamID);
						$frm.find('select[name="teamID"]').append( new Option(rowsUser[i].team_name,
						rowsUser[i].teamID) );
						}
					$frm.find('select[name="userID"]').append( new Option(rowsUser[i].name,
					rowsUser[i].userID) );
				}		
				}
				break;
			case "teamID":
				var teamID = $frm.find("select[name='teamID']").val();
				$frm.find('select[name="userID"]').find('option').remove().end();
				$frm.find('select[name="userID"]').append( new Option('---select---',0) );
				
				for (i=0;i<rowsUser.length;i++) {
					if (rowsUser[i].teamID==teamID || teamID==0) {
					$frm.find('select[name="userID"]').append( new Option(rowsUser[i].name,
					rowsUser[i].userID) );
					}		
				}
				break;
			
			} // end switch ifield

return;
}



/**
 * Posteingang called from dashboard and Postinbook
 */ 


function params_unserialize(p){
var ret = {},
    seg = p.replace(/^\?/,'').split('&'),
    len = seg.length, i = 0, s;
for (;i<len;i++) {
    if (!seg[i]) { continue; }
    s = seg[i].split('=');
    ret[s[0]] = s[1];
}
return ret;
}

function variation_value(parameter) {
	return ('subquery');
}

function array2obj(arr) {
  var rv = {};
  for (var i = 0; i < arr.length; ++i)
    if (arr[i] !== undefined) rv[i] = arr[i];
  return rv;
}

function storeSession($grid) {
		var colM=$grid.pqGrid( "option", "colModel" );
		// get filter of 1st column
			var filter={};
			var f=-1;
            for (var i = 0, len = colM.length; i < len; i++) {
				if (colM[i].filter!=undefined) {
					temp=colM[i].filter;					
					if (temp.value==undefined)
						temp.value='';
					if (temp.labelIndx==undefined)
						temp.labelIndx=colM[i].dataIndx;
					var storeTemp={};
					storeTemp.labelIndx=temp.labelIndx;
					storeTemp.value=temp.value;
					/*
					 * cache not at the moment //storeTemp.cache=temp.cache;
					 */
					
					filter[++f]=storeTemp;
				}
			}
		saveSession("purchasebook",filter);
return;
}

function saveSession(label,obj) {
		document.cookie=label+"="+JSON.stringify(obj);
		
	}

function setFilter($grid) {
arrayJSession="";

	var arrTemp=document.cookie.split(';');
			for (var i=0;i<arrTemp.length;i++) {
				if (arrTemp[i].indexOf('purchasebook')>=0) {
					arrTemp=arrTemp[i].split('=');
					arrayJSession=JSON.parse(arrTemp[1]);
					break;
				}
			}
if (arrayJSession=="") return;

var size = Object.size(arrayJSession);

		var colM=$grid.pqGrid( "option", "colModel" );
		
            for (var i = 0; i < colM.length; i++) {
				
				for (var ii=0;ii<size;ii++) {
				
					if (arrayJSession[ii].labelIndx==colM[i].dataIndx && arrayJSession[ii].value!="") {
					colM[i].filter.value = arrayJSession[ii].value;				
					// colM[i].filter.on = true;
					}
				}
			}

}

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};


// Dialogfunction
function dialogInit(dialogId,obj) {
	
	
	for(key in obj){
		if (obj[key] === null)
			obj[key]='';

		if (dialogId.find("textarea[name='"+key+"']").length>0) 
			dialogId.find("textarea[name='"+key+"']").val(obj[key]);
		
		
		if (dialogId.find("input[name='"+key+"']").length>0) {
			var input=dialogId.find("input[name='"+key+"']");
			
			switch (input[0]['type']) {
			case "checkbox":
				
				dialogId.find("input[name='"+key+"']").prop("checked", false);
				if (obj[key]==1) 
					dialogId.find("input[name='"+key+"']").prop("checked", true);
				break;

			default:
				if (obj[key].indexOf('-')==4 
						&& obj[key].indexOf('-',6)==7 
						|| key.indexOf('date')>=0 
						|| key.indexOf('Date')>=0) {
					dialogId.find("input[name='"+key+"']").datepicker(datepickerGerman);
					dialogId.find("input[name='"+key+"']").val(dateSql2German(obj[key]));
				} else {
					dialogId.find("input[name='"+key+"']").val(obj[key]);	
				}
				
				/*
				 * germanDezimal
				 * 
				 */
				if (dialogId.find("input[name='"+key+"']").val().indexOf('.')>=0) {
				if (dialogId.find("input[name='"+key+"']").val().lastIndexOf('.')==dialogId.find("input[name='"+key+"']").val().length-4) 
					dialogId.find("input[name='"+key+"']").val(germanDezimal(dialogId.find("input[name='"+key+"']").val()));
				if (dialogId.find("input[name='"+key+"']").val().lastIndexOf('.')==dialogId.find("input[name='"+key+"']").val().length-3) 
					dialogId.find("input[name='"+key+"']").val(germanDezimal(dialogId.find("input[name='"+key+"']").val()));
				}
				break;
			}
			
			
	    
		}
		
		if (dialogId.find("select[name='"+key+"']").length>0) 
			dialogId.find("select[name='"+key+"']").val(obj[key]);
		
		}
return;
}
/*
 * dialogInitSelect var array=new Array(); array[0]={};
 * array[0].field='from_company'; array[0].rows=array_data["rowsFirms"];
 * array[0].autocomplete=1; array[0].label='company'; array[0].value='company';
 * dialogInitSelect(dialogId,array)
 * 
 */
function dialogInitAutocomplete(dialogId,array) {

	for (var i=0;i<array.length;i++) {
	obj=array[0];
	var source=new Array();
	
		var rows=obj.rows;
		var field=obj.field;
		var label=obj.label;
		var value=obj.value;
		// prepare for autocomplete
		for (var ii = 0; ii < rows.length; ii++) {
			source[ii] = {
				'value' : eval('rows[ii].'+value),
				'label' : eval('rows[ii].'+label)
			};
		}
		
		dialogId.find("input[name='"+field+"']").autocomplete({
			source : source,
			minLength : 0
		});

	}
}

function dialogInitSelect(dialogId,array) {
	
	for (var ai=0;ai<array.length;ai++) {
	obj=array[ai];
	if (obj.filter==undefined)
		obj.filter='1==1';
	
	var source=new Array();
		var rows=obj.rows;
		var field=obj.field;
		var label=obj.label;
		var value=obj.value;
		if (obj.blank!=undefined) {
			var arrayBlank=obj.blank;	
		} else {
			var arrayBlank={};
		}
		
		
		dialogId.find('select[name="'+field+'"]').find('option').remove().end();

		
		if (arrayBlank.label!=undefined) {
			dialogId.find('select[name="'+field+'"]').append(
					new Option(arrayBlank.label, arrayBlank.value));
		}
		
		for(var i=0;i<rows.length;i++) {
			
			if (eval(obj.filter)) {
				
				if (label.indexOf('{')==0) {
					var temp=label;
					temp=temp.substr(1);
					temp=temp.substr(0,temp.length-1);
					
					var string=eval(temp);
				} else {
					var string=eval('rows[i].'+label);	
				}
			
			var id=eval('rows[i].'+value);
			
			dialogId.find('select[name="'+field+'"]').append(
					new Option(string, id));
			}
		}

	}
}
function dialogInitSelectG(dialogId,array) {
	var arrayUser=new Array();
	
	// for (var ai=0;ai<array.length;ai++) {
	obj=array[0];
	if (obj.filter==undefined)
		obj.filter='1==1';
	
	var source=new Array();
	
		var rows=obj.rows;
		var field=obj.field;
		var label=obj.label;
		var value=obj.value;
		var groupField=obj.groupField;
		var arrayGroup=new Array();
	
		dialogId.find('select[name="'+field+'"]').find('option').remove().end();	
		/*
		 * collect groups
		 * 
		 */
		for (var i=0;i<rows.length;i++) {
			var found=false;
			
				if (arrayGroup.indexOf(eval('rows[i].'+groupField))>=0) {
					found=true;
				}
			
			if (!found) {
				arrayGroup.push(eval('rows[i].'+groupField))
			}
			
		}
		
	    for (var gi=0;gi<arrayGroup.length;gi++) {
	    	var group=arrayGroup[gi];
	    	
	    	var optgroup = $('<optgroup style="font-size:10">');
            optgroup.attr('label',group);
            
            for (var i=0;i<rows.length;i++) {
            	if (eval('rows[i].'+groupField)==group) {
            		found=false;
            		if (arrayUser.indexOf(eval('rows[i].user_name'))>=0) {
    					found=true;
    				}
            		
            		if (!found) {
            			
            			arrayUser.push(eval('rows[i].user_name'));
            			var option = $("<option style='font-size:10;'></option>");
            			option.val(eval('rows[i].'+value));
            			option.text(eval('rows[i].'+label));
            			optgroup.append(option);
            		}
            	}
            }
        
            dialogId.find('select[name="userID"]').append(optgroup);
	    }

	    
	
}

function dialogInitSelectTermPayment(dialogId) {
	var array=new Array();
	array[0]=new Array();
	array[0]={
			"rows" : array_data["rowsTermPayment"],
			"field" : "termPayment",
			"label" : "name",
			"value" : "id"
	};
	
	dialogInitSelect(dialogId,array);
}

function dialogDeleteId(dialogId,id,modul,postFunction = '') {
	
	if (!confirm('löschen, sind Sie sicher?'))
		return;
	var data = {};
	
	if (typeof id == "object") {
		for (var i=0;i<id.length;i++)
			data[id[i].field]=id[i].value;
		
	} else {
		data["id"] = id;	
	}
    
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);
	
	$.ajax({
		type : "POST",
		url : modul,
		dataType : "json",
		data : data,
		success : function(data) {
			array_data = getDataContent(data);
			if (postFunction!='') 
				eval(postFunction);
		} // end ajax success

	}); // end ajax


	
	if (postFunction!='') 
		eval(postFunction);
	
	return;
	}

function dialogGetRow(dialogId) {

	var formdata = dialogId.serializeArray();
	
	var data = {};
	$(formdata ).each(function(index, obj){
	    data[obj.name] = obj.value;
	});
	
	dialogId.find('input[type=checkbox]').each(function () {
	    if (this.checked) {
	    	data[this.name]=1;
	    } else {
	    	data[this.name]=0;
	    }
	});
	
	return (data);
}


function dialogSave(dialogId,id,modul,postFunction = '',data=new Array()) {
	
	
	
	if (typeof dialogId=="string")
		dialogId=$("form#"+dialogId);
	
	
	dialogId.find("input[name='buttonSave']").val('add');

	if (data.length==0) {
		var formdata = dialogId.serializeArray();
		
		var data = {};
		
		$(formdata ).each(function(index, obj){
			if (data[obj.name]== undefined)
				data[obj.name] = obj.value;
		});
	
		dialogId.find('input[type=checkbox]').each(function () {
			if (this.checked) {
				data[this.name]=1;
			} else {
				data[this.name]=0;
			}
		});
		
		dialogId.find('input[type=radio]').each(function () {
			data[this.name]=dialogId.find(this).val();
		});

	}
	
	
	var data = {
			"data" : JSON.stringify(data)
		};
	
	data = $.param(data);

	
	
	$.ajax({
		type : "POST",
		dataType : "json",
		url : modul,
		data : data,
		success : function(data) {
			
			if (postFunction!='') {
				
				var array_data = getDataContent(data);
				eval(postFunction);
			} else {
				var array_data = getDataContent(data);
			}
				
		} // end ajax success

	}); // end ajax

	
	}


/*
 * end dialogfunction
 */
function innerHTMLInit(htmlId,obj) {

	for(key in obj){
		value=obj[key];
		if (obj[key].length==10 
				&& obj[key].indexOf('-')==4 
				&& obj[key].indexOf('-',6)==7) 
			value=dateSql2German(obj[key]);
		
		/*
		 * germanDezimal
		 * 
		 */
		if (value.indexOf('.')>=0) {
		if (value.lastIndexOf('.')==value.length-4) 
			value=germanDezimal(value);
		if (value.lastIndexOf('.')==value.length-3) 
			value=germanDezimal(value);
		}

		htmlId.find('#'+key).html(value);
	}

}
function tbodyRows(htmlId,tbody,rows,filter="",insert=true) {

	if (filter=="")
			filter="1==1";
	
		if (rows==undefined)
			rows=new Array();
		
		var string="";
		for (var i=0;i<rows.length;i++) {
			if (eval(filter)) {
				
			var obj=rows[i];
			
			var temp=tbody;
			for(key in obj){
				var search='['+key+']';
				var replacement=obj[key];
				if (replacement==null)
					replacement='';
				
				if (temp.indexOf(search)>=0)
					temp=temp.split(search).join(replacement);
				
				
			}
			
			var z=-1;
			while (temp.indexOf('{')>=0) {
				z++;
				temp=tbodyRowsEmbedded(temp);
				if (z==50) break;
			}
			
			
		string+=temp;	
			} // endif filter
		} // next
		
		if (insert)
			$('#'+htmlId).html(string);
		return(string);
	}

function tbodyRowsG(htmlId,tbody,rows,groupField) {
	var string="";
	
	var colspan = tbody.split("<td").length - 1;
	colspan += tbody.split("<TD").length - 1;
	colspan += tbody.split("<Td").length - 1;
	
	var arrayGroups=new Array();
	for (var i=0;i<rows.length;i++) {
		if (arrayGroups.indexOf(rows[i][groupField])<0)
			arrayGroups.push(rows[i][groupField]);
	}
	
	for (var gi=0;gi<arrayGroups.length;gi++) {
		var group=arrayGroups[gi];
		var style="background-color: #eee; font-weight: bold;";
		string+="<tr><td colspan="+colspan+" style='"+style+"'>"+group+"</td></tr>";
	
	for (var i=0;i<rows.length;i++) {
		if (rows[i][groupField]==group) {
	
		var obj=rows[i];
		var temp=tbody;
		for(key in obj){
			var search='['+key+']';
			var replacement=obj[key];
			
			if (temp.indexOf(search)>=0)
				temp=temp.split(search).join(replacement);
			
			
		}
		
		var z=-1;
		while (temp.indexOf('{')>=0) {
			z++;
			temp=tbodyRowsEmbedded(temp);
			if (z==50) break;
		}
		
		string+=temp;
		}
	}
	}
	$('#'+htmlId).html(string);
	return(string);
}

	function tbodyRowsEmbedded(temp) {
		
		var pos=temp.indexOf('{');
		var pos2=temp.indexOf('}');

		var search=temp.substr(pos,pos2-pos+1);
		var func=search.substr(1,pos2-pos-1);
		var value=eval(func);
		
		return (temp.replace(search,value));

	}


function ticketFiles(ticketID=-1) {
	
	var dialogId=$("form#dialogFiles");
	dialogId.find('input[type=file]').val('');
	
	if (ticketID==-1) {
		ticketID=dialogId.find("input[name='ticketID']").val();
	} else {
		dialogId.find("input[name='ticketID']").val(ticketID);
	}
	
	dialogId.find('input[type=file]').on('change', prepareUpload);
	var data = {
			"ticketID" : ticketID
		};
	
	data = $.param(data);
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "/ticketGetFiles",
			async: true,
			data : data,
			success : function(data) {
				var array_data = getDataContent(data);
				rowsFiles=array_data["rowsFiles"];
				rowsFilesInternal=array_data["rowsFilesInternal"];
				if (tbodyTicketFiles=='') 
					tbodyTicketFiles=$('#tbodyTicketFiles').html();
					
				if (tbodyTicketFilesInternal=='') 
					tbodyTicketFilesInternal=$('#tbodyTicketFilesInternal').html();
				
				tbodyRows('tbodyTicketFiles',tbodyTicketFiles,rowsFiles);
				tbodyRows('tbodyTicketFilesInternal',tbodyTicketFilesInternal,rowsFilesInternal);
				
			}
		});

	$("#ticketDocuments").dialog(
			{
				title : "Dokumente zu ticket# "+ticketID,
				width: 1200,
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	}

function filePreview(id) {
	var dialogId=$("form#dialogFiles");
	ticketID=dialogId.find("input[name='ticketID']").val();
	var data={
			"id": id
	}
	data=JSON.stringify(data);
	$('#previewFile').attr('src',"/getTicketFile?data="+data);

}

function ticketFileUpload(postblock='',ticketID=-1,dialogId='') {
	if (ticketID==-1) {
	var dialogId=$("form#dialogFiles");
	if (ticketID=-1)
		ticketID=dialogId.find("input[name='ticketID']").val();
	}
	if (files == undefined)
		return;
	var data = new FormData();
	data.append('file', files[0]);
	data.append('ticketID', ticketID);
	
	$.ajax({
		url : 'uploadTicketFile',
		data : data,
		type : 'POST',
		processData : false,
		contentType : false,
		success : function(data) {
			var array=getDataContent(data);
			dialogId.find("input[name='file']").val('');
			if (postblock!='') eval(postblock);
			}
	})

}

function moveTicketFile(id,postblock='') {
	/*
	 * var dialogId=$("form#dialogFiles"); var
	 * ticketID=dialogId.find("input[name='ticketID']").val();
	 * 
	 * var data = { "id": id }; data = $.param(data); $.ajax({ type : "POST",
	 * dataType : "json", url : "/moveTicketFile", async: true, data : data,
	 * success : function(data) { if (postblock!='') eval(postblock); } });
	 */
}

function showCatalogue(firmID=-1) {
	if (firmID==-1) 
		firmID=_session.firmID;
	$("#dialogCatalogue").dialog(
			{
				title : "Katalog firmenID# "+firmID,
				width: 1200,
				height: 400,
				buttons : {
					Close : function() {
						$(this).dialog("close");
					}
				}
			}).dialog("open");
	

	var srcString = '<div><iframe id="frame" style="width:100%; height:450px;" frameBorder=0></iframe></div>';
	$("#srcCatalogue").html(srcString);
	var data={
			"kind": "catalogue",
			"firmID": firmID,
			"timestamp": new Date().getTime()
	}
	data=JSON.stringify(data);
	$('#frame').attr('src',"/getFirmFile?data="+data);
	
}

function checkFirmID(company) {
	if (company=='') {
		alert('geben Sie eine Firma ein!');
		return (-1);
	}

	var firmID=-1;
	for (var i=0;i<array_data["rowsFirms"].length;i++) {
		if (array_data["rowsFirms"][i].company==company) {
			firmID=array_data["rowsFirms"][i].firmID;
			break;
		}
	}
	
	if (firmID==-1) {
		alert('Firma: "'+company+'" not found!');
		return (-1);
	}
	
	return (firmID);
}

/*
 * pqGrid function
 * 
 */
function getPqGrid(rowGrid) {
	
var Grid=JSON.parse(JSON.stringify(rowGrid));	
var obj = JSON.parse(Grid.objGrid);

Grid.toolbar=Grid.toolbar.replace(/(\r\n\t|\n|\r\t)/gm,"");

obj.toolbar = JSON.parse('{'+Grid.toolbar+'}');
// must be done in main-function
/*
 * embeded function addRow for (var i=0;i<obj.toolbar.items.length;i++)
 * obj.toolbar.items[i].listeners[0].click=eval(obj.toolbar.items[i].listeners[0].click)
 */

Grid.colModel = Grid.colModel.replace(/(\r\n\t|\n|\r\t)/gm,"");
var colModel=JSON.parse(Grid.colModel);


for (var i=0;i<colModel.length;i++) {
	if (colModel[i].render!=undefined && colModel[i].render!="") {

		var render=colModel[i].render;
		colModel[i].render=function(ui) {
			return (eval(render));}			
	}

}

obj.colModel = colModel;
var dataModel = JSON.parse(Grid.dataModel);
obj.dataModel = dataModel;
obj.dataModel.data = array_data[dataModel.data];
return (obj);
}

class _Position {
	
	
	  constructor(obj) {
		  if (obj.dataRowsName==undefined)
		    	obj.dataRowsName='rowsOrderPositions';
		  this.dataRowsName=obj.dataRowsName;

		if (obj.className==undefined)
	    	obj.className='classPosition';
	    this.className=obj.className;
	    if (obj.postFunction==undefined) {
	    	obj.postFunction=this.className+"._refresh()";
	    } else {
	    	obj.postFunction=obj.postFunction+";"+this.className+"._refresh()";
	    }
	    	
	    if (obj.division==undefined)
	    	obj.division='E';
	    this.division=obj.division;
	    this.postFunction=obj.postFunction;
        this.dialogId = obj.dialogId;
		this.htmlId = obj.htmlId;
		this.firmID = obj.firmID;
		this.phpModulSave= obj.phpModulSave;
		if (obj.phpModulDelete==undefined)
	    	obj.phpModulDelete=this.phpModulSave.replace('Save','Delete');
		this.phpModulDelete= obj.phpModulDelete;
	    this.tbodyTemplate = obj.tbody;
	    this.orderID = obj.orderID;
	    this.rowsPositions = obj.rowsPositions;
	    this.rowsArticle=obj.rowsArticle;
	    if (obj.rowsArticleFilter==undefined)
	    	obj.rowsArticleFilter='S';
	    this.rowsArticleFilter=obj.rowsArticleFilter;
	    this.rowsVariation=obj.rowsVariation;
	    this.rowsVariationSpec=obj.rowsVariationSpec;
	    this.rowsVAT=obj.rowsVAT;
	    this.autoCompleteArticle=new Array();
		var a=-1;
		for (var i = 0; i < this.rowsArticle.length; i++) {
			
			if (this.rowsArticleFilter=='' 
				|| this.rowsArticleFilter==this.rowsArticle[i].kind) {
			this.autoCompleteArticle[++a] = {
				'value' : this.rowsArticle[i].article_code,
				'label' : this.rowsArticle[i].article_code+" "+this.rowsArticle[i].name
			}
			}
		}
		
		
		this.dialogId.find('input[name="article_code"]').autocomplete({
			source : this.autoCompleteArticle,
			minLength : 0
		});

		var array=new Array();
		array[0]={};
			array[0].field='vat_id';
			array[0].rows=this.rowsVAT;
			array[0].label='name';
			array[0].value='vat_id';
			if (this.division=="E") {
				array[0].filter='rows[i].UV=="V"';	
			} else {
				array[0].filter='rows[i].UV=="U"';
			}
			
		dialogInitSelect(this.dialogId,array);
	    
		var dialogId=this.dialogId;
		var phpModulSave=this.phpModulSave;
		var postFunction=this.postFunction;
		this.dialogId.find('input[name="saveButton"]').click(function() {
			dialogSave(dialogId,-1,phpModulSave,postFunction);
		});
	    
	  } // end constuctor
	  
	  _deletePosition(id) {
		  console.log(this.phpModulDelete);
		  dialogDeleteId(this.dialogId,id,this.phpModulDelete,this.postFunction);
	  }
	  
	  _editPosition(id) {
		  
		for (var i=0;i<this.rowsPositions.length;i++) {
			if (this.rowsPositions[i].id==id) {
				var article_id=this.rowsPositions[i].article_id;
				var variation1_id=this.rowsPositions[i].variation1_id;
				var array=new Array();
				array[0]={};
					array[0].field='variation1_id';
					array[0].rows=array_data["rowsVariationSpec"];
					array[0].label='variation1';
					array[0].value='variation1_id';
					array[0].filter='rows[i].article_id=='+article_id;
				array[1]={};
					array[1].field='variation2_id';
					array[1].rows=array_data["rowsVariationSpec"];
					array[1].label='variation2';
					array[1].value='variation2_id';
					array[1].filter='rows[i].variation1_id=='+variation1_id+' && rows[i].article_id=='+article_id;

				dialogInitSelect(this.dialogId,array)
				dialogInit(this.dialogId,this.rowsPositions[i]);
				this.dialogId.find("input[name='saveButton']").val('update');
				break;
			}
		}		  
	  }
	  
	  _refresh() {
		  /*
			 * rowsPosition in controler to define
			 */
		  this.rowsPositions=array_data[this.dataRowsName];
		  tbodyRows(this.htmlId,this.tbodyTemplate,this.rowsPositions);
		  
		  this.dialogId.find('input').val('');
		  this.dialogId.find('input[name="orderID"]').val(this.orderID);
		  this.dialogId.find('input[name="id"]').val(-1);
		  this.dialogId.find('input[name="article_id"]').val(-1);
		  this.dialogId.find("input[name='saveButton']").val('add');
	  }
	  
	  sayHi() {
		  	  
			tbodyRows(this.htmlId,this.tbodyTemplate,this.rowsPositions);
			var rowsArticle=this.rowsArticle;
			var dialogId=this.dialogId;
			
			this.dialogId.find("input[name='article_code']").blur(function() {
				
				for (var i=0;i<rowsArticle.length;i++) {
					if (rowsArticle[i].article_code==this.value) {
						rowsArticle[i].article_id=rowsArticle[i].id;
						var article_id=rowsArticle[i].id;
						delete rowsArticle[i].id;
						dialogInit(dialogId,rowsArticle[i]);
					
					var array=new Array();
					array[0]={};
					
						array[0].field='variation1_id';
						array[0].rows=array_data["rowsVariationSpec"];
						array[0].label='variation1';
						array[0].value='variation1_id';
						array[0].filter='rows[i].article_id=='+article_id;
					dialogInitSelect(dialogId,array)
			
						break;
					}
						
				}
						
					
				}) // end blur
				
				this.dialogId.find("select[name='variation1_id']").blur(function() {
					
					var rowsVariationSpec=array_data["rowsVariationSpec"];
					
					for (var i=0;i<rowsVariationSpec.length;i++) {
						if (rowsVariationSpec[i].variation1_id==this.value) {
							var article_id=rowsVariationSpec[i].article_id;
							delete rowsVariationSpec[i].id;
							dialogInit(dialogId,rowsVariationSpec[i]);
							
						var array=new Array();
						array[0]={};
							array[0].field='variation2_id';
							array[0].rows=array_data["rowsVariationSpec"];
							array[0].label='variation2';
							array[0].value='variation2_id';
							array[0].filter='rows[i].variation1_id=='+this.value+' && rows[i].article_id=='+article_id;
						dialogInitSelect(dialogId,array)
							break;
						}
							
					}
				})
							
					this.dialogId.find("select[name='variation2_id']").blur(function() {
						
						var rowsVariationSpec=array_data["rowsVariationSpec"];
						for (var i=0;i<rowsVariationSpec.length;i++) {
							if (rowsVariationSpec[i].variation2_id==this.value &&
								rowsVariationSpec[i].variation1_id==dialogId.find("select[name='variation1_id']").val()) {
								delete rowsVariationSpec[i].id;
								dialogInit(dialogId,rowsVariationSpec[i]);								
								break;
							}
								
						}
						
					}) // end blur

				this.dialogId.find("input[name='quantity']").blur(function() {
					var quantity=comma2dot(dialogId.find("input[name='quantity']").val());
					var price=comma2dot(dialogId.find("input[name='price']").val());
					var discount=comma2dot(dialogId.find("input[name='discount']").val());
					dialogId.find("input[name='sumPosition']").val(germanDezimal(quantity*price*(1-discount/100)));
				})
				this.dialogId.find("input[name='price']").blur(function() {
					var quantity=comma2dot(dialogId.find("input[name='quantity']").val());
					var price=comma2dot(dialogId.find("input[name='price']").val());
					var discount=comma2dot(dialogId.find("input[name='discount']").val());
					dialogId.find("input[name='sumPosition']").val(germanDezimal(quantity*price*(1-discount/100)));
				})
				this.dialogId.find("input[name='discount']").blur(function() {
					var quantity=comma2dot(dialogId.find("input[name='quantity']").val());
					var price=comma2dot(dialogId.find("input[name='price']").val());
					var discount=comma2dot(dialogId.find("input[name='discount']").val());
					dialogId.find("input[name='sumPosition']").val(germanDezimal(quantity*price*(1-discount/100)));
				})
						
	  } // end sayHi




} // end class

function totalSum(dialogId,rows) {
	console.log(VATrate);
	var merchandiseNetVn=0; 
	var merchandiseNetVr=0; 
	var packageNetVn=0; 
	var packageNetVr=0; 
	var dispatchNetVn=0; 
	var dispatchNetVr=0; 
	var NetVn=0; 
	var NetVr=0; 
	var VATn=0; 
	var VATr=0; 
	var grossValue=0; 
	var tradeDiscount=0; 
	var paymentAmount=0; 

	var packingCost=0;
	var shippingCost=0;
	
	percentageTermPayment=0;
	
	var termPayment=dialogId.find('select[name="termPayment"]').val();
	for (var i=0;i<array_data["rowsTermPayment"].length;i++) {
		if (termPayment==array_data["rowsTermPayment"][i].id)
			percentageTermPayment=string2number(array_data["rowsTermPayment"][i].discount);
	}
	
	if (dialogId.find('input[name="packingCost"]'))
		packingCost=string2number(dialogId.find('input[name="packingCost"]').val());
	if (dialogId.find('input[name="shippingCosts"]'))
		shippingCosts=string2number(dialogId.find('input[name="shippingCosts"]').val());
	
	for (var i=0;i<rows.length;i++) {
		var price=string2number(rows[i].price);
		var quantity=string2number(rows[i].quantity);
		var discount=string2number(rows[i].discount);
		var percentage=string2number(rows[i].percentage);
		
		if (percentage==VATrate || percentage==VATrate/100) {
			merchandiseNetVn+=quantity*price*(1-discount/100);
		} else {
			merchandiseNetVr+=quantity*price*(1-discount/100);
		}
	}
	
	if (packingCost!=0) {
		if (merchandiseNetVn!=0 && merchandiseNetVr==0)
			packageNetVn=packingCost;
		if (merchandiseNetVn==0 && merchandiseNetVr!=0)
			packageNetVr=packingCost;
		if (merchandiseNetVn!=0 && merchandiseNetVr!=0) {
			var partPercentVn=merchandiseNetVn/(merchandiseNetVn+merchandiseNetVr);
			packageNetVn=packingCost*partPercentVn;
			packageNetVr=packingCost-packageNetVn;
		}
	}

	if (shippingCosts!=0) {
		if (merchandiseNetVn!=0 && merchandiseNetVr==0)
			dispatchNetVn=shippingCosts;
		if (merchandiseNetVn==0 && merchandiseNetVr!=0)
			dispatchNetVr=shippingCosts;
		if (merchandiseNetVn!=0 && merchandiseNetVr!=0) {
			var partPercentVn=merchandiseNetVn/(merchandiseNetVn+merchandiseNetVr);
			dispatchNetVn=shippingCosts*partPercentVn;
			dispatchNetVr=shippingCosts-dispatchNetVn;
		}
	}

	NetVn=merchandiseNetVn+packageNetVn+dispatchNetVn; 
	NetVr=merchandiseNetVr+packageNetVr+dispatchNetVr; 
	VATn=NetVn*VATrate/100; 
	VATr=NetVr*VATrateReduced/100; 
	
	grossValue=NetVn+NetVr+VATn+VATr;
	
	tradeDiscount=percentageTermPayment/100*(merchandiseNetVn*(1+VATrate/100)+merchandiseNetVr*(1+(VATrateReduced/100))); 
	paymentAmount=grossValue-tradeDiscount; 
	
	var row=new Array();
	row["merchandiseNetVn"]=number2String(merchandiseNetVn); 
	row["merchandiseNetVr"]=number2String(merchandiseNetVr); 
	row["packageNetVn"]=number2String(packageNetVn); 
	row["packageNetVr"]=number2String(packageNetVr); 
	row["dispatchNetVn"]=number2String(dispatchNetVn); 
	row["dispatchNetVr"]=number2String(dispatchNetVr); 
	row["NetVn"]=number2String(NetVn); 
	row["NetVr"]=number2String(NetVr); 
	row["VATn"]=number2String(VATn); 
	row["VATr"]=number2String(VATr); 
	row["grossValue"]=number2String(grossValue); 
	row["tradeDiscount"]=number2String(tradeDiscount); 
	row["paymentAmount"]=number2String(paymentAmount); 

	dialogInit(dialogId,row);
	
	return;
}

function fileViewNew(id,divDialogId,modul) {

$("#"+divDialogId).dialog({
	width : 800,
	modal : true,
	autoOpen : false
});

$("#"+divDialogId).dialog(
		{
			title : "Datei (#"+id+")",
			buttons : {
				Close : function() {
					$(this).dialog("close");
				}
			}
		}).dialog("open");	

$("#"+divDialogId).css({
	height : 500
});

var srcString = '<div><iframe id="frameFileView" style="width:100%; height:450px;" frameBorder=0></iframe></div>';
$("#srcFile").html(srcString);

var data={
		"id": id
}

data=JSON.stringify(data);
$('#frameFileView').attr('src',"/"+modul+"?data="+data);
return;
}

function workflowStatusChecked(workflowStatus) {
	
	var _wf_array=workflowStatus.split(',');
	
	for (var i=0;i<_wf_array.length;i++) {
		var string=_wf_array[i];
		$('#wfS'+string).attr("class", "ui-icon ui-icon-check");
	}

}

function pqGridObj(gridId,rowGrid,rowsData) {

	function customRenderer( ui,string ) {
		//inject class, style or HTML attributes in the cell.
		console.log(ui.dataIndx+" "+string);
		return (eval(string))
		};
	
var Grid=JSON.parse(JSON.stringify(rowGrid));	
var obj = JSON.parse(Grid.objGrid);

Grid.toolbar=Grid.toolbar.replace(/(\r\n\t|\n|\r\t)/gm,"");
obj.toolbar = JSON.parse('{'+Grid.toolbar+'}');

for (var i=0;i<obj.toolbar.items.length;i++) 
		obj.toolbar.items[i].listeners[0].click=eval(obj.toolbar.items[i].listeners[0].click)

Grid.colModel = Grid.colModel.replace(/(\r\n\t|\n|\r\t)/gm,"");

colModel=JSON.parse(Grid.colModel);


var customR=new Array();
var z=-1;
for (i=0;i<colModel.length;i++) {

	if (colModel[i].render!=undefined && colModel[i].render!='') {
		var customR[++z]=colModel[i].render;
		colModel[i].render=function(ui) {
			return (customRenderer(ui,customR[z]))
			}
	}
}
/*
colModel[5].render=function(ui) {
	return (customRenderer(ui))}
colModel[7].render=function(ui) {
	return (customRenderer(ui))}
*/
obj.colModel = colModel;

var dataModel = JSON.parse(Grid.dataModel);
obj.dataModel = dataModel;
obj.dataModel.data = array_data[dataModel.data];

var $grid = $(gridId).pqGrid(obj);

$(gridId).pqGrid({
	rowDblClick : function(event, ui) {
		editRow();
	}
});


$grid.pqGrid( "option", "colModel", colModel );

$grid.pqGrid("showLoading");

if (rowsData.length > 0) {
	// load from_company dropdowns.
	for (var i=0;i<colModel.length;i++) {
		if (colModel[i].filter!=undefined && colModel[i].filter!="") {
			var column = $grid.pqGrid("getColumn", {
				dataIndx : colModel[i].dataIndx
			});
		var filter = column.filter;
			filter.cache = null;
			filter.options = $grid.pqGrid("getData", {
				dataIndx : [ colModel[i].dataIndx ]
			});

		}
	}

	$grid.pqGrid("refreshDataAndView");
}

$grid.pqGrid("hideLoading");
return ($grid);
	

}

