<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$base_url = 'https://api.themoviedb.org/3/';
$api_key = '0d3f6d259a8f22ef5f36a73864656b53';
$extras = 'include_adult=false&language=es-ES';

function checkFile( $file , $url ) {
  //echo $file;
  //echo '<br />';
  //echo $url;
 
  $filename = $file . '.json';

  if (file_exists($filename)) {
    // check
    //echo "The file $filename exists";
  } else {
      //echo "The file $filename does not exist";
      if (file_put_contents($filename, file_get_contents($url)))
        {
            //echo "File downloaded successfully";
        }
        else
        {
            //echo "File downloading failed.";
        }
      }
    $data = file_get_contents($filename);
    echo $data;
}

// https://api.themoviedb.org/3/discover/tv?include_adult=false&language=es-ES&page=1&sort_by=popularity.desc&api_key=0d3f6d259a8f22ef5f36a73864656b53

if(isset($_GET['query'])) {

    switch ($_GET['query']) {
        case 'movies_popular':
          $url = $base_url . 'discover/movie?api_key=' . $api_key . '&page=1&sort_by=popularity.desc&' . $extras;
          checkFile( $_GET['query'] ,  $url );
          break;
        case 'tvshows_popular':
          $url = $base_url . 'discover/tv?api_key=' . $api_key . '&page=1&sort_by=popularity.desc&' . $extras;
          checkFile( $_GET['query'] ,  $url );
          break;
        case 'movie':
          //code block
          break;
        case 'tvshows':
            //code block
            break;
        default:
            echo '<b>Query not defined!! Try:</b><br/>';
            echo '- query=movies_popular:<br/>';
            echo '- query=tvshows_popular:<br/>';
            echo '- query=movie&id=XXX:<br/>';
      }
} else {
    echo '<b>Query not defined!! Try:</b><br/>';
    echo '- query=movies_popular:<br/>';
    echo '- query=tvshows_popular:<br/>';
    echo '- query=movie&id=XXX:<br/>';
}