<?php
require_once 'HTTP/Request2.php';


class makeRequests{

    public $url;
    
    function __construct($url){

        $this->url = $url;
    }

    function makeGet(){
        $response = file_get_contents($this->url);
        return $response;
    }

    function makePost($data){

        $request = new HTTP_Request2();
        $request->setUrl($this->url."/post"); 
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        //sends this as body parameters
        $request->setBody('{\n    "myData":'."\"".$data."\"".'\n}');

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
        
    }

}

//initiating object for the class

//$requester_post = new makeRequests("http://ptsv2.com/t/94eux-1657035441");

//$requester_post->makePost("ok testing");

//another object though both can be done using the same
$requester_get = new makeRequests("http://ptsv2.com/t/94eux-1657035441/d/5137680006381568/json");
$data = $requester_get->makeGet();

//let's get json datas
$myJsonData = json_decode($data, false);
//when it is false
echo $myJsonData->Timestamp."\n";

$myJsonData2 = json_decode($data, True);
//when True
echo $myJsonData2['Timestamp'];
echo "\n".$myJsonData2['FormValues'];


//getting the Array values
print_r($myJsonData2['FormValues']);
?>