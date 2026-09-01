<?php

mysqli_report(MYSQLI_REPORT_ERROR);

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$db){

     db_log(mysqli_connect_error());

    include('db-error.php');
    exit ;
    
}