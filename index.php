<?php 
/******
PHP Demo for LinkedIn's 2 legged & 3 legged auth
This demo also includes methods for ,
1. Refresh Token
2. Token Introspection
3. Get profile data
******/

require_once "config.php";
require_once "functions.php";
$requested_3legged_flag = 0;
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>  
<body>
<h1>PHP demo</h1>	
<h1>Authenticate</h1>
<h5>Please click on the link below to get access code for 3 legged auth...</h5>
<?php
$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URL."&scope=".SCOPES;
?>
<a href="<?php echo $url; ?>"><button class="btn btn-primary" style="">Login with LinkedIn</button></a>

<?php
//After login with LinkedIn is successful
//Generate access token if access code is returned in the URL
if(isset($_REQUEST["code"])){
	try {
        print_r("<h5>Trading authorization code for access token...</h5>");
	    $output = get_access_token($_REQUEST["code"]);
		print_r($output);
		$json_op = json_decode($output);	
		if($json_op->access_token)
		{
		    print_r("<h5 style='color:green;'>Received access token: </h5>");
			file_put_contents('token.txt',$output);
		    $requested_3legged_flag = 1;
		}else{
			//if access token generation failed show the error.
			print_r("<h5 style='color:red;'>Please click on 'Login with LinkedIn' button to generate access code!</h5>");
		}

	} catch(Exception $e) {
		echo $e->getMessage();
	}

}
//Get Profile Info (only works for 3 legged Auth)
if(filesize('token.txt') && $requested_3legged_flag == 1){
	?>
			<br>
			<a href="getid.php"><button class="btn btn-link">Get Profile Info</button></a>
			<br>
		<?php
}
//Refresh Token (only works for 3 legged Auth)
if(filesize('token.txt') && $requested_3legged_flag == 1){
	?>
			<br>
			<a href="refresh_token.php"><button class="btn btn-link">Refresh Token</button></a>
			<br>
		<?php
}

//Generate 2 legged Auth 
/**** 
?><h4>Requesting access token for 2 legged auth...</h4><?php  
print_r("<h5>Trading Client ID and Client Secret key for access token...</h5>");
$output = two_legged_auth();
print_r("<h3 style='color:green;'>".$output."</h3>");
*/

//Token Introspection

if(filesize('token.txt') != 0 ){ 
	print_r("<br>");
    print_r("<h3> Performing Token Introspection... </h3>");
	$token = json_decode(file_get_contents('token.txt'));
	$output = token_introspection($token->access_token);
	print_r("<h3 style='color:green;'>".$output."</h3>");
} ?>
</body>
</html>
		
