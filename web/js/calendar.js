var rows = Array;
var rowsCategory = Array;
var _session = Array;
$(document)
		.ready(
				function() {
					var initialLocaleCode = 'de';

					/*
					 * initialize the external events
					 * -----------------------------------------------------------------
					 */

					loadDrags();

					/*
					 * initialize the calendar
					 * -----------------------------------------------------------------
					 */

					$('#calendar')
							.fullCalendar(
									{
										header : {
											left : 'prev,next today',
											center : 'title',
											right : 'month,agendaWeek,agendaDay'
										},
										locale : initialLocaleCode,
										editable : true,
										events : {
											url : 'calendar_get_events.php',
											error : function() {
												$('#script-warning').show();
											}
										},
										loading : function(bool) {
											$('#loading').toggle(bool);
										},

										eventRender : function(event, element) {
											element.attr('href',
													'javascript:void(0);');
											element
													.click(function() {
														$("#startTime")
																.html(
																		moment(
																				event.start)
																				.format(
																						'MMM Do h:mm A'));
														$("#endTime")
																.html(
																		moment(
																				event.end)
																				.format(
																						'MMM Do h:mm A'));
														$("#eventInfo")
																.html(
																		event.description);
														$("#eventLink").attr(
																'href',
																event.url);
														// $("#eventContent").dialog({
														// modal: true, title:
														// event.title,
														// width:350,
														// height:400});
														editEvent(moment(event));
													});
										},
										/*
										 * eventClick: function(event, element) {
										 * alert('edit event'); event.title =
										 * "click";
										 * $('#calendar').fullCalendar('updateEvent',
										 * event); },
										 */
										droppable : true, // this allows
															// things to be
															// dropped onto the
															// calendar
										drop : function(date, allDay) {
											console.log(date);
											_saveEventDrop(date, $(this).attr(
													'ticketID'), $(this).attr(
													'title'), $(this).attr(
													'userID'))
											// is the "remove after drop"
											// checkbox checked?
											if ($('#drop-remove')
													.is(':checked')) {
												// if so, remove the element
												// from the "Draggable Events"
												// list
												$(this).remove();
											}
										},

										eventAllow : function(event, delta,
												revertFunc) {
											if (delta.cID == undefined)
												return true;

											for (var i = 0; i < rowsCategory.length; i++) {
												console.log(rowsCategory[i].id
														+ ' ' + delta.cID + " "
														+ _session.status);
												if (rowsCategory[i].id == delta.cID
														&& _session.status >= rowsCategory[i].statusEdit) {
													return true;
													break;
												}
											}
											return false;
										},

										eventDragStop : function(event, delta,
												revertFunc) {

											// alert(event.title + " was dropped
											// on " + event.start.format());

											// if (!confirm("Are you sure about
											// this change?")) {
											// revertFunc();
											// }

										},
										eventDrop : function(event, delta,
												revertFunc) {

											// alert(event.title + " was dropped
											// on " + event.start.format());
											_saveEventDragDrop(event);

											if (!confirm("Are you sure about this change?")) {
												// revertFunc();
											}

										}
									});

					$("#eventContent").dialog({
						width : 500,
						modal : true,
						open : function() {
							$(".ui-dialog").position({
								of : "#grid_dialog"
							});
						},
						autoOpen : false
					});
					$('#eventContent td').css('align', 'left');

					$('input[name="startDate"]').datepicker(datepickerGerman);
					$('input[name="endDate"]').datepicker(datepickerGerman);

				});
