<!DOCTYPE html>
<?php
session_start();
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
    <title>Normaltic login hw</title>
    <!-- bootstrap 적용 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <!-- 상단 Navbar -->
<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hacking 페이지</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<br><br>
<!-- Grid 시스템 -->
<div class="container text-center">
  <div class="row">
    <div class="col">
    <div class="card" style="width: 10rem;">
  <img src="https://atos.net/wp-content/uploads/2020/07/hacking-blog-image.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">해커 커뮤니티</h5>
    <p class="card-text">이 곳에서 해킹 얘기들을 자유롭게 꺼내보세요</p>
    <a href="./noticeboard.php" class="btn btn-primary">게시판 이동</a>
  </div>
</div>
    </div>
    <div class="col">
    <div class="card" style="width: 10rem;">
  <img src="https://img.gqkorea.co.kr/gq/2022/07/style_62da366deba2b.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">오늘의 연예일간</h5>
    <p class="card-text">최신 연예뉴스를 구독하세요</p>
    <a href="./noticeboard.php" class="btn btn-primary">게시판 이동</a>
  </div>
</div>
    </div>
    <div class="col">
    <div class="card" style="width: 10rem;">
  <img src="https://png.pngtree.com/background/20210714/original/pngtree-cool-background-material-picture-image_1215741.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">문의 게시판</h5>
    <p class="card-text">이용하시다 문의사항이 있다면, 여기에 남겨주세요</p>
    <a href="./noticeboard.php" class="btn btn-primary">게시판 이동</a>
  </div>
</div>
    </div>
  </div>
</div>
<!-- 게시판 이동 -->
<br>
<?php
if(!isset($_SESSION['is_login'])){
    $_SESSION['msg']='로그인을 해야합니다';
    header('Location: ./test.php');
}else{
    if(isset($_SESSION['id'])){
        echo "<br><br>현재".$_SESSION['id']."님으로 로그인되어 있습니다<p>";
    }else{
        echo 'Welcome to blog management';
    }
    echo '<form action="logout.php">
    <input type="submit" value="로그아웃"/>
    </form>'; 
}
?>
<br>
<script>
var today = new Date();
document.write(today)
</script>
<div>made by Bokyu</div>
</body>
</html>