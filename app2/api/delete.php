<?php
//處理刪除資料的請求
include_once "db.php";
if(isset($_POST['id'])){
    $Student->del($_POST['id']);
}

?>