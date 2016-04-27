<?php
  session_start(); //Starts the session//
  //Making sure that if they're logged in, they don't have to re-login
    if(isset($_COOKIE['logged'])){
      if ($_COOKIE['logged'] == 1){
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php');
        echo 'eyyy';
      }
    }
  //-----------------------------------//

  //PASSWORD AND USERNAME. DO NOT SHARE
    $USERNAME = "<username here>";
    $PASSWORD = "<password here>";
  //-----------------------------------//

  //Prevent (for the most part) form injection
    $salt = 'sdfh87f9h67dj5f67456a3r67gsaih78j7sdfg78567876re7ts64786h478a6t78s6et';
    if (isset($_SESSION['time'])){
      $token2 = sha1($salt . $_SESSION['time']);
    }

    $time = time();
    $_SESSION['time'] = $time;
    $token = sha1($salt . $time);
      //Tests for data
        if (isset($_POST['submit'])){
          if($token2 != $_POST['token']){
            die('Session Timed Out');
          }
          else
          {
            if($USERNAME = $_POST['username'] && $PASSWORD = $_POST['password'])
            {
              setcookie("logged","1",mktime().time()+60*60*24,"/");
              header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php');
            }
          }
        }
      //-----------------------------------//
  //-----------------------------------//
?>
<html>
<head>
  <title>LOGIN</title>
  <link rel="stylesheet" type="text/css" href="./Styles/login.css">
</head>
<body>
  <div class="center login">
  <t style="font-size: 20px;">Login:</t>
  <form method="post">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <input type="text" placeholder="username" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];}?>"><br>
    <input type="password" placeholder="password" name="password"><br/>
    <input type="submit" name='submit'>
  </form>
  </div>
  </body>
</html>