function add_event(date) {
	var $frm = $("form#dialog_event");
	$frm.find('select[name="categoryID"]').find('option').remove().end();
	for (i = 0; i < rowsCategory.length; i++) {
		$frm.find('select[name="categoryID"]').append(
				new Option(rowsCategory[i].name, rowsCategory[i].id));
	}
	$frm.find('input[name="id"]').val(-1);
	$frm.find('input[name="title"]').val('');
	$frm.find('input[name="location"]').val('');
	$frm.find('input[name="startDate"]').val('');
	$frm.find('input[name="startTime"]').val('');
	$frm.find('input[name="endDate"]').val('');
	$frm.find('input[name="endTime"]').val('');
	$frm.find('select[name="categoryID"]').val('');
	$frm.find('textarea[name="content"]').html('');

	$("#eventContent").dialog({
		title : "Add Event",
		buttons : {
			Add : function() {
				// update row.
				var rowG = {};
				_saveEvent('add');
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	}).dialog("open");
}

function editEvent(event) {
	var eventData = event._i;
	console.log(eventData);
	var $frm = $("form#dialog_event");

	var dateTime = dateJS2Sql(eventData.start._d);

	var arr_temp = dateTime.split(' ');
	var startDate = dateSql2German(arr_temp[0]);
	var startTime = arr_temp[1];

	if (eventData.end == null)
		eventData.end = eventData.start._d;

	var dateTime = dateJS2Sql(eventData.end);
	// var time=time.replace('Z','');
	var arr_temp = dateTime.split(' ');
	var endDate = dateSql2German(arr_temp[0]);
	var endTime = arr_temp[1];

	$frm.find('#eventContent table td').css('align', 'left');
	$frm.find('select[name="categoryID"]').find('option').remove().end();
	for (i = 0; i < rowsCategory.length; i++) {
		$frm.find('select[name="categoryID"]').append(
				new Option(rowsCategory[i].name, rowsCategory[i].id));
	}
	$frm.find('input[name="id"]').val(eventData.id);
	$frm.find('input[name="title"]').val(eventData.title);
	$frm.find('input[name="location"]').val(eventData.room);
	$frm.find('input[name="startDate"]').val(startDate);
	$frm.find('input[name="startTime"]').val(startTime);
	$frm.find('input[name="endDate"]').val(endDate);
	$frm.find('input[name="endTime"]').val(endTime);
	$frm.find('select[name="categoryID"]').val(eventData.cID);
	$frm.find('textarea[name="content"]').html(br2JS(eventData.content));
	if (eventData.fulltime == 1) {
		var checked = true;
	} else {
		var checked = false;
	}
	$frm.find('input[type="checkbox"]').prop('checked', checked);

	$("#eventContent").dialog({
		title : "Edit Event",
		buttons : {
			Update : function() {
				// update row.
				var rowG = {};
				_saveEvent('update');
				$(this).dialog("close");
			},
			Delete : function() {
				_saveEvent('delete');
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	}).dialog("open");
}

function loadDrags() {
	phpModul = "calendar_load_drags.php";
	var data = {
		"action" : "load"
	};

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			_session = array_data["session"];
			rowsCategory = array_data["rows_category"];
			rows = array_data["rows"];
			console.log(array_data);
			var string = '';
			string += '<h4>offene Aufgaben</h4>';
			// string+='diese Aufgaben werden gegenwärtig zu Testzwecken nicht
			// gelöscht!';
			if (rows != null) {
				for (var i = 0; i < rows.length; i++) {
					string += '<div class="fc-event" ticketID='
							+ rows[i].ticketID + ' title=' + rows[i].voucher
							+ ' userID=' + rows[i].userID + '>'
							+ rows[i].voucher + '</div>';
				}
			}
			string += '<p>';
			string += '<input type="checkbox" id="drop-remove" checked />';
			string += '<label for="drop-remove">remove after drop</label>';
			string += '</p>';
			console.log(string);
			$('#external-events').html(string);

			$('#external-events .fc-event').each(function() {

				// store data so the calendar knows to render an event upon drop
				$(this).data('event', {
					title : $.trim($(this).text()), // use the element's text as
													// the event title
					stick : true
				// maintain when user navigates (see docs on the renderEvent
				// method)
				});

				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex : 999,
					revert : true, // will cause the event to go back to its
					revertDuration : 0
				// original position after the drag
				});

			});

		} // end ajax success

	}); // end ajax

	return;

}

function _saveEventDrop(date, ticketID, title, userID) {
	phpModul = "./calendar_eventDrop_add.php";
	var data = {
		"action" : "save",
		"ticketID" : ticketID,
		"date" : dateJS2Sql(date),
		"title" : title,
		"userID" : userID
	};
	data = $.param(data);
	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			alert("gespeichert");
			// $('#calendar').fullCalendar('refetchEvents');
		} // end ajax success

	}); // end ajax

}

function _saveEvent(action) {

	switch (action) {
	case "add":
		phpModul = "./calendar_event_add.php";
		break;
	case "update":
		phpModul = "./calendar_event_update.php";
		break;
	case "delete":
		phpModul = "./calendar_event_delete.php";
		break;
	}
	var data = {
		"action" : action
	};

	data = $('#dialog_event').serialize() + "&" + $.param(data);
	console.log(data);

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			$('#calendar').fullCalendar('refetchEvents');
			// alert("gespeichert");
		} // end ajax success

	}); // end ajax

}

function _saveEventDragDrop(event) {
	console.log(event);
	phpModul = "./calendar_eventDrop_update.php";

	var data = {
		"action" : 'update',
		"start" : dateJS2Sql(event.start._d),
		"id" : event.id
	};

	data = $.param(data);

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {
			$('#calendar').fullCalendar('refetchEvents');
			// alert("gespeichert");
		} // end ajax success

	}); // end ajax

}
