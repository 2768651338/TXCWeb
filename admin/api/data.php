<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

$auth = new AuthManager();
$auth->requireAuth();

header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$dataDir = __DIR__ . '/../../data/';
$files = [
    'config' => 'config.json',
    'profile' => 'profile.json',
    'sites' => 'sites.json',
    'friends' => 'friends.json'
];

if (!isset($files[$type])) {
    echo json_encode(['success' => false, 'message' => '无效的数据类型']);
    exit;
}

$filePath = $dataDir . $files[$type];

if (!file_exists($filePath)) {
    echo json_encode(['success' => false, 'message' => '数据文件不存在']);
    exit;
}

$content = file_get_contents($filePath);
$data = json_decode($content, true);

echo json_encode(['success' => true, 'data' => $data], JSON_UNESCAPED_UNICODE);
