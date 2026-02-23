

<?php
include "chech_auth.php";
if($_SESSION['user_type']!="admin")
{
	die(" لا تملك صلاحيات ");
}
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
	
	
	
	if(fullname==0||fullname==''||fullname===undefined)
	{
		alert('يجب تحديد اسم المدير');
		return;
	}
	
	if(fullname_words.length<4)
	{
		alert('يجب ادخال اسم المدير الرباعي');
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
		url:"admin_save.php",
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
			
			
			$sql="SELECT * FROM admin WHERE id='$row_id'";
			
			//echo $sql;
	    $query = mysqli_query($connect, $sql);
	    $row = mysqli_fetch_array($query);

	    $fullname = htmlspecialchars($row['fullname']);

	    $loginname = $row['loginname'];
	    
     
	  } else {
		    die("dont try to play ");
		}
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_data') 
{
	$action_function="update_data";
}



?>




<div align="middle">
<div class="title" style="width:100%;">بيانات المدير</div>


<table dir="rtl" width="100%" class="tablein" style="border:1px dashed #999;">
   
                
                <tr>
                    <td  >اسم المدير</td>
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




