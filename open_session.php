
<?php


$return_data=array();


require "config.php";




$loginname = mysqli_real_escape_string($connect, @$_POST['loginname']);
$password = hash("sha256",$_POST['password']);

if ($loginname && $password) 
{

	  $sql="SELECT loginname,password,id FROM customer WHERE loginname='$loginname' AND password='$password' ";
	  $user_type="customer";
	  
    $finder = mysqli_query($connect, $sql) or die("mysql error");
    
    if (mysqli_num_rows($finder) == 0)
    {
      $sql="SELECT loginname,password,id FROM admin WHERE loginname='$loginname' AND password='$password' ";
      $user_type="admin";
      
      $finder = mysqli_query($connect, $sql) or die("mysql error");
    }
    
    if (mysqli_num_rows($finder) != 0) 
    {
        while ($row = mysqli_fetch_object($finder)) 
        {
            $user_name = stripslashes($row->loginname);
            $user_password = $row->password;
            $user_id = $row->id;
        }
        
        
        
     		//session_unset();//
     		unset($_SESSION['user_id']);
     		unset($_SESSION['user_name']);
     		unset($_SESSION['user_password']);
     		unset($_SESSION['user_type']);

     

		    $_SESSION['user_id'] = $user_id;
		    $_SESSION['user_name'] = $user_name;
		    $_SESSION['user_password'] = $user_password;
		    $_SESSION['user_type'] = $user_type;
		    

		    $return_data["status"]="ok";
	      $return_data["note"]="session opened";						   
		    
        
	}
	else
	{
		$return_data["status"]="error";
		$return_data["note"]="خطا في كلمة المرور او اسم المستخدم" ;
	}
				    
} 
else 
{
	    $return_data["status"]="error";
      $return_data["note"]="خطأ غير معروف";
}



echo json_encode($return_data);

//ob_end_flush();









