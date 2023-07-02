<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: ./test.php');
}
//세션 아이디 $login_id에 저장
$login_id =$_SESSION['id'];

//DB연결
$con = mysqli_connect('localhost','root','1234','test');

$new_pass = $_POST['new_pass'];

$pass_update_query = "UPDATE user SET password='$new_pass' WHERE username='$login_id'";
$pass_update_res = $con->query($pass_update_query);

if (isset($pass_update_res)){
echo "변경되었습니다!";
echo "<a href='password_change.php'><button >되돌아가기</button></a>";
} else {
echo "오류가 발생했습니다. 되돌아가서 다시 진행해주세요";
}
?>
