<?php
session_start();

//클릭한 게시글의 number를 가져옴
$bno = $_GET['number'];

//데이터베이스 연결 기본 셋팅
$con = mysqli_connect('localhost','root','1234','test');
$query = "SELECT * FROM qna_board WHERE number='$bno';";
$result = $con->query($query);
$board = $result->fetch_array();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의 게시판 글쓰기</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <?php
    require('nav.html');
    ?>
    <style>
    #boardwrite{
    margin:0 auto;
    }

    </style>

        <h1>문의 게시판 글수정</h1>
        <hr>
        <div id="boardwrite">
        <h6>문의게시판 글수정</h6>
        <br>
            <form action="./qna_modify_proc.php?number=<?php echo $bno; ?>" method="POST" enctype="multipart/form-data">
                <table id="boardwrite">
                    <thead>
                        <tr>
                            <th>제목</th>
                            <td class="title"><textarea style="width:700px;" type="text" name="bTitle" id="bTitle"><?php echo $board['title']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td class="content"><textarea style="width:700px;height:400px;" name="bContent" id="bContent"><?php echo $board['content']; ?></textarea></td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td class="phone"><textarea placeholder="비밀글로 하시려면 작성해주세요" style="width:700px;" type="text" name="bPhone" id="bPhone"></textarea></td>
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
