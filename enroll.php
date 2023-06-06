<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if(isset($_SESSION['is_login'])){
        header('Location: ./main.php');
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function checkid(){
            var userid = document.getElementById("uid").value;
            if(userid){
                url = 'check_id.php?userid='+userid;
                    window.open(url,"chkid","width=300px,height=300px");
            } else {
                alert('아이디를 입력하세요');
            }
        }
        function address(){
            address_url = "address.php";
            window.open(address_url,"addr",'width=300,height=300, scrollbars=no, resizable=no');
        }

    </script>
    <link rel="stylesheet" type='text/css' href='test.css'>
</head>
<body>
    <h1>회원가입 페이지</h1>
    <br>
        <form action='enroll_proc.php' method='post'>
            <div class="center">
            ID
            <div style="text-align:left"><input type="text" id='uid' name='username' class="input"></div>
            <input type='button' value='중복체크' onClick='checkid();'>
            <br>
            비밀번호
            <div style="text-align:left"><input type="text" name="pwd" class="input"></div>
            <br>
            이메일
            <div style="text-align:left"><input type="text" name="email" class="input"></div>
            <br>
            휴대전화 번호
            <div style="text-align:left"><input type="text" name="phone" class="input"></div>
            <br><br>
            <div class=subject>주소 입력</div>
            <input class=textform type='text' name='join_addr' id='addr' onClick='address();' placeholder="주소를 검색해주세요." required>
            <input type="submit" value="가입하기" class="enroll">
        </form>
    </div>
</body>
</html>