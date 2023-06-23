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
        <h1>문의 게시판 글수정</h1>
        <hr>
        <div id="boardwrite">
        <h6>문의게시판 글수정</h6>
        <br>
            <form action="./qna_modify_proc.php?number=<?php echo $bno; ?>" method="POST">
                <table>
                    <thead>
                    <tr>
                            <th>비밀번호</th>
                            <td class="password"><input type="text" name="bPassword" id="bPassword"></td>
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td class="title"><textarea type="text" name="bTitle" id="bTitle" maxlength="100"><?php echo $board['title']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td class="content"><textarea name="bContent" id="bContent" maxlength="100"><?php echo $board['content']; ?></textarea></td>
                        </tr>
                        </thead>
            </table>
            <br>
            <div class="btnSEt">
                        <button type="submit" class="btnSubmit btn">수정 완료</button>
                        <a href="./qna_board.php" class="btnLIst btn">목록</a></div>
                    </form>   
</body>
</html>
