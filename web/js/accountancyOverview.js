
function accountancyOverviewJournalListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyOverviewJournalList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyOverviewJournalList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyOverviewJournalListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyOverviewJournalDiv",
	    "dialogId" : "form#dialogAccountancyOverviewJournal",
		"gridId": "#gridAccountancyOverviewJournal",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyOverviewJournal"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyOverviewJournal",
	  		   	"field" : "ID",
	  		   	"modul" : "/accountancyOverviewJournalListDelete"
		        },
		 "filterDialog": {
			 "modul" : "/accountancyChangeData",
			 "table" : "p17_fibu_journal",
			 "field" : "datum",
			 "rowsName" : "rowsJournal"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyOverviewJournal",array_data["rowGrid"],dialogObj);
}

function accountancyOverviewOutstandingListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyOverviewOutstandingList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyOverviewOutstandingList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyOverviewOutstandingListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyOverviewOutstandingDiv",
	    "dialogId" : "form#dialogAccountancyOverviewOutstanding",
		"gridId": "#gridAccountancyOverviewOutstanding",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyOverviewOutstanding"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyOverviewOutstanding",
	  		   	"field" : "ID",
	  		   	"modul" : "/accountancyOverviewOutstandingListDelete"
		        },
		 "filterDialog": {
			 "modul" : "/accountancyChangeData",
			 "table" : "p17_fibu_opliste",
			 "field" : "datum",
			 "rowsName" : "rowsOutstanding"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyOverviewOutstanding",array_data["rowGrid"],dialogObj);
}

function accountancyOverviewLedgerListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyOverviewLedgerList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyOverviewLedgerList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyOverviewLedgerListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyOverviewLedgerDiv",
	    "dialogId" : "form#dialogAccountancyOverviewLedger",
		"gridId": "#gridAccountancyOverviewLedger",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyOverviewLedger"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyOverviewLedger",
	  		   	"field" : "ID",
	  		   	"modul" : "/accountancyOverviewLedgerListDelete"
		        },
		 "filterDialog": {
			 "modul" : "/accountancyChangeData",
			 "table" : "p17_fibu_hauptbuch",
			 "field" : "datum",
			 "rowsName" : "rowsLedger"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyOverviewLedger",array_data["rowGrid"],dialogObj);
}

function accountancyOverviewBalanceListInit() {
	$gridClass=undefined;
	$('#li_icon_menu').css('right', 10);
	
	$('#navtabs').on('click','li',function (){
		$('li').css('text-decoration','');
		$('li').css('color','black');
		$('#'+this.id).css('text-decoration','underline');
		$('#'+this.id).css('color','blue');
		
	});
	$('#navtabs').find('#registerAccountancyOverviewBalanceList').css('text-decoration','underline');
	$('#navtabs').find('#registerAccountancyOverviewBalanceList').css('color','blue');
	
	$gridClass="";
	console.log("function accountancyOverviewBalanceListInit");
	dialogObj=
	{
		"divId": "#dialogAccountancyOverviewBalanceDiv",
	    "dialogId" : "form#dialogAccountancyOverviewBalance",
		"gridId": "#gridAccountancyOverviewBalance",
		"toolbarFilter": "accountancyToolbarFilter(value,dialogObj)",
		"dialogBox": {
				"width": "500",
				"modal": true,
				"autoopen": false
		},
		"editDialog": {
  		   "title" : "Edit Record",
		   "dialogId" : "form#dialogAccountancyOverviewBalance"
	        },
		"deleteDialog": {
				"dialogId" : "form#dialogAccountancyOverviewBalance",
	  		   	"field" : "ID",
	  		   	"modul" : "/accountancyOverviewBalanceListDelete"
		        },
		 "filterDialog": {
			 "modul" : "/accountancyOverviewBalanceListInit",
			 "table" : "p17_fibu_hauptbuch",
			 "field" : "datum",
			 "rowsName" : "rowsBalance"
		 }
	}

$gridClass= new _myGrid("#gridAccountancyOverviewBalance",array_data["rowGrid"],dialogObj);
}



