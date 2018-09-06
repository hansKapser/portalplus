/* mainMenu
 * get all menu-calls 
 * 1st parameter: modul 
 * 2nd parameter: optional parameter as array
 * 	structure of 2nd parameter: key => value
 * fetch via ajax content
 * calls [modulInit]-function 
 * 
 */ 
var rowFirm = new Array();
var rowsTermPayment = new Array();


function mainMenu(modul,parameter = '') {
console.log("mainMenu: "+modul);
	content=isHtmlContent(modul);
	console.log("get back from isHtmlContent:");
	console.log(content);
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
				}
				
				$('#mainContent').html(content);
				jsModul=modul+"()";
		
				eval(jsModul);
				console.log("coming back mainMenu.js -> mainMenu with eval "+jsModul);
			}
		});

} // end function mainMenu


function indexMenuManagement(modul) {
	console.log("mainMenu->function indexMenuManagement: "+modul);
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
				}

				rowFirm=array_data["rowFirm"];
				rowsTermPayment=array_data["rowsTermPayment"];
				rowsWBTime=array_data["rowsWBTime"];
				$('div.modulContent').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end indexMenuManagement

function indexMenuArticle(modul) {
console.log("mainMenu.js -> indexMenuArticle:"+modul);
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
				}

				$('div.modulContent').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end indexMenuArticle

function indexMenuStore(modul) {
	console.log("mainMenu.js -> indexMenuStore:"+modul);
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
					}

					$('div.modulContent').html(content);
					var jsModul=modul+"()";
					eval(jsModul);
				}
			});
		
	} // end indexMenuArticle


function indexMenuPurchase(modul,doEval=true) {
	console.log("mainMenu.js -> indexMenuPurchase:"+modul);
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
					}
					$('div.modulContent').html(content);
					if (doEval) {
					var jsModul=modul+"()";
					eval(jsModul);
					}
				}
			});
		
	} // end indexMenuPurchase

function indexMenuSelling(modul,doEval=true) {
	console.log("mainMenu.js -> indexMenuSelling:"+modul);
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
					}

					$('div.modulContent').html(content);
					if (doEval) {
						var jsModul=modul+"()";
						eval(jsModul);
					}

				}
			});
		
	} // end indexMenuSelling

function indexMenuAccountancy(modul) {
	console.log("mainMenu->function indexMenuAccountancy: "+modul);
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
				}

				$('div.modulContent').html(content);
				var jsModul=modul+"()";
				eval(jsModul);
			}
		});
	
} // end indexMenuAccountancy

function indexMenuSysAdmin(modul) {
	console.log("mainMenu.js -> indexMenuSelling:"+modul);
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

					$('div.modulContent').html(content);
					var jsModul=modul+"()";
					eval(jsModul);
				}
			});
		
	} // end indexMenuSysAdmin