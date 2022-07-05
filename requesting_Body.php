<?php
require_once 'HTTP/Request2.php';

$someData = "testLife";

$request = new HTTP_Request2();
$request->setUrl('http://ptsv2.com/t/94eux-1657035441/post'); //from ptsv2 (Random Toilet)
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
//sends this as body parameters
$request->setBody('{\n    "myData":'."\"".$someData."\"".'\n}');


try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}