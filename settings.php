<?php
if (isset($_COOKIE["logged"]) && $_COOKIE["logged"]="1")
{
$xml = simplexml_load_file("./settings.xml");
$theme = $xml->theme;
$serverBox = $xml->serverBox;
$ruleBox = $xml->ruleBox;
$playerInfo = $xml->playerBox;
$misc = $xml->misc;
if (isset($_POST['submit'])){

  if ($_POST['themeColor'] != "")
  {$xml->theme->color = $_POST['themeColor'];}

  if ($_POST['background'] != "")
  {$xml->theme->background = $_POST['background'];}

  if ($_POST['progressColor'] != "")
  {$xml->theme->progressColor = $_POST['progressColor'];}

  if ($_POST['boxShadow'] != "")
  {$xml->theme->boxShadow = $_POST['boxShadow'];}

  if ($_POST['logoH'] != "")
  {$xml->theme->logoH = $_POST['logoH'];}


  if ($_POST['serverBoxTitleFont'] != "")
  {$xml->serverBox->titleFont  = $_POST['serverBoxTitleFont'];}

  if ($_POST['serverBoxTableFont'] != "")
  {$xml->serverBox->tableFont = $_POST['serverBoxTableFont'];}

  if (isset($_POST['serverBoxDisabled']))
  {$xml->serverBox->disable = "checked";}else{$xml->serverBox->disable = "t";}


  if ($_POST['ruleBoxTitleFont'] != "")
  {$xml->ruleBox->titleFont  = $_POST['ruleBoxTitleFont'];}

  if ($_POST['ruleBoxTableFont'] != "")
  {$xml->ruleBox->tableFont = $_POST['ruleBoxTableFont'];}

  if (isset($_POST['ruleBoxDisabled']))
  {$xml->ruleBox->disable = "checked";}else{$xml->ruleBox->disable = "";}


  if ($_POST['playerInfoAvatarSize'] != "")
  {$xml->playerBox->avatarSize  = $_POST['playerInfoAvatarSize'];}

  if ($_POST['playerInfoFontSize'] != "")
  {$xml->playerBox->fontSize = $_POST['playerInfoFontSize'];}

  if (isset($_POST['playerInfoDisabled']))
  {$xml->playerBox->disable = "checked";}else{$xml->playerBox->disable = "";}


  if ($_POST['yTube'] != "")
  {
    $parts = parse_url($_POST['yTube']);
    parse_str($parts['query'], $query);
    $xml->misc->yTube = $_POST['yTube'];
    $xml->misc->yTID = $query['v'];
  }

  if (isset($_POST['yTEnabled']))
  {$xml->misc->yTEnabled = "checked";}else{$xml->misc->yTEnabled = "";}

  if (isset($_POST['logoImage']))
  {$xml->misc->logoImage = $_POST['logoImage'];}

  if (isset($_POST['customCSS']))
  {$xml->misc->customCSS = $_POST['customCSS'];}


  $output = $xml->asXML('./settings.xml');
}
?>
<html>
<head>
  <title>Settings</title>
  <link rel="stylesheet" type="text/css" href="./Styles/settings.css">
  <style type="text/css">
  .settings > .head {
    background: <?php echo $theme->color;?>;
  }
  body
  {
    background: url(./Backgrounds/default.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }
</style>
</head>
<body>
<div class="settings">
  <div class="head">Settings:</div><br>
  <div class="content">
    <div style="padding-left:10px;">
      <form method="post">
        <t style="font-size:20px">Server Box</t><br/>
        <div style="margin-left:20px;margin-top:10px;">
          Title Font
          <br/>
          <input name="serverBoxTitleFont" placeholder="<?php echo $serverBox->titleFont;?>" type="text">
          <br>
          Table Font
          <br/>
          <input name="serverBoxTableFont" placeholder="<?php echo $serverBox->tableFont;?>" type="text">
          <br>
          Disabled<input name="serverBoxDisabled" type="checkbox" <?php echo $serverBox->disable;?>><br/>
          <input style="margin-top:10px;" name="submit" type="submit">
        </div>

        <t style="font-size:20px">Rules Box</t><br/>
        <div style="margin-left:20px;margin-top:10px;">
          Title Font
          <br/>
          <input name="ruleBoxTitleFont" placeholder="<?php echo $ruleBox->titleFont;?>" type="text">
          <br>
          Table Font
          <br/>
          <input name="ruleBoxTableFont" placeholder="<?php echo $ruleBox->tableFont;?>" type="text">
          <br>
          Disabled<input name="ruleBoxDisabled" type="checkbox" <?php echo $ruleBox->disable;?>><br/>
          <input style="margin-top:10px;" name="submit" type="submit">
        </div>

        <t style="font-size:20px">Player Info</t><br/>
        <div style="margin-left:20px;margin-top:10px;">
          Avatar Size
          <br/>
          <input name="playerInfoAvatarSize" placeholder="<?php echo $playerInfo->avatarSize;?>" type="text">
          <br>
          Font Size
          <br/>
          <input name="playerInfoFontSize" placeholder="<?php echo $playerInfo->fontSize;?>" type="text">
          <br>
          Disabled<input name="playerInfoDisabled" type="checkbox" <?php echo $playerInfo->disable;?>><br/>
          <input style="margin-top:10px;" name="submit" type="submit">
        </div>

        <t style="font-size:20px">Theme</t><br/>
        <div style="margin-left:20px;margin-top:10px;">
          Progress Bar Color<br>
          <input name="progressColor" placeholder="<?php echo $theme->progressColor;?>" type="text">
          <br>
          Primary Color<br>
          <input name="themeColor" placeholder="<?php echo $theme->color;?>" type="text" >
          <br>
          Background Folder<br>
          <input name="background" value="<?php echo $theme->background;?>" placeholder="./Backgrounds/" type="text">
          <br>
          Box Shadow<br>
          <input name="boxShadow" placeholder="[x] [y] [blur] [color]" value="<?php echo $theme->boxShadow;?>" type="text">
          <br>
          Logo Height<br>
          <input name="logoH" placeholder="<?php echo $theme->logoH;?>" type="text">
          <br>
          <input style="margin-top:10px;" name="submit" type="submit">
        </div>

        <t style="font-size:20px">Misc.</t><br/>
        <div style="margin-left:20px;margin-top:10px;">
          Youtube Music<br>
          <input name="yTube" placeholder="<?php echo $misc->yTube;?>" type="text">
          <input type="checkbox" name="yTEnabled" <?php echo $misc->yTEnabled;?>>
          <br>
          Logo Image<br>
          <input name="logoImage" value="<?php echo $misc->logoImage;?>" type="text">
          <br>
          Custom CSS<br>
          <textarea name="customCSS"><?php echo $misc->customCSS;?></textarea>
          <br>
          <input style="margin-top:10px;" name="submit" type="submit">
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<?php
}
else
{
  header('Location: http://'.$_SERVER['SERVER_NAME'].'/login.php');
}
?>