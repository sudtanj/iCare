<?php
require '../db.php';

class HospitalBridge {
    
}
function look4id($source, $id) {
    foreach ($source as $child) {
        if ($child['mdfId'] == $id) {
            return $source['children'];
        } else {
            if ($source['children']) {
                return look4id($source['children'], $id);
            }
        }
    }
}
$auth = base64_encode("admin:Admin123");
$context = stream_context_create(['http' => ['header' => "Authorization: Basic $auth"]]);
$homepage = file_get_contents('https://demo.openmrs.org/openmrs/ws/rest/v1/visit', false, $context);
//echo $homepage;
//$json=json_decode($homepage,true);
preg_match_all('/"uri":"http?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)"/i',$homepage,$data);
//print_r($data);
foreach($data[0] as $value){
    $visit= preg_split('/"/',$value)[3];
    $homepage1 = file_get_contents($visit, false, $context);
    preg_match_all('/"uri":"http?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)"/i',$homepage1,$data1);
    preg_match_all('/"display":".+?(?=")/i',$homepage1,$resultDisplay);
    foreach($resultDisplay[0] as $valueResult){
        $result1 = preg_split('/"/',$valueResult)[3];
        echo $result1,PHP_EOL;
    }
   foreach($data1[0] as $value1){
       $result = preg_split('/"/',$value1)[3];
       if(strpos($result,"patient")==true)
            echo preg_split('/"/',$value1)[3],PHP_EOL;
   }
    
}
//echo $data;
//echo array_search("http://demo.openmrs.org/openmrs/ws/rest/v1/visit/",$json);
