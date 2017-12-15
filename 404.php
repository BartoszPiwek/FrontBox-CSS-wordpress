<!--=======================================================================
|| FILE: 404.php
===========================================================================
|| The HTTP 404, 404 Not Found and 404 (pronounced "four oh four") error message is a Hypertext Transfer Protocol (HTTP) standard response code, 
|| in computer network communications, to indicate that the client was able to communicate with a given server, but the server could not find what was requested.
===========================================================================
|| Redirection to home page
||
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();
||
||
=========================================================================->

<?php
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ".get_bloginfo('url'));
  exit();
?>
