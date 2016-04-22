<?php
  $id = $_GET["steamid"];
  $map = $_GET["mapname"];
            
  $xml = simplexml_load_string(file_get_contents('http://steamcommunity.com/profiles/'.$id.'?xml=1'));
  $avatar = (string) $xml->avatarFull;
  $name = $xml->steamID;

  $tempThemeColor = "#54D4FF";
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="./style2.css">
  <style type="text/css">
  *
  {
  }
  </style>
  <script type="text/javascript">
  var joinStatus;
  var neededFiles;
  var fileDownloading;
  var filesRemaining;

  var serverName;
  var serverUrl;
  var mapName;
  var maxPlayers;
  var gameMode;

  function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
    serverName = servername;
    serverUrl = serverurl;
    mapName = mapname;
    maxPlayers = maxplayers;
    gameMode = gamemode
  }
  function SetFilesTotal( total ) {
    neededFiles = total;
  }
  function DownloadingFile( fileName ) {
    fileDownloading = fileName;
  }
  function SetFilesNeeded( needed ) {
    filesRemaining = needed;
  }
  function SetStatusChanged( status ) {
    joinStatus = status;
  }
  </script>
</head>
<body>
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
  <div>
    <div>SERVER</div>
    <div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
</body>
</html>