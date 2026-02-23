<?php
session_start();
$current_date=date('Y-m-d');


include "chech_auth.php";


?>


<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <link rel="stylesheet" type="text/css" href="../assets/css/font-style.css">
        <link href="../assets/css/fontAwesome.css" rel="stylesheet">
    
        <script src="../assets/js/jquery-2.2.4.min.js"></script>

    </head>
    <body style="background:url('../assets/images/bg.png') !important ;background-size: cover !important;">
      <div align="middle" style="width:100%;">

      <div align="middle" style="width:60%;min-width:300px;float:center;padding:1px;">
      <?php include "link.php";?>

      <div align="middle" style="width:100%;padding-top:44px;">
        <div align="right" style="min-width:400px;float:center;background:#fdfdfd;min-height:300px;border:1px solid #C70D80;padding:11px;">

<script>
function get_all_reservation_time(element) {
    var selected_date = element.value;

    var pass_data = new FormData();
    pass_data.append('wash_date', selected_date);

    $.ajax({
        type: "POST",
        url: "get_bookings_by_date.php", // الملف الجديد
        data: pass_data,
        contentType: false,
        processData: false,
        success: function(response) {
            response = JSON.parse(response.trim());

            if (response.status == "ok" || response.status == "empty") {
                $("#all_res_time").html(response.html);
            } else {
                $("#all_res_time").html("<div>حدث خطأ، حاول مجددًا</div>");
            }
        }
    });
}
</script>


<script>



function send_booking(element,action)
{
	var wash_date=$("[name='wash_date']").val();
	var wash_time=$("[name='wash_time']").val();




	var pass_data = new FormData();
	pass_data.append('action',action);
	pass_data.append('wash_date',wash_date);
	pass_data.append('wash_time',wash_time);



	$.ajax({
		type:"POST",
		url:"booking_save.php",
		data:pass_data,
		contentType: false, 
    	processData: false, 
		success: function(response) {
		  //alert(response);
			response=JSON.parse(response.trim());

      

			if(response.status=="ok")
			{
				$("#response-note").css({color:"green",});
				$("#response-note").html(response.note);	
        $(element).prop("disabled", true); // لتعطيل العنصر
        $("[name='wash_date']").prop("disabled", true); // لتعطيل العنصر
        $("[name='wash_time']").prop("disabled", true); // لتعطيل العنصر
			}
			else if(response.status=="error")
			{
				//alert(response.note);
				$("#response-note").css({color:"red",});
				$("#response-note").html(response.note);	
			}
			
	 	}
	});
		
					


}

</script>



<div style="float:right;width:50%">
      <div align="middle" style="width:100%">
        <div style="float:center !important;width:70%">
         <span style="color:#C70D80;font-weight:bold;">التاريخ</span>
         <br>
        <input dir="ltr" onchange="get_all_reservation_time(this);" type="date" name="wash_date" style="height:37px;width:220px;padding:3px;border-radius:4px;border:1px solid #C70D80;" required/>
        </div>
      </div>
      <br>
      <div align="middle" style="width:100%">
        <div style="float:center !important;width:90%">
        <span style="color:#C70D80;font-weight:bold;">الوقت</span>
       <br>
        <input dir="ltr" type="time" maxlength=10 name="wash_time" style="height:37px;width:220px;padding:3px;border-radius:4px;border:1px solid #C70D80;" required/>
        </div>
      </div>
      <br>
      <br>
      <div align="middle" style="width:100%">
        <div style="float:center !important;width:90%">
          <input type="submit" onclick="send_booking(this,'save_booking');" name="add_btn_submit" style="font-size:1em;color:#fff;border:none;padding:4px;height:37px;width:220px;background:#C70D80;border-radius:5px;" value="ارسال حجز موعد"/>
          <br><br>
          <div id="response-note" style="font-size:1.1em;color:gray;font-weight:bold;text-align:center;color:#393;text-shadow:1px 0px 3px #fff;">
          
          </div>
          <br>
          <div id="show-map" style="font-size:1.1em;color:gray;font-weight:bold;text-align:center;color:#393;text-shadow:1px 0px 3px #fff;">

          </div>

          <br><br>
        </div>
      </div>
</div>


<div style="float:left;width:50%;" >
  <div id="all_res_time" style="background:#fff;">

  </div>
</div>


      </div>

</div>


<br><br>
  </div>
</div>





<style>
input{
  border:none;
 
}
input:focus{
  border:1px solid #C70D80 !important;
 
}
</style>

