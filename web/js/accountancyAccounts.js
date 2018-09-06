
function accountancyImpersonalAccountsListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyImpersonalAccountsList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyImpersonalAccountsList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyImpersonalAccountsListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyImpersonalAccountsDiv",
	    "dialogId" : "form#dialogAccountancyImpersonalAccounts",
		"gridId": "#gridAccountancyImpersonalAccounts",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyImpersonalAccounts"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyImpersonalAccounts",
	  		   "field" : "orderID",
			   "modul" : "/accountancyImpersonalAccountsListDelete"
		        }
	}

$gridClass= new _myGrid("#gridAccountancyImpersonalAccounts",array_data["rowGrid"],dialogObj);
}


function accountancyPersonalAccountsListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyPersonalAccountsList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyPersonalAccountsList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyPersonalAccountsListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyPersonalAccountsDiv",
	    "dialogId" : "form#dialogAccountancyPersonalAccounts",
		"gridId": "#gridAccountancyPersonalAccounts",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyPersonalAccounts"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyPersonalAccounts",
	  		   "field" : "orderID",
			   "modul" : "/accountancyPersonalAccountsListDelete"
		        }
	}

$gridClass= new _myGrid("#gridAccountancyPersonalAccounts",array_data["rowGrid"],dialogObj);
}
