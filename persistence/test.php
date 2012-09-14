<?php
//ini_set('session.cookie_domain', substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));

require_once('session.php');
require_once('database.php');
require_once('functions.php');

$subdomain = explode('.',$_SERVER['SERVER_NAME']);
print_r($subdomain);
echo "\n";
echo substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100);
echo "\n";
echo $_SERVER['SERVER_NAME'];
echo "\n";
echo $_SERVER['HTTP_HOST'];
echo "\n";
echo $_SERVER['REMOTE_ADDR'];
echo "\n";
echo $_SERVER['REMOTE_HOST'];

/*
$query = "INSERT INTO `test`(`test`) VALUES ('pepe')";
$result = $db->query($query);
echo "[".$result."]<br>";
echo "[".$db->insert_id."]";
*/



//print_r($_REQUEST);

//echo $_REQUEST['fede']['datos'];
/*
foreach ($_REQUEST['data'] as $key => $data)
{
	echo "KEY: $key<br>\n";
	
	foreach ($data as $val)
	{
		echo "=> $val<br>\n";
	}
}

$json = $_REQUEST['data'];
$dtoObject = json_encode($json);

echo $dtoObject;
*/
/*
'HTTP_HOST'
    Contents of the Host: header from the current request, if there is one. 
'REMOTE_ADDR'
    The IP address from which the user is viewing the current page. 
'REMOTE_HOST'
    The Host name from which the user is viewing the current page. The reverse dns lookup is based off the REMOTE_ADDR of the user.

        Note: Your web server must be configured to create this variable. For example in Apache you'll need HostnameLookups On inside httpd.conf for it to exist. See also gethostbyaddr(). 

*/
/*
echo $_SERVER['HTTP_HOST'];
echo "\n";
echo $_SERVER['REMOTE_ADDR'];
echo "\n";
echo $_SERVER['REMOTE_HOST'];
*/
/*
$resultado = $db->query("SELECT * FROM game_users");
print_r($resultado);
$fila = $resultado->fetch_assoc();
print_r($fila);
*/
/*
$to = 'fstein@gmail.com';
$subject = 'Test de fede!';
$message = 'Test de mensaje';
$headers = "From: contact@playthegreendream.com\r\n" .
			"X-Mailer: php";
$res = mail($to , $subject , $message, $headers);

if ($res)
{
	echo "OK!";
}
else
{
	echo "OUCH!";
}*/
/*
? ><html>
<head>
<script src="/persistence/js/jquery-1.7.2.js"></script>
<script>
function test()
{
	var testObject = { "fede" : ["datos", "valor"], "fede2" : ["datos", "valor"],};
	
	var jqxhr = $.post('/persistence/test.php', {data: testObject} , function(data) {
		//alert(data);
		$('#data').text(data);
		//response = jQuery.parseJSON(data);
		
    })
}
</script>
</head>
<body>
<input type="button" value="Click" onclick="javascript:test();" />
<div id="data"></div>
</body>
</html>
*/