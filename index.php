<?php
require 'config.php';
require 'libs/utils.lib.php';
require 'libs/persistance.lib.php';

$facebook = new Facebook(array(
            'appId' => $config["appId"],
            'secret' => $config["secret"],
            'cookie' => true,
            'status' => true,
            'oauth' => true
        ));

$lastGameState = array(
  "gamestate" => "",
  "hypertime" => ""
  );

// Begin checking registration
try {
  $me = $facebook->getUser();

  if ($me != 0)
  {
    $profile = get_user_by_id($me);

    if($profile == false)
    {
      $request = $facebook->getSignedRequest();
      $profile = $facebook->api('/me','GET');
      $profile = register_user($profile);
    }
    $lastGameState = load_game($me);
  }

}
catch(FacebookApiException $e) {
  $loginUrl = $facebook->getLoginUrl();
  $me = 0;
  error_log($e->getType());
  error_log($e->getMessage());
}

// Get some variables first, we don't want to mess up the HTML with lots of PHP
// I'd definitely love a templating engine right now

$title = "Make It Grow";
if ($me != 0)
  $title = "".$profile["farm"]." Holistic Farm | ".$title;

$description = " my holistic farm at Make It Grow!";

if ($me != 0)
  $description = "Come visit".$description; 
else
  $description = "Grow your own".$description;

// Twitter Message
if ($me != 0)
  $twit_msg = "Come visit my holistic farm in";
else
  $twit_msg = "Grow your own sustainable farm at";

// login or logout url will be needed depending on current user state.
if ($me != 0) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <!-- Make sure to modify the Title and Description according to whether the user is
    logged in or not so the social sharing plugins work as expected -->
    <title><?=$title?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="cache-control" content="public" />
    <meta name="robots" content="follow, all" />
    <meta name="language" content="en" />
    <meta name="description" content="<?=$description?>" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta charset="utf-8"/>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>    
    <script src="assets/js/libs/bootstrap-dropdown.js" type="text/javascript"></script>
    <script src="assets/js/libs/bootstrap-modal.js" type="text/javascript"></script>

<!-- start Mixpanel --><script type="text/javascript">(function(c,a){window.mixpanel=a;var b,d,h,e;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src=("https:"===c.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.1.min.js';d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d);a._i=[];a.init=function(b,c,f){function d(a,b){var c=b.split(".");2==c.length&&(a=a[c[0]],b=c[1]);a[b]=function(){a.push([b].concat(Array.prototype.slice.call(arguments,0)))}}var g=a;"undefined"!==typeof f?
g=a[f]=[]:f="mixpanel";g.people=g.people||[];h="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config people.identify people.set people.increment".split(" ");for(e=0;e<h.length;e++)d(g,h[e]);a._i.push([b,c,f])};a.__SV=1.1})(document,window.mixpanel||[]);
mixpanel.init("106f3f467f64ccc0f1a3fd06b0bcae00");</script><!-- end Mixpanel -->

    <script type="text/javascript">
    //Social Sharing Analytics
      (function() {
      var dgh = document.createElement("script"); dgh.type = "text/javascript";dgh.async = true;
      dgh.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dtym7iokkjlif.cloudfront.net/dough/1.0/recipe.js';
      var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(dgh, s);
      })();
    </script>
    <script type="text/javascript">
      function isLoggedIn() {
        return <?php echo $me; ?>;
      }
      function save(data,hypertime) {
        console.log("Making post call with the following data:", data, hypertime);
        $.post("save.php", { gamestate: data, hypertime: hypertime }, function (result) {
          console.log("Saving results:",result);
        });
      }
      function load() {
        return "<?php echo $lastGameState['hypertime'].$lastGameState['gamestate']; ?>";
      }
      function tutorial_step (step) {
        $.get('tutorial.php', {step: step}, function (data) {
          console.log(data);
          return data;
        })
      }
      function save_tutorial (status) {
        $.post('tutorial.php', {status: status}, function (result) {
          console.log("Tutorial status saving results:",result);
        })
      }
    </script>
</head>

<body>

    <div id="fb-root"></div>
    <script>

      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo $facebook->getAppId(); ?>', // App ID
          channelUrl : '//www.makeitgrowgame.com/new/channel.php', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        FB.Event.subscribe('auth.login',
            function(response) {
                mixpanel.track('Login successfully');
                window.location.reload();
            }
        );
      };

      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));
    </script>

    <div class="login-status" style="position: fixed;">
      <?php if ($me != 0) { ?>
        <div class="btn-group">
          <button class="btn btn-info">
            <img class="profile-img" src="https://graph.facebook.com/<?php echo $me; ?>/picture" alt="" width="32px" height="32px" />
            <span><?php echo $profile['first_name']; ?></span>
          </button>
          <button class="btn btn-info dropdown-toggle" style="padding: 10px;" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Save game</a></li>
            <li><a href="#">Account</a></li>
            <li class="divider"></li>
            <li><a href="#share" role="button" data-toggle="modal">Share</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo $logoutUrl; ?>"> Logout </a></li>
          </ul>
        </div>   
      <?php } else { ?>
        <fb:login-button registration-url="<?php echo $config["base_url"]; ?>/register.php" />
      <?php } ?>

    </div>
    
    <section style="text-align:center;">
      <div class="gm4html5_div_class" id="gm4html5_div_id">
        <!-- Create the canvas element the game draws to -->
        <canvas id="canvas" width="800" height="600">
           <p>Your browser doesn't support HTML5 canvas.</p>
        </canvas>
      </div>

      <!-- Run the game code -->
        <script type="text/javascript" src="html5game/index.js?<?php echo GAME_KEY; ?>"></script>
    </section>


    <div id="share" class="modal hide fade">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Sharing is caring!</h3>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <p>Some text here perhaps.</p>
      </div>
    </div>

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

    <script type="text/javascript">
    if(isLoggedIn() === 0) {
      mixpanel.track('New visitor');
    } else {
      mixpanel.track('Login successfully');
    }
    </script>

    <a href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_light.png" alt="Mobile Analytics" /></a>
</body>

</html>