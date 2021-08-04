LinkedIn REST API Getting Started Tutorial
==========================================
The function here can help you get started with LinkedIn OAuth 3.0 and 2.0. Use this code to get access token , make API calls to LinkedIn API.

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

1. Download and add all file's in your project root folder.
2. Configure your app credentials in config.php file.
3. Include "config.php", "functions.php" to the file from which you want to make the   API request calls. Here we have used "index.php" to make the calls.
4. To generate access token for 3 legged auth click on "Login with LinkedIn" button. After you receive the authentication code "get_access_token(<authentication     code>)" function is responsible for generating access token.
5. To generate access token for 2 legged auth run "two_legged_auth()" function.
6. Generated token is saved in "token.txt" file for future use.
7. Use "token_introspection(<Token>)" to introspect token.
8. Use "refresh_access_token(<Refresh Token>)" to refresh access token.
