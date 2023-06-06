<?php
session_start();
echo '<script> if (confirm("정말 로그아웃 하시겠습니까?")){';
session_destroy();
header('Location: ./test.php');
echo '} ;</script>';
?>
