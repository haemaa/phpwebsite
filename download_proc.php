<?php
    if(isset($_GET['filename'])){
        //파일 이름 및 경로 가져오기
        $filename = $_GET['filename'];
        $filepath ='./upload/'.$filename;

        if(file_exists($filepath)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            echo '파일이 존재하지 않습니다';
        }
    } else {
        echo '파일 이름이 전달되지 않았습니다';
    }
?>