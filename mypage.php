<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    //세션 아이디 $login_id에 저장
    $login_id =$_SESSION['id'];

    //DB연결
    $con = mysqli_connect('localhost','root','1234','test');
    //타입 때문에 $login_id에 작은 따옴표 꼭 붙여야 함
    $mypage_query = "SELECT * FROM user WHERE username='$login_id'";
    $myp_result = $con->query($mypage_query);
    $myp = $myp_result->fetch_array();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이 페이지</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        //상단 바 생성
        require("./nav.html");
    ?>
    <br>
    <h1>마이 페이지</h1>
    <hr>
    <br><Br>
    <table class="table table-striped table-hover">
        <tr>
        <div class="center">
        <th>ID</th>
        <td><?php echo $myp['username'];?></td></div>
</tr>
        <tr>
        <th>이메일</th>
        <td><?php echo $myp['email'];?></td></div>
</tr>
        <tr>
        <th>휴대전화 번호</th>
        <td><?php echo $myp['phone'];?></div></td>
        <tr>
        <th>주소</th>
        <td><?php echo $myp['address'];?></td>
</div>
</table>
<p>
<br><br>
    <a href="./mypage_update.php"><button class="btn btn-outline-secondary">수정</button></a>
    &nbsp;&nbsp;&nbsp;<a href="./password_change.php"><button class="btn btn-outline-secondary">비밀번호 변경</button></a>
    <a href="./main.php" class="btnLIst btn"><button class="btn btn-outline-warning">메인 페이지로</button></a>
</body>
</html>