<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

$auth = new AuthManager();
$auth->requireAuth();

header('Content-Type: application/json');

$dataDir = __DIR__ . '/../../data/';
$backupDir = $dataDir . 'backups/';

if (!is_dir($backupDir)) {
    echo json_encode(['success' => false, 'message' => '备份目录不存在']);
    exit;
}

// 处理文件上传
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '仅支持POST请求']);
    exit;
}

if (!isset($_FILES['backupFile']) || $_FILES['backupFile']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => '文件上传失败']);
    exit;
}

$uploadedFile = $_FILES['backupFile']['tmpName'];
$fileName = $_FILES['backupFile']['name'];

// 验证文件扩展名
if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'json') {
    echo json_encode(['success' => false, 'message' => '仅支持JSON格式的备份文件']);
    exit;
}

// 验证文件大小（限制50MB）
if ($_FILES['backupFile']['size'] > 50 * 1024 * 1024) {
    echo json_encode(['success' => false, 'message' => '备份文件大小不能超过50MB']);
    exit;
}

// 读取上传的文件内容
$backupContent = file_get_contents($uploadedFile);
if ($backupContent === false) {
    echo json_encode(['success' => false, 'message' => '读取上传文件失败']);
    exit;
}

// 解析JSON数据
$backupData = json_decode($backupContent, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => '备份文件格式错误: ' . json_last_error_msg()]);
    exit;
}

// 验证备份文件结构
if (!isset($backupData['version']) || !isset($backupData['timestamp']) || !isset($backupData['files'])) {
    echo json_encode(['success' => false, 'message' => '备份文件结构不完整']);
    exit;
}

// 验证版本号
if (!preg_match('/^\d+\.\d+\.\d+$/', $backupData['version'])) {
    echo json_encode(['success' => false, 'message' => '版本号格式无效']);
    exit;
}

// 验证时间戳
if (strtotime($backupData['timestamp']) === false) {
    echo json_encode(['success' => false, 'message' => '时间戳格式无效']);
    exit;
}

// 验证files数组
if (!is_array($backupData['files'])) {
    echo json_encode(['success' => false, 'message' => '备份数据结构错误']);
    exit;
}

// 允许的文件类型
$allowedFiles = ['config', 'profile', 'sites', 'friends'];
$importedFiles = [];
$errors = [];

// 验证并导入每个文件
foreach ($allowedFiles as $fileType) {
    if (isset($backupData['files'][$fileType])) {
        $fileData = $backupData['files'][$fileType];

        // 验证数据是否为数组
        if (!is_array($fileData)) {
            $errors[] = "{$fileType}.json 数据格式错误";
            continue;
        }

        // 目标文件路径
        $targetFile = $dataDir . $fileType . '.json';

        // 导入前先备份当前数据
        if (file_exists($targetFile)) {
            $backupCopyFile = $backupDir . $fileType . '_import_backup_' . date('Ymd_His') . '.json';
            if (!@copy($targetFile, $backupCopyFile)) {
                $errors[] = "无法备份当前 {$fileType}.json 文件";
                continue;
            }
        }

        // 写入数据
        $jsonContent = json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if (file_put_contents($targetFile, $jsonContent) === false) {
            $errors[] = "写入 {$fileType}.json 失败";
            continue;
        }

        $importedFiles[] = $fileType;
    }
}

// 检查是否有任何文件成功导入
if (empty($importedFiles)) {
    echo json_encode(['success' => false, 'message' => '没有成功导入任何数据', 'errors' => $errors]);
    exit;
}

// 构建响应
$response = [
    'success' => true,
    'message' => '数据导入成功',
    'importedFiles' => $importedFiles,
    'backupTimestamp' => $backupData['timestamp'],
    'backupVersion' => $backupData['version']
];

if (!empty($errors)) {
    $response['warnings'] = $errors;
}

echo json_encode($response);
