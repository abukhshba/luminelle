<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\HtmlString;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/* All App's Helpers */

/* API Helper */
function get_auth(){
    foreach (config('auth.guards') as $key => $guard){
        if (auth($key)->check())
            return auth($key);
    }

    return false;
}

function parent_auth(){
    if (auth('parent')->check())
        return auth('parent');

    return false;
}

/* Site's Helper */
function get_lang(){
    return LaravelLocalization::getCurrentLocale();
}
function get_direction(){
    return LaravelLocalization::getCurrentLocaleDirection();
}
function get_academic_year(){
    return auth()->user()->year_id;
}
function currency($currency = null) : null | string {
    if (is_null($currency)) return null;
    return $currency.' ج.م';
}

function currency_thousands($price){
    return number_format($price, 2, '.', ',');
}

function pad_code($code){
    return str_pad($code,6,'0',STR_PAD_LEFT);
}

function pad_code_two($time){
    return str_pad($time,2,'0',STR_PAD_LEFT);
}
function get_exact_time($seconds = 0){
    if (!is_numeric($seconds))
        return "00:00:00";

    $secs = $seconds % 60;
    $hrs = $seconds / 60;
    $mins = $hrs % 60;

    $hrs = (int)($hrs / 60);

    return (pad_code_two($hrs) . ":" . pad_code_two($mins). ":" . pad_code_two($secs));
}

// Payment Helpers
function fawry_msg($price, $ref){
    return 'برجاء التوجه الى أقرب ماكينة فوري و ايداع مبلغ '.currency($price).' على رقم '.$ref.' في خدمة FawryPay.';
}

function vodafone_cash_msg($price, $phone){
    return "قم بتحويل مبلغ {$price} لحساب فودافون كاش على رقم {$phone} وابعت صورة التحويل على الواتساب أو قم بإرفاقها بالضغط على الزر بالأسفل.";
}

// Invoice Status
function check_status($status){
    return match ($status) {
        0, null => 'pending',
        1 => 'approved',
        default => 'cancelled'
    };
}
function youtube_video_time($video){
    $httpClient = new \GuzzleHttp\Client();
    $response = $httpClient->request('GET', 'https://www.googleapis.com/youtube/v3/videos?id='.$video.'&key=AIzaSyB3gYmdRWSOBDiF0JwUnQ5WdL0X4bYS_-U&part=snippet,contentDetails,statistics,status');

    $response = json_decode($response->getBody()->getContents());
    $start = new \DateTime('@0'); // Unix epoch
    $start->add(new \DateInterval($response->items[0]->contentDetails->duration));

    return duration_in_seconds($start->format('H:i:s'));
}
function duration_in_seconds($time){
    $seconds = 0;
    $values = explode(':', $time);
    $seconds += intval($values[0]) * 60* (count($values) == 3 ? 60 : 1);
    $seconds += isset($values[2]) ? intval($values[1]) * (count($values) == 3 ? 60 : 1) : 0;
    $seconds += isset($values[2]) ? intval($values[2]) : 0;
    return $seconds;
}
// Color Status
function get_color($status){
    return match (check_status($status)) {
        'pending' => '#f1c40f',
        'approved' => '#2ecc71',
        default => '#e74c3c'
    };
}

function is_admin(){
    return auth('admin')->check() && auth('admin')->user()->is_admin;
}

function is_super_admin(){
    return is_admin() && auth('admin')->user()->role == 'super';
}

function is_instructor()
{
    return auth('admin')->check() && !auth('admin')->user()->is_admin;
}

function get_image_name($file)
{
    return \Illuminate\Support\Str::slug($file->getClientOriginalName()) . '-' . time() . '.' . $file->getClientOriginalExtension();
}

/* Site's Helper */
function get_user_title()
{
    if (is_instructor()) {
        return 'مدرس';
    }

    return 'مدير';
}

