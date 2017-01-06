"use-strict";
var location_input;
var duration_input;
var start_time_input;
var description_input;
var event_name_input;

// buttons
var btn_propose_event;

// checkboxes
var chk_troll;

$(window).load(function() {
	// capture all the DOM elements
	location_input = $("#location_input");
	duration_input = $("#duration_input");
	start_time_input = $("#start_time_input");
	description_input = $("#description_input");
	event_name_input = $("#event_name_input");
	btn_propose_event = $("#btn_propose_event");
	chk_troll = $("#chk_troll");

	// add functionality to them

	btn_propose_event.click(function(event) {
		event.preventDefault();
		propose_event();
		//getEventInfoForEvent(1);
	});
});

function getEventInfoForEvent(eventNum){
	$.ajax({
		type : "POST",
		url : "getEventInfo.php", // filename of what is handling the
									// request
		data : {
			'event_id': eventNum
		}
	}).always(function(returnData) {
		// we know it returns json data
		//console.log(returnData);
		var json = JSON.parse(returnData);
		console.log(json[0].time);
		event_name_input.val(json[0].time);
	});
}


function propose_event() {
	// get the values in the inputs
	var location = location_input.val();
	var duration = duration_input.val();
	var start_time = start_time_input.val();
	var description = description_input.val();
	var event_name = event_name_input.val();

	if (location == "" || duration == "" || start_time == "") { // add more checks
		alert("please fill in the entire form");
	} else {
		$.ajax({
			type : "POST",
			url : "proposeEvent.php", // filename of what is handling the
										// request
			data : {
				'location' : location,
				'duration' : duration,
				'start_time' : start_time,
				'description' : description,
				'event_name' : event_name
			}
		}).always(function(returnData) {
			// we know it returns json data
			var json = JSON.parse(returnData);
			if (json.error) {
				alert("invalid request");
			} else {
				alert("valid request succeed");
			}
		});
	}

}
