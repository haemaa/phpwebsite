<!DOCTYPE html>
<html>
<?php
    session_start();
    if(isset($_SESSION['is_login'])){
        header('Location: ./main.php');
    }
?>

<head>
    <meta charset="utf-8"/></head> 
    <title>login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>   
<span class="d-block p-2 text-bg-dark"><h1>White Hacker haemaa</h1></span>
<span class="d-block p-2 text-bg-secondary">made by bokyu<a class="nav-link" href="./qna_board.php" style="float:right;">문의 게시판</a></span>
<span class="d-block p-2 text-bg-dark">web hacking test web</span>
       <br><p>아이디 비밀번호 입력하세요</p><br>
    <form action='login_proc.php' method='POST'>
    <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10"> 
        <input type='text' class="form-control" name='id' placeholder='여기에 아이디를 입력하세요' /></p>
        </div>
</div>
        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">PW</label>
    <div class="col-sm-10">
        <input type='password' class="form-control" name='pw' placeholder='여기에 비밀번호를 입력하세요'/></p>
    </div>
</div>
        <br><Br><input type='submit' style="float:right;" value='로그인' class="btn btn-secondary"/>
        <br><br>
    </form>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
   ?>
   <br><Br>
    <form action='enroll.php' method='POST'>
    <div class="h4 pb-2 mb-4 text-danger border-bottom border-danger">
  아직 회원가입을 하지 않으셨나요?
</div>

<div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
  아래 버튼을 눌러 회원가입을 진행해주세요
</div><br>
    <input id="enroll" style="float:right;"type='submit' class="btn btn-secondary" value='회원가입'/>
    </form>
</body>
</html>
