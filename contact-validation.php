<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/lib/config.php";

use \Mailjet\Resources;

$mj = new \Mailjet\Client(API_USER, API_LOGIN, true, ['version' => 'v3.1']);

if (!empty($_POST["email"]) && !empty($_POST["message"])) {
	$email = htmlentities($_POST["email"]);
	$message = htmlspecialchars($_POST["message"]);

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$body = [
			'Messages' => [
				[
					'From' => [
						'Email' => "thomas.garenne@outlook.com",
						'Name' => "Thomas"
					],
					'To' => [
						[
							'Email' => "thomas.garenne@outlook.com",
							'Name' => "Thomas"
						]
					],
					'Subject' => "Demande de renseignement",
					'TextPart' => "$email, $message",

					'CustomID' => "AppGettingStartedTest"
				]
			]
		];
		$response = $mj->post(Resources::$Email, ['body' => $body]);
		$response->success();
		header("Location: contact.php");
	} else {
		header("Location: contact.php");
	}
}
