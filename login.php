

<html>

<head>
	<title>تسجيل دخول</title>
	<link rel="icon" href="assets/icons/favicon.png" type="image/gif" sizes="16x16">
	
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="" />

  <link rel="stylesheet" type="text/css" href="assets/css/font-style.css">
  <link href="assets/css/fontAwesome.css" rel="stylesheet">

  <script src="assets/js/jquery-2.2.4.min.js"></script>


</head>

      <body style="background-image:url('assets/images/bg.png');background-size: cover;">
                    
        <script>

            function login(element)
            {

	            var loginname=$("[id=loginname]").val();
	            var password=$("[id=password]").val();
	            
	            //alert(4);
	            if(loginname!="" && password!="")
	            {

		            var pass_data={

			            'loginname':loginname,
			            'password':password
		            }


		            $.ajax({
			            type:"POST",
			            url:"open_session.php",
			            data:pass_data,
			            success: function(response) {
			            
				            //alert(response);
				            response=JSON.parse(response.trim());
				            
				            if(response.status=="ok")
				            {
				            
					            $("[name=loginname]").empty();//.remove();
					            $("[name=password]").empty();//.remove();
					            location="home/index.php";

					            
					            
				            }
				            else if(response.status=="error")
				            {
					            alert(response.note);			
				            }
				            
				            else
				            {
					            alert("ERROR 11111");	
				            
				            }
				            
				            
		             	}
		            });
	             
	            }

            }
            </script>

          <style>
          /* Style for the login page */

            .div_form {
                background: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width:300px;
                font-size:0.9em;
                text-align:right;
            }

            .legend {
                font-size: 1.1em;
                color: #C70E80;
                opacity: 1;
                text-align: center;
            }

            hr {
                border: 0.5px solid #ccc;
                margin-top: 10px;
            }

            input[type="text"],
            input[type="password"],
            select {
                width: calc(100% - 30px);
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            .input {
                position: relative;
            }

            .input span {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                left: 10px;
                color: #ccc;
            }

            .submit {
                background: #C70E80;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 3px;
                cursor: pointer;
                display: inline-block;
                transition: background 0.3s ease;
            }

            .submit:hover {
                background: #0d8bf0;
            }



          </style>





    <div align="middle" style="width:100%;margin-top:10%;" >

      <div align="middle" dir="rtl" class="div_form" style="position:relative;">
          <div style="background:#C70E80;color:#fff;border-radius:6px;padding:10px;text-align:center;width:200px;position:absolute;margin-top:-22px;left:50%;transform: translate(-50%, -50%);font-weight:bold;font-size:1.1em;">الدخول الى الحساب</div>
          <br>
          <div style="position:relative;top:50%;left:50%;transform: translate(-50%, -50%);text-align:center;">
              <h3 class="legend" style="opacity:1;color:gray;font-size:1em;" >اهلا وسهلا بكم</h3>
          </div>
          <hr>

          <div >
            <span >اسم المستخدم</span>
            <input type="text" placeholder="اسم المستخدم" id="loginname" required />
          </div>
          <div >
            <span >كلمة المرور</span>
            <input type="password" class="pass" placeholder="كلمة المرور" id="password" required />
          </div>
          <button id="login-btn" type="submit" onclick="login(this)" class="btn submit"><span class="fa fa-check" aria-hidden="true"></span><span style="margin-right:7px;">تسجيل دخول</span></button>
          
          
         
          
          
          <br></br>
          <a href='./index.php' style="text-align:center;" > عودة الى الصفحة الرئيسة </a>
          
        </div>

    </div>



</body>

</html>
