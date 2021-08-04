<?php 
require_once("config.php");

function array_to_urlstring($data){
    $post_data = "";
    foreach( $data as $key => $val ) {
        $post_data .=$key."=".$val."&";
     }
     $post_data = rtrim($post_data, "&");
     return $post_data;
}
function curl_url_request($url){
        $cs = curl_init();
		curl_setopt($cs, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($cs, CURLOPT_HTTPHEADER, HEADERS);
		curl_setopt($cs, CURLOPT_URL, $url);
		curl_setopt($cs, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($cs, CURLOPT_TIMEOUT,3000);
		$output = curl_exec($cs);
        return $output;
}    

function curl_post_data($url, $data){
    $cs = curl_init();
    curl_setopt($cs, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($cs, CURLOPT_HTTPHEADER, HEADERS);
    curl_setopt($cs, CURLOPT_URL, $url);
    curl_setopt($cs, CURLOPT_POSTFIELDS, $data);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cs, CURLOPT_TIMEOUT,3000);
    $output = curl_exec($cs);
    return $output;

}

function get_access_token($code){
    $data = [
        
        "client_id" => CLIENT_ID,
        "client_secret" => CLIENT_SECRET,
        "redirect_uri" => REDIRECT_URL,
        "code" => $code,
        "grant_type" => "authorization_code"
   ];
    $data = array_to_urlstring($data);
    $url = "https://www.linkedin.com/oauth/v2/accessToken";
    $cs = curl_init();
    curl_setopt($cs, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($cs, CURLOPT_URL, $url);
    curl_setopt($cs, CURLOPT_POSTFIELDS, $data);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cs, CURLOPT_TIMEOUT,3000);
    $output = curl_exec($cs);
    return $output;
}

function refresh_access_token($refresh_token){
    $data = [
        "client_id" => CLIENT_ID,
        "client_secret" => CLIENT_SECRET,
        "refresh_token" => $refresh_token,
        "grant_type" => "refresh_token"
   ];
    $data = array_to_urlstring($data);
    $url = "https://www.linkedin.com/oauth/v2/accessToken";
    $cs = curl_init();
    curl_setopt($cs, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($cs, CURLOPT_URL, $url);
    curl_setopt($cs, CURLOPT_POSTFIELDS, $data);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cs, CURLOPT_TIMEOUT,3000);
    $output = curl_exec($cs);
    return $output;
}


function token_introspection($token){
    $url = "https://www.linkedin.com/oauth/v2/introspectToken";
 
    $data = [
            "client_id" => CLIENT_ID,
            "client_secret" => CLIENT_SECRET,
            "token" => $token
        ];
    $data = array_to_urlstring($data);
    $output = curl_post_data($url, $data);
    return $output;
}

function two_legged_auth(){
    $url = "https://www.linkedin.com/oauth/v2/accessToken?grant_type=client_credentials&client_id=".CLIENT_ID."&client_secret=".CLIENT_SECRET;
    $output = curl_url_request($url);
    $op = json_decode($output);
    //save access token in txt file
    if($op->access_token){
       file_put_contents("token.txt",$output);
    }
    return $output;
}