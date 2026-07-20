<?php
// إعداد الهيدرز للسماح بمرور البيانات بدون حظر CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

// بيانات سيرفر Hyper Live
$host     = "http://hyrahe.xyz";
$username = "ahmedmohamady1";
$password = "854726";

// تحديد الأكشن المطلوب (افتراضياً يجلب أقسام الأفلام إذا لم يحدد)
$action = isset($_GET['action']) ? $_GET['action'] : 'get_vod_categories';

// بناء رابط الطلب
$target_url = "{$host}/player_api.php?username={$username}&password={$password}&action={$action}";

// جلب البيانات من السيرفر
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// طباعة النتيجة لتطبيق Hyper Live
if ($http_code == 200 && $response) {
    echo $response;
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch data from server",
        "code" => $http_code
    ]);
}
?>
