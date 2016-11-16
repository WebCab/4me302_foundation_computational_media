<?php

$htmlBody = <<<END
<link href="//www.w3resource.com/includes/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" href="src/css/html.css" type="text/css" />
<style type="text/css">
</style>
<form method="GET">
<div ><h3>Search for Parkinsons diseases latest Video </h3> </div>
  <div id="page-right-youtube-wrapper">
    <input type="search" id="q" name="q" value="Parkinsons" size="100" >
  </div>
  <div id="page-right-youtube-max-wrapper">
    <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="10">
    <input type="submit" value="Youtube Video">
  </div>
  
</form>
END;

// user query in the form executed here

if (isset($_GET['q']) && $_GET['maxResults']) {
  
require_once 'src/Google/Client.php';
require_once 'src/Google/Service/YouTube.php';

  /*
   * Set $DEVELOPER_KEY 
   */
 // $DEVELOPER_KEY = 'AIzaSyAL-qFNxX1ygdhC8ux2ThNXyZ2HObzipPU';
  $DEVELOPER_KEY = 'AIzaSyCxEmsjqMb2Ty6B_OtugeMidkGfmHBP5-0';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  //  all API requests by naking object.
  $youtube = new Google_Service_YouTube($client);

  try {
    //  retrieve results matching the specified by Calling the search.list method
    // max result term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Making list of videos and making link
    
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
        
        //  $videos .= sprintf('<li>%s (%s)</li>',
          //    $searchResult['snippet']['title'], $searchResult['id']['videoId']);
              
              $videos .= sprintf('<li> %s</li>', "<a href=http://www.youtube.com/watch?v=".$searchResult['id']['videoId']." target=_blank>". $searchResult['snippet']['title'] ."</a>");
              
        //     echo $videos. '<li>'.$searchResult['id']['videoId'].'</li>';
                            
          break;
        
      }

    }


    $htmlBody .= <<<END
    <h3>Parkinsons Videos</h3>
    <ul>$videos</ul>
    
END;
  } catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
  </head>
  <body>
    <?=$htmlBody?>
  </body>
</html>