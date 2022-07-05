<?php
//simple way to making a get request
//The response here was a JSON , we are just performing a simple GET  
$responses = file_get_contents("https://dummy-value.herokuapp.com/data");
//echo $responses; printing the response

//how about a function now?

function get_data($url){
    $data = file_get_contents($url);
    return $data;
}

$myData = get_data("https://dummy-value.herokuapp.com/data");
echo $myData;
?>