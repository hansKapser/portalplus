
function accountancyBankJournalListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyBankJournalList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyBankJournalList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyBankJournalListInit");
	console.log(array_data["rowsTransactions"]);
	dialogObj=
	{
		"divId": "#dialogAccountancyBankJournalDiv",
	    "dialogId" : "form#dialogAccountancyBankJournal",
		"gridId": "#gridAccountancyBankJournal",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyBankJournal"
	        },
	       
	     "filterDialog": {
			 "modul" : "/accountancyBankJournalListInit",
			 "table" : "Transaction",
			 "field" : "date",
			 "rowsName" : "rowsTransactions"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyBankJournal",array_data["rowGrid"],dialogObj);
}

function accountancyPayFriendListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyPayFriendJournalList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyPayFriendJournalList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyPayFriendJournalListInit");
	console.log(array_data["rowsTransactions"]);
	dialogObj=
	{
		"divId": "#dialogAccountancyPayFriendJournalDiv",
	    "dialogId" : "form#dialogAccountancyPayFriendJournal",
		"gridId": "#gridAccountancyPayFriendJournal",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyPayFriendJournal"
	        },
	       
	     "filterDialog": {
			 "modul" : "/accountancyPayFriendJournalListInit",
			 "table" : "Transaction",
			 "field" : "date",
			 "rowsName" : "rowsTransactions"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyPayFriendJournal",array_data["rowGrid"],dialogObj);
}



