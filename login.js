/**
 * @author George Finn
 */

"use-strict";
//Inputs
var username_input;
var password_input;

//Buttons
var btn_login;

$(window).load(function()
{
	username_input = $("#username_input");
	password_input = $("#password_input");
	btn_login = $("#btn_login");
		
	btn_login.click(function(event)
	{
		event.preventDefault();
		login();
	});
});
	
function login()
{
	var username = username_input.val();
	var password = password_input.val();
	console.log(username);
	console.log(password);
	if(username == "" || password == "")
	{
		alert("please enter in a legit username and password");
	}
	else
	{
		$.ajax({
			type : "POST",
			url : "getLoginInfo.php",
			data : {
				'username_input' : username,
				'password_input' : password
			}
		}).always(function(returnData) {
			console.log(returnData);
			var json = JSON.parse(returnData);
			if(json.error) {
				alert("invalid username/password");
			} else {
				window.location.replace("dashboard.html")  
			}
		});
	}
	
}
