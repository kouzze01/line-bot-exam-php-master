<?php // callback.php

require "vendor/autoload.php";
require_once("reply_from_db.php");
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'LGHmeErIoWEVY15w4l5sHPIKhEDSlf2Q8HQ77pBMEKwu9l5DQ4A0ZTepyDD4DnGR6JuIqU6tVtNhBmHL+oF+OVj9HCPXZz0doP0cxmY9LpdslVwyzEIerZWbNt7gYkVmjBYgB7F0fYxufc5Ux0VNgAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// test tonson


// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			//$text = $event['source']['userId'];
			$text = $event['message']['text'];
			if(strpos($text, 'สมหมาย') !== false){ // ($text contains 'สมหมาย')
				$replyTextMsg = "ถ้าอยากเรียกใช้ สมหมาย ให้ใส่ ! ข้างหน้าหน้าข้อความนะจ๊ะ";
			}else{
					if(startsWith($text,"input(\"")){
						$inputStr = get_string_between($text,'input("','",');
						$replyStr = get_string_between($text,',"','")');
						$replyTextMsg = teachToDB($inputStr,$replyStr);
					}else{
						if(startsWith($text,"!")){
							$replyTextMsg = replyFromDB($text);
						}
					}
			}


			// Reply message Logic //


			//  End Reply message Logic  //




			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $replyTextMsg
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			// Check Sticker input
		}else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {
			$text = "ส่งสติ๊กเกอร์ ทำควยไร";
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			/*$messages = [
				'type' => 'sticker',
				'packageId' => '1',
				'stickerId' => '131'
			];*/

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
