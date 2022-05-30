<?php 
/* 
* Copyright (c) 2022 Flavio Ansovini (perniciousflyer@gmail.com)  
* This code is a part of the ochin project (https://github.com/ochin-space)
* For license details see the LICENSE.md file included in the project. 
*/
require 'helper/SQLiteConstructor.php';
require 'helper/Config.php';

$dbConstructor = new SQLiteConstructor();
$ochin_db = $dbConstructor->connect(Config::emptyTemplate_db);
session_start();
?>