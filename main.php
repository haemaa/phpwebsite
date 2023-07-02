<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: ./test.php');
}
?>

<style>
    .notice {
    color : purple;
}
</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haemaa Web</title>
    <!-- bootstrap 적용 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <!-- 상단 Navbar -->
<?php
require('nav.html');
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<br><br>
<!-- Grid 시스템 -->
<div class="container text-center">
  <div class="row">
    <div class="col">
    <div class="card" style="width: 10rem;height: 25rem;">
  <img src="https://atos.net/wp-content/uploads/2020/07/hacking-blog-image.jpg" class="card-img-top" alt="..." style="height: 20rem;">
  <div class="card-body">
    <h5 class="card-title">해커 커뮤니티</h5>
    <p class="card-text">이 곳에서 해킹 얘기들을 자유롭게 꺼내보세요</p>
    <a href="./noticeboard.php" class="btn btn-outline-secondary">게시판 이동</a>
  </div>
</div>
    </div>
    <div class="col">
    <div class="card" style="width: 10rem;height: 25rem;">
  <img src="https://img.gqkorea.co.kr/gq/2022/07/style_62da366deba2b.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">마이 페이지</h5>
    <br>
    <p class="card-text">현재 본인의 계정 상태를 확인하세요</p>
    <a href="mypage.php" class="btn btn-outline-secondary">페이지 이동</a>
  </div>
</div>
    </div>
    <div class="col">
    <div class="card" style="width: 10rem;height: 25rem;">
  <img src="https://png.pngtree.com/background/20210714/original/pngtree-cool-background-material-picture-image_1215741.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">문의 게시판</h5>
    <p class="card-text">이용하시다 문의사항이 있다면, 여기에 남겨주세요</p>
    <a href="./qna_board.php" class="btn btn-outline-secondary">게시판 이동</a>
  </div>
</div>
    </div>
  </div>
</div>
<!-- 게시판 이동 -->
<br>
<hr>
<?php
if(!isset($_SESSION['is_login'])){
    $_SESSION['msg']='로그인을 해야합니다';
    header('Location: ./test.php');
}else{
    if(isset($_SESSION['id'])){
        echo "<br><br><span class='d-block p-2 text-bg-secondary'>현재 ".$_SESSION['id']." 님으로 로그인되어 있습니다</span><p>";
    }else{
        echo 'Welcome to blog management';
    }
    echo '<form action="logout.php">
    <input type="submit" class="btn btn-outline-secondary" value="로그아웃"/>
    </form>'; 
}
?>
<br>
<span class='d-block p-2 text-bg-primary'>
<script>
var today = new Date();
document.write(today)
</script>
</span>
<span class='d-block p-2 text-bg-primary'>made by Bokyu</span>
</body>
</html>
