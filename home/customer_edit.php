

<?php
include "chech_auth.php";

?>

<html>
    <head>
      <title></title>
      <link rel='stylesheet' type='text/css' href='../assets/css/cpanel_style.css'/>
      <link rel="stylesheet" type="text/css" href="../assets/css/font-style.css">
      <link href="../assets/css/fontAwesome.css" rel="stylesheet">
      <script src="../assets/js/jquery-2.2.4.min.js"></script>
   </head>
    <body style="background: url('../assets/images/bg.png') !important;background-size: cover !important;">
<div align="middle" style="width:100%;">

<div align="middle" style="width:60%;min-width:300px;float:center;padding:1px;">
<?php include "link.php";?>


        
<script>


function save_update(element,action)
{
	var fullname=$("[name='fullname']").val();

	var loginname=$("#loginname").val();

	var password=$("#password").val();
	var confirm_password=$("#confirm_password").val();
	
	let fullname_words = fullname.trim().split(' ');
	
var card_number = $("[name='card_number']").val().replace(/\s+/g, '');
  var card_name = $("[name='card_name']").val().trim();
  var card_expiry = $("[name='card_expiry']").val().trim();
  var card_cvv = $("[name='card_cvv']").val().trim();

  // تحقق من رقم البطاقة: 16 رقم فقط
  if (!/^\d{16}$/.test(card_number)) {
    alert("رقم البطاقة يجب أن يكون 16 رقمًا بدون فواصل أو مسافات.");
    return false;
  }

  // تحقق من الاسم على البطاقة
  if (card_name.length < 3) {
    alert("يرجى إدخال اسم صالح على البطاقة.");
    return false;
  }

  // تحقق من تاريخ الانتهاء بصيغة MM/YY
  if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(card_expiry)) {
    alert("يرجى إدخال تاريخ الانتهاء بصيغة صحيحة مثل 12/25");
    return false;
  }

  // تحقق من CVV (3 أو 4 أرقام)
  if (!/^\d{3,4}$/.test(card_cvv)) {
    alert("رمز CVV يجب أن يكون 3 أو 4 أرقام.");
    return false;
  }
  
  
	
	if(fullname==0||fullname==''||fullname===undefined)
	{
		alert('يجب تحديد اسم الزبون');
		return;
	}
	
	if(fullname_words.length<4)
	{
		alert('يجب ادخال اسم الزبون الرباعي');
		return;
	}
	
	if(loginname==0||loginname==''||loginname===undefined)
	{
		alert('يجب تحديد اسم مستخدم');
		return;
	}


	//var pass_data={};
	var pass_data = new FormData();
	pass_data.append('action',action);
	pass_data.append('fullname',fullname);
	pass_data.append('loginname',loginname);
	pass_data.append('password',password);
	pass_data.append('confirm_password',confirm_password);

  pass_data.append('card_number', card_number);
  pass_data.append('card_name', card_name);
  pass_data.append('card_expiry', card_expiry);
  pass_data.append('card_cvv', card_cvv);
	
	//alert(3);
	if(action=='update_data')
	{
		var row_id=$("#row_id").val();
		if(row_id==0||row_id==''||row_id===undefined)
		{
			alert('رقم السجل غير معروف ');
			return;
		}

		pass_data.append('row_id',row_id);
	}


	$.ajax({
		type:"POST",
		url:"customer_save.php",
		data:pass_data,
		contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    	processData: false, // NEEDED, DON'T OMIT THIS
		success: function(response) {

			//alert(3);
			response=JSON.parse(response.trim());
		
			if(response.status=="ok")
			{
				$("#response-note").css({color:"black",});
				$("#response-note").text(response.note);	
				setTimeout(function(){ 
					if(action=='insert_data')window.history.back();
					else location.reload(); 
				}, 2000);
			}
			else if(response.status=="error")
			{
				//alert(response.note);
				$("#response-note").css({color:"red",});
				$("#response-note").text(response.note);	
			}
			
	 	}
	});
		
					


}

</script>






<?php


$row_id='';
$fullname = '';




$action_function="insert_data";

