<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

header('Content-Type: application/json');

$auth = new AuthManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['username']) || !isset($data['password'])) {
        echo json_encode(['success' => false, 'message' => '用户名和密码不能为空']);
        exit;
    }
    
    $result = $auth->login($data['username'], $data['password']);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => '仅支持POST请求']);
}
