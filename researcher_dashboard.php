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
    $_SESSION['user'] = $user_profile;
    if($user_profile && isset($user_profile->identifier))
    {
        ?>

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
            <li><a href="#"><?php echo $user_profile->displayName."<br>";?></a></li>
            <li><a href="#"><?php echo $user_profile->email."<br>";?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li><a href="map.php">Map</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container homepage">
      <div class="row">
         <div class="col-md-3"></div>
            <div class="col-md-6 welcome-page">
              <h2>Researcher Dashboard.</h2>
            </div>
          <div class="col-md-3"></div>
        </div>
    </div>  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>

        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-2 left=menu">
                    <h3>Patients</h3>
                    <ul style="list-style-type: none;">
                        <?php
                        $url = 'http://4me302-16.site88.net/getData.php?table=User';

                        $url_role = 'http://4me302-16.site88.net/getData.php?table=Role';

                        $role = simplexml_load_file($url_role);
                        $org = simplexml_load_file($url);

                        //foreach($role as $key => $item){

                        //  echo $item->roleID;
                        //print_r($item);exit;

                        //echo '123';exit;

                        foreach ($org as $key => $item) {
                            if ($item->Role_IDrole == '1') {
                                //echo $key . ":" . $item->username. $item->email."<br>";
                                //  echo "<pre>";print_r($user123);

                                ?>


                                <ui>


                                    <a href="<?php
                                    if (isset($_GET['user'])){
                                        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                                        echo $uri_parts[0]."?provider=".$_GET['provider']. "&user=" . $item['id'];
                                    }
                                    else
                                    {
                                        echo $_SERVER['REQUEST_URI'] . "&user=" . $item['id'];
                                    }?>"><?php echo $item->username;

                                        ?>
                                    </a></br>

                                </ui>

                            <?php }

                        }

                        ?>
                    </ul>
                    <?php if(isset($_GET['user'])){?>




                        <h3>Test Sessions</h3>
                        <?php
                        $patient_therapy_url = 'http://4me302-16.site88.net/getData.php?table=Therapy';
                        $patient_therapy = simplexml_load_file($patient_therapy_url);
                        foreach ($patient_therapy as $key => $item) {
                            if ($item->User_IDpatient == $_GET['user']) {
                                $therapy_id = $item['id'];
//                    $test_url="http://4me302-16.site88.net/getData.php?table=Test";
//                    $test_data = simplexml_load_file($test_url);
                                $url = 'http://4me302-16.site88.net/getFilterData.php?parameter=therapyID&value='.$therapy_id;
                                $org = simplexml_load_file($url);
                                foreach($org as $key => $item){?>
                                    <ui>
                                        <li><a href="<?php if(isset($_REQUEST['id']))
                                            { echo substr($_SERVER['REQUEST_URI'], 0, -5).'&id='.$item['id']; }
                                            else
                                            {
                                                echo $_SERVER['REQUEST_URI'].'&id='.$item['id'];
                                            } ?>"><?php echo $item->test_datetime ?> </a></li></br>
                                    </ui>

                                <?php }
                            }}}
                    ?>


                </div>


                <div class="col-md-10 right-content">
                    <?php
                    if(isset($_REQUEST['id']))
                    { $id = $_REQUEST['id'];
                        $myFile = "http://4me302-16.site88.net/data".$id.".csv";
                        $fileArr = @file($myFile);
                        $newdata =  explode("\r",$fileArr[0]);

                        $comma='';

///$chart_arr = array();

                        if(count($newdata)>0)
                        {
                            $chart_data = '[';
                            foreach($newdata as $k=>$v)
                            {
                                if($k)
                                {
                                    $linedata =  explode(",",$v);
                                    $chart_data .= $comma.'['.$linedata[0].','.$linedata[1].']';
                                    $comma = ',';
                                }
                                if($k>=10)
                                {
                                    ///break;
                                }
                            }
                            $chart_data .= ']';


                        }
///echo "<pre>"; print_r($chart_data);
                    }
                    else
                    {
                        $id = 1;
                    }?>

                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                    <script type="text/javascript">
                        $(function () {
                            $('#container').highcharts({
                                chart: {
                                    type: 'spline',
                                    inverted: true
                                },
                                title: {
                                    text: 'Patient exercise data'
                                },
                                subtitle: {
                                    text: 'Chart of CSV data'
                                },
                                xAxis: {
                                    reversed: false,
                                    title: {
                                        enabled: true,
                                        text: 'Y-axis'
                                    },
                                    labels: {

                                    },
                                    maxPadding: 0.05,
                                    showLastLabel: true
                                },
                                yAxis: {
                                    title: {
                                        text: 'X-axis'
                                    },
                                    labels: {

                                    },
                                    lineWidth: 2
                                },
                                legend: {
                                    enabled: false
                                },
                                tooltip: {
                                    headerFormat: '<b>{series.name}</b><br/>',
                                    pointFormat: '{point.x} km: {point.y}°C'
                                },
                                plotOptions: {
                                    spline: {
                                        marker: {
                                            enable: false
                                        }
                                    }
                                },
                                series: [{
                                    name: 'Temperature',
                                    data: <?php echo $chart_data;?>
                                    /*data: [[108,125], [108, 121], [107, 116], [103, 113], [99, 113],
                                     [95, 116], [92, 120], [89, 124], [87, 130]]*/
                                }]
                            });
                        });


                    </script>
                    <script src="js/highcharts.js"></script>
                    <script src="js/modules/exporting.js"></script>
                    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


                </div>
            </div>
        </div>



        </body>
        </html>



<?php
        
       // echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
       // echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
        //echo "<img src='".$user_profile->photoURL."'/><br>";
       // echo "<b>Email</b> :".$user_profile->email."<br>";
       // echo "<br> <a href='logout.php'>Logout</a>";

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
                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                         break;
                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                         $authProvider->logout();
                         break;
                case 7 : echo "User not connected to the provider.";
                         $authProvider->logout();
                         break;
                case 8 : echo "Provider does not support this feature."; break;
        }
 
        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();
 
        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
 
    }
 
}
?>