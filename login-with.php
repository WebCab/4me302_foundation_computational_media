<?php
        session_start();
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
	        	echo "<b>Name</b> :".$user_profile->displayName."<br>";
	        	echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
	        	echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
	        	echo "<img src='".$user_profile->photoURL."'/><br>";
	        	echo "<b>Email</b> :".$user_profile->email."<br>";	        		        		        	
	        	echo "<br> <a href='logout.php'>Logout</a>";
                        echo "<br>";
                   //     echo $provider;
                        if($provider =='Facebook')
                        {
                               
                                include_once 'flickrjson.php';
                            // header('Location: adminhome.php');
                        }
                        else if($provider =='Twitter')
                        {


                        ######## Twitts Start
                        ?>


<!DOCTYPE html>

<html>
<head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Robin's Custom Twitter API: Test</title>
        
        <style type="text/css">
                table a:link {
                        color: #666;
                        font-weight: bold;
                        text-decoration:none;
                }
                table a:visited {
                        color: #999999;
                        font-weight:bold;
                        text-decoration:none;
                }
                table a:active,
                table a:hover {
                        color: #bd5a35;
                        text-decoration:underline;
                }
                table {
                        font-family:Arial, Helvetica, sans-serif;
                        color:#666;
                        font-size:12px;
                        text-shadow: 1px 1px 0px #fff;
                        width: 900px;
                        margin: 0 auto;
                        background:#eaebec;
                        border:#ccc 1px solid;

                        -moz-border-radius:3px;
                        -webkit-border-radius:3px;
                        border-radius:3px;

                        -moz-box-shadow: 0 1px 2px #d1d1d1;
                        -webkit-box-shadow: 0 1px 2px #d1d1d1;
                        box-shadow: 0 1px 2px #d1d1d1;
                }
                table th {
                        padding:21px 25px 22px 25px;
                        border-top:1px solid #fafafa;
                        border-bottom:1px solid #e0e0e0;

                        background: #ededed;
                        background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
                        background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
                }
                table th:first-child {
                        text-align: left;
                        padding-left:20px;
                }
                table tr:first-child th:first-child {
                        -moz-border-radius-topleft:3px;
                        -webkit-border-top-left-radius:3px;
                        border-top-left-radius:3px;
                }
                table tr:first-child th:last-child {
                        -moz-border-radius-topright:3px;
                        -webkit-border-top-right-radius:3px;
                        border-top-right-radius:3px;
                }
                table tr {
                        text-align: center;
                        padding-left:20px;
                }
                table td:first-child {
                        text-align: left;
                        padding-left:20px;
                        border-left: 0;
                }
                table td {
                        padding:18px;
                        border-top: 1px solid #ffffff;
                        border-bottom:1px solid #e0e0e0;
                        border-left: 1px solid #e0e0e0;

                        background: #fafafa;
                        background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
                        background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
                }
                table tr.even td {
                        background: #f6f6f6;
                        background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
                        background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
                }
                table tr:last-child td {
                        border-bottom:0;
                }
                table tr:last-child td:first-child {
                        -moz-border-radius-bottomleft:3px;
                        -webkit-border-bottom-left-radius:3px;
                        border-bottom-left-radius:3px;
                }
                table tr:last-child td:last-child {
                        -moz-border-radius-bottomright:3px;
                        -webkit-border-bottom-right-radius:3px;
                        border-bottom-right-radius:3px;
                }
                table tr:hover td {
                        background: #f2f2f2;
                        background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
                        background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);
                }
        </style>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
        <script type="text/javascript">
        $( document ).ready(function() {
        
                // Get the 5 latest tweets from user: thardesign
                var username = "thardesign";
                var tweets = "5";
                
                $.get('./twitter_api.php?type=timeline&username=' + username + '&count=' + tweets, function (jsondata) {

                        // Parse JSON
                        var data = $.parseJSON(jsondata);
                        var i = 0;
                        
                        // Append to content
                        $.each(data, function() {
                                i++;
                                $('#tweets-timeline').append('<tr><td>' + i + '</td><td>' + this['username'] + '</td><td>' + this['type'] + '</td><td><img src="' + this['avatar'] + '" /></td><td>' + this['date'] + '</td><td>' + this['tweet'] + '</td><tr>');
                        });
                        
                });
                
                // Get the 5 most recent tweets with keyword: test
                // var keyword = "#Växjö";
                var keyword = "#exercise, Parkinsons";
                var searchtype = "recent";
                var tweets = "10";

                $.get('./twitter_api.php?type=search&searchtype=' + searchtype + '&q=' + encodeURIComponent(keyword) + '&count=' + tweets, function (jsondata) {
                
                        // Parse JSON
                        var data = $.parseJSON(jsondata);
                        var i = 0;
                        
                        // Append to content
                        $.each(data, function() {
                                i++;
                                $('#tweets-search-recent').append('<tr><td>' + i + '</td><td>' + this['username'] + '</td><td>' + this['type'] + '</td><td><img src="' + this['avatar'] + '" /></td><td>' + this['date'] + '</td><td>' + this['tweet'] + '</td><tr>');
                        });
                        
                });
                        
        });
        </script>
        
        <body>
        
                <table cellpadding="0" cellspacing="0">
                        <caption>
                                <br>
                                <h1>Twitter PHP API</h1>
                                
                                
                                
                                
                                
                        <thead>
                                <tr>
                                        <th>#</th>
                                        <th>Twitter Name</th>
                                        <th>Tweet Type</th>
                                        <th>Avatar</th>
                                        <th>Date</th>
                                        <th>Tweet</th>
                                </tr>
                        </thead>
                        <tbody id="tweets-search-recent"></tbody>
                </table>
        </body>
</html>






<?php

                       ##########  End Of Twiits  ######### 

                               
                        }  #### End of else if
                   
                        elseif ($provider== 'Google') {

                           // echo 'You are google user';
                            // include_once 'google-api-php-client-master/index.php';

                        ########## Start of You tube Api ################

                            ?>

                           <iframe src="http://localhost/newlogin/hybridauth/google-api-php-client-master/" width="900" height="900" border"0"></iframe>

         
                    

                        <?php

                        ########## Start of You tube Api ################
                        
                        }



                   //     if(isset($provider)==='twitter')
                     //   {
                      //          echo 'You are twitter User';
                      //  }
                       // else  {
                        //        # code...
                         //       echo 'You are not Twitter user';
                       // }
                        
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>