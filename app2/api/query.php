<?php
//處理查詢資料的請求
include_once "db.php";
switch($_GET['do']){
    case 'all':
header('Content-Type:applaction/json;charset:utf-8');
echo json_encode($Student->all());
break;
//     case 'def':
    // dd($_GET);
    //         break;
    case 'sex':
        // dd($_GET['val']);
        header('Content-Type:applaction/json;charset:utf-8');
        $users = $Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where substr(`uni_id`,2,1)='{$_GET['val']}'");
        echo json_encode($users);
        break;
    case 'class':
dd($_GET);
        break;
}