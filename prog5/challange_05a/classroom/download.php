<?php
if(isset($_GET['file'])){
    $filename=$_GET['file'];
    $path="uploads/teacher/".$filename;
    if(file_exists($path)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
    }
}
?>