<?php


if (!isset($_GET["steamid"]))
{
  echo "<H1>Hey!</H1><br> <h3>You seem to be missing the steam id in the url! To fix this, you need to set the sv_loadingurl in you server.cfg to have ?steamid=%s at the end! <br> Example: http://example.com/index.php?steamid=%s</h3><br><br><h4><a href='https://wiki.garrysmod.com/page/Loading_URL'>Click here for more information</a></h4>";
}
else
{
  $id = $_GET["steamid"];
  $map = $_GET["mapname"];
  
  $xml = simplexml_load_string(file_get_contents('http://steamcommunity.com/profiles/'.$id.'?xml=1'));
  $avatar = (string) $xml->avatarFull;
  $name = $xml->steamID;

  $xml = simplexml_load_file("./settings.xml");
  $theme = $xml->theme;
  $misc = $xml->misc;
  $serverBox = $xml->serverBox;
  $ruleBox = $xml->ruleBox;
  $playerBox = $xml->playerBox;

  $themeColor = $theme->color;
  $background = $theme->background;
  $progressColor = $theme->progressColor;

  $serverBoxFont = $serverBox->tableFont;
  $serverBoxTitleFont = $serverBox->titleFont;

  $ruleBoxFont = $ruleBox->tableFont;
  $ruleBoxTitleFont = $ruleBox->titleFont;
//Gets the youtube stuff
  if ($misc->yTEnabled == "checked"){
    $youtubeVideo = "<iframe style='display:none;' src='http://www.youtube.com/embed/".$misc->yTID."?autoplay=1'></iframe>";
  }
  else
  {
    $youtubeVideo = "";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Server Name [SN]</title>
  <?php echo $youtubeVideo;?>
  <script type="text/javascript" src="./Scripts/jquery.min.js"></script>
  <script type="text/javascript" src="./Scripts/main.js"></script>
  <script type="text/javascript" src="./Scripts/jquery.cycle2.min.js"></script>
  <style type="text/css">:root {--theme-color: <?php echo $themeColor;?>;}</style>
  <link rel="stylesheet" type="text/css" href="./Styles/style.css">
  <style type="text/css">
    <?php
    if($serverBox->disable=="checked"){echo "#serverStatus {display: none !important;}";}
    if($ruleBox->disable=="checked"){echo "#rules {display: none !important;}";}
    if($playerBox->disable=="checked"){echo "#playerStatus {display: none !important;}";}
    ?>

    #playerStatus > #avatar,.infoTable > .infoTitle{background: <?php echo $themeColor?>;}
    .infoTable, #playerStatus {box-shadow:<?php echo $theme->boxShadow;?>;}
    #serverStatus{font-size:<?php echo $serverBoxFont?>;}
    #serverStatus > .infoTitle{font-size:<?php echo $serverBoxTitleFont?>;}
    #rules{font-size:<?php echo $ruleBoxFont?>;}
    #rules > .infoTitle{font-size:<?php echo $ruleBoxTitleFont?>;}
    #playerStatus > #userInfo{line-height:<?php echo (intval($playerBox->avatarSize)+14)."px";?>;height:<?php echo (intval($playerBox->avatarSize)+14)."px";?>;}
    #playerStatus > #userInfo > #name{font-size:<?php echo $playerBox->fontSize;?>;}
    #playerStatus > #avatar > div > img{width:<?php echo $playerBox->avatarSize;?>;height:<?php echo $playerBox->avatarSize;?>;}
    #playerStatus > #avatar > div {border-radius: 100%;height: <?php echo (intval($playerBox->avatarSize)+4)."px";?>;width: <?php echo (intval($playerBox->avatarSize)+4)."px";?>;background-color: white;}
    #progress > span {background: <?php echo $progressColor;?> }
    #logo {max-height: <?php echo $theme->logoH; ?>}
  </style>
</head>
<body>

<div class="cycle-slideshow"
    data-cycle-speed="1000">
  <?php
  $images = scandir($background);
  foreach ($images as $value) {
    $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
    $allowedExt = array("png","jpg","jpeg","gif","bmp","svg");
    if (in_array($ext, $allowedExt))
    {
      echo "  <img src='./Backgrounds/Polygon Backgrounds 1/$value'>\n";
    }
  }
  ?>
</div>
<div id="content">
  <img id="logo" src="<?php echo $misc->logoImage; ?>">
  <div style="display:table;margin:auto;">

    <div id="col_1">

      <div id="playerStatus">
        <div id="avatar">
          <div>
            <img src="<?php echo $avatar;?>">
          </div>
        </div>
        <div id="userInfo">
          <div id="name"><i>Player</i> : <?php echo $name;?></div>
        </div>
      </div>
      <br>
      <!-- Server Stats -->
      <div id="serverStatus" class="infoTable">
        <div class="infoTitle">SERVER</div>
        <div class="table">
          <div id="serverName">Server Name [SN]</div>
          <div id="mapName">gm_map_name</div>
          <div id="gameType">Game Type</div>
        </div>
      </div>
    </div>
    <div id="col_2">
      <div id="rules" class="infoTable">
        <div class="infoTitle">RULES</div>
        <div class="table">
          <div>1. Follow the rules.</div>
          <div>2. No prop killing.</div>
          <div>3. No prop pushing.</div>
          <div>4. No prop surfing.</div>
          <div>5. Do not hack or exploit.</div>
          <div>6. Do not micspam.</div>
          <div>7. Do not hack or exploit.</div>
        </div>
      </div>
    </div>
  </div>
  <div id="downloadStatus">Loading...</div>
  <div id="progress" class="metre">
    <span style="width:1%;"></span>
  </div>
</div>
</body>
</html>
<audio id="audio" autobuffer="autobuffer" autoplay style="display:none;">
  <?php
  if ($misc->yTEnabled == "")//So long as youtube is not enabled, run the ogg music
  {
    $music = scandir("./Music/");
    $validMusic = array();
    foreach ($music as $song) {
      $songExt = strtolower(pathinfo($song, PATHINFO_EXTENSION));
      if (in_array($songExt, array("ogg","mp3")))
      {
        $validMusic[] = $song;
      }
    }
    echo "<source  src='./Music/".$validMusic[rand(0, count($validMusic) - 1)]."' type='audio/ogg'>";
  }
  ?>
</audio>
<?php
}
?>