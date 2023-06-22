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
$pass_result = $con->query($pass_query);
$pass = $pass_result->fetch_array();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 변경</title>
</head>
<body>
    <?php
    $_SESSION['msg']='비밀번호가 잘못되었습니다';
    //차후에 해쉬처리하면 변경해야함 md5나 SH256
if($input_pass == $pass['password']){
echo '<form action="pass_proc2.php" method="POST">
변경할 비밀번호 : <input type="password" name="new_pass"/>
<input type="submit" value="변경"/>
</form>';
} else {
    echo $_SESSION['msg'];
    header('Location: ./password_change.php');
};
    ?>
</body>
</html>
