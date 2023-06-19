<!DOCTYPE html>

<?php
session_start();

$con = mysqli_connect('localhost','root','1234','test');
$query = "SELECT * FROM board";
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
<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hacking 페이지</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./main.php">메인 페이지로</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<br>
    <h1>자유게시판</h1>
<!--날짜 지정 검색 구현/3가지 태그를 나열하기 위해 table 태그 사용-->
   
  <tr>
<th>원하는 내용을 자유롭게 작성해주세요!</th>
<th>
    <a href="./write.php"><button itype="button" class="btn btn-outline-success space">글쓰기</button></a>
</th>
</tr>
    <table class="table">
        <thead>
            <tr>
                <th width="70">번호</th>
                <th width="300">제목</th>
                <th width="130">글쓴이</th>
                <th width="120">작성일</th>
                <th width="70">조회수</th>
                <th width="70">추천수</th>
            </tr>
        </thead>      
        <!-- 페이징 -->
        <?php
        if(isset($_GET['page'])){
          $page = $_GET['page'];
        } else {
          $page = 1;
        }

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

        $query2 = "SELECT * FROM board order by number desc limit $start_num,$list";
        $result2 = $con ->query($query2);
          while($board = $result2->fetch_array()){
            $title = $board['title']; //게시글 제목
            $number = $board['number']; //게시글 번호
            $name = $board['name']; //작성자
            $date = $board['date']; //작성 날짜
            $thumbup = $board['thumbup']; //좋아요 수
            $hit = $board['hit']; //조회수
            if(strlen($title)>30){
                $title = str_replace($board['title'],mb_substr($board['title'],0,30,"utf-8")."...",$board['title']);
            }
          
          //title이 30글자가 넘어가면 ...표시
          ?>
        <tbody>
            <tr>
                <td width="70"><?php echo $number; ?></td>
                <td width="300"><a href="./read.php?number=<?php echo $board['number'];?>"><?php echo $title;?></td>
                <td width="130"><?php echo $name; ?></td>
                <td width="120"><?php echo $date; ?></td>
                <td width="50"><?php echo $hit; ?></td>
                <td width="50"><?php echo $thumbup; ?></td>
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
            echo "<li><a href='?page=1'>처음</a></li>"; //아니라면 처음글자에 1번페이지로 갈 수 있게 링크
          }
          if($page <= 1){    
          } else {
            $pre = $page -1;
            echo "<li><a href='?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면 
              echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<li><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
            }
          }
          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li><a href='?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li><a href='?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
          ?>
        </ul>
        <br><Br>
        <div class="input-group mb-3 container">
          <!-- 검색 항목 form 태그 -->
          <form action="search_result.php" method="GET" style="margin: auto;">
            <select name="category">
             <option value="title">제목</option>
             <option value="name">글쓴이</option>
             <option value="content">내용</option> 
            </select>
  <input type="text" name="search" placeholder="검색할 게시글 입력" required="required">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">검색</button>
  <div class="date">
    <br>    
    <div>시작일: <input type="date" name="pre_date" id="pre_date" data-placeholder="시작 날짜"/>
   종료일: <input type="date" name="end_date" id="end_date" /></div>
  </form>  
  </div>
    </div>
</body>
</html>