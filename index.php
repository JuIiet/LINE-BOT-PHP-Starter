<?php
$access_token = 'YWncz0xqGNNrqyawTvXRMvHv/G4hvOHJBkpCb15pFK0XGV/h7r3PgyDMfwkQ4enqz82877P6dbFZVgSACr1bj4HGoYhN0SwePqXrMo25wB9x5mFcekSKy04y7+QBVariBQMDYEIqkpXpX2nbD5EQrQdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			//Get UserID
			$userId = $event['source']['userId'];
			
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $userId
			];
			
			//$messages = array("type" => "text","text" => 'ทดสอบระบบ');
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages]
			];
			//$data = array("replyToken" => $replyToken,"messages" => [$messages]);
			$post = json_encode($data);
			
			$headers = array('Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $access_token);
			$testvalue = json_encode($headers);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			//echo $result . "\r\n";
			
			$strFileName = "newfile.txt";
			$objFopen = fopen($strFileName, 'w');
			$strText1 = "I Love ThaiCreate.Com Line1\r\n";
			fwrite($objFopen, $testvalue);

		}else if ($event['type'] == 'message' && $event['message']['type'] == 'image'){
		
			$arr = array("U0fa1e57bb597256e92751fe5b8449c18","Ubbbf15ca12440b7dce60d34135901a5e","Uf24d1d8fc96b7db32e551b4b38632a7f");
			// Get text sent
			//$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'image',
				'originalContentUrl' => 'https://github.com/apple-touch-icon.png',
				'previewImageUrl' => 'https://github.com/apple-touch-icon.png'
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			foreach ($arr as $value) {
				$data = [
				'to' => $value,
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
			}
			
			
		}else if($event['type'] == 'message' && $event['message']['type'] == 'sticker'){
			//Get UserID
			$userId = $event['source']['userId'];
			
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$actions = ['type' => 'message',
				    'label' => 'Open',
				    'uri' => 'http://www.efintradeplus.com/'
				   ];
			
			$messages = [ 'type' => 'template',
				     'altText' => 'this is a confirm template',
				     'template' => [ 'type' => 'confirm',
						    'text' => 'คุณคือผู้เริ่มต้น?',
						    'actions'=> [ [ 'type' => 'message',
								   'label' => 'Yes',
								   'text' => "yes" ],
								 [ 'type' => 'message',
								  'label' => 'No',
								  'text' => 'no' ] ] ] 
				    ];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data,true);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
		}
	}
}
// $strFileName = "newfile.txt";
// $objFopen = fopen($strFileName, 'w');
// $strText1 = "I Love ThaiCreate.Com Line1\r\n";
// fwrite($objFopen, $strText1);
// $strText2 = "I Love ThaiCreate.Com Line2\r\n";
// fwrite($objFopen, $strText2);
// $strText3 = "I Love ThaiCreate.Com Line3\r\n";
// fwrite($objFopen, $strText3);
// if($objFopen)
// {
	// echo "File writed.";
// }else{
	// echo "File can not write";
// }

// $content = "some text here";
// $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/newfile.txt","wb");
// fwrite($fp,$content);
// fclose($fp);
// if($objFopen)
// {
	// echo "File writed.";
// }else{
	// echo "File can not write";
// }

// $filename = "newfile.txt";

// chmod($filename,0777);

// $file = fopen( $filename, "w" );
// if( $file == false )
// {
   // echo ( "Error in opening new file" );
   // exit();
// }

// fwrite( $file, "This is  a simple test\n" );
// fclose( $file );




echo "OK3";
?>
