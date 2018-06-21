<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui" />

    <title>Remote Address Test</title>
  </head>

  <body>
  <?php

  function get_ip_address() {
      foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
          if (array_key_exists($key, $_SERVER) === true) {
              foreach (explode(',', $_SERVER[$key]) as $ip) {
                  $ip = trim($ip); // just to be safe

                  if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                      return $ip;
                  }
              }
          }
      }
  }

  ?>
    
    <h1>Remote Address Test</h1>
    <p>Your remote address is <code><?php echo get_ip_address(); ?></code>.</p>
    <hr/>
    <pre><?php var_dump($_SERVER); ?></pre>
  </body>
</html>