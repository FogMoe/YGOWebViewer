<?php
include 'Controller.php'; // 确保包含了修改后的Controller类

$controller = new Controller();
$controller->getCardById(32864);
echo $controller->getCardById(32864);
?>

