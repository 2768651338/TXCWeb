<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

header('Content-Type: application/json; charset=utf-8');

$auth = new AuthManager();

// 检查是否已登录
if (!$auth->isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => '未登录，请先登录']);
    exit;
}

// 只接受 POST 请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '仅支持POST请求']);
    exit;
}

// 获取并解析 JSON 数据
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => '请求数据格式错误']);
    exit;
}

// 获取参数
$currentPassword = $data['currentPassword'] ?? '';
$newPassword = $data['newPassword'] ?? '';

// 验证参数
if (empty($currentPassword)) {
    echo json_encode(['success' => false, 'message' => '请输入当前密码']);
    exit;
}

if (empty($newPassword)) {
    echo json_encode(['success' => false, 'message' => '请输入新密码']);
    exit;
}

if (strlen($newPassword) < 8) {
    echo json_encode(['success' => false, 'message' => '新密码长度不能少于8位']);
    exit;
}

if ($currentPassword === $newPassword) {
    echo json_encode(['success' => false, 'message' => '新密码不能与当前密码相同']);
    exit;
}

// 调用密码修改方法
$result = $auth->changePassword($currentPassword, $newPassword);

echo json_encode($result);