function get_user_image()
{
    if (get_auth()->check()) {
        $image = get_auth()->user()->image_url;

        if (file_exists('uploads/images/' . $image) && !is_null($image)) {
            return asset('uploads/images/' . $image);
        }

//        return asset('assets/back/img/placeholder.png');

        return 'https://eu.ui-avatars.com/api/?size=128&rounded=true&bold=true&background=2ecc71&color=fff&name='.get_auth()->user()->name;
    }
}

function get_teacher_avatar($image, $name){

    if (file_exists('uploads/images/' . $image) && !is_null($image)) {
        return asset('uploads/images/' . $image);
    }

    return "https://eu.ui-avatars.com/api/?size=128&rounded=true&bold=true&background=363A76&color=fff&name={$name}";
}

function get_student_slug($id, $name){
    return Str::slug($name.'-'.$id);
}

function get_student_avatar($slug, $gender = 'male'){
    $gender = $gender == '' ? 'male' : $gender;

//    return $gender;
//    if (file_exists('uploads/teachers/' . $image) && !is_null($image)) {
//        return asset('uploads/teachers/' . $image);
//    }

//    return "https://eu.ui-avatars.com/api/?size=128&rounded=true&bold=true&background=2ecc71&color=fff&name={$name}";
    return "https://avatars.dicebear.com/api/{$gender}/{$slug}.svg";
}

function check_route($prefix, $routes)
{
    foreach ($routes as $route) {
        $is_route = \Route::is($prefix . $route);

        if ($is_route) return true;
    }
}

function encode($file)
{
    return base64_encode(base64_encode($file));
}

function decode($file)
{
    return base64_decode(base64_decode($file));
}

function check_passed($day_date, $now, $is_coming)
{
    if ($is_coming)
        return '';
    elseif ($day_date > $now)
        return 'table-success';
    else
        return 'table-hover';
}

function count_reviews($reviews)
{
    $stars = [];

    for ($i = 1; $i <= 5; $i++)
        $stars[$i] = 0;

    foreach ($reviews as $review) {
        $stars[$review->stars] = $stars[$review->stars] + 1;
    }

    return $stars;
}

function review_percent($count, $total)
{
    return number_format($count > 0 ?? (($count / $total) * 100), 2);
}

function calculate_reviews($stars, $total)
{
    $calc = 0;

    for ($i = 1; $i <= 5; $i++) {
        $calc += $stars[$i] * $i;
    }

    return number_format($calc / $total, 1);
}

function is_front_admin($round_id)
{
    return auth('admin')->check() && !auth()->user()->is_teacher;
}

function is_front_instructor($round_id)
{
    return auth('admin')->check() && auth()->user()->is_teacher;
}
function vodafone_cash_fees($price){
//    return $price ? ceil((($price * 1) / 100) + 2) : 0;
    return $price ? ceil((($price * 2.75) / 100) + 4) : 0;
}
function final_price($price) {
    return fawry_fees($price);
//    return roundUpToAny($fees, 2);
}

function initial($price){
    $init = (($price * 2.75) / 100) + 3;
    return $price ? ceil($init+(($init*14) / 100)) : 0;
}

function fawry_fees($price){
    $init = (($price * 4) / 100) + 4;
    return $price ? ceil($init+(($init*14) / 100)) : 0;
}

function decent_fawry_fees($price){
    $init = (($price * 2.75) / 100) + 3;
    return $price ?$init+(($init*14) / 100) : 0;
}

function decent_vodafone_fees($price){
    return ($price * 1) / 100;
}

function droos_profit($price, $fees, $type = 'fawry') {
    $total = $price + $fees;
    $decent = ('decent_'.$type.'_fees')($total);
    return round($fees - $decent, 2);
}

function credit_card_fees($price){
    return $price ? ceil((($price * 2.5) / 100) + 4) : 0;
}

// Blocked Note
function is_true($condition){
    return $condition == 1;
}

function lesson_quiz_status(){
    // passed
    // closed
    // quiz_id
    // Null

    $id = rand(0,3);

    return match ($id) {
        0 => 'passed',
        1 => 'closed',
        2 => 'allowed',
        default => null
    };
}

