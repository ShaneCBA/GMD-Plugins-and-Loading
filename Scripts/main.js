var joinStatus = "";
var neededFiles = 00;
var fileDownloading = "";
var filesRemaining = 00;

var serverName;
var serverUrl;
var mapName;
var maxPlayers;
var gameMode;

var barPercentage;
var downloadStatus;

function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
  serverName = servername;
  document.getElementById("serverName").innerHTML = serverName;
  serverUrl = serverurl;
  mapName = mapname;
  document.getElementById("mapName").innerHTML = mapname;
  maxPlayers = maxplayers;
  gameMode = gamemode
  document.getElementById("gameType").innerHTML = gamemode;
}
function SetFilesTotal( total ) {
  neededFiles = total;
}
function DownloadingFile( fileName ) {
  fileDownloading = fileName;
  document.getElementById('progress').children[0].style.innerHTML = fileDownloading;
}
function SetFilesNeeded( needed ) {
  filesRemaining = needed;
  barPercentage = ((neededFiles-filesRemaining)/neededFiles)*100
  console.log(barPercentage);
  document.getElementById('progress').children[0].style.width = barPercentage.toString()+"%"
}
function SetStatusChanged( status ) {
  joinStatus = status;
  var downloadedFiles = neededFiles - filesRemaining;
  document.getElementById('downloadStatus').innerHTML = joinStatus;
}

$(window).bind('load', function(){
  var fromTop = (( $(document).height()-$("#content").height() )/2)+"px"
  $("#content").css("top",fromTop)
  console.log(fromTop)
})