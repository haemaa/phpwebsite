<?php
//세션 시작
session_start();

//작성된 값을 받아서 변수로 저장함
$name = $_SESSION['id'];
$bPassword = $_POST['bPassword'];
$bTitle = $_POST['bTitle'];
$date = date('Y-m-d H:i:s');
$bContent = $_POST['bContent'];
//파일 관련 변수
$tmpfile = $_FILES['board_file']['tmp_name'];
$origin_filename = $_FILES['board_file']['name'];
$filename = iconv("UTF-8","EUC-KR",$_FILES['board_file']['name']);
$folder = "./upload/".$filename;
move_uploaded_file($tmpfile,$folder);

//데이터베이스에 저장할 쿼리 엶
$con = mysqli_connect('localhost','root','1234','test');
$query = "INSERT INTO board (title, content, date, name,password, file) VALUES ('$bTitle','$bContent','$date','$name','$bPassword','$origin_filename')";

if ($con->query($query)){
    echo "<h1>글쓰기 완료</h1>";
    echo "<p>작성한 글이 성공적으로 등록되었습니다.</p>";
    echo "<a href='noticeboard.php'><button>목록으로 돌아가기</button></a>";
} else {
    echo "Error:".$sql."<br>".mysqli_error($con);
    echo "<a href='write.php'><button>돌아가기</button></a>";
}
?>