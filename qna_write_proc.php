<?php
//세션 시작
session_start();

//작성된 값을 받아서 변수로 저장함
if(isset($_SESSION['id'])){
    $name = $_SESSION['id'];
} else {
    $name = "익명";
}


$bPhone = $_POST['bPhone'];
$bTitle = $_POST['bTitle'];
// $bNick = $_POST['bNick'];
$date = date('Y-m-d');
$bContent = $_POST['bContent'];

if(isset($_POST['lockpost'])){
    $lock_post = 1 ;
} else {
    $lock_post = 0 ;
}

//파일 관련 변수
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['board_file']['name'] !=""){
// $filesize=$_FILES['board_file']['size'];
// $file_error=$_FILES['board_file']['error'];
$tmpfile = $_FILES['board_file']['tmp_name'];
$origin_filename = $_FILES['board_file']['name'];
$allowed_mime_types =['image/jpeg','image/png','image/gif','application/zip','application/x-hwp','application/msword','application/pdf']; //mime허락된 형식
$filename = iconv("UTF-8","EUC-KR",$_FILES['board_file']['name']);

$timestamp = time();
$new_filename = $timestamp.'_'.$filename;
$file_mime_type = mime_content_type($tmpfile);
// if(in_array($file_mime_type, $allowed_mime_types)){
    //파일 저장 경로
    $upload_path = './upload/'.$new_filename;
    if(move_uploaded_file($tmpfile,$upload_path)){
        $_SESSION['write_error'] = '파일 업로드 success!';
    } else {
        $_SESSION['write_error'] = '파일 업로드 Fail ㅜㅜ';
    } 
} else {
};
    
//데이터베이스에 저장할 쿼리 엶
$con = mysqli_connect('localhost','root','1234','test');

if(!empty($origin_filename)){
$query = "INSERT INTO qna_board (title, content, date, name,phone,file,lock_post) VALUES ('$bTitle','$bContent','$date','$name','$bPhone','$new_filename','$lock_post')";
} else {
    $query = "INSERT INTO qna_board (title, content, date, name,phone,file,lock_post) VALUES ('$bTitle','$bContent','$date','$name','$bPhone',NULL,'$lock_post')";
}
if ($con->query($query)){
    echo "<h1>글쓰기 완료</h1>";
    echo "<p>작성한 글이 성공적으로 등록되었습니다.</p>";
    echo "<a href='qna_board.php'><button>목록으로 돌아가기</button></a>";
} else {
    echo "Error:".$sql."<br>".mysqli_error($con);
    echo "<a href='qna_write.php'><button>돌아가기</button></a>";
}
?>
