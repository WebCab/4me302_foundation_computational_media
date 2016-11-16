<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Bootstrap 101 Template</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/style.css" rel="stylesheet">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
  	</head>
  	<body>
    
	    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        
	        </div>

	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="researcher_dashboard.php?provider=Twitter">Dashboard</a></li>
	            <li><a href="logout.php">Logout</a></li>
	          </ul>
	          <ul class="nav navbar-nav navbar-left">
	            <li><a href="map.php">Map</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>

	    <div class="container homepage">
	    	<h2> PATIENTS LOCATIONS </h2>
	    	<div id="map" style="width: 100%; height: 700px;"></div>
	    </div>  

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>
	    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>     
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIUqHXtcSYnm2Ve3U49y2ma4pfEEGDfU" async defer></script>
    </body>
</html>
    <script type="text/javascript">

        //this is called when the page is ready
        $(document).ready(function() {
        	//first get the patients
        	getPatients(function(patients) {
        		//when we get the patients now we can read their 
        		//latitudes and longitudes so we can show the google maps too
        		showPatientsInMap(patients)

        	});
    	});

        /**
        * this function gets the patient data through AJAX
        */
        function getPatients(callback) {
        	//this function will peform an AJAX call to our getData.php file to get the data 
        	$.ajax({ type: "POST", url: 'getData.php', data: { type: 'getAllPatients'}})
		  	 .done(function(response) {
		        var patients = $.parseJSON(response);
		        callback(patients);
			});
        }

        /**
        *  this function shows the google maps into the div
        */
        function showPatientsInMap(patients) {

        	console.log(patients);
        	//we empty out the map div
        	$('#map').html("");
			//we get static lat and lng to the map so it can focus better in sweden
			//so we can see both of our users
			var map;
			map = new google.maps.Map(document.getElementById('map'), {
		      center: {lat: 56.8833333, lng: 14.8166667},
		      zoom: 6
		    });

			$.each(patients, function(key, patient) {
			    var marker = new google.maps.Marker({
			      position: {lat: parseFloat(patient.lat), lng: parseFloat(patient.long)},
			      map: map
			    });

			    google.maps.event.addListener(marker, 'click', function () {
				   // do something with this marker ...
				   var patientInfo = "username : " + patient.username + " email :" + patient.email 
				   		+ " part of organization : " + patient.Organization;

				   alert(patientInfo);
				});
			});
        }

    </script>