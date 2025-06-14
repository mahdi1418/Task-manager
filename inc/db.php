<?php
require_once 'config.php';
function db_connection(){
    global $config;
    $conn = mysqli_connect($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
    if($conn){
        return $conn;
    }

    return false;
}













// function db_insert($table_name , $input_array = array()){
//     $connection = db_connection();
//     $keys_string = '';
//     $values_string = '';
//     $array_length = count($input_array);
//     $i = 1;

//     foreach($input_array as $key => $value){
//         $keys_string .= $key;
//         $values_string .= "'$value'";

//         if($i < $array_length){
//             $keys_string.= ',';  
//             $values_string .= ',';  
//         }
//         $i++;
//     }

//     $sql = "INSERT INTO `$table_name` ($keys_string) VALUES ($values_string)";
//     $result = mysqli_query($connection,$sql);
//     return $result;
// }

// function db_delete($table_name, $input_array){
//     $connection = db_connection();
//     $where_string = '';
    
//     $array_length = count($input_array);
//     $i = 1;

//     foreach($input_array as $key => $value){
//         $where_string .= "$key='$value'";

//         if($i < $array_length){
//             $where_string .= ' AND ';
//         }
//         $i++;
//     }

//     $sql = "DELETE FROM $table_name WHERE $where_string";
//     $result = mysqli_query($connection,$sql);
//     return $result;


// function db_update($table_name,$new_data,$where){
//     $connection = db_connection();
// }

// function db_select($sql){
//     $connection = db_connection();
//     $result = mysqli_query($connection,$sql);
//     $output = mysqli_fetch_all($result);
//     return $output;
// }

// function db_select_one($sql){
//     $connection = db_connection();
//     $result = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` = ''");
//     $output = mysqli_fetch_row($result);
//     return $output;
// }
?>
