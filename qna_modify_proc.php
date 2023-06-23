<?php
session_start();

$con = mysqli_connect('localhost','root','1234','test');

//이 부분은 url로 전달받음
$bno = $_GET['number'];

//이건 로그인한 이후로 원래 있는거
if(isset($_SESSION['id'])){
    $username = $_SESSION['id'];
} else {
    $username = "익명";
}
//post로 전달받은 부분
$userpw = $_POST['bPassword'];
$title = $_POST['bTitle'];
$content = $_POST['bContent'];

//쿼리문 실행
$query = "UPDATE qna_board SET name='$username',password='$userpw',title='$title',content='$content' WHERE number='$bno'";
$result = $con->query($query);

echo "수정이 완료되었습니다!<br><br>";
echo "<a href='qna_board.php'><button>게시판으로 돌아가기</button></a>";
?>
