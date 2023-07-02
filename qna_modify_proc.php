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
$bPhone = $_POST['bPhone'];
$bTitle = $_POST['bTitle'];
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


//쿼리문 실행
$query = "UPDATE qna_board SET name='$username',phone='$bPhone',title='$bTitle',content='$bContent',lock_post='$lock_post',file='$new_filename' WHERE number='$bno'";
$result = $con->query($query);

echo "수정이 완료되었습니다!<br><br>";
echo "<a href='qna_board.php'><button>게시판으로 돌아가기</button></a>";
?>
