
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

	
		
<?php
if ($_SESSION['user_type'] == "admin") {
  #----------------------------------
  if ($_REQUEST['action'] == 'delete') {
    $sql="DELETE FROM customer_booking WHERE id=$_REQUEST[row_id]";
    $del = mysqli_query($connect, $sql);
  }

  #----------------------------------

  if ($_REQUEST['action'] == 'finish') {
    $sql="UPDATE customer_booking SET status=2 WHERE id=$_REQUEST[row_id]";
    $update = mysqli_query($connect, $sql);
  }
  if ($_REQUEST['action'] == 'not-finish') {
    $sql="UPDATE customer_booking SET status=1 WHERE id=$_REQUEST[row_id]";
    $update = mysqli_query($connect, $sql);
  }
  #----------------------------------
}

?>
<?php
include "../link.php";
?>
<div class="title">طلبات الحجز</div>
<?php
if ($_SESSION['user_type'] == "admin") {
?>
<form method="GET" action="" style="background:#fdfdfd;border:1px solid #C70D80;padding:15px;">


  <input type="text" name="customer_name" value="<?php echo $_REQUEST['customer_name'];?>" placeholder="البحث عن  اسم"/>
  
  <input type="submit" class="btn btn-primary"  value="بحث" />
</form>
<?php
}
?>

<br>

<table class="table" width="100%">
    <tr class="firstTR">
        <th width='3%'></th>
        <th width='12%'>وقت الارسال</th>
        <th width='20%'>اسم الزبون</th>
        <th width='14%'>اليوم</th>
        <th width='14%'>الساعة</th>
        <th width='9%'>الحالة</th>
        <th width='10%'>QR</th>
        
        <?php
        if ($_SESSION['user_type'] == "admin") {
        ?>
        <th width='5%'>حذف</th>
        <?php
        }
        ?>
        
    </tr>

    <?php
    $customer_id=intval($_SESSION['user_id']);
    
    if (!empty($_REQUEST['customer_name'])) {
        $where_search = "AND (c.fullname LIKE '%" . mysqli_real_escape_string($connect, $_REQUEST['customer_name']) . "%')";
    }
    
    if ($_SESSION['user_type'] == "customer") {
      $where_customer_id="AND customer_id=$customer_id";
    }



    $current_datetime = date('Y-m-d H:i:s');
    $current_time = date('H:i:s');

    $sql = "UPDATE customer_booking
        SET status = 3
        WHERE wash_date <= CURDATE()
        AND '$current_datetime' >= CONCAT(wash_date, ' ', ADDTIME(wash_time, '01:00:00'))";

    //echo $sql;
    
    $update = mysqli_query($connect, $sql);

    
    $sql = "SELECT cb.id, cb.booking_datetime, cb.wash_date, cb.wash_time, cb.status,cb.serial_QR, c.fullname 
            FROM customer_booking cb
            LEFT JOIN customer c ON cb.customer_id = c.id
            WHERE 1 
            $where_search 
            $where_customer_id
            ORDER BY cb.id DESC";

    $query = mysqli_query($connect, $sql);
    $row_number = 0;

    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $serial_QR = $row['serial_QR'];
        $row_number++;
        
        $status = "<a href='?action=finish&row_id=$id'><img width=33 src='../assets/icons/not-finish.png' /></a>";
        if ($row['status'] == 2) {
          $status = "<a href='?action=not-finish&row_id=$id'><img width=33 src='../assets/icons/finish.png' /></a>";
      }
      if ($row['status'] == 3) {
        $status = "<a href='?action=not-finish&row_id=$id'><img width=33 src='../assets/icons/outOfDatetime.png' /></a>";
    }
        ?>
        <tr>
            <td><?php echo $row_number; ?></td>
            <td style="font-size:0.8em;color:gray;">
                <?php echo $row['booking_datetime']; ?><br><?php echo "id=$id"; ?>
            </td>
            <td><?php echo $row['fullname']; ?></td>
            <td style="font-size:1.0em;color:#888;font-weight:bold;">
                <?php echo $row['wash_date']; ?>
            </td>
            <td style="font-size:1.1em;color:#000;font-weight:bold;">
                <?php if (!empty($row['wash_time'])) echo date("H:i", strtotime($row['wash_time'])); ?>
            </td>
            <td><?php echo $status; ?></td>
            
            <td>

              <?php
              $data = urlencode($serial_QR);
              ?>
              <a href="QR_screen.php?data=<?php echo $data;?>" target="_blank">Show QR</a>

            </td>
            
            <?php
            if ($_SESSION['user_type'] == "admin") {
            ?>
            <td>
                <a href="?action=delete&row_id=<?php echo $id; ?>">
                    <img width=22 src="../assets/icons/delete.png" onclick="return confirm('هل تريد بالتأكيد الحذف؟ ')"/>
                </a>
            </td>
            <?php
            }
            ?>
            
        </tr>
        <?php 
    }
    ?>
</table>



