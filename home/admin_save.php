<?php

	include 'chech_auth.php';


	$return_data=array();
  if($_SESSION['user_type']!="admin")
  {
	  $return_data["status"]="error";
	  $return_data["note"]=" لا تملك صلاحيات ";
	  echo json_encode($return_data);
	  exit();
  }

	  
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
		
		
		$delete = mysqli_query($connect, "UPDATE `admin` SET delete_status=1 WHERE id='$row_id' AND id!=1");
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
		$sql = mysqli_query($connect, "SELECT loginname FROM admin WHERE loginname='$loginname'");
    $num = mysqli_num_rows($sql);
    	
		if ($num>0) 
		{
			$return_data["status"]="error";
			$return_data["note"]="اسم المستخدم هذا موجود لمدير اخر";
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
		
		$pass_form = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[\w!@#$%^&*]{6,}$/';
		if (!preg_match($pass_form, $password)) 
	 	{
	 	  $return_data["status"]="error";
			$return_data["note"]="يجب ان تحتوي كلمة المرور على حروف كبيرة وصغيرة وارقام وان لا تقل عن 6 خانات";
			echo json_encode($return_data);
			exit();
	 	}
	 	
		$password = hash("sha256",$password);
		  
		##========
		
		
		 $sql="
		 INSERT INTO admin
		        (fullname,loginname,password)
		 VALUES
		        ($fullname,'$loginname','$password')";

		//echo  $insert_sql;

		$insert1 = mysqli_query($connect, $sql);

		
		//------------------------------------------------------------------------
		$last_admin_id = mysqli_insert_id($connect);/////mean SELECT * FROM agent WHERE id = SCOPE_IDENTITY(); 
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
      $sql = mysqli_query($connect, "SELECT loginname FROM admin WHERE loginname='$loginname' AND id !=$row_id");
      $num = mysqli_num_rows($sql);

      if ($num>0) 
      {
        $return_data["status"]="error";
        $return_data["note"]="اسم المستخدم هذا موجود لمدير اخر";
        echo json_encode($return_data);
        exit();

      }

      $update_user = mysqli_query($connect, "UPDATE admin SET loginname='$loginname' WHERE id='$row_id'");

      if(!empty($password) && $password==$confirm_password)
      {
        $pass_form = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[\w!@#$%^&*]{6,}$/';
        if (!preg_match($pass_form, $password)) 
	     	{
	     	  $return_data["status"]="error";
			    $return_data["note"]="يجب ان تحتوي كلمة المرور على حروف كبيرة وصغيرة وارقام وان لا تقل عن 6 خانات";
			    echo json_encode($return_data);
			    exit();
	     	}
	 	
		    $password = hash("sha256",$password);
        $update_user = mysqli_query($connect, "UPDATE admin SET password='$password' WHERE id='$row_id'");
      }

    }

		##========
		
		$sql="UPDATE admin SET 
				fullname=$fullname,
				loginname='$loginname'
				WHERE id=$row_id ";

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
	
	
	
	
	$return_data["status"]="ok";
	$return_data["note"]=$ok_msg;
	echo json_encode($return_data);
	exit();











?>

