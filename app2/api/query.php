<?php
//處理查詢資料的請求
include_once "db.php";
switch($_GET['do']){
    case 'all':
header('Content-Type:applaction/json;charset:utf-8');
echo json_encode($Student->all());
        break;
    case 'def':
dd($_GET);
        break;
    case 'sex':
dd($_GET);
        break;
    case 'class':
dd($_GET);
        break;
}