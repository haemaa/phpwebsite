<?php
session_start();

$con = mysqli_connect('localhost','root','1234','test');

//이 부분은 url로 전달받음
$bno = $_GET['number'];

//삭제 쿼리문 실행
$query = "DELETE from qna_board WHERE number='$bno'";
$result = $con->query($query);

echo "삭제가 완료되었습니다!<br><br>";
echo "<a href='qna_board.php'><button>게시판으로 돌아가기</button></a>";
?>
