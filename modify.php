<?php
session_start();
if(!isset($_SESSION['id'])){
  header('Location: ./test.php');
}

//클릭한 게시글의 number를 가져옴
$bno = $_GET['number'];

//데이터베이스 연결 기본 셋팅
$con = mysqli_connect('localhost','root','1234','test');
$query = "SELECT * FROM board WHERE number='$bno';";
$result = $con->query($query);
$board = $result->fetch_array();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 글쓰기</title>
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

        <h1>게시판 글수정</h1>
        <hr>
        <br>
            <form action="./modify_proc.php?number=<?php echo $bno; ?>" method="POST" enctype="multipart/form-data">
            <table id="boardwrite">
                    <thead>
                        <tr>
                            <th>제목</th>
                            <td class="title"><textarea style="width:700px;" type="text" name="bTitle" id="bTitle" maxlength="100"><?php echo $board['title']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td class="content"><textarea style="width:700px;height:400px;" name="bContent" id="bContent" maxlength="100"><?php echo $board['content']; ?></textarea></td>
                        </tr>
                        <!-- <tr>
                            <th>비밀번호</th>
                            <td class="password"><input style="width:700px;" type="text" name="bPassword" id="bPassword"></td>
                        </tr> -->
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <td>
                        <input type="file" name="board_file" />
                        <a href="./noticeboard.php" class="btnLIst btn"><div style="margin-left:250px;border:2px solid grey;">목록</div></a>
                        <button style="background-color:pink" type="submit" class="btnSubmit btn"><div class="btnSEt">수정 완료</div></button>
                        </td>
                        </tr>
                        </tbody>
                </table>
                <br>     
            </form>   
</body>
</html>
