

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

   


<div class="title">حسابات الادارة</div>
<script>
function cancel_restore_row(element,action,row_id)
{

	var ok=confirm("هل تريد بالتاكيد حذف السجل؟");
	if(!ok)return;
	
	var pass_data={
		'action':action,
		'row_id':row_id,
	}

	$.ajax({
		type:"POST",
		url:"admin_save.php",
		data:pass_data,
		success: function(response) {

			response=JSON.parse(response.trim());
		
			if(response.status=="ok")
			{
				$(element).parent().parent().fadeOut('slow');
	
			}
			else if(response.status=="error")
			{
				alert(response.note);
			}

	 	}
	});
		
					


}

</script>




<a href="admin_edit.php?action=insert_data" >
	<div align="right" class="btn btn-success" style="float:right;color:white;font-size:1.0em;margin:5px;height:25px;padding:2px;width:120px;">
		<span style="float:right;margin-right:5px;" >اضافة مدير</span>
	</div>
</a>





</center>
<table class="table" width="100%" >
    <tr class="firstTR">
        <th width="3%">#</th>
        <th width="3%">id</th>
        <th width="42%"> اسم المدير</th>
        <th width="3%">تعديل</th>
        <th width="3%">حذف</th>
 
    </tr>
    <?php
    

    
		$sql = "SELECT * FROM admin WHERE 1 AND delete_status=0 ORDER BY id DESC"; 



 
    $query = mysqli_query($connect, $sql);
    $row_number=0;
    while ($row = mysqli_fetch_array($query)) {
          $id = $row['id'];
          $row_number=$row_number+1;

        


        ?>
        <tr>
            <td><?php echo $row_number; ?></td>
            <td><?php echo $id; ?></td>

            <td><?php echo $row['fullname']; ?></td>


            <td><a title="تعديل معلومات المدير" href="admin_edit.php?action=update_data&row_id=<?php echo $id; ?>"><img src="../assets/icons/update.png" width=22 /> </a></td>
            <td><a onclick="cancel_restore_row(this,'cancel_row',<?php echo $id; ?>)" title="حذف المدير" ><img src="../assets/icons/delete.png" width=22 /></a></td>

        </tr>
    <?php 
    }
    
    
    
     ?>
</table>




