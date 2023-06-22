<!DOCTYPE html>
<?php
session_start();
//세션 아이디 $login_id에 저장
$login_id =$_SESSION['id'];

//입력한 비밀번호 받음
$input_pass = $_POST['input_pass'];

//DB연결
$con = mysqli_connect('localhost','root','1234','test');
//타입 때문에 $login_id에 작은 따옴표 꼭 붙여야 함
$pass_query = "SELECT * FROM user WHERE username='$login_id'";
$pass_result = $con->query($mypage_query);
$pass = $myp_result->fetch_array();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 변경</title>
</head>
<body>
    <?php
    //차후에 해쉬처리하면 변경해야함 md5나 SH256
if($input_pass == $pass['password']){
    $pass_update_query = "UPDATE user SET password=$new_pass WHERE username='$login_id'";
    $pass_update_res = $con->query($pass_update_query);
    $pass_update = $pass_update_res->fetch_array();
    echo "<script>alert('변경되었습니다!')</script>";
} else {
    echo "<script>alert('비밀번호가 잘못되었습니다!')</script>";
    $_SESSION['msg']='비밀번호가 잘못되었습니다';
    header('Location: ./password_change.php');
};
    ?>
</body>
</html>
