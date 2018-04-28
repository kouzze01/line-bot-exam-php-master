<?php

// //

$replyTeachMessage = "คือไรอ่ะ งง สอนเราหน่อยใช้คำสั่ง : \"input(\"ข้อความถาม\",\"ข้อความตอบ\")\"";
$replyTeachMessageSuccess = "เราเข้าใจนายแล้ว";
// DB Connection //

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

//$server = $url["host"];
$server = 'localhost';
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);



function teachToDB($inputMsg) {

  return $replyTeachMessageSuccess;
}

function replyFromDB($inputMsg) {
  $conn = mysqli_connect($server, $username, $password, $db);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


  //execute the SQL query and return records
  $sql = "SELECT ID,InputMassage,ReplyMassage FROM linebot where InputMassage=".$inputMsg;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      // while($row = $result->fetch_assoc()) {
      //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      // }
      // Else Data Exits //
      $rand_keys = array_rand($result, 1);
      $textReply = $result[$rand_keys[0]];
      //close the connection
      mysql_close($dbhandle);
      return $textReply['ReplyMassage'];
  } else {
      echo "0 results";
      return $replyTeachMessage;
  }
  $conn->close();




}



?>