if ($_REQUEST['action'] == 'update_data' || $_GET['myaccount']==1) {

	
     if (isset($_SERVER['HTTP_REFERER'])) 
     {
     
      if($_GET['myaccount']==1)
        $row_id = intval($_SESSION['user_id']);
      else
			  $row_id = intval($_REQUEST['row_id']);
			  
			$sql="SELECT * FROM customer WHERE id='$row_id'";
			
			//echo $sql;
	    $query = mysqli_query($connect, $sql);
	    $row = mysqli_fetch_array($query);

	    $fullname = htmlspecialchars($row['fullname']);

	    $loginname = $row['loginname'];
	    
     
	  } else {
		    die(" error");
		}
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_data') 
{
	$action_function="update_data";
}



?>




<div align="middle">
<div class="title" style="width:100%;">بيانات الزبون</div>


<table dir="rtl" width="100%" class="tablein" style="border:1px dashed #999;">
   
   
   
                                     
<?php
    if($_SESSION['user_type']=="customer")
    {
    ?>
    
<tr>

<td>
</td>
<td >

<style>

.credit-card-box {
    background: linear-gradient(135deg, #1e272e, #485460);
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    color: white;
    transition: 0.3s;
    width:330px;
    padding:20px;
    float:center;
    
}

.credit-card-box:hover {
    transform: scale(1.02);
}

.card-front label {
    color: #dcdde1;
    font-weight: 500;
    margin-bottom: 5px;
    display: block;
}

.card-input {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    border-radius: 10px;
}

.card-input::placeholder {
    color: #ced6e0;
}

.card-input:focus {
    border-color: #70a1ff;
    background-color: rgba(255, 255, 255, 0.2);
    box-shadow: none;
    color: white;
}
</style>


<br><br>


    <div class="credit-card-box p-4 mb-4">
        <div class="card-front">
            <div class="card-number-box">
                <label>رقم البطاقة</label>
                <input name="card_number"  value="<?php echo $row['card_number'];?>" type="text" class="form-control card-input" placeholder="1234 5678 9012 3456" maxlength="19">
            </div>
            <div class="card-holder-box mt-3">
                <label>الاسم على البطاقة</label>
                <input name="card_name" value="<?php echo $row['card_name'];?>" type="text" class="form-control card-input" placeholder="الاسم الكامل">
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label>تاريخ الانتهاء</label>
                    <input name="card_expiry" value="<?php echo $row['card_expiry'];?>" type="text" class="form-control card-input" placeholder="MM/YY" maxlength="5">
                </div>
                <div class="col-md-6">
                    <label>CVV</label>
                    <input name="card_cvv" type="password" class="form-control card-input" placeholder="123" maxlength="4">
                </div>
            </div>
        </div>
    </div>

<br><br>

                
                </td>
                
                </tr>
<?php
}
?>



                
                <tr>
                    <td  >اسم الزبون</td>
                    <td  ><input type="text" name="fullname"  required="required" value='<?php echo $fullname; ?>' /></td>
                </tr>
                

                <tr>
                  <td  style="color:black;">اسم المستخدم</td><td><input dir="ltr" type="text" style="text-align:center;font-size:1.0em;font-weight:bold;color:black;" class="cp_input" value="<?php echo $loginname ?>" id="loginname" autocomplete="off" placeholder="اسم المستخدم"/></td>
                </tr> 
                <tr>
                  <td  style="color:black;">كلمة المرور</td><td><input dir="ltr" type="password" style="text-align:center;font-size:1.0em;font-weight:bold;color:black;" class="cp_input" value="" id="password" autocomplete="new-password" placeholder="كلمة المرور"/></td>
                </tr> 

                <tr>
                  <td  style="color:black;">تاكيد كلمة المرور</td><td><input dir="ltr" type="password" style="text-align:center;font-size:1.0em;font-weight:bold;color:black;" class="cp_input" value="" id="confirm_password" autocomplete="new-password" placeholder="تاكيد كلمة المرور"/></td>
                </tr> 

                <tr class="control_showing" >
                		<?php 
		                if($action_function=="update_data")
		                {
		                ?>
		                	<input type='hidden' id='row_id' value='<?php echo $row_id;?>' />
		                	<td colspan=2>
		                	
		                		<button class="btn btn-success" type='submit' onclick="save_update(this,'update_data');" >حفظ البيانات</button>
		                	</td>
		                <?php
		                }
		                else if($action_function=="insert_data")
		                {
		                ?>
		                	<td colspan=2>
		                		<button class="btn btn-success" type='submit' onclick="save_update(this,'insert_data');" >ادخال البيانات</button>
		                	</td>
		                <?php
		                }
		                ?>
                </tr>
                 <tr><td colspan=2 align="middle"><div id="response-note"></div></td></tr>
     
</table>




