<?php

	include 'config.php';
  

	$return_data=array();





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

	$ok_msg="تم انشاء الحساب";

	
	$return_data["status"]="ok";
	$return_data["note"]=$ok_msg;
	echo json_encode($return_data);
	exit();











?>

