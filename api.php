<?php

include "config.php";

date_default_timezone_set('Asia/Jerusalem');

$qr_code_value = $connect->real_escape_string($_POST['qr_code']);

$current_date = date('Y-m-d');
$current_time = date('H:i:s');

// SQL: تحقق أن التاريخ هو تاريخ اليوم وأن الوقت الحالي بين وقت الحجز ووقت الحجز + ساعة
$sql = "SELECT * FROM customer_booking 
        WHERE serial_QR = '$qr_code_value' 
        AND status = 1 
        AND wash_date = '$current_date' 
        AND TIME('$current_time') BETWEEN wash_time AND ADDTIME(wash_time, '00:08:00')";

// سجل الاستعلام في ملف
file_put_contents("output.debug", "$sql\n", FILE_APPEND);

$result = $connect->query($sql);

if ($result && $result->num_rows > 0) {
    echo 'valid';

    // تحديث الحالة إلى "تم الاستخدام"
    $update_sql = "UPDATE customer_booking SET status = 2 WHERE serial_QR = '$qr_code_value'";
    $connect->query($update_sql);
    
} else {
    echo 'invalid';
}

?>
