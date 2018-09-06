/* mainMenu
 * get all menu-calls 
 * 1st parameter: modul 
 * 2nd parameter: optional parameter as array
 * 	structure of 2nd parameter: key => value
 * fetch via ajax content
 * calls [modulInit]-function 
 * 
 */ 

function articleInit() {
console.log("article.js -> articleInit called by mainMeu");
console.log("nothing to do back to mainMeu");
} // end function mainMenu


function registerMenuArticle(modul) {
	console.log("function article.js -> registerMenuArticle: "+modul);
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

					
					$('div.contentArticle').html(content);
					var jsModul=modul+"()";
					eval(jsModul);
				}
			});
		
	} // end registerMenuarticleMaster

