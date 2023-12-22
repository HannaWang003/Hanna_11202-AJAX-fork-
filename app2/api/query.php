<?php
//處理查詢資料的請求
include_once "db.php";
$Student = new DB('students');
switch ($_GET['do']) {
    case 'all':
        header('Content-Type:application/json;charset=utf8');
        echo json_encode($Student->all());
        break;
    case 'def':
        dd($_GET);
        break;
}