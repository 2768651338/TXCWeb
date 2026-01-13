<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

$auth = new AuthManager();
$auth->requireAuth();

header('Content-Type: application/json');

$dataDir = __DIR__ . '/../../data/';
$backupDir = $dataDir . 'backups/';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$timestamp = date('Ymd_His');
$files = ['config.json', 'profile.json', 'sites.json', 'friends.json'];
$backupFile = $backupDir . 'full_backup_' . $timestamp . '.tar.gz';

$backupData = [
    'version' => '1.0.0',
    'timestamp' => date('c'),
    'files' => []
];

foreach ($files as $file) {
    $filePath = $dataDir . $file;
    if (file_exists($filePath)) {
        $backupData['files'][basename($file, '.json')] = json_decode(file_get_contents($filePath), true);
    }
}

file_put_contents($backupDir . 'full_backup_' . $timestamp . '.json', json_encode($backupData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 清理旧备份（只保留最近5个）
$backupFiles = glob($backupDir . 'full_backup_*.json');
usort($backupFiles, function($a, $b) {
    return filemtime($a) < filemtime($b);
});

foreach (array_slice($backupFiles, 5) as $file) {
    unlink($file);
}

echo json_encode(['success' => true, 'message' => '备份成功', 'timestamp' => $timestamp]);
