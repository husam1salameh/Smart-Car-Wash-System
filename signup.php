<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>إنشاء حساب</title>
  <link rel="icon" href="assets/icons/favicon.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="assets/css/font-style.css">
  <link href="assets/css/fontAwesome.css" rel="stylesheet">
  <script src="assets/js/jquery-2.2.4.min.js"></script>

  <style>
    body {
      background-image: url('assets/images/bg.png');
      background-size: cover;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 60px auto;
      background: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 25px;
      color: #333;
      font-weight: bold;
    }

    table {
      width: 100%;
    }

    td {
      padding: 10px 5px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .btn {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      background-color: #d55cb0;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #d55cb0bb;
    }

    #response-note {
      margin-top: 15px;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="title">بياناتك</div>

    <table class="tablein" style="border:1px dashed #999;">
      <tr>
        <td>الاسم الكامل</td>
        <td><input type="text" name="fullname" required="required" value='' /></td>
      </tr>
      <tr>
        <td>اسم المستخدم</td>
        <td><input dir="ltr" type="text" id="loginname" class="cp_input" style="text-align:center;" value="" autocomplete="off" placeholder="اسم المستخدم" /></td>
      </tr>
      <tr>
        <td>كلمة المرور</td>
        <td><input dir="ltr" type="password" id="password" class="cp_input" style="text-align:center;" placeholder="كلمة المرور" autocomplete="new-password" /></td>
      </tr>
      <tr>
        <td>تأكيد كلمة المرور</td>
        <td><input dir="ltr" type="password" id="confirm_password" class="cp_input" style="text-align:center;" placeholder="تأكيد كلمة المرور" autocomplete="new-password" /></td>
      </tr>
      <tr>
        <td colspan="2">
          <button class="btn" type="submit" onclick="save_update(this,'insert_data');">سجل الآن</button>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <div id="response-note"></div>
        </td>
      </tr>
    </table>
  </div>

  <script>
    function save_update(element, action) {
      var fullname = $("[name='fullname']").val();
      var loginname = $("#loginname").val();
      var password = $("#password").val();
      var confirm_password = $("#confirm_password").val();

      let fullname_words = fullname.trim().split(' ');

      if (fullname == 0 || fullname == '' || fullname === undefined) {
        alert('يجب تحديد اسم الزبون');
        return;
      }

      if (fullname_words.length < 4) {
        alert('يجب ادخال اسم الزبون الرباعي');
        return;
      }

      if (loginname == 0 || loginname == '' || loginname === undefined) {
        alert('يجب تحديد اسم مستخدم');
        return;
      }

      var pass_data = new FormData();
      pass_data.append('action', action);
      pass_data.append('fullname', fullname);
      pass_data.append('loginname', loginname);
      pass_data.append('password', password);
      pass_data.append('confirm_password', confirm_password);

      $.ajax({
        type: "POST",
        url: "signup_save.php",
        data: pass_data,
        contentType: false,
        processData: false,
        success: function (response) {
          response = JSON.parse(response.trim());

          if (response.status == "ok") {
            $("#response-note").css({ color: "black" }).text(response.note);
            setTimeout(function () {
              if (action == 'insert_data') window.history.back();
              else location.reload();
            }, 2000);
          } else if (response.status == "error") {
            $("#response-note").css({ color: "red" }).text(response.note);
          }
        }
      });
    }
  </script>

</body>

</html>

