<?php
session_start();


$con = mysqli_connect('localhost','root','1234','test');

//이건 로그인한 이후로 원래 있는거
$login_id = $_SESSION['id'];

//post로 전달받은 부분
$user_new_name = $_POST['myp_username'];
$user_mail = $_POST['myp_email'];
$user_phone = $_POST['myp_phone'];
$user_add = $_POST['myp_address'];

//쿼리문 실행
$query = "UPDATE user SET username='$user_new_name',email='$user_mail',phone='$user_phone',address='$user_add' WHERE username='$login_id'";

$result = $con->query($query);

echo "수정이 완료되었습니다! 다시 로그인 해주세요~<br><br>";
echo "<a href='mypage.php'><button>마이 페이지로 돌아가기</button></a>";
?>