<!DOCTYPE html>
<html>
<?php
    session_start();
    if(isset($_SESSION['is_login'])){
        header('Location: ./main.php');
    }
?>

<head>
    <meta charset="utf-8"/></head> 
    <title>Normaltic login hw</title>
    <link rel='stylesheet' type='text/css' href='test.css'/>
</head>
<body>
    <H1>2주차 로그인 기능 구현 과제</h1>
        <p>아이디 비밀번호 입력하세요</p>
    <form action='login_proc.php' method='POST'>
        <p>ID : 
        <input type='text' name='id' placeholder='여기에 아이디를 입력하세요' /></p>
        <p>PW : 
        <input type='text' name='pw' placeholder='여기에 비밀번호를 입력하세요'/></p>
        <input type='submit' value='로그인'/>
        <br><br>
    </form>
    <form action='enroll.php' method='POST'>
    <input id="enroll" type='submit' value='회원가입'/>
    </form>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
   ?>
</body>
</html>
