<?php

function send_notification($fcm_token, $payload, $info = [])
{
   
 // print_r($fcm_token); die;
   //print_r($title); print_r($body);  print_r($type) print_r($sender); print_r($receiver);
   // die();

     
    $URL = 'https://fcm.googleapis.com/fcm/send';

    $post_data = [
        'registration_ids' => $fcm_token, //firebase token array
        'data' => $payload, //msg for andriod
        'notification' => $payload, //msg for ios
    ];
    

    $crl = curl_init();

    $headr = [];
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: key='.FCM_KEY;
  
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

    $rest = curl_exec($crl);
    curl_close($crl);
   
    $insert['sender'] = array_key_exists('sender', $info) ? $info['sender'] : '';

    $insert['receiver'] = array_key_exists('receiver', $info) ? $info['receiver'] : '';
     $insert['reference_id'] = array_key_exists('reference_id', $info) ? $info['reference_id'] : '0';
    $insert['payload'] = json_encode($payload);

    $insert['tokens'] = json_encode($fcm_token);

    $insert['fcm_response'] = $rest;

    $insert['added_on'] = now;
    $insert['updated_on'] = now;
   $insert['type'] = array_key_exists('type', $info) ? $info['type'] : '';
    
    $query = DB::table('notifications')->insert($insert);
 
    return $rest;
}


function get_Formatted_date($date,$format)
{
    $formattedDate=date($format,strtotime($date));
    return $formattedDate;
}
