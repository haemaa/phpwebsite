<?php
session_start();
$login_id = $_SESSION['id'];


//클릭할 때 number GET으로 가져옴
$bno = $_GET['number'];

$con = mysqli_connect('localhost','root','1234','test');

//POST로 전달받은 게시판 넘버를 저장한다 (SQL Injection 대응을 하면서)
//strip_tags로 태그 제거하고 filter_var로 유효성 검사 수행
$boardlike_id = mysqli_real_escape_string($con,filter_var(strip_tags($bno), FILTER_SANITIZE_SPECIAL_CHARS));

//window.history.back을 쓰면 뒤로가기 됨
$sql_check = "SELECT * FROM board WHERE number=$boardlike_id";
$res_check = mysqli_fetch_array(mysqli_query($con, $sql_check));
if($login_id == $res_check['name']){
    $hit_query = "UPDATE board SET hit=hit-1 WHERE number=$boardlike_id";
    mysqli_query($con,$hit_query);
    echo "<script>alert('본인의 게시글입니다!');";
    echo "window.history.back()</script>";
    exit;
}

//like_manger DB에 저장
$sql_check2 = "SELECT * FROM like_manager WHERE like_board_id='$boardlike_id' and username='$login_id'";
$res_check2 = mysqli_fetch_array(mysqli_query($con, $sql_check2));
$delete_like_query = "
UPDATE board SET thumbup= thumbup-1 WHERE number=$boardlike_id;
DELETE FROM like_manager WHERE like_board_id=$boardlike_id and username='$login_id';
";

if($res_check2){
  $hit_query = "UPDATE board SET hit=hit-1 WHERE number=$boardlike_id;";
    mysqli_query($con,$hit_query);
    //확인을 누르면 멀티쿼리가 실행되면서 좋아요 수를 1 감소시키고 데이터를 삭제시킴
    echo "<script>if(confirm('이미 좋아한 게시글입니다! 좋아요를 취소하시겠어요?')==true){
      ".mysqli_multi_query($con, $delete_like_query).";
    } else {};
    </script>";
    
    echo "<script>window.history.back()</script>";
    exit;
}

$sql = "
UPDATE board SET thumbup =thumbup +1,hit=hit-1 WHERE number=$boardlike_id;
INSERT INTO like_manager(like_board_id, username) VALUES ($boardlike_id, '$login_id');
";
$res = mysqli_multi_query($con, $sql);
echo "<script>alert('좋아요를 눌렀습니다!');";
echo "window.history.back()</script>";
?>