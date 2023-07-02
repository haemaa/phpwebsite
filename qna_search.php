<!DOCTYPE html>

<?php
session_start();

$con = mysqli_connect('localhost','root','1234','test');
//get으로 카테고리와 검색값을 받음
$category = $_GET['category'];
$search_title= $_GET['search'];

if(isset($_GET['ord_ca'])){
  $ord_ca = $_GET['ord_ca'];
} else {
  //정렬을 안했을 때
  $ord_ca = 'number';
}

//get으로 날짜 지정값을 받음
$pre_date = $_GET['pre_date'];
$end_date = $_GET['end_date'];


//GET으로 page받음
if(isset($_GET['page'])){
  $page = $_GET['page'];
} else {
  $page = 1;
}



if($category=='title'){
  $catname = "제목";
} else if ($category=="name"){
  $catname = "작성자";
} else if ($category=="content"){
  $catname = '내용';
}


if($pre_date&&$end_date){
  $query = "SELECT * FROM qna_board WHERE $category LIKE '%$search_title%' AND date BETWEEN '$pre_date' and '$end_date' ORDER BY $ord_ca DESC" ;
} else {
  $query = "SELECT * FROM qna_board WHERE $category like '%$search_title%' order by $ord_ca desc";
}


$result = $con->query($query);

?>

<style>
#page_num{
    font-size: 14px;
    margin:0 auto;
    text-align:center;
}

#page_num ul{
  text-align:center;
}

#page_num ul li {
    margin-left: 10px;
    display:inline-block;
}

.fo_re {
    font-weight: bold;
    color:red;
}

.space {
  float: right;
}

.table thead th{
  text-align: center;
}

.table tbody tr{
  text-align: center;
}

.container{
  display: inline-block;
  margin: 0 auto;
  text-align: center;
}
.date {
  text-align: center;
}
</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php
require('./nav.html');
?>
<br>
    <h1>문의 게시판 검색결과</h1>
   <hr>
    <th><?php echo $catname." 내에서 ".$_GET['search']." 검색결과 표시" ?>
    <p>


</th>
    
    <th>
    <a href="./qna_write.php"><button itype="button" class="btn btn-outline-success space">글쓰기</button></a>
    </th>

    <table class="table">
        <thead>
            <tr>
                <th width="70">번호</th>
                <th width="300">제목</th>
                <th width="130">글쓴이</th>
                <th width="120">작성일</th>
            </tr>
        </thead>      
        <?php
        $row_num = mysqli_num_rows($result); //게시판 총 개수
        $list = 5; //한 페이지에 보여줄 개수
        $block_ct = 5; //블록당 보여줄 페이지 개수
        $block_num = ceil($page/$block_ct); //현재 페이지 블록 구하기
        $block_start = (($block_num-1)* $block_ct)+1; //블록의 시작번호
        $block_end= $block_start + $block_ct -1; //블록 마지막 번호

        $total_page = ceil($row_num/$list); //페이징한 페이지 수 구하기
        if($block_end >$total_page){
          $block_end = $total_page;
        } //만약 블록의 마지막 번호가 페이지수보다 많다면 마지막번호는 페이지 수
        $total_block = ceil($total_page/$block_ct); //블럭 총 개수
        $start_num = ($page-1)*$list; //시작번호 (page -1)에서 $list 를 곱한다.
       
        if($pre_date&&$end_date){
          $query3 = "SELECT * FROM qna_board WHERE $category LIKE '%$search_title%' AND date BETWEEN '$pre_date' AND '$end_date' order by $ord_ca DESC limit $start_num,$list";
        } else {
          $query3 = "SELECT * FROM qna_board WHERE $category like '%$search_title%' order by $ord_ca desc limit $start_num,$list";
        }
  
        $result3 = $con ->query($query3);
          while($s_board = $result3->fetch_array()){
            $title = $s_board['title'];
            $number = $s_board['number'];
            $lockpost = $s_board['lock_post'];
            if(isset($s_board['name'])){
            $name = $s_board['name']; //작성자
            } else {
             $name = "익명"; 
            }
            $date = $s_board['date'];
            if(strlen($title)>30){
                $title = str_replace($s_board['title'],mb_substr($s_board['title'],0,30,"utf-8")."...",$s_board['title']);
            }
          
          //title이 30글자가 넘어가면 ...표시
          ?>
        <tbody>
            <tr>
                <td width="70"><?php echo $number; ?></td>
                <td width="300">
                <?php 
                  $locking = "<img src='./image/lockpost.png' alt='lock' title='lock' width='20' height='20'";
                if($lockpost == '0'){ ?>
                  <a href="./qna_read.php?number=<?php echo $s_board['number'];?>"><?php echo $title;?></td>
                  <?php } else { ?>
                  <a href="./ck_read.php?number=<?php echo $s_board['number'];?>"><?php echo $title,$locking;?></td>
                  <?php } ?>
                <td width="130"><?php echo $name; ?></td>
                <td width="120"><?php echo $date; ?></td>
            </tr>    
        </tbody>
        <?php
          }
          ?>
        </table>
       <div id="page_num">
         <ul>
          <?php
          if($page <= 1)
          { //만약 page가 1보다 크거나 같다면
            echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시
          } else {
            echo "<li><a href='?page=1&ord_ca=$ord_ca'>처음</a></li>"; //아니라면 처음글자에 1번페이지로 갈 수 있게 링크
          }
          if($page <= 1){    
          } else {
            $pre = $page -1;
            echo "<li><a href='?category=$category&search=$search_title&page=$pre&pre_date=$pre_date&end_date=$end_date&ord_ca=$ord_ca'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면 
              echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<li><a href='?category=$category&search=$search_title&page=$i&pre_date=$pre_date&end_date=$end_date&ord_ca=$ord_ca'>[$i]</a></li>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li><a href='?category=$category&search=$search_title&page=$next&pre_date=$pre_date&end_date=$end_date&ord_ca=$ord_ca'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li><a href='?category=$category&search=$search_title&page=$total_page&pre_date=$pre_date&end_date=$end_date&ord_ca=$ord_ca'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
          ?>
        </ul>
        <br><Br>
        <div class="input-group mb-3 container">
          <form action="qna_search.php" method="GET" style="margin: auto;">
          <select name="category">
             <option value="title">제목</option>
             <option value="name">글쓴이</option>
             <option value="content">내용</option> 
            </select>
  <input type="text" name="search" placeholder="검색할 게시글 입력" required="required">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">검색</button>
  <br>
  <div>시작일: <input type="date" name="pre_date" id="pre_date" data-placeholder="시작 날짜"/>
   &nbsp;종료일: <input type="date" name="end_date" id="end_date" /></div>        
  </form>
    </div>
</body>
</html>
