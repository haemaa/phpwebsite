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
    <title>개인 정보 수정</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        //상단 바 생성
        require("./nav.html");
    ?>

<br>
    <h1>마이 페이지 수정</h1>
    <hr>
    <br>
    <table>
    <form action="myp_update_proc.php" method="post">
        <div>
        <tr>
        <th>ID</th>
        <td><textarea type="text" name="myp_username" id="username"><?php echo $myp['username'];?></textarea></td>
    </div>
</tr>
        <div>
        <tr>
        <th>이메일</th>
        <td><textarea type="text" name="myp_email" id="email"><?php echo $myp['email'];?></textarea></td>
    </div>
</tr>
        <div>
        <tr>
        <th>휴대전화 번호</th>
        <td><textarea type="text" name="myp_phone" id="phone"><?php echo $myp['phone'];?></textarea></td>
    </div>
</tr>
        <div>
        <tr>
            <th>주소</th>
        <td><textarea type="text" name="myp_address" id="address"><?php echo $myp['address'];?></textarea></td>
    </div>
</tr>
    </table>
    <br>
    <div class="btnSEt">
    <button type="submit" class="btn btn-outline-success" onclick="return confirm('현재 상태로 수정하시겠습니까?')">수정 완료</button></div>
    </form>
</body>
</html>