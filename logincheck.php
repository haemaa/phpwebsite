<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$id = $_GET["id"];
$pwd = $_GET["password"];
if ($_GET['id']=='bg5294' && $_GET['password']=='1111'){
    echo "현재".$_GET['id'].'님으로 로그인 되어있습니다';
    echo '<br>안녕하세요!';
} else {
    echo "<script>location.href='./login.php';</script>";
}
?><br>
<h1>이곳은 메인 페이지입니다</h1>
<input type='text' placeholder='작성하고 싶은 내용을 써넣으세요'>
<br><br>
<input type="submit" value='로그아웃' onClick="
if (confirm('정말 로그아웃 하시겠습니까?')){
    location.href='./login.php';
};
">
<br><br>
<script>
//현재 날짜 시간 표시해줌
var today = new Date();
document.write(today)
</script>
</body>
</html>