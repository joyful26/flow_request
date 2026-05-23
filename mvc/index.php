<?php
session_start();
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
require_once(ROOT.'app/BdModel.php');
require_once(ROOT.'app/MainController.php');
require_once(ROOT.'app/MainRooter.php');
$main =new MainRooter();
$main->start();
?>