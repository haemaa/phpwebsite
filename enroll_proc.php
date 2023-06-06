<?php
 //세션 시작
  session_start();

  //post로 받아온 정보를 변수로 저장한다.
  $sign_name = $_POST['username'];
  $sign_password = $_POST['pwd'];
  $sign_email = $_POST['email'];
  $sign_phone = $_POST['phone'];
  $sign_address = $_POST['join_addr']; //주소 검색 추가
  //DB와 연결
  $conn = mysqli_connect('localhost','root','1234');
  mysqli_select_db($conn,'test');
  $query = "SELECT * FROM user WHERE username='".$sign_name."'";
  $result = $conn -> query($query); //쿼리문을 데이터베이스에 적용시켜라
  $member=mysqli_fetch_array($result);
  $sign = "INSERT INTO `user` (username, password ,email,phone, address) VALUES ('$sign_name','$sign_password','$sign_email','$sign_phone','$sign_address')";
  //현재 아이디, 비번, 이메일 , 폰넘버, 주소검색 추가되어 있음
  if ($member == 0){
  if ($conn -> query($sign)){
    echo "회원가입에 성공했습니다!";
    echo '<form action="gofirst.php" method="post">
    <input type="submit" value="로그인 페이지로 이동"/>
    </form>';
  } else {
    echo '회원가입에 실패하였습니다';
    header('Location: ./enroll.php');
  }
} else {
  echo "아이디 중복체크를 진행해주세요";
  header('Location: ./enroll.php');
}
  conn_close($conn);

?>