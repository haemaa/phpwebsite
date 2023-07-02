<?php
//비회원도 이용가능해야하므로 세션없어도 이용가능해야함
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의 게시판 글쓰기</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php
require('./nav.html');
?>
<style>
#boardwrite{
    margin:0 auto;
}

</style>


</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <BR>
        <h1>문의 게시판 글쓰기</h1>
        <HR>
            <form action="./qna_write_proc.php" method="POST" enctype="multipart/form-data">
                <table id="boardwrite">
                    <thead>
                        <tr>
                            <th>제목</th>
                            <td class="title"><input style="width:700px;" type="text" name="bTitle" id="bTitle"></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td class="content"><textarea style="width:700px;height:400px;" name="bContent" id="bContent"></textarea></td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td class="phone"><input placeholder="비밀글로 하시려면 작성해주세요" style="width:700px;" type="text" name="bPhone" id="bPhone"></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <!-- 게시글 잠금 기능 -->
                        <input type="checkbox" value="1" name="lockpost" id="lockpost"/> 비밀글 설정
                        </td>
                        </tr>    
                        </thead>
                        <tbody>
                        <tr>
                            <th></th>
                            <td>
                                <input type="file" name="board_file" />
                            <a href="qna_board.php" class="btnLIst btn"><div style="margin-left:300px;border:2px solid grey;">목록</div></a> 
                            <button 
                            style="background-color:pink" 
                            type="submit" 
                            onClick=
                            "return confirm('이대로 작성하시겠습니까? \n전화번호를 남기셨으면 차후 전화번호인증을 통해 게시글을 열람할 수 있습니다.')">
                            <div class="btnSEt">작성</div>
                            </button>
                        </td>
                        </tr>
                    
                        </tbody>
                    </table>
                </form> 
</body>
</html>
