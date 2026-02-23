<?php

	include 'chech_auth.php';
  

	$return_data=array();


	
	if ($_REQUEST['action'] == 'cancel_row') 
	{
		$row_id = intval($_REQUEST['row_id']);
    
    if ($row_id==1) 
		{	
			$return_data["status"]="error";
			$return_data["note"]="لا يمكن حذف هذا المدير  ";
			echo json_encode($return_data);
			exit();
		}
		
		
		$delete = mysqli_query($connect, "UPDATE `customer` SET delete_status=1 WHERE id='$row_id' AND id!=1");
		if (!$delete) 
		{	
			$return_data["status"]="error";
			$return_data["note"]="حدث خطا في الحذف ";
			echo json_encode($return_data);
			exit();
		}
		$ok_msg="تم حذف السجل بنجاح";
		$return_data["status"]="ok";
		$return_data["note"]=$ok_msg;
		echo json_encode($return_data);
		exit();
		
		
	}
	

			
	

	if ($_POST['action'] == 'insert_data' || $_POST['action'] == 'update_data') 
	{
	
	
		$fullname = $_POST['fullname'];
		$fullname = mysqli_real_escape_string($connect, $fullname);
		if(!empty($fullname))$fullname="'$fullname'";
		else
		{
			$return_data["status"]="error";
			$return_data["note"]="يجب كتابة الاسم";
			echo json_encode($return_data);
			exit();
		}

		$loginname =mysqli_real_escape_string($connect,$_POST['loginname']);
		if(!empty($loginname) && strlen($loginname)<4)
		{
			$return_data["status"]="error";
			$return_data["note"]="اسم مستخدم يجب ألا يقل عن 4 خانات";
			echo json_encode($return_data);
			exit();
		}

	 	$password =mysqli_real_escape_string($connect,$_POST['password']);
	 	$confirm_password =mysqli_real_escape_string($connect,$_POST['confirm_password']);
	 	

	  


	}

	if ($_POST['action'] == 'insert_data') 
	{

		##========user data
		$sql = mysqli_query($connect, "SELECT loginname FROM customer WHERE loginname='$loginname'");
    $num = mysqli_num_rows($sql);
    	
		if ($num>0) 
		{
			$return_data["status"]="error";
			$return_data["note"]="اسم المستخدم هذا موجود لزبون اخر";
			echo json_encode($return_data);
			exit();

		}
		if(empty($password))
		{
			$return_data["status"]="error";
			$return_data["note"]="الرجاء ادخال كلمة مرور";
			echo json_encode($return_data);
			exit();
		
		}
		if($password!=$confirm_password)
		{
			$return_data["status"]="error";
			$return_data["note"]="كلمة المرور غير متطابقة";
			echo json_encode($return_data);
			exit();
		}
		

		$password = hash("sha256",$password);
		  
		##========
		
		
		 $sql="
		 INSERT INTO customer
		        (fullname,loginname,password)
		 VALUES
		        ($fullname,'$loginname','$password')";

		//echo  $insert_sql;

		$insert1 = mysqli_query($connect, $sql);

		
		//------------------------------------------------------------------------
		$last_customer_id = mysqli_insert_id($connect);/////mean SELECT * FROM agent WHERE id = SCOPE_IDENTITY(); 
		//------------------------------------------------------------------------

		if (!$insert1) 
		{
			$return_data["status"]="error";
			$return_data["note"]="حدث خطا اثناء الحفظ";
			echo json_encode($return_data);
			exit();

		}
	
		$ok_msg="تم الحفظ";
	}



	if ($_POST['action'] == 'update_data') 
	{
		$row_id = intval($_POST['row_id']);
		


		##========user data

    if(!empty($row_id))
    {
      $sql = mysqli_query($connect, "SELECT loginname FROM customer WHERE loginname='$loginname' AND id !=$row_id");
      $num = mysqli_num_rows($sql);

      if ($num>0) 
      {
        $return_data["status"]="error";
        $return_data["note"]="اسم المستخدم هذا موجود لزبون اخر";
        echo json_encode($return_data);
        exit();

      }

      $update_user = mysqli_query($connect, "UPDATE customer SET loginname='$loginname' WHERE id='$row_id'");

      if(!empty($password) && $password==$confirm_password)
      {

        $password = hash("sha256",$password);
        $update_user = mysqli_query($connect, "UPDATE customer SET password='$password' WHERE id='$row_id'");
      }

    }

		##========
		
		$sql="UPDATE customer SET 
				fullname=$fullname,
				loginname='$loginname'
				WHERE id=$row_id ";

    if($_SESSION['user_type']=="customer")
    {
      $card_number = $_POST['card_number'] ?? '';
      $card_name = $_POST['card_name'] ?? '';
      $card_expiry = $_POST['card_expiry'] ?? '';
      $card_cvv = $_POST['card_cvv'] ?? '';
      
      if(!empty($card_cvv))$update_card_cvv=" card_cvv='$card_cvv', ";

		  $sql="UPDATE customer SET 
          $update_card_cvv
          card_number='$card_number',
          card_name='$card_name',
          card_expiry='$card_expiry'
				WHERE id=$row_id ";
    }
    
		$update = mysqli_query($connect, $sql);
		
		if (!$update)
		{
			$return_data["status"]="error";
			$return_data["note"]="حدث خطا في حفظ التعديلات";
			echo json_encode($return_data);
			exit();
		   
		}

		$ok_msg="تم الحفظ";
	}
	##################################################################
	
	
	
	$return_data["status"]="ok";
	$return_data["note"]=$ok_msg;
	echo json_encode($return_data);
	exit();











?>

