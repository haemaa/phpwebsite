<?php
session_start();


$con = mysqli_connect('localhost','root','1234','test');
// mysqli_select_db($con,'test');
$input_id = $_POST['id'];
$input_pw = $_POST['pw'];

//아이디가 있는지 없는지 검사
$query = "SELECT username,password FROM user WHERE username='$input_id'";
$result = $con -> query($query); //쿼리문을 데이터베이스에 적용시켜라

//아이디가 있으면 비밀번호 검사
if(mysqli_num_rows($result)>=1) {
    $row=mysqli_fetch_assoc($result);

    if($row['password']==$input_pw){
        $_SESSION['is_login']=true;
        $_SESSION['id']=$input_id;
        header('Location: ./main.php');
    } else {
        $_SESSION['msg']='wrong id or pw';
        header('Location: ./test.php');
    }
}else{
    $_SESSION['msg']='null id or pw';
    header('Location: ./test.php');
}
?>
