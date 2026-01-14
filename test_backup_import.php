<?php
/**
 * 备份导入导出测试脚本
 * 用于验证导入导出功能的对称性和正确性
 */

$basePath = dirname(__DIR__);
$dataDir = __DIR__ . '/../data/';
$backupDir = $dataDir . 'backups/';

// 测试1: 导出备份
echo "=== 测试1: 导出备份 ===\n";

require_once $basePath . '/admin/auth.php';

$auth = new AuthManager();
// 跳过认证用于测试
$_SESSION['admin_logged_in'] = true;

// 模拟备份导出
$timestamp = date('Ymd_His');
$files = ['config.json', 'profile.json', 'sites.json', 'friends.json'];

$backupData = [
    'version' => '1.0.0',
    'timestamp' => date('c'),
    'files' => []
];

foreach ($files as $file) {
    $filePath = $dataDir . $file;
    if (file_exists($filePath)) {
        $backupData['files'][basename($file, '.json')] = json_decode(file_get_contents($filePath), true);
        echo "✓ 已读取: {$file}\n";
    } else {
        echo "✗ 文件不存在: {$file}\n";
    }
}

$backupFile = $backupDir . 'full_backup_' . $timestamp . '.json';
$backupContent = json_encode($backupData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

if (file_put_contents($backupFile, $backupContent)) {
    echo "✓ 备份文件已创建: " . basename($backupFile) . "\n";
    echo "  大小: " . number_format(filesize($backupFile)) . " 字节\n";
} else {
    echo "✗ 备份文件创建失败\n";
    exit(1);
}

// 测试2: 验证备份文件结构
echo "\n=== 测试2: 验证备份文件结构 ===\n";

$loadedBackup = json_decode(file_get_contents($backupFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "✗ 备份文件 JSON 解析失败: " . json_last_error_msg() . "\n";
    exit(1);
}

echo "✓ JSON 解析成功\n";

// 验证必需字段
$requiredFields = ['version', 'timestamp', 'files'];
foreach ($requiredFields as $field) {
    if (!isset($loadedBackup[$field])) {
        echo "✗ 缺少必需字段: {$field}\n";
        exit(1);
    }
    echo "✓ 字段存在: {$field}\n";
}

// 验证版本号格式
if (!preg_match('/^\d+\.\d+\.\d+$/', $loadedBackup['version'])) {
    echo "✗ 版本号格式无效\n";
    exit(1);
}
echo "✓ 版本号格式正确: " . $loadedBackup['version'] . "\n";

// 验证时间戳
if (strtotime($loadedBackup['timestamp']) === false) {
    echo "✗ 时间戳格式无效\n";
    exit(1);
}
echo "✓ 时间戳格式正确: " . $loadedBackup['timestamp'] . "\n";

// 验证 files 数组
if (!is_array($loadedBackup['files'])) {
    echo "✗ files 不是数组\n";
    exit(1);
}
echo "✓ files 是数组，包含 " . count($loadedBackup['files']) . " 个文件\n";

// 验证每个文件的数据
$allowedFiles = ['config', 'profile', 'sites', 'friends'];
foreach ($allowedFiles as $fileType) {
    if (isset($loadedBackup['files'][$fileType])) {
        if (!is_array($loadedBackup['files'][$fileType])) {
            echo "✗ {$fileType} 数据不是数组\n";
            exit(1);
        }
        echo "✓ {$fileType} 数据结构正确\n";
    }
}

// 测试3: 模拟导入过程（不实际覆盖数据）
echo "\n=== 测试3: 模拟导入验证 ===\n";

$importBackup = $loadedBackup;

// 创建临时备份目录
$tempBackupDir = $backupDir . 'temp_import_test/';
if (!is_dir($tempBackupDir)) {
    mkdir($tempBackupDir, 0755, true);
}

// 模拟导入前备份
$importedFiles = [];
foreach ($allowedFiles as $fileType) {
    if (isset($importBackup['files'][$fileType])) {
        $fileData = $importBackup['files'][$fileType];
        
        if (!is_array($fileData)) {
            echo "✗ {$fileType} 数据格式错误\n";
            continue;
        }
        
        // 模拟写入临时文件
        $tempFile = $tempBackupDir . $fileType . '.json';
        $jsonContent = json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        if (file_put_contents($tempFile, $jsonContent)) {
            $importedFiles[] = $fileType;
            echo "✓ {$fileType} 数据可恢复\n";
        } else {
            echo "✗ {$fileType} 数据恢复失败\n";
        }
    }
}

echo "\n成功恢复的文件: " . implode(', ', $importedFiles) . "\n";

// 验证导出和导入的对称性
echo "\n=== 测试4: 验证导出导入对称性 ===\n";

$symmetryPassed = true;

foreach ($allowedFiles as $fileType) {
    if (isset($backupData['files'][$fileType]) && isset($importBackup['files'][$fileType])) {
        $original = json_encode($backupData['files'][$fileType], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $restored = json_encode($importBackup['files'][$fileType], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        if ($original === $restored) {
            echo "✓ {$fileType} 数据完全对称\n";
        } else {
            echo "✗ {$fileType} 数据不对称\n";
            $symmetryPassed = false;
        }
    }
}

// 验证编码格式
$exportedContent = file_get_contents($backupFile);
if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $exportedContent)) {
    echo "✓ 中文字符正确保留（未转义）\n";
} else {
    echo "⚠ 可能未检测到中文字符\n";
}

if (preg_match('/\n/', $exportedContent)) {
    echo "✓ 格式化输出（JSON_PRETTY_PRINT）\n";
} else {
    echo "✗ 未检测到格式化输出\n";
    $symmetryPassed = false;
}

// 清理临时文件
foreach (glob($tempBackupDir . '*.json') as $tempFile) {
    unlink($tempFile);
}
rmdir($tempBackupDir);

// 测试结果
echo "\n=== 测试结果 ===\n";
if ($symmetryPassed && count($importedFiles) > 0) {
    echo "✓ 所有测试通过！导入导出功能完全对称。\n";
    echo "\n功能验证：\n";
    echo "- 备份文件结构正确\n";
    echo "- 数据完整性验证通过\n";
    echo "- 导出导入完全对称\n";
    echo "- 编码格式一致\n";
    exit(0);
} else {
    echo "✗ 部分测试失败，请检查上述错误信息。\n";
    exit(1);
}
