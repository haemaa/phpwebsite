<?php
session_start();

$con = mysqli_connect('localhost','root','1234','test');

//이 부분은 url로 전달받음
$bno = $_GET['number'];

//이건 로그인한 이후로 원래 있는거
$username = $_SESSION['id'];

//post로 전달받은 부분
$userpw = $_POST['bPassword'];
$title = $_POST['bTitle'];
$content = $_POST['bContent'];

//쿼리문 실행
$query = "UPDATE board SET name='$username',password='$userpw',title='$title',content='$content' WHERE number='$bno'";
$result = $con->query($query);

echo "수정이 완료되었습니다!<br><br>";
echo "<a href='noticeboard.php'><button>게시판으로 돌아가기</button></a>";
?>
