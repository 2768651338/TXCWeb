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

// 获取所有备份文件
$backupFiles = glob($backupDir . 'full_backup_*.json');

$backups = [];

foreach ($backupFiles as $file) {
    $fileName = basename($file);
    $fileSize = filesize($file);
    $fileModTime = filemtime($file);

    // 尝试读取备份元数据
    $backupInfo = [
        'fileName' => $fileName,
        'fileSize' => $fileSize,
        'fileSizeFormatted' => formatFileSize($fileSize),
        'modifiedTime' => $fileModTime,
        'modifiedTimeFormatted' => date('Y-m-d H:i:s', $fileModTime)
    ];

    // 读取备份文件内容获取版本和时间戳
    $content = file_get_contents($file);
    if ($content !== false) {
        $backupData = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($backupData['version'])) {
            $backupInfo['version'] = $backupData['version'];
            $backupInfo['timestamp'] = $backupData['timestamp'];
            $backupInfo['hasConfig'] = isset($backupData['files']['config']);
            $backupInfo['hasProfile'] = isset($backupData['files']['profile']);
            $backupInfo['hasSites'] = isset($backupData['files']['sites']);
            $backupInfo['hasFriends'] = isset($backupData['files']['friends']);
        }
    }

    $backups[] = $backupInfo;
}

// 按修改时间降序排序
usort($backups, function($a, $b) {
    return $b['modifiedTime'] - $a['modifiedTime'];
});

echo json_encode([
    'success' => true,
    'backups' => $backups,
    'count' => count($backups)
]);

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' B';
    }
}
