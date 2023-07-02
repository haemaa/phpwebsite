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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
            window.open(address_url,"addr",'width=350,height=300, scrollbars=no, resizable=no');
        }

    </script>
    <link rel="stylesheet" type='text/css' href='test.css'>
</head>
<body>
<span class="d-block p-2 text-bg-dark"><h1>회원가입 페이지</h1></span>
<span class="d-block p-2 text-bg-secondary">made by bokyu</span>

    <br>
        <form action='enroll_proc.php' method='post'>
            <div class="center">
            ID
            <div style="text-align:left"><input type="text" id='uid' name='username' class="input">
            <input type='button' class="btn btn-outline-secondary" value='중복체크' onClick='checkid();'></div>
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
            <input type="submit" class="btn btn-secondary" value="가입하기" class="enroll">
        </form>
    </div>
</body>
</html>
