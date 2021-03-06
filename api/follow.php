<?php
header("Content-type: application/json; charset=utf-8");
require "functions.php";
$apiActions = array(
	"add",
	"remove"
);
$token = $_POST["token"];
$action = strtolower($_POST["action"]);
$username = strtolower($_POST["username"]);
if (!isset($token, $action, $username)) {
	$error = "MISSING_PARAMETER";
} else if (!in_array($action, $apiActions)) {
	$error = "INVALID_ACTION";
} else {
	if ($action === "add") {
		$result = follow($token, $username);
		if ($result !== true) {
			$error = $result;
		} else {
			$error = false;
		}
	} else if ($action === "remove") {
		$result = unfollow($token, $username);
		if ($result !== true) {
			$error = $result;
		} else {
			$error = false;
		}
	} else {
		// IDK
	}
}
$array = array(
	"error" => $error
);
echo json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>