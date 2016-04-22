<?php
//Loading Screen By Shane Robertson [steamcommunity.com/id/shane_is_tired]
  $backgroundImg = "http://i40.tinypic.com/2ho9szs.gif";
  $themeColor = "#DA5C5C";//colorpicker.com
  $id = $_GET["steamid"];
  $map = $_GET["mapname"];
            
  $xml = simplexml_load_string(file_get_contents('http://steamcommunity.com/profiles/'.$id.'?xml=1'));
  $avatar = (string) $xml->avatarFull;
  $name = $xml->steamID;
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./style.css">

  <style type="text/css">
    body
    {
      background: url(<?php echo $backgroundImg?>);
    }
    .container > .title
    {
      background-color: <?php echo $themeColor;?>;
    }
  </style>

  <script type="text/javascript">
    function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
      document.getElementById("playerLimit").innerHTML += maxplayers
      document.getElementById("serverName").innerHTML += servername
    }
  </script>

</head>
<body>
<div class="hcenter" style="font-size:100px;color:#FFF;text-shadow: 0px -1px 5px rgba(0,0,0,0.75);margin:10px">ServerName</div>
<div class="center content">
  <div class="center">
    <img class="avatar" src="<?php echo $avatar;?>" />
    <div class="userinfo inline vcenter"><?php echo $name;?></div>
  </div>
  <br>
  <div>
    <div class="container">
      <div class="title">Rules</div>
      <div class="contcontent">
        <div class="row">1. No thingies <br/></div>
        <div class="row">2. No OTHER thingies <br/></div>
        <div class="row">3. Propity Blockity Shiz<br/></div>
      </div>
    </div>
    <div class="container">
      <div class="title">Info</div>
      <div class="contcontent">
        <div class="row" id="serverName">NAME: </div>
        <div class="row" id="playerLimit">PLAYER_LIMIT: </div>
        <div class="row">MAP: <?php echo $map;?></div>
      </div>
    </div>
  </div>
</div>
</body>