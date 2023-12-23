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
$stnums = $ClassStudent->all(['class_code'=>$_GET['val']]);//拿到的是一個二維陣列，因為要單獨拿出code這個欄位的值去找student的全部資料，所以用foreach
$nums = [];
foreach($stnums as $stn){
    $st = $Student->find(['school_num'=>$stn['school_num']]);//用學號去找student裡相對應的學生資料，再存入id，之後用id去帶出條件下的全部資料表
    if(!empty($st)){//如果有找到這此資料再放進來
        $nums[]=$st['id'];
        }
    }
    //再把拿到的陣列串進where in
    $in = join(",",$nums);
$users = $Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where `id` in($in)");
header('Content-Type:applaction/json;charset:utf-8');
echo json_encode($users);
            break;

            case 'classes':
                $classes = $Classes->q("select `code`,`name` from `classes`");
                header('Content-Type:applaction/json;charset:utf-8');
                echo json_encode($classes);
                break;
            }