function get_status_badge($status){
    if ($status) {
        return "<h5><span class='badge droos-badge bg-success'>فعال</span></h5>";
    }

    return "<span class='badge droos-badge bg-danger'>غير فعال</span>";
}

function get_image_path($dir, $image){
    if (file_exists(public_path('uploads/'.$dir.'/'.$image)) && $image != ''){
        return asset('uploads/'.$dir.'/'.$image);
    }

    return asset('assets/front/images/placeholder.jpg');
}
function get_student_rank() {
    if (get_auth()) {
        return \App\Models\User::where('points', '>', (int)get_auth()->user()->points)->count() + 1;
    }

    return 1;
}
function get_image($dir, $image){
    if (file_exists(public_path($dir.'/'.$image)) && $image != ''){
        return asset($dir.'/'.$image);
    }

    return asset('assets/images/placeholder.png');
}

function get_lesson_image($dir, $image, $type = 'youtube', $id = 0){
    if (file_exists(public_path($dir.'/'.$image)) && $image != ''){
        return asset($dir.'/'.$image);
    }

    if ($type == 'youtube'){
        return 'https://i.ytimg.com/vi/'.$id.'/sddefault.jpg';
    }

    return asset('assets/images/thumbnail-placeholder.jpg');
}
function get_mime_type($text){
    $file = explode('.', $text);
    return strtolower(end($file));
}
function get_video_status($video_status, $id = null){
    if ($video_status)
        return "<span class='text-success'><i class='fa fa-check-circle'></i> فعال </span>";

    return "<span class='text-danger processing' id='".$id."'><img style='height: 20px' src='".asset('assets/images/icons/preloader.svg')."' alt='' /> جاري المعالجة </span>";
}

function get_badge_color($status){
    return match (check_status($status)) {
        'pending' => 'warning',
        'approved' => 'success',
        default => 'danger'
    };
}

function file_extension($file){
    return pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
}

function file_name($file, $title){
    return $title.'-'.rand(1,9999).'.'.file_extension($file);
}

function get_item_order($obj, $column = null, $col_value = null){
    if ($obj->exists){
        return $obj->item_order;
    }

    if (!is_null($column))
        $obj = $obj->where($column, $col_value);

    $obj = $obj->select('item_order')->orderBy('item_order', 'DESC')->first();

    return isset($obj->item_order) ? $obj->item_order + 1 : 1;
}

function saveImg($image, $title, $path, $width, $height){
    if (file_extension($image) != 'svg') {
        $img = Image::make($image->path());
        $img->resize($width, $height, function($constraint) {
            $constraint->aspectRatio();
        })->save($path.'/'.$title);
    }else {
        $image->move($path,$title);
    }
}

