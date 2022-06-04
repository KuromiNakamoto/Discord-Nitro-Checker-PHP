<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = trim(htmlspecialchars(addslashes($_GET['code'])));
    
    if (strlen($code) < 16) {
        echo json_encode(array("message" => "Value must be more than 16 characters !", "status" => 100), JSON_PRETTY_PRINT);
    } else if (strlen($code) > 30) {
        echo json_encode(array("message" => "Value must be less than 30 characters !", "status" => 101), JSON_PRETTY_PRINT);
    } else {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://discord.com/api/v9/entitlements/gift-codes/".$code."?with_application=false&with_subscription_plan=true",
            CURLOPT_SSL_VERIFYPEER => false
        ));
        
        $resp = curl_exec($curl);
        
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        $result = json_decode($resp, true);
        
        curl_close($curl);
        
        if ($http_code == 200 || $http_code == 201) {
            echo json_encode(array("message" => $result['uses']?"Code is valid but this code is being used !":"Code is valid !", "status" => 200, "claimed" => $result['uses']?true:false), JSON_PRETTY_PRINT);
        } else if ($http_code == 404) {
            echo json_encode(array("message" => "Code is invalid !", "status" => 404), JSON_PRETTY_PRINT);
        } else if ($http_code == 429) {
            echo json_encode(array("message" => "Wait for cooldown : ".ceil(intval($result['retry_after']))." (s)", "status" => 429, "countdown" => ceil(intval($result['retry_after']))), JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array("message" => "Unknown status", "status" => -1), JSON_PRETTY_PRINT);
        }
    }
} else {
    echo json_encode(array("message" => "MISSING_INFORMATION", "status" => 0), JSON_PRETTY_PRINT);
}