<?php
require 'config.php';
require 'functions.php';
require 'libs/utils.lib.php';

$facebook = new Facebook(array(
            'appId' => $config["appId"],
            'secret' => $config["secret"],
        ));

$congratulations = FALSE;
// capture the $_REQUEST coming to this page and check if it's a new user
check_registration($facebook,$config["fb_fields"]);

$me = $facebook->getUser();

// Get some variables first, we don't want to mess up the HTML with lots of PHP
// I'd definitely love a templating engine right now
$title = "Make It Grow";
if ($me)
  $title = "".$farmName." Holistic Farm | ".$title;

$description = " my holistic farm at Make It Grow!";

if ($me)
  $description = "Come visit".$description; 
else
  $description = "Grow your own".$description;

// Twitter Message
if ($me)
  $twit_msg = "Come visit my holistic farm in";
else
  $twit_msg = "Grow your own sustainable farm at";

// login or logout url will be needed depending on current user state.
if ($me) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    // we are not using this url in our example
    $loginUrl = $facebook->getLoginUrl();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <!-- Make sure to modify the Title and Description according to whether the user is
    logged in or not so the social sharing plugins work as expected -->
    <title><?=$title?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="public" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    <meta name="description" content="<?=$description?>" />

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
    
    <div class="login-status">
        <?php if ($me): ?>
        <div class="profile">
            <img class="profile-img" src="https://graph.facebook.com/<?php echo $uid; ?>/picture" alt="" />
            <span><?php echo $me['name']; ?></span>
            <a href="<?php echo $logoutUrl; ?>">
                <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif" />
            </a>
        </div>
        <?php else: ?>
        <fb:login-button registration-url="<?php echo $config["base_url"]; ?>/register.php" />
        <?php endif ?>
    </div>
    
    <section style="text-align:center;">
        <iframe src="/game/index.html" width="800" height="600" frameborder="0" scrolling="no" name="GreenDream">
            Oh No. Your browser can't support iframes. Play the game <a href="http://www.<?=DOMAIN?>/game/"> here.</a>
        </iframe>
    </section>

    <!-- Start Shareaholic Sassy Bookmarks HTML-->
    <div class="shr_ss shr_publisher"></div>
    <!-- End Shareaholic Sassy Bookmarks HTML -->

    <!-- Start Shareaholic Sassy Bookmarks settings -->
    <script type="text/javascript">
      var SHRSS_Settings = {"shr_ss":{"src":"//dtym7iokkjlif.cloudfront.net/media/downloads/sassybookmark","link":"","service":"5,7,2,313,38,201,88,74","apikey":"b87f5899d80a5edce8b5e55f58542ef0f","localize":true,"shortener":"bitly","shortener_key":"","designer_toolTips":true,"tip_bg_color":"black","tip_text_color":"white","viewport":true,"twitter_template":"<?=$twit_msg?> Make It Grow - ${short_link} via @Shareaholic"}};
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

    <!-- Start Google Analytics script -->
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
    
    <div id="fb-root"></div>
    <script type="text/javascript">
        window.fbAsyncInit = function() {
                FB.init({
                        appId   : '<?php echo $facebook->getAppId(); ?>',
                        status  : true, // check login status
                        cookie  : true, // enable cookies to allow the server to access the session
                        xfbml   : true, // parse XFBML
                        session : {}
                });

                // whenever the user logs in, we refresh the page
                FB.Event.subscribe('auth.login', function() {
                        window.location.reload();
                });
        };

        (function() {
                var e = document.createElement('script');
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
        }());
    </script>
</body>

</html>