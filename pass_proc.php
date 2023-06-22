<!DOCTYPE html>
<?php
session_start();
//세션 아이디 $login_id에 저장
$login_id =$_SESSION['id'];

//입력한 비밀번호 받음
$input_pass = $_POST['input_pass'];


//DB연결
$con = mysqli_connect('localhost','root','1234','test');
//타입 때문에 $login_id에 작은 따옴표 꼭 붙여야 함
$pass_query = "SELECT * FROM user WHERE username='$login_id'";
$pass_result = $con->query($pass_query);
$pass = $pass_result->fetch_array();

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
    <?php
    $_SESSION['msg']='비밀번호가 잘못되었습니다';
    //차후에 해쉬처리하면 변경해야함 md5나 SH256
if($input_pass == $pass['password']){
echo '<br><br><form style="margin-left:10px;" class="row g-3" action="pass_proc2.php" method="POST">
<div class="col-auto">
  <label for="staticEmail2" class="visually-hidden">변경할 비밀번호</label>
  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="변경할 비밀번호">
</div>
<div class="col-auto">
  <label for="inputPassword2" class="visually-hidden">Password</label>
  <input type="password" name="new_pass" class="form-control" id="inputPassword2" placeholder="Password">
</div>
<div class="col-auto">
  <button type="submit" class="btn btn-secondary mb-3">변경</button>
</div>
</form>';
} else {
    echo $_SESSION['msg'];
    header('Location: ./password_change.php');
};
    ?>
</body>
</html>
