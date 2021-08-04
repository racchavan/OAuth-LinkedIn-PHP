LinkedIn REST API Getting Started Tutorial
==========================================
The code, functions contained here is part of our new getting started tutorial which can be found on our developer site at the following location:

https://docs.microsoft.com/en-us/linkedin/

Currently we provide support for Java, PHP, and Python with additional languages being added to the tutorial in the future.

License
-------
Copyright 2021 LinkedIn Corporation


Requirements
------------
PHP Server to host the code and make API requests

Steps
-------

1. Add Download and add all the file in your project root folder.
2. Configure your app credentials in config.php file.
3. Include "config.php", "functions.php" to the file from which you want to make the   API request calls. Here we have used "index.php" to make the calls.
4. To generate access token for 3 legged auth click on "Login with LinkedIn" button. After you receive the authentication code "get_access_token(<authentication     code>)" function is responsible for generating access token.
5. To generate access token for 2 legged auth run "two_legged_auth()" function.
6. Generated token is saved in "token.txt" file for future use.
7. Use "token_introspection(<Token>)" to introspect token.
8. Use "refresh_access_token(<Refresh Token>)" to refresh access token.
