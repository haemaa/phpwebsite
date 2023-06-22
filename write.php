<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 글쓰기</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php
require('./nav.html');
?>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <article class="article">
        <BR>
        <h1>게시판 글쓰기</h1>
        <HR>
        <div id="boardwrite">
            <form action="./write_update.php" method="POST" enctype="multipart/form-data">
                <table id="boardwrite">
                    <caption class="readHIde">자유게시판 글쓰기</caption>
                    <tbody>
                        <tr>
                            <th scope="row"><label for="bTitle">제목</label></th>
                            <td class="title"><input type="text" name="bTitle" id="bTitle"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="bContent">내용</label></th>
                            <td class="content"><textarea name="bContent" id="bContent"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="bPassword">비밀번호</label></th>
                            <td class="password"><input type="text" name="bPassword" id="bPassword"></td>
                        </tr>
                    </tbody>
                    <div class="btnSEt">
                        
                        <button style="background-color:pink" type="submit"><div>작성</div></button>
                    </div>
                    <input type="file" name="board_file" />
                </form> 
                <a href="noticeboard.php" class="btnLIst btn"><div style="border:2px solid grey;">목록</div></a>          
            </div>
        </article>
</body>
</html>