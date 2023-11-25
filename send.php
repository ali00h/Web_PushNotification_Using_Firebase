<?php
include 'secret.php';

$res_obj = array();
if(isset($_GET['token']) && $_GET['token'] != ''){
    $registrationIDs = array();
    $registrationIDs[] = $_GET['token'];

    //send push notification
    //$forApp = true;
    $notify_message = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => array(
            "title" => 'Notify Test',
            "body" => date("Y-m-d H:i:s"),
            //"icon" => "name_of_icon"
        ),
        'data' => array(
            "link" => '',
            "platform" => '',
        ),
    );
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($notify_message),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: ' . 'key=' . $app_config['APP_FIREBASE_SERVER_KEY']
        ),
    ));
    
    $response_fcm = curl_exec($curl);
    
    curl_close($curl);
    $json_fcm = json_decode($response_fcm,true);
    $res_obj = array('token'=>$_GET['token'],'result'=>$json_fcm);
}

$encoded = json_encode($res_obj, 256);
$unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
    return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
}, $encoded);
header('Content-Type: application/json');
echo $unescaped;

?>