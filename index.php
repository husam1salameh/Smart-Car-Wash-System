<!DOCTYPE html>
<html lang="ar">
<?php
include "config.php";
if($_REQUEST["action"]=="logout")
{
  session_destroy();
  header("Location: index.php"); 
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>نظام حجز مغسلة السيارات</title>
  <link rel="icon" href="assets/icons/favicon.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="assets/css/font-style.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-image: url('assets/images/bg.png');
      background-size: cover;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
    }

    .content {
      flex: 1;
      padding: 20px;
      text-align: center;
      color: #fff;
    }

    .info-container {
      flex: 1;
      padding: 20px;
      
    }

    .info {
      margin-top: 50px;
    }

    .info img {
      width: 100%;
      max-width:555px;
      height: auto;

      box-shadow: 0px 0px 5px 1px #C70D8066;
      border-radius:11px;
      background:#fff;
      padding:66px 0;
    }

    #login-btn {
      width: 150px;
      box-shadow: 0px 0px 5px 1px #fff;
      background: #fdfdfd;
      color: #000;
    }

    .logo {
      width: 160px;
      border-radius: 22px;
      margin-bottom:66px;
      box-shadow: 0px 0px 5px 1px #C70D80;
    }
  </style>
</head>

<body>

  <div class="content">

    

    <img src="assets/images/qr.gif" class="logo" />
    <h1 style="color:#C70D80;padding:11px;background:#fffd;"> نظام حجز مغسلة السيارات</h1>

    <div align="middle" style="width:100%;margin-top:20%;" >
      <?php
      if(!empty($_SESSION["user_id"]))
      {
      ?>
      <div onclick="location.href='?action=logout'" style="color:#fff;background:#C70D80;font-weight:bold;border-radius:5px;padding:0 11px;font-size:1.8em;cursor:pointer;border:7px solid #fff;">
        تسجيل خروج
      </div>
      <?php
      }
      if(empty($_SESSION["user_id"]))
      {
      ?>
        <div onclick="location.href='login.php'" style="color:#fff;background:#C70D80;font-weight:bold;border-radius:5px;padding:0 11px;font-size:1.8em;cursor:pointer;border:7px solid #fff;">
        تسجيل دخول
      </div>
      <div onclick="location.href='signup.php'" style="margin-top:9px; color:#fff;background:#C70D80;font-weight:bold;border-radius:5px;padding:0 11px;font-size:1.8em;cursor:pointer;border:7px solid #fff;">
        انشاء حساب
      </div>
      <?php
      }
      ?>
    </div>

  </div>

  <!-- info Container -->
  <div class="info-container">
    <!-- info -->
    <div class="info">
      <img src="assets/images/info.webp" >
    </div>
  </div>



</body>

</html>

