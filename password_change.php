<!DOCTYPE html>
<?php
session_start();
//세션 아이디 $login_id에 저장
$login_id =$_SESSION['id'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 변경</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php
require('nav.html');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<br><br>
<form style="margin-left:10px;" class="row g-3" action="pass_proc.php" method="POST">
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">비밀번호 확인</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="비밀번호 확인">
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" name="input_pass" class="form-control" id="inputPassword2" placeholder="Password">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-secondary mb-3">확인</button>
  </div>
</form>

<?php
//에러 표시해줌
echo $_SESSION['msg'];
unset($_SESSION['msg']);
?>
</body>
</html>