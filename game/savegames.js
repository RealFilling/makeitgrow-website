function load()
{
	dataReady = false;
	dataStatus = 0;
	$.ajaxSetup({async:false});
	
	var jqxhr = $.post('/persistence/load.php', function(data) {
		response = jQuery.parseJSON(data);
		if (response.result.status == 'ok')
		{
			dataReady = true;
			dataStatus = 1;
			finalData = response.result.data;
		}
		else
		{
			dataReady = true;
			dataStatus = 2;
			finalData = "";
		}
    })
    .error(function(result) { 
		dataStatus = 2;
	})
}

var saveDataFinal = "";
function save(saveData)
{
	saveDataFinal = saveData;
	dataReady = false;
	dataStatus = 0;
	$.ajaxSetup({async:false});
	
	var jqxhr = $.post('/persistence/save.php', { data: saveDataFinal}, function(data) {
		response = jQuery.parseJSON(data);
		if (response.result.status == 'ok')
		{
			dataReady = true;
			dataStatus = 1;
			finalData = response.result.data;
			saveDataFinal = "";
		}
		else
		{
			dataReady = true;
			dataStatus = 2;
			finalData = "";
			saveDataFinal = "";
		}
    })
    .error(function(result) { 
		dataStatus = 2;
	});
}


var finalData = "";
var dataReady = false;
var dataStatus = 0;
function getDataStatus()
{
	if (dataReady)
	{
		//$('#data').text(finalData);
	}
	return dataStatus;
}

function getData()
{
	return finalData;
}


var isLogged = 0;
function checkLoggedIn()
{
	isLogged = 0;
	var jqxhr = $.post('/persistence/isloggedin.php', function(data) {
		console.log(data);
		response = jQuery.parseJSON(data);
		if (response.result.status == 'ok')
		{
			isLogged = 1;
		}
		else
		{
			isLogged = 2;
		}
	})
}

function isLoggedIn()
{
	return isLogged;
}