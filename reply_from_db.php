<?php

// //


// DB Connection //

//echo $url." ".$server." ".$username." ".$password." ".$db;
//$conn = new mysqli($server, $username, $password, $db);
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 ||(substr($haystack, -$length) === $needle);
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function teachToDB($inputMsg,$replyStr) {
  $replyTeachMessageSuccess = "เราเข้าใจนายแล้ว";
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  $conn = new mysqli($server, $username, $password, $db);
  $conn->set_charset("utf8");
  // Check connection
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql = "INSERT INTO linebot (`InputMassage`,`ReplyMassage`) VALUES ('".$inputMsg."','".$replyStr."')";
  $queryrResult = $conn->query($sql);
  if ($queryrResult) {
     $conn->close();
    return $replyTeachMessageSuccess;
  }else{
     $conn->close();
    return "ไม่สามารถเพิ่มข้อมูลได้อ่ะ";
  }
}

function replyFromDB($inputMsg) {
  $replyTeachMessage = "คือไรอ่ะ งง สอนเราหน่อยใช้คำสั่ง : input(\"ข้อความถาม\",\"ข้อความตอบ\")";
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  $conn = new mysqli($server, $username, $password, $db);
  $conn->set_charset("utf8");
   $inputMsg = get_string_between($inputMsg,"!","");
  // Check connection
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $result = "ควยไรมึง";

  //execute the SQL query and return records
   $sql = "SELECT * FROM linebot where InputMassage='".$inputMsg."'";
  //
  $queryrResult = $conn->query($sql);
  if (mysqli_num_rows($queryrResult)>0) {
    // output data of each row
    //$returnResult = mysqli_num_rows($queryrResult);
    // Cycle through results
    $group_arr = [];
     while ($row = $queryrResult->fetch_object()){
         $group_arr[] = $row;
     }
    $rand_keys = array_rand($group_arr, 1);
    $textReply = $group_arr[$rand_keys];

    error_log($textReply->ReplyMassage);
    mysqli_free_result($queryrResult);
     $conn->close();
    return $textReply->ReplyMassage;


  } else {
     $conn->close();
      return $replyTeachMessage;
  }

  // if ($result->num_rows > 0) {
  //     // output data of each row
  //     // while($row = $result->fetch_assoc()) {
  //     //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  //     // }
  //     // Else Data Exits //
  //     $rand_keys = array_rand($result, 1);
  //     $textReply = $result[$rand_keys[0]];
  //     //close the connection
  //     mysql_close($dbhandle);
  //     return $textReply['ReplyMassage'];
  // } else {
  //     echo "0 results";
  //     return $replyTeachMessage;
  // }
//  $conn->close();

  //return $result;


}



?>
