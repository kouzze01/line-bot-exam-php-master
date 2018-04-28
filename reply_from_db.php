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



function teachToDB($inputMsg) {

  return $replyTeachMessageSuccess;
}

function replyFromDB($inputMsg) {
  $conn = new mysqli($server, $username, $password, $db);

  $result = $conn->query("SELECT ID,InputMassage,ReplyMassage FROM Line_DB where InputMassage=".$inputMsg)
  return $result;
  // if (mysql_num_rows($result)==0) {
  //
  //   mysql_close($dbhandle);
  //   return $replyTeachMessage;
  // }else{
  //   // Else Data Exits //
  //   $rand_keys = array_rand($result, 1);
  //   $textReply = $result[$rand_keys[0]];
  //   //close the connection
  //   mysql_close($dbhandle);
  //   return $textReply{'ReplyMassage'};
  //
  // }



}



?>
