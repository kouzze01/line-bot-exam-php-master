<?php

// //

$replyTeachMessage = "คือไรอ่ะ งง สอนเราหน่อยใช้คำสั่ง : \"input(\"ข้อความถาม\",\"ข้อความตอบ\")\"";
$replyTeachMessageSuccess = "เราเข้าใจนายแล้ว";
// DB Connection //

$username = "iyaphatt";
$password = "RhRiyd2774";
$hostname = "103.86.51.212";



function teachToDB($inputMsg) {

  return $replyTeachMessageSuccess;
}

function replyFromDB($inputMsg) {
  //connection to the database
  $dbhandle = mysql_connect($hostname, $username, $password)
   or die("Unable to connect to MySQL");
  echo "Connected to MySQL<br>";
  //select a database to work with
  $selected = mysql_select_db("test",$dbhandle)
    or die("Could not select examples");

  //execute the SQL query and return records
  $result = mysql_query("SELECT ID,InputMassage,ReplyMassage FROM Line_DB where InputMassage=".$inputMsg);
  if (mysql_num_rows($result)==0) {

    mysql_close($dbhandle);
    return $replyTeachMessage;
  }else{
    // Else Data Exits //
    $rand_keys = array_rand($result, 1);
    $textReply = $result[$rand_keys[0]];
    //close the connection
    mysql_close($dbhandle);
    return $textReply{'ReplyMassage'};

  }



}



?>
