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
<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hacking 페이지</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./main.php">메인 페이지로</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>



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
<hr>
<div>내용 : <?php echo $board['content']; ?></div>
<hr>
<!-- 좋아요 버튼 -->
<?php
 //like_manager DB 검증
 $con2 = mysqli_connect('localhost','root','1234','test');
 $check_url2 = "SELECT username FROM like_manager WHERE like_board_id=$boardlike_id and username='$login_id'";
 $sql_check2= $con2->query($check_url2);
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
<a href="./modify.php?number=<?php echo $board['number'];?>"><button>수정</button></a>
<a href="./delete_proc.php?number=<?php echo $board['number'];?>" onclick="return confirm('정말로 삭제하시겠습니까? 삭제 후에는 되돌릴 수 없습니다.')"><button>삭제</button></a>
<a href="./noticeboard.php"><button>목록</button></a>
<p>

<?php 
  if(isset($_SESSION['write_error'])){
    echo $_SESSION['write_error'];
    unset($_SESSION['write_error']);
  }
?>
</body>
</html>