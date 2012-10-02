<?php
require 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Make It Grow</title>

    <style type="text/css">
        body {
            float: center;
            margin: 25% auto;
        }
    </style>
</head>

<body>
    <div id="fb-root" class="center"></div>
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                    appId   : '<?php echo $config["appId"]; ?>',
                    xfbml   : true
                });

                FB.getLoginStatus(function(response) {
                    if (response.status == "connected" || response.status == "unknown") {
                        window.location = "<?php echo $config["base_url"]; ?>";
                    }
                });
            };
            (function() {
                var e = document.createElement('script');
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());
        </script>
        <fb:registration
            fields='<?php echo json_encode($config["fb_fields"]); ?>'
            redirect-uri="<?php echo $config["base_url"]; ?>"
            fb_only="true"
            width="530">
        </fb:registration>
    </div>    
</body>
</html>