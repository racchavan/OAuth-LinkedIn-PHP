<?php 

require_once "config.php";
require_once "functions.php";
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head> 
<body>
	<h1>GET ID page for "Authorization"</h1>	
<?php
if(filesize('token.txt')){
	$token = json_decode(file_get_contents('token.txt'));
	$url = "https://api.linkedin.com/v2/me?oauth2_access_token=".$token->access_token;
	try {
        print_r("<h5>Using access token to get your public profile...</h5>");
        $output = curl_url_request($url);
        print_r("<h4>Here is your public profile</h4>");
		print_r("<h3 style='color:green'>".$output."</h3>");
    } catch(Exception $e) {
		echo $e->getMessage();
	}

}

?>
</body>
</html>

		
