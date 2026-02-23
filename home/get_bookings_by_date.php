<?php
include "chech_auth.php";


$return_data = [];

if (isset($_POST['wash_date'])) {
    $wash_date = mysqli_real_escape_string($connect, $_POST['wash_date']);

    $sql = "SELECT wash_time FROM customer_booking WHERE wash_date = '$wash_date' ORDER BY wash_time ASC " ;

    
    $result = mysqli_query($connect, $sql);

    $booked_times = [];

    while ($row = mysqli_fetch_assoc($result))
    {
    
        $booked_times[] = $row['wash_time'];
    }


    if (!empty($booked_times)) {

         $table = "<table style='width:100%; border-collapse: collapse;'>";
         $table .= "<tr><th style='border: 1px solid #C70D80; padding: 8px;'>الوقت المحجوز</th></tr>";

        foreach ($booked_times as $time) {
          $from = date("H:i", strtotime($time));
          $to = date("H:i", strtotime($time) + 15 * 60); // زائد 15 دقيقة
          $table .= "<tr><td style='border: 1px solid #C70D80; padding: 8px; text-align: center;'>من $from إلى $to</td></tr>";

        }

        $table .= "</table>";

        $return_data["status"] = "ok";
        $return_data["html"] = $table;
    } else {
        $return_data["status"] = "empty";
        $return_data["html"] = "<div dir='rtl' style='text-align:center;'>لا توجد حجوزات في هذا اليوم.</div>";
    }

    echo json_encode($return_data);
    exit();
}
?>

