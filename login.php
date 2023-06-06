<!DOCTYPE html>
<?php session_start(); ?> <!-- 세션 시작 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normaltic login hw</title>
</head>
<body>
        <h1>2주차 로그인 기능 구현 과제</h1>
        <form action='./logincheck.php' method='get'>
        <input type="text" id="id" name="id" placeholder="여기에 아이디를 치세요">
        <input type="password" id="password" name="password" placeholder="여기에 비밀번호를 치세요">
        <script>
                function idalert (){
                    inputid = document.getElementById('id').value;
                    inputpwd = document.getElementById('password').value;
                    if (inputid == 'bg5294' && inputpwd == '1111'){
                        alert ('로그인에 성공했습니다');
                        // window.location.replace('logincheck.php');
                    } else {
                        alert ('입력하신 정보가 맞지 않습니다');
                    } //id 값과 비번값을 javascript에서 받아올 수 있는 함수
                }
        </script>
        <input type="submit" value="제출" onclick="idalert()" >
        </form>
    </body>
</html>