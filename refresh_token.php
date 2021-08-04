<?php 
require_once "config.php";
require_once "functions.php";
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head> 
<body>
	<h1>Refresh Token</h1>	
<?php
if(filesize('token.txt')){
        $token = json_decode(file_get_contents('token.txt'));
        $output = refresh_access_token($token->refresh_token);
        $json_op = json_decode($output);
        if($json_op->refresh_token)
        {	
            file_put_contents('token.txt',$output);
            print_r("<h4 style='color:green;'>Access token is successfully updated!</h4>");
        }
}else{
    print_r("<h4 style='color:red'>Cannot find access token, please generate access token using 3 legged Authentication</h4>");
}

?>
</body>
</html>

		
