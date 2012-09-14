function gd_set_delay(ms)
{

}

function initGame()
{
	//prepareDialogs();
}

var shouldRedirect = true;
var redirectURL = 'http://www.makeitgrowgame.com';
function prepareDialogs(mode)
{
	//$('#userName').keyup(verifyName);
	$('#emailName').keyup(verifyMail);
	$('#farmName').keyup(verifyFarmName);

	 $('#login').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 450,
		height: 300,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Cancel: function() {
				$('#login').dialog( "close" );
				window.location = redirectURL;
			}
		}
		});
	$('#login').css({'visibility': 'visible'});
		
	$('#registration').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 450,
		height: 400,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Cancel: function() {
				$('#registration').dialog( "close" );
				window.location = redirectURL;
			}
		}
		});
		$('#registration').css({'visibility': 'visible'});
		
	$('#forgot').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 400,
		height: 300,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Cancel: function() {
				$('#forgot').dialog( "close" );
				window.location = redirectURL;
			}
		}
		});
		$('#forgot').css({'visibility': 'visible'});
		
	$('#logout').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 400,
		height: 300,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Ok: function() {
				window.location = "/persistence/logout.php";
			},
			Cancel: function() {
				$('#logout').dialog( "close" );
				window.location = redirectURL;
			}
		}
		});
		$('#logout').css({'visibility': 'visible'});
	
	$('#welcome').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 400,
		height: 300,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Play: function() {
				window.location = redirectURL;
			},
		}
		});
		$('#welcome').css({'visibility': 'visible'});
		
		
	$('#forgotconfirmation').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 400,
		height: 300,
		close: function() {
				if (shouldRedirect)
				{
					window.location = redirectURL;
				}
			},
		buttons: {
			Ok: function() {
				window.location = redirectURL;
			},
		}
		});
		$('#forgotconfirmation').css({'visibility': 'visible'});
	
	//loadGame();
	if (mode == 'register')
	{
		showRegistration();
	}
	else if (mode == 'logout')
	{
		showLogOut();
	}
	else
	{
		showLogin();
	}
}

function loadGame()
{
  var fileref=document.createElement('script');
  fileref.setAttribute("id","gameScript");
  fileref.setAttribute("type","text/javascript");
  fileref.setAttribute("src", "/game/agrigame1-73h.js?CXUAC=308739888");
  document.getElementsByTagName("body")[0].appendChild(fileref);
  eval(fileref);
}

function closeDialogs()
{
	shouldRedirect = false;
	$('#login').dialog( "close" );
	$('#registration').dialog( "close" );
	$('#forgot').dialog( "close" );
	$('#logout').dialog( "close" );
	$('#welcome').dialog( "close" );
	$('#forgotconfirmation').dialog( "close" );
	
	shouldRedirect = true;
}