function push_single_notification($tokens, $title, $body, $sound = 'default'){

    $url = 'https://fcm.googleapis.com/fcm/send';

//    $data = [
////        'body' => $body,
////        'title' => $title,
//        'vibrate' => 1,
//        'message' => true,
//        "to" => $tokens,
//        "notification" => [
//            "title" => $title,
//            "body" => $body,
//            "sound" => "alert.aiff",
////            "android_channel_id" => "high_importance_channel"
//        ],
//
//        "android" => [
//            "priority" => "high",
//            "notification" => [
//                "sound" => "alert.mp3"
//            ]
//        ]
//    ];

//    $fields = [
//        'registration_ids' => $tokens,
//        'data' => $data,
//        'priority' => 'high',
//    ];
//
//
//    return Http::withHeaders([
//        'Authorization: key='.env('SERVER_KEY'),
//        'Content-Type: application/json',
//    ])
//    ->post($url, $fields)
//    ->json();

//    return $response;
    $data = [
        "registration_ids" => $tokens,

        "notification" => [
            "title" => $title,
            "body" => $body,
            "sound" => "alert.aiff",
//            "android_channel_id" => "high_importance_channel"
        ],

        "android" => [
            "priority" => "high",
            "notification" => [
                "sound" => "notification.mp3"
            ]
        ]
    ];
//
    $dataString = json_encode($data);
//
    $headers = [
        'Authorization: key=AAAA-ziXizo:APA91bGVJ5Ek6U1jcIoYDFHxfO_LDENXBEAnu0MhPk2TJ_YgujyHAPf-OWGN-DBSgoG7l1Yg2hOOp6KzVNtPk4iuzdicQaRCD9qXhZ_sAE1smPmchZLTbuC1SJ1Gtw7c872V8K8-Ktd4',
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    return curl_exec($ch);
}

function get_dashboard_title($page_title){
    $name = 'لوحة تحكم '.config('app.name');
    $separator = !\Illuminate\Support\Facades\Route::is('dashboard.') ? ' | ' : '';
    $page_title = isset($page_title) ? $page_title : '';

    return  $page_title.$separator.$name;
}
function omega_link($uuid){
    return 'https://api.omegastream.net/stream/company/processed-enterprise-media/bc233331/video/'.$uuid.'/playlist.m3u8';
}

function video_link($type, $link){
    return match ($type) {
        'omega' => base64_encode(omega_link($link)),
        default => base64_encode($link)
    };
}

function get_video_type($type){
    return match ($type) {
        1 => 'omega',
        2 => 'youtube',
        default => 'vimeo'
    };
}
function omega_upload_video($title, $video_path){
    $link = env('OMEGA_URL').'/client/video/stream/copy';

    $httpClient = new \GuzzleHttp\Client();

    $response = $httpClient->request('POST', $link, [
        'json' => [
            'title' => $title,
            'url' => route('dashboard.download.storage', encode($video_path)),
        ]
    ]);

    return json_decode($response->getBody()->getContents());
}
function omega_get_video_duration($video){
    return (new \getID3)->analyze(storage_path('app/videos/'.$video))['playtime_seconds'];
}
function omega_get_video_details($uuid){
    $link = env('OMEGA_URL')."/client/video/$uuid";

    $httpClient = new \GuzzleHttp\Client();

    try {
        $response = $httpClient->request('GET', $link, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.env('OMEGA_API_KEY')
            ]
        ]);

        return json_decode($response->getBody()->getContents());

    }catch (\Exception $e) {
        return false;
    }
}
function omega_delete_video($uuid){
    $link = env('OMEGA_URL').'/client/video/'.$uuid;

    $httpClient = new \GuzzleHttp\Client();

    try {
        $httpClient->request('DELETE', $link, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.env('OMEGA_API_KEY')
            ]
        ]);
    }catch (\Exception $e){}

//    return json_decode($response->getBody()->getContents());
}

function user_month_subscription($month_id, $user_id = null){
    $user_id = is_null($user_id) ? get_auth()->id() : $user_id;
    return \App\Models\Invoice::select('id')->where('user_id', $user_id)->where('model_id', $month_id)->where('model_type', 'App\Models\CourseMonth')->where('status', 1)->first();
}

function is_subscribed($month){
    return auth('admin')->check() || !$month->price || user_month_subscription($month->id);
}

function push_realtime_notification($channel, $event, $data){
    $options = array(
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true
    );

    $pusher = new Pusher\Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );

    $pusher->trigger($channel, $event, $data);
}

function base64UrlEncode(string $data): string
{
    // First of all you should encode $data to Base64 string
    $b64 = base64_encode($data);

    // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
    if ($b64 === false) {
        return false;
    }

    // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
    $url = strtr($b64, '+/', '-_');

    // Remove padding character from the end of line and return the Base64URL result
    return rtrim($url, '=');
}

function base64UrlDecode(string $base64Url): string
{
    return base64_decode(strtr($base64Url, '-_', '+/'));
}

