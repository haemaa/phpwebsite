<?php
$full = $_GET['full'];

echo $full;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <script>
        function my_addr(){
            var full= '<?=$full?>';
            var my_addr = full+" "+document.getElementById("detail").value;
            opener.document.getElementById("addr").value = my_addr;
            window.close();
        }
    </script>    
</head>
<body>
    <input id="detail" type=text>
    <input type=button value="확인" onClick="my_addr()">
</body>
</html>

