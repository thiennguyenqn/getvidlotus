<?php 
include 'simple_html_dom.php';
$link = isset($_GET['link']) ? htmlspecialchars($_GET['link']) : 'https://lotus.vn/w/video/724976317629702144.htm';

$html = file_get_html($link);
$noidung = $html->find('.videoplayerDetail',0);

$regex = '/https?\:\/\/[^\" \n]+/i';
  preg_match_all($regex, $noidung, $matches);
  foreach ($matches[0] as $url) {
    $s1 = substr($url, 0, strlen($url));
    $array[] = $url;
}

$thumb = $array[0];
$vid = $array[1];

function get_between($input, $start, $end)
{
  $substr = substr($input, strlen($start)+strpos($input, $start), (strlen($input) - strpos($input, $end))*(-1));
  return $substr;
}
$title = get_between($noidung, 'data-title=', 'data-file="');

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get lotus.vn</title>
  <meta name="description" content="Get lotus.vn">
  <meta content='<?php echo $thumb;?>' property='og:image'/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" scrossorigin="anonymous">
    <script src="https://cdn.jwplayer.com/libraries/Zvs1kisj.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body style="padding-top: 50px">
    <main role="main" class="container">
      <center>
      <div id="player"></div>
      <script>
      jwplayer("player").setup({
          "image": "<?php echo $thumb;?>",
          "file": "<?php echo $vid;?>",
          "title": "",
          "height": 360,
          "width": 640,
          "autostart": false
      });
      </script>
  </center>
  <br/>
    <p><strong>Title:</strong> <?php echo $title;?></p>
      <p><strong>Thumbnail:</strong> <?php echo $thumb = preg_replace("~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~","<a href=\"\\0\">\\0</a>",$thumb);?> </p>
      <p><strong>Link stream:</strong> <?php echo $vid = preg_replace("~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~","<a href=\"\\0\">\\0</a>",$vid);?> </p>
  </main>
  <script src="https://cdn.jwplayer.com/libraries/lqsWlr4Z.js"></script>
</body>
