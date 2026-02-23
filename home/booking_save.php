<?php
include "chech_auth.php";

$return_data=array();

$customer_id=intval($_SESSION['user_id']);


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_booking') 
{

  $wash_date = mysqli_real_escape_string($connect,$_POST['wash_date']);
  $wash_time = mysqli_real_escape_string($connect,$_POST['wash_time']);

  //===========================
  $wash_date = $_POST['wash_date']; // تاريخ الحجز بصيغة 'Y-m-d'
  $wash_time = $_POST['wash_time']; // الوقت المحجوز بصيغة 'H:i:s'
  if (empty($wash_date)||empty($wash_time)) 
  {
      $return_data["status"] = "error";
      $return_data["note"] = "يجب ادخال التاريخ والوقت";
      echo json_encode($return_data);
      exit();
  }
  
  //-----------------------------
  $input_datetime_str = $wash_date . ' ' . $wash_time;
  if (strtotime($input_datetime_str) < time()) {
      $return_data["status"] = "error";
      $return_data["note"] = "لا يمكن اختيار تاريخ أو وقت في الماضي";
      echo json_encode($return_data);
      exit();
  }
  //-----------------------------


  $sql = "SELECT COUNT(*) AS total_bookings 
          FROM `customer_booking` 
          WHERE TIMESTAMP(wash_date, wash_time) 
                BETWEEN TIMESTAMP('$wash_date', '$wash_time') - INTERVAL 15 MINUTE 
                    AND TIMESTAMP('$wash_date', '$wash_time') + INTERVAL 15 MINUTE";

  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
  $this_time_wash_count = $row['total_bookings'];


    $sql1 = "SELECT * FROM customer WHERE id=$_SESSION[user_id]";
    $result1 = mysqli_query($connect, $sql1);
    $row1 = mysqli_fetch_array($result1);
    
    if (empty($row1['card_cvv'])||empty($row1['card_number'])||empty($row1['card_name'])||empty($row1['card_expiry'])) 
    {
		  $return_data["status"]="error";
		  $return_data["note"]="يجب ادخال بيانات صحيحة للبطاقة  <a target='_blank' href='customer_edit.php?action=update_data&myaccount=1'>من هنا</a>";
		  echo json_encode($return_data);
		  exit();
    } 


  if ($this_time_wash_count >= 1) 
  {
      $return_data["status"] = "error";
      $return_data["note"] = "اختر وقت اخر لأن الحد الأقصى من الحجوزات تم الوصول إليه.";
      echo json_encode($return_data);
      exit();
  }
  //===========================

  $serial_QR=bin2hex(random_bytes(20));

  $sql="INSERT INTO customer_booking 
	(wash_date,wash_time, customer_id,serial_QR) 
	VALUES 
	('$wash_date', '$wash_time',$customer_id,'$serial_QR')";

	
  $insert = mysqli_query($connect, $sql);

  if($insert)
  {
    $return_data["status"]="ok";
    $return_data["note"]="تم الحجز بنجاح";
		echo json_encode($return_data);
		exit();
  
  }
  
  

}
?>


