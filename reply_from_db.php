<?php

// //

$replyTeachMessage = "คือไรอ่ะ งง สอนเราหน่อยใช้คำสั่ง : \"input(\"ข้อความถาม\",\"ข้อความตอบ\")\"";
$replyTeachMessageSuccess = "เราเข้าใจนายแล้ว";
// DB Connection //

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
//echo $url." ".$server." ".$username." ".$password." ".$db;
//$conn = new mysqli($server, $username, $password, $db);

function teachToDB($inputMsg) {

  return $replyTeachMessageSuccess;
}

function replyFromDB($inputMsg) {
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
  $result = "ควยไรมึง";

  //execute the SQL query and return records
   $sql = "SELECT * FROM linebot where InputMassage='".$inputMsg."'";
  //
  $queryrResult = $conn->query($sql);
  if (mysqli_num_rows($queryrResult)>0) {
    // output data of each row
    //$returnResult = mysqli_num_rows($queryrResult);
    $row = $queryrResult->fetch_array(MYSQLI_NUM);
    $rand_keys = array_rand($row, 1);
    $textReply = $row[$rand_keys];
    error_log(serialize($textReply));
    return $textReply[$rand_keys][3];


  } else {
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
