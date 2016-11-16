<?php
	/**
	* we use this file to get the data from our data API provided by the course instructor
	* then this data is called from other files through AJAX calls 
	* this file privides API gateway
	*/
	if (isset($_REQUEST)) {
		//we have a user request

		if ($_REQUEST['type'] == 'getAllPatients') {

			$dataURL = "http://4me302-16.site88.net/getData.php?table=User";
			$patients = file_get_contents($dataURL);
			$obj = new SimpleXMLElement($patients, 1);

			$users_array = array();
			//we convert it into an array that we can create json from
			foreach ($obj->userID as $user) {
				//we add only the users
				if ((string)$user['id'] == '3' || (string)$user['id'] == '4') {
					$user_array['id'] = (string)$user['id'];
					$user_array['username'] = (string)$user->username;
					$user_array['email'] = (string)$user->email;
					$user_array['lat'] = (string)$user->Lat;
					$user_array['long'] = (string)$user->Long;
					//get role name from role id
					//$role = new Role();
					$user_array['Role_IDrole'] = 'patient';
					$user_array['Organization'] = 'organization';

					array_push($users_array, $user_array);
				}
			}

			//this is what is returned to the javascript code in map.php
			print_r(json_encode($users_array));
		}
	}
	
?>