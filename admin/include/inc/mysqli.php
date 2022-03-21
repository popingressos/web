<?php
$sql_host = "";      
$sql_username = "root";    
$sql_password = "";       
$sql_database = ""; 


$mysqli = new mysqli($sql_host , $sql_username , $sql_password , $sql_database );

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}
if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($string){
        global $mysqli;
        if($string){
            $newString =  $mysqli->real_escape_string($string);
            return $newString;
        }
    }
}

$conn = null;
if (!function_exists('mysql_query')) {
    function mysql_query($query) {
        global $mysqli;
        if($query) {
            $result = $mysqli->query($query);
            return $result;
        }
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result){
        if($result){
            $row =  $result->fetch_assoc();
            return $row;
        }
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result){
        if($result){
            $row_cnt = $result->num_rows;
            return $row_cnt;
        }
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result){
        if($result){
            $row = $result->fetch_assoc();
            return $row;
        }
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result){
        if($result){
            $row = $result->fetch_row();
            return $row;
        }
    }
}

if (!function_exists('mysql_free_result')) {
    function mysql_free_result($result){
        if($result){
            global $mysqli;
            $result->free();

        }
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, $offset){
        if($result){
            global $mysqli;
            return $result->data_seek($offset);

        }
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close(){
        global $mysqli;
        return $mysqli->close();
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id(){
            global $mysqli;
            $lastInsertId = $mysqli->insert_id;
            return $lastInsertId;
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error(){
        global $mysqli;
        $error = $mysqli->error;
        return $error;
    }
}
?>