function post_fawry(){
    $merchantCode    = 'siYxylRjSPx44XScjf4JyQ==';
    $merchantRefNum  = '2312465201';
    $merchant_cust_prof_id  = '777777';
    $payment_method = 'PAYATFAWRY';
    $amount = '580.55';
    $merchant_sec_key =  '9273c605-ae33-4e39-9034-56c5a44941c2'; // For the sake of demonstration
    $signature = hash('sha256' , $merchantCode . $merchantRefNum . $merchant_cust_prof_id . $payment_method . $amount . $merchant_sec_key);

    $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3

    $response = $httpClient->request('POST', 'https://www.atfawry.com/ECommerceWeb/Fawry/payments/charge', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json'
        ],
        'body' => json_encode(   [
            'merchantCode' => $merchantCode,
            'merchantRefNum' => $merchantRefNum,
            'customerName' => 'Ahmed Ali',
            'customerMobile' => '01559488897',
            'customerEmail' => 'ahmedyasersalama@gmail.com',
            'customerProfileId'=> '777777',
            'amount' => $amount,
            'currencyCode' => 'EGP',
            'language' => 'ar-eg',
            'chargeItems' => [
                [
                    'itemId' => '897fa8e81be26df25db592e81c31c',
                    'description' => 'Item Description',
                    'price' => $amount,
                    'quantity' => '1'
                ]
            ],
            'signature' => $signature,
            'paymentMethod' => $payment_method,
            'description' => 'example description'
        ] , true)
    ]);

    return json_decode($response->getBody()->getContents(), true);
}

function is_the_teacher($teacher_id){
    if(auth('admin')->check())
        return is_null(auth('admin')->user()->is_admin) && $teacher_id == auth('admin')->id();

    return false;
}

function is_course_subscribed($course_id){
    if (get_auth()->check()){
        $user = get_auth()->user();
        return !is_null(\App\Models\Invoice::select('id')->where('model_type', 'App\Models\Course')->where('model_id', $course_id)->where('user_id', $user->id)->where('status', 1)->first());
    }

    return false;
}

function is_month_subscribed($month_id){
    if (get_auth()->check()){
        $user = get_auth()->user();
        return !is_null(\App\Models\Invoice::select('id')->where('model_type', 'App\Models\CourseMonth')->where('model_id', $month_id)->where('user_id', $user->id)->where('status', 1)->first());
    }

    return false;
}

function is_lessom_subscribed($lesson_id){
    if (get_auth()->check()){
        $user = get_auth()->user();
        return !is_null(\App\Models\Invoice::select('id')->where('model_type', 'App\Models\CourseMonthLesson')->where('model_id', $lesson_id)->where('user_id', $user->id)->first());
    }

    return false;
}

function phone_status($verified){

    if ($verified)
        return "<span class='text-danger'><i class='fa fa-times-circle'></i> غير فعال </span>";

    return "<span class='text-success'><i class='fa fa-check-circle'></i> فعال </span>";
}

// Permissions
function can($permission){
    return auth('admin')->user()->can($permission);
}

function calculate_profit($total,$profit,$type){
    return get_fixed_profit($total,$profit,$type);
}

function teacher_profit($total,$profit,$type){
    return $total - get_fixed_profit($total, $profit, $type);
}

function get_fixed_profit($total, $profit = 10, $type = 'fixed'){
    switch ($type) {
        case 'fixed':
            return $profit;
        case 'percent':
            return ($total * $profit) / 100;
    }
}

function get_app_version() {
//    if (get_auth()) {
//        $user = get_auth()->user();
//        return $user->os_name == 'ios';
//    }

    return false;
}

function get_profit_type($profit, $type){
    return match ($type) {
        'fixed' => currency($profit),
        'percent' => $profit.'%',
        default => 0
    };
}

function get_time($time) : int | null{
    return $time ? intval($time) : null;
}

function get_lesson_progress($lesson, $time) : int | null {
    $duration = $lesson->duration ?? 1;
    return $time > 0 ? intval(($time / $duration) * 100) : null;
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

function check_if_allowed_device($user, $mac, $device){
    $macs = $user->macs()->select('macaddress')->where('device', $device)->get();

    if ($macs->count() > 0) {
        foreach ($macs as $macItem) {
            if ($macItem->macaddress == $mac) return true;
        }
    }

    if(!$macs->count()) return true;

    return false;
}
