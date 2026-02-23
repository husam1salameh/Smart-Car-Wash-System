<?php
session_start();
include "chech_auth.php";
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/font-style.css">
    <link href="../assets/css/fontAwesome.css" rel="stylesheet">
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
<style>
body {
    background: url('../assets/images/bg.png') !important;background-size: cover !important;
}

.container {
    float:center;
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Align items to the start of the flex container */
    flex-wrap: wrap; /* Enable wrapping of items */
    max-width: 1200px; /* Set maximum width for the container */
    margin: 0 auto; /* Center the container horizontally */
    
}

.item {
    flex: 0 0 calc(33.33% - 20px); /* Adjust item width for three items per row */
    margin: 10px; /* Adjust margin between items */
    text-align: center;
}

.img_btn {
    background: #fff;
    border-radius: 50%;
    height: 120px;
    width: 120px;
    padding: 20px;
    font-size: 1.2em;
    color: #fff;
    border: 2px solid #ddd;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
}

.div_btn {
    background: #C70E80;
    border-radius:9px;
    height: 180px;
    width: 190px;
    padding: 20px;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
}
.div_btn a {
  color:#fff;
}

.img_btn:hover {
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transform: translateY(-9px);
    
}

.div_btn:hover{
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transform: translateY(-5px);
    
}


.div_btn a:hover {
    color:#C70E80;
}

@media only screen and (max-width: 992px) {
    .item {
        flex: 0 0 calc(50% - 20px); /* Adjust item width for two items per row */
    }
}

@media only screen and (max-width: 600px) {
    .item {
        flex: 0 0 calc(100% - 20px); /* Adjust item width for one item per row */
    }
}
</style>



</head>
<body>

<div align="middle" style="width:100%;">

<div align="middle" style="width:60%;min-width:300px;float:center;padding:1px;">
<?php include "link.php";?>

   
     


<div class="container" >


    <div class="item">
        <div class="div_btn">
            <a style="text-decoration:none;font-size:1.2em;font-weight:bold;"
               href="booking_list.php" >
                <img class="img_btn" src="../assets/images/booking.png"/>
                <br>
                <strong>جميع الحجوزات</strong>
            </a>
        </div>
    </div>

<?php
if ($_SESSION['user_type'] == "customer") {
?>
    <div class="item">
        <div class="div_btn">
            <a style="text-decoration:none;font-size:1.2em;font-weight:bold;"
               href="booking_form.php" >
                <img class="img_btn" src="../assets/images/new_booking.png"/>
                <br>
                <strong>حجز جديد</strong>
            </a>
        </div>
    </div>
<?php
}
?>

<?php
if ($_SESSION['user_type'] == "admin") {
?>

    <div class="item">
        <div class="div_btn">
            <a style="text-decoration:none;font-size:1.2em;font-weight:bold;"
               href="admin.php" >
                <img class="img_btn" src="../assets/images/admin.jpg"/>
                <br>
                <strong>حسابات الإدارة</strong>
            </a>
        </div>
    </div>

    <div class="item">
        <div class="div_btn">
            <a style="text-decoration:none;font-size:1.2em;font-weight:bold;"
               href="customer.php" >
                <img class="img_btn" src="../assets/images/customers.webp"/>
                <br>
                <strong>حسابات الزبائن</strong>
            </a>
        </div>
    </div>
<?php
}
?>
</div>

</body>
</html>

