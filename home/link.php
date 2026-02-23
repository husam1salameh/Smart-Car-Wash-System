<div dir="rtl" style="display: flex; align-items: center; justify-content: center; gap: 15px; padding: 20px; color: #fff; text-shadow: 1px 1px 3px #000;background:#fff7;margin-bottom:20px;">
    <a style="font-size: 1.2em; font-weight: bold; display: flex; align-items: center; gap: 10px;color: #fff;text-decoration :none" href="index.php">
        <i class="fa fa-home"></i> 
        الرئيسية 
    </a>
    <a style="font-size: 1.2em; font-weight: bold; display: flex; align-items: center; gap: 10px;color: #fff;text-decoration :none" href="<?php if($_SESSION['user_type']=="admin")echo "admin_edit.php?action=update_data&myaccount=1";else if($_SESSION['user_type']=="customer")echo "customer_edit.php?action=update_data&myaccount=1";?>">
        <i class="fa fa-user-circle-o"></i> 
        <?php 
            $query = "SELECT fullname FROM {$_SESSION['user_type']} WHERE id = {$_SESSION['user_id']}";
            echo mysqli_fetch_array(mysqli_query($connect, $query))['fullname']; 
        ?> 
    </a>

    <a href="?logout=1"  onclick="return confirm('هل تريد تسجيل خروج؟');" 
       style="text-decoration: none; color: #fff; font-size: 1em; padding: 5px 10px; border-radius: 5px; background: rgba(255,255,255,0.2); transition: background 0.3s;font-weight:bold;"
       title="تسجيل خروج"> 
       تسجيل خروج 
    </a>
</div>

