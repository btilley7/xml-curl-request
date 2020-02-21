<?php

$url = 'https://jobfeed.jobrobotix.com/api/jobs/086209A856E04A4393CE4A06A19E3925';
$jrtoken = 'Authorization: Bearer D56CE16C0704485A941ABB9E75014CCA';


function get_xml_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml' , $jrtoken )); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 4);

    $respone_xml_data = curl_exec($ch);
    
    curl_close($ch);

    return $respone_xml_data;
}


// $response_xml_data = file_get_contents($url, false, $context);

if ($response_xml_data === false){
    echo "Error fetching XML\n";
} else {
   libxml_use_internal_errors(true);
   $data = simplexml_load_string($response_xml_data);
   if (!$data) {
       echo "Error loading XML\n";
       foreach(libxml_get_errors() as $error) {
           echo "\t", $error->message;
       }
   } else {

     echo "The file's contents are now being written, please wait.";
     file_put_contents('importeddata.xml', $response_xml_data);
     echo "The file's contents have been written.";

      // print_r($data);
   }
}

?>
