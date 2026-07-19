<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

$dns = "http://hyrahe.xyz";
$user = "ahmedmohamady1";
$pass = "854726";

$apiUrl = $dns . "/player_api.php?username=" . $user . "&password=" . $pass . "&action=get_vod_streams";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    echo $response;
} else {
    echo json_encode(["status" => "error", "message" => "Failed to fetch data"]);
}
?>

