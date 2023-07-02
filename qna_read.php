<?php
//세션 시작
session_start();
if(isset($_SESSION['id'])){
$login_id = $_SESSION['id'];
} else {
$login_id = "익명";
}

//클릭할 때 number GET으로 가져옴
$bno = $_GET['number'];

//전화번호 인증한거 변수로 저장
$pw_phone = $_POST['phone'];

//게시판 DB 연결
$con = mysqli_connect('localhost','root','1234','test');

//SQL Injection 대응
$boardlike_id = mysqli_real_escape_string($con,filter_var(strip_tags($bno), FILTER_SANITIZE_SPECIAL_CHARS));

//게시판 내용 보여주기
$query = "SELECT * FROM qna_board WHERE number='".$bno."'";
$result = $con->query($query);
$board = $result->fetch_array();

//문의게시판에는 조회수 기능 필요 없음
// $hit = $board['hit'];
// $hit = $hit + 1;
// $hit_query = "UPDATE board SET hit = '".$hit."' WHERE number ='".$bno."'";
// $hit_result = $con->query($hit_query);
if($board['lock_post']=='1'){
  if($board['phone']==$pw_phone){
    echo "<script>alert('전화번호 인증에 성공했습니다!')</script>";
  } else {
    $_SESSION['msg'] = "전화번호 인증에 실패했습니다";
    header("Location: ./qna_board.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의 게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php
require('./nav.html');
?>

<!-- 게시글 불러오기 -->
<h2><?php echo $board['title']; ?></h2><HR>
<div>작성자 :<?php echo $board['name']; ?>
<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;작성날짜 : ".$board['date']; ?></div>
<!-- 기준선 -->
<HR>
<?php 
$filename = explode('_', $board['file'])[1]; //타임스탬프를 제거 후 파일명만 분리
$download_url = 'download_proc.php?filename='.$board['file'];
echo '<p>파일 : <a href="'.$download_url.'">'.$filename.'</a></p>';
?>

<textarea style="width:100%; height:15rem;" readonly><?php echo $board['content']; ?></textarea>

<br><Br>
<a href="./qna_modify.php?number=<?php echo $board['number'];?>"><button class="btn btn-secondary">수정</button></a>
<a href="./qna_delete.php?number=<?php echo $board['number'];?>" onclick="return confirm('정말로 삭제하시겠습니까? 삭제 후에는 되돌릴 수 없습니다.')"><button class="btn btn-secondary">삭제</button></a>
<a href="./qna_board.php"><button class="btn btn-secondary">목록</button></a>
<p>

<?php
  if(isset($_SESSION['write_error'])){
    echo $_SESSION['write_error'];
    unset($_SESSION['write_error']);
  }
?>
</body>
</html>
