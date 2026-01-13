<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

header('Content-Type: application/json');

$auth = new AuthManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->logout();
    echo json_encode(['success' => true, 'message' => '退出成功']);
} else {
    echo json_encode(['success' => false, 'message' => '仅支持POST请求']);
}
