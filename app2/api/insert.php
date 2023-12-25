<?php
//處理新增資料的請求
include_once "../api/db.php";
$Student->save($_POST);
to("../index.html");
