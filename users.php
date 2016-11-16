<html>
<head>
<link rel="stylesheet" href="CSS/main.css" type="text/css">

<?php

$url = 'http://4me302-16.site88.net/getData.php?table=User';

$url_role = 'http://4me302-16.site88.net/getData.php?table=Role';

$role = simplexml_load_file($url_role);
$org = simplexml_load_file($url);

//foreach($role as $key => $item){

   //  echo $item->roleID;
//print_r($item);exit;

 //echo '123';exit;

foreach($org as $key => $item){
    if($item->Role_IDrole == '1')

{
    //echo $key . ":" . $item->username. $item->email."<br>";
 //  echo "<pre>";print_r($user123);

?>
          

            <ui>
             
             
             <li> <a href=""><?php echo $item->username  ?> </a></li>
             
            </ui>

            <?php   } 

}

            ?>


</body>
</html>