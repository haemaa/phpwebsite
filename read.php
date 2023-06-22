<?php
//세션 시작
session_start();
$login_id = $_SESSION['id'];

//클릭할 때 number GET으로 가져옴
$bno = $_GET['number'];

//게시판 DB 연결
$con = mysqli_connect('localhost','root','1234','test');

//SQL Injection 대응
$boardlike_id = mysqli_real_escape_string($con,filter_var(strip_tags($bno), FILTER_SANITIZE_SPECIAL_CHARS));

//게시판 내용 보여주기
$query = "SELECT * FROM board WHERE number='".$bno."'";
$result = $con->query($query);
$board = $result->fetch_array();

//클릭할 때 조회수 1 증가
$hit = $board['hit'];
$hit = $hit + 1;
$hit_query = "UPDATE board SET hit = '".$hit."' WHERE number ='".$bno."'";
$hit_result = $con->query($hit_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
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
<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;작성날짜 : ".$board['date']; ?>&nbsp;&nbsp;&nbsp;&nbsp;조회수 : <?php echo $board['hit']+1; ?></div>
<!-- 기준선 -->
<HR>
<?php 
$filename = explode('_', $board['file'])[1]; //타임스탬프를 제거 후 파일명만 분리
$download_url = 'download_proc.php?filename='.$board['file'];
echo '<p>파일 : <a href="'.$download_url.'">'.$filename.'</a></p>';
?>

<textarea style="width:100%; height:15rem;" readonly><?php echo $board['content']; ?></textarea>
  <br>
<!-- 좋아요 버튼 -->
<?php
 //like_manager DB 검증

 $check_url2 = "SELECT username FROM like_manager WHERE like_board_id=$boardlike_id and username='$login_id'";
 $sql_check2= $con->query($check_url2);
 $res_check2 = $sql_check2->fetch_array();

// 접속한 id와 게시판 작성자가 달라야 좋아요 버튼 생성
if ($_SESSION['id'] != $board['name']){
  //like_manager DB에서 검증 후, 좋아요 기록이 없으면 밋밋한 엄지
  if ($_SESSION['id'] == $res_check2['username']){
   echo
//게시판 리스트에서 read로 갈때 사용했던 GET과 POST둘 다 사용하는 방법 
'<form action="./like_update.php?number='.$boardlike_id.'" method="POST">
<input type="image" style="cursor: pointer; width:30px;height:30px;"
id="myimg" name="board_id" src="./image/thumb2.png"></form>';
  } else if ($_SESSION['id'] != $res_check2['username']){
    //좋아요 기록이 있으면 색깔 엄지
   echo 
'<form action="./like_update.php?number='.$boardlike_id.'" method="POST">
<input type="image" style="cursor: pointer; width:30px;height:30px;"
id="myimg" name="board_id" src="./image/thumb1.png"></form>';
  }
};
echo' 좋아요 수 : '.$board['thumbup'];
?>

<br><Br>
<?php 
if ($_SESSION['id'] == $board['name']){
?>
<a href="./modify.php?number=<?php echo $board['number'];?>"><button class="btn btn-secondary">수정</button></a>
<a href="./delete_proc.php?number=<?php echo $board['number'];?>" onclick="return confirm('정말로 삭제하시겠습니까? 삭제 후에는 되돌릴 수 없습니다.')"><button class="btn btn-secondary">삭제</button></a>
<?php } ?>
<a href="./noticeboard.php"><button class="btn btn-secondary">목록</button></a>
<p>

<?php
  if(isset($_SESSION['write_error'])){
    echo $_SESSION['write_error'];
    unset($_SESSION['write_error']);
  }
?>
</body>
</html>