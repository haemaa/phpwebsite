<?php
$con = mysqli_connect('localhost','root','1234');
mysqli_select_db($con,'test');
$uid = $_GET['userid'];

//아이디가 있는지 없는지 검사
$query = "SELECT * FROM user WHERE username='".$uid."'";
$result = $con -> query($query); //쿼리문을 데이터베이스에 적용시켜라
$member=mysqli_fetch_array($result);
if ($member == 0){
    echo $uid."는 사용가능한 아이디입니다.";
} else {
    echo $uid."는 중복된 아이디입니다.";
}

?>
<button value="닫기" onClick="window.close()">닫기</button>