function showLogin()
{
	closeDialogs();
	$('#loginform').find('input[name=name]').val("");
	$('#loginform').find('input[name=password]').val("");
	
	$('#loginformnameerror').text("");
	$('#loginformpasserror').text("");
	$('#loginformerror').text("");
	
	$('#login').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function showRegistration()
{
	closeDialogs();
	$('#registrationform').find('input[name=name]').val("");
	$('#registrationform').find('input[name=password]').val("");
	$('#registrationform').find('input[name=pass2]').val("");
	$('#registrationform').find('input[name=email]').val("");
	
	$('#registrationformnameerror').text("");
	$('#registrationformpasserror').text("");
	$('#registrationformpass2error').text("");
	$('#registrationformemailerror').text("");
	$('#registrationformerror').text("");
	
	$('#registration').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function showForgot()
{
	closeDialogs();
	$('#forgot').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function showForgotConfirmation()
{
	closeDialogs();
	$('#forgotconfirmation').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function showLogOut()
{
	closeDialogs();
	$('#logout').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function showWelcome()
{
	closeDialogs();
	$('#welcome').dialog('open');
	$('.ui-widget-overlay').css({'height':'100%'});
}

function logout()
{
	showLogOut();
}

var loginURL;
function loginSubmit()
{
	$('#loginformnameerror').text("");
	$('#loginformpasserror').text("");
	$('#loginformerror').text("");

	name = $.trim($('#loginform').find( 'input[name="name"]' ).val());
	password = $.trim($('#loginform').find( 'input[name="password"]' ).val());
	
	error = false;
	if (name == "")
	{
		$('#loginformnameerror').text("Enter your user name");
		error = true;
	}
	if (password == "")
	{
		error = true;
		$('#loginformpasserror').text("Enter your password");
	}
	
	if (!error)
	{
		// submit
		var jqxhr = $.post('/persistence/login.php', { name: name, password: password, login: 1}, function(data) {
			console.log(data);
			response = jQuery.parseJSON(data);
			if (response.result.status == 'ok')
			{
				dataReady = true;
				dataStatus = 1;
				finalData = response.result.data;
				closeDialogs();
				$('#login').dialog( "close" );
			}
			else
			{
				$('#loginform').find('input[name=password]').val('');
				$('#loginformerror').text("User name or password invalid");
			}
		})
	}
}

function registrationSubmit()
{
	$('#registrationformnameerror').text("");
	$('#registrationformpasserror').text("");
	$('#registrationformpass2error').text("");
	$('#registrationformemailerror').text("");
	$('#registrationformerror').text("");
	$('#registrationformfarmerror').text("");

	name = $.trim($('#registrationform').find( 'input[name="name"]' ).val());
	password = $.trim($('#registrationform').find( 'input[name="password"]' ).val());
	password2 = $.trim($('#registrationform').find( 'input[name="pass2"]' ).val());
	email = $.trim($('#registrationform').find( 'input[name="email"]' ).val());
	farm = $.trim($('#registrationform').find( 'input[name="farm"]' ).val());
	
	error = false;
	if (name == "")
	{
		$('#registrationformnameerror').text("Enter your user name");
		error = true;
	}

	if (name.length < 3)
	{
		$('#registrationformnameerror').text("Name needs at least 3 characters");
		error = true;
	}
	
	 if (name.length > 50)
	 {
		$('#registrationformnameerror').text("Name should have less than 50 characters");
		error = true;
	 }
	
	if (password == "")
	{
		error = true;
		$('#registrationformpasserror').text("Enter your password");
	}
	
	if (password.length < 6)
	{
		error = true;
		$('#registrationformpasserror').text("Password needs at least 6 characters");
	}

	if (password != password2)
	{
		error = true;
		$('#registrationformpass2error').text("Password doesn't match");
	}
	
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) 
	{
		error = true;
		$('#registrationformemailerror').text("Invalid e-mail");
	}

	if (farm == "")
	{
		$('#registrationformfarmerror').text("Enter your farm name");
		error = true;
	}

	if (farm.length < 3)
	{
		$('#registrationformfarmerror').text("Farm needs at least 3 characters");
		error = true;
	}

	 if (name.length > 50)
	 {
		$('#registrationformfarmerror').text("Farm should have less than 50 characters");
		error = true;
	 }
	
	
	if (!error)
	{
		//alert("submit!");
		// submit
		var jqxhr = $.post('/persistence/register.php', { name: name, password: password, farm: farm, email: email, register: 1}, function(data) {
			console.log(data);
			response = jQuery.parseJSON(data);
			if (response.result.status == 'ok')
			{
				dataReady = true;
				finalData = response.result.data;
				closeDialogs();
				shouldRedirect = false;
				$('#registration').dialog( "close" );
				shouldRedirect = true;
				showWelcome();
			}
			else
			{
				$('#registrationform').find('input[name=password]').val('');
				$('#registrationform').find('input[name=pass2]').val('');
				$('#registrationformerror').text(response.result.data);
			}
		})
	}
}

function forgotSubmit()
{
	$('#forgotformerror').text("");

	farm = $.trim($('#forgotform').find( 'input[name="farm"]' ).val());
	email = $.trim($('#forgotform').find( 'input[name="email"]' ).val());
	
	error = false;
	if ((farm == "") && (email == ""))
	{
		error = true;
		$('#forgotformerror').text("Enter your farm name or e-mail");
	}
	
	if (!error)
	{
		// submit
		var jqxhr = $.post('/persistence/forgot.php', { farm: farm, email: email, forgot: 1}, function(data) {
			response = jQuery.parseJSON(data);
			if (response.result.status == 'ok')
			{
				dataReady = true;
				dataStatus = 1;
				finalData = response.result.data;
				closeDialogs();
				shouldRedirect = false;
				$('#forgotform').dialog( "close" );
				shouldRedirect = true;
				showForgotConfirmation();
				
			}
			else
			{
				$('#forgotform').find('input[name="farm"]').val('');
				$('#forgotform').find('input[name="email"]').val('');
				$('#forgotformerror').text("Farm name or e-mail invalid");
			}
		})
	}
}


var checkUserNameCall;
function verifyName()
{
	name = $.trim($('#registrationform').find( 'input[name="name"]' ).val());
	if (name.length < 3)
	{
		return;
	}
	
	if (checkUserNameCall != null)
	{
		checkUserNameCall.abort();
	}
	checkUserNameCall = $.ajax({
			type		: "POST",
			url			: "/persistence/verifyusername.php",
			data		: "name=" + name,
			dataType	: "html",
			success: function( data ){
				if (data == "OK")
				{
					$('#registrationformnameerror').text("");
				}
				else
				{
					$('#registrationformnameerror').text("Name taken");				
				}
			}
		});
}

var checkFarmNameCall = null;
function verifyFarmName()
{
	name = $.trim($('#registrationform').find( 'input[name="farm"]' ).val());

	if (name.length < 3)
	{
		return;
	}
	
	if (checkFarmNameCall != null)
	{
		checkFarmNameCall.abort();
	}
	checkFarmNameCall = $.ajax({
			type		: "POST",
			url			: "/persistence/verifyfarmname.php",
			data		: "name=" + name,
			dataType	: "html",
			success: function( data ){
				if (data == "OK")
				{
					$('#registrationformfarmerror').text("");
				}
				else
				{
					$('#registrationformfarmerror').text("Name taken");				
				}
			}
		});
}

var checkMailCall = null;
function verifyMail()
{
	name = $.trim($('#registrationform').find( 'input[name="email"]' ).val());

	if (name.length < 3)
	{
		return;
	}
	
	if (checkMailCall != null)
	{
		checkMailCall.abort();
	}
	checkMailCall = $.ajax({
			type		: "POST",
			url			: "/persistence/verifymail.php",
			data		: "name=" + name,
			dataType	: "html",
			success: function( data ){
				if (data == "OK")
				{
					$('#registrationformemailerror').text("");
				}
				else
				{
					$('#registrationformemailerror').text("e-mail taken");				
				}
			}
		});
}

/*

function gd_save(savedata, debug)
{
	var response = "error";
	$.ajaxSetup({async:false});
	
	var jqxhr = $.post("/save", { data: savedata}, function(result) {
      //alert("success" + data);
	  response = "ok";
    })
    .success(function(result) { 
		//alert("second success"); 
	})
    .error(function(result) { 
		if (debug)
		{
			str = "Status: " + result.status + "\n";
			str += "Status text: " + result.statusText + "\n";
			str += "Resp text: " + result.responseText;
			alert(str); 
		}
		response = "error";
	})
    .complete(function() { 
		//alert("complete");
		//response = "ok3";
	});
	
	return response;
}

function gd_load(debug)
{
	var response = "error";
	$.ajaxSetup({async:false});
	
	var jqxhr = $.post("/load", function(data) {
		//alert("success" + data);
		response = data;
    })
    .success(function() { 
		//alert("second success"); 
	})
    .error(function(result) { 
		if (debug)
		{
			str = "Status: " + result.status + "\n";
			str += "Status text: " + result.statusText + "\n";
			str += "Resp text: " + result.responseText;
			alert(str); 
		}
		response = "error";
	})
    .complete(function() { 
		//alert("complete");
	});
	
	return response;
}
*/