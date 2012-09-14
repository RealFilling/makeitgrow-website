<?php
require_once('persistence/session.php');
require_once('persistence/database.php');
require_once('persistence/functions.php');
require_once('persistence/settings.php');
global $_THEDOMAIN;

/*
check logged in
if not logged in
	check subdomain
	if not www
		if farm exists
			ask for log in
			redirect to its farm
		else
			redirect to www
else
	check subdomain
	check if farm belongs to player
		if it does
			play
		else
			(redirect to its farm)
endif
*/
$farmName = trim(strtolower(getSubdomain()));
$isloggedin = 0;

if (isset($_SESSION['user_id']))
{
	$isloggedin = $_SESSION['user_id'];
	
	$farmName = getSubdomain();
	$id = farmExists($farmName);

	if ($id != $isloggedin)
	{
		$farmName = getFarm($isloggedin);

		header( 'Location: http://' . $farmName . '.' . $_THEDOMAIN . '/');
	}
}
else
{
	$sd = explode('.', $_THEDOMAIN);

	if (($farmName != 'www') && ($farmName != $sd[0]))
	{
		$id = farmExists($farmName);
		if ($id > 0)
		{
			header( 'Location: http://' . $farmName . '.' . $_THEDOMAIN. '/persistence');
		}
		else
		{
			header( 'Location: http://www.' . $_THEDOMAIN);
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" lang="en" version="-//W3C//DTD XHTML 1.1//EN" xmlns="http://www.w3.org/1999/xhtml" itemscope itemtype="http://schema.org/">
  <head>
    <!-- Make sure to modify the Title and Description according to whether the user is
    logged in or not so the social sharing plugins work as expected -->
    <title><?php
    if ($isloggedin)
      echo "".$farmName." Holistic Farm | "; 
    echo "Make It Grow";
    ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="public" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    <meta name="description" content="<?php
    if ($isloggedin)
      echo "Come visit my holistic farm at Make It Grow!"; 
    else
      echo "Grow your own holistic farm at Make It Grow!";
    ?>" />
    <script type="text/javascript">
    //Social Sharing Analytics
    (function() {
    var dgh = document.createElement("script"); dgh.type = "text/javascript";dgh.async = true;
    dgh.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dtym7iokkjlif.cloudfront.net/dough/1.0/recipe.js';
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(dgh, s);
    })();
    </script>
  </head>
  <body>
 <?php
 
 ?>
 <a href="/persistence/<?php 
 
if ($isloggedin)
{
	echo '?mode=logout';
}
?>">
<?
if ($isloggedin)
{
	echo "Log out";
}
else
{
	echo "Log in";
}
?>
</a>&nbsp;
<a href="/persistence/?mode=register">Register</a>

<div style="text-align:center;">
<iframe src="/game.php"
 width="800" height="600" 
frameborder="0" scrolling="no" name="GreenDream">
Oh No. Your browser can't support iframes. Play the game <a href="http://www.<? echo $_THEDOMAIN; ?>"> here.</a></iframe>
</div>

<!-- Start Shareaholic Sassy Bookmarks HTML-->
<div class="shr_ss shr_publisher">

</div>
<!-- End Shareaholic Sassy Bookmarks HTML -->
<!-- Start Shareaholic Sassy Bookmarks settings -->
<script type="text/javascript">
var SHRSS_Settings = {"shr_ss":{"src":"//dtym7iokkjlif.cloudfront.net/media/downloads/sassybookmark","link":"","service":"5,7,2,313,38,201,88,74","apikey":"b87f5899d80a5edce8b5e55f58542ef0f","localize":true,"shortener":"bitly","shortener_key":"","designer_toolTips":true,"tip_bg_color":"black","tip_text_color":"white","viewport":true,"twitter_template":"<?php
if ($isloggedin)
  echo "Come visit my holistic farm in";
else
  echo "Grow your own sustainable farm at";
?> Make It Grow - ${short_link} via @Shareaholic"}};
</script>
<!-- End Shareaholic Sassy Bookmarks settings -->
<!-- Start Shareaholic Sassy Bookmarks script -->
<script type="text/javascript">
(function() {
var sb = document.createElement("script"); sb.type = "text/javascript";sb.async = true;
sb.src = ("https:" == document.location.protocol ? "https://dtym7iokkjlif.cloudfront.net" : "http://cdn.shareaholic.com") + "/media/js/jquery.shareaholic-publishers-ss.min.js";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sb, s);
})();
</script>

<!-- End Shareaholic Sassy Bookmarks script -->


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32180577-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </body>
</html>
<?php
/*
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/xampp/');
	exit;
? >
Something is wrong with the XAMPP installation :-(
*/
?>
