<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
            background-color: #f4f4f4;
        }
        .qr-container {
            text-align: center;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="qr-container">
    <?php
    if (isset($_GET['data'])) {
       
        $data = urlencode($_GET['data']);
        $svg = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data={$data}&size=200x200&format=svg");
        echo $svg;
        
        
    } else {
        echo "<p>لم يتم توفير بيانات لإنشاء QR Code</p>";
    }
    ?>
</div>

</body>
</html>

