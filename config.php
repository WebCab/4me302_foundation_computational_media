<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
$config =array(
		//"base_url" => "http://asghar.gulmarble.com/sociallogin/",
		"base_url" => "http://asghar.gulsoft.se/social_auth_login/hybridauth/index.php",
		// "base_url" => "http://localhost/hybridauth1/hybridauth/index.php",
		//"base_url" => "http://localhost/hybridauth1/hybridauth/index.php?hauth.done=Google",
		//"base_url" => "http://hayageek.com/examples/oauth/hybridauth/hybridauth/index.php", 
		"providers" => array ( 

// gogogleauth app at ak222eh.lnu.se
			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "680453741594-gdrcm7muill6jkf61haaordo8vhb9gge.apps.googleusercontent.com", "secret" => "gdIBXpjPcZApmoEZtRXvfgro" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "835365023180942", "secret" => "e426256d15fe57773295b29aa267039b" ), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "OwQ8YOdespQ7AUWSshgAxD3iZ", "secret" => "zf6uh6aVFxGfbBxinEh23YiGyJhhMoQCbYTdRzhdWGqwrqg8fy" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);
