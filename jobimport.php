<?php

$url = 'https://jobfeed.jobrobotix.com/api/jobs/086209A856E04A4393CE4A06A19E3925';
$jrtoken = 'D56CE16C0704485A941ABB9E75014CCA';


$context = stream_context_create(array(
     'http' => array(
          'header' => "Authorization: Bearer " . base64_encode("$jrtoken")
     )
)
);


$response_xml_data = file_get_contents($url, false, $context);

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
