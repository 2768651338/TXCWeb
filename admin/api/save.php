<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/auth.php';

$auth = new AuthManager();
$auth->requireAuth();

header('Content-Type: application/json');
// 设置较长的超时时间
set_time_limit(300);

$input = json_decode(file_get_contents('php://input'), true);
$type = $_GET['type'] ?? '';
$action = $_GET['action'] ?? '';

$dataDir = __DIR__ . '/../../data/';

try {
    switch($type) {
        case 'config':
            $filePath = $dataDir . 'config.json';
            if (!file_exists($filePath)) {
                throw new Exception('配置文件不存在');
            }

            $config = json_decode(file_get_contents($filePath), true);
            $config['site']['title'] = $input['title'] ?? $config['site']['title'];
            $config['site']['description'] = $input['description'] ?? $config['site']['description'];
            $config['site']['keywords'] = $input['keywords'] ?? $config['site']['keywords'];
            $config['site']['themeColor'] = $input['themeColor'] ?? $config['site']['themeColor'];
            $config['site']['copyright'] = $input['copyright'] ?? $config['site']['copyright'];
            $config['lastModified'] = date('c');

            $writeResult = file_put_contents($filePath, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if ($writeResult === false) {
                throw new Exception('配置文件写入失败');
            }

            // 备份失败不影响主流程
            try {
                createBackup($filePath, 'config');
            } catch (Exception $backupError) {
                // 记录备份错误但不影响主流程
                error_log('备份失败: ' . $backupError->getMessage());
            }

            echo json_encode(['success' => true, 'message' => '配置保存成功']);
            break;

        case 'profile':
            $filePath = $dataDir . 'profile.json';
            if (!file_exists($filePath)) {
                throw new Exception('个人信息文件不存在');
            }

            $profile = json_decode(file_get_contents($filePath), true);
            $profile['avatar'] = $input['avatar'] ?? $profile['avatar'];
            $profile['name'] = $input['name'] ?? $profile['name'];
            $profile['slogan'] = $input['slogan'] ?? $profile['slogan'];
            $profile['identityTags'] = $input['identityTags'] ?? $profile['identityTags'];
            $profile['techStack'] = $input['techStack'] ?? $profile['techStack'];
            $profile['lastModified'] = date('c');

            $writeResult = file_put_contents($filePath, json_encode($profile, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if ($writeResult === false) {
                throw new Exception('个人信息文件写入失败');
            }

            // 备份失败不影响主流程
            try {
                createBackup($filePath, 'profile');
            } catch (Exception $backupError) {
                error_log('备份失败: ' . $backupError->getMessage());
            }

            echo json_encode(['success' => true, 'message' => '个人信息保存成功']);
            break;

        case 'site':
            $filePath = $dataDir . 'sites.json';
            if (!file_exists($filePath)) {
                throw new Exception('站点文件不存在');
            }

            $sitesData = json_decode(file_get_contents($filePath), true);
            $sites = &$sitesData['sites'];

            if ($action === 'add') {
                $sites[] = $input;
            } elseif ($action === 'update') {
                foreach ($sites as &$site) {
                    if ($site['id'] === $input['id']) {
                        $site = $input;
                        break;
                    }
                }
            } elseif ($action === 'delete') {
                $sites = array_filter($sites, function($site) use ($input) {
                    return $site['id'] !== $input['id'];
                });
                $sites = array_values($sites);
            }

            $sitesData['lastModified'] = date('c');
            $writeResult = file_put_contents($filePath, json_encode($sitesData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if ($writeResult === false) {
                throw new Exception('站点文件写入失败');
            }

            // 备份失败不影响主流程
            try {
                createBackup($filePath, 'sites');
            } catch (Exception $backupError) {
                error_log('备份失败: ' . $backupError->getMessage());
            }

            echo json_encode(['success' => true, 'message' => '站点保存成功']);
            break;

        case 'friend':
            $filePath = $dataDir . 'friends.json';
            if (!file_exists($filePath)) {
                throw new Exception('友链文件不存在');
            }

            $friendsData = json_decode(file_get_contents($filePath), true);
            $friends = &$friendsData['friends'];

            if ($action === 'add') {
                $friends[] = $input;
            } elseif ($action === 'update') {
                foreach ($friends as &$friend) {
                    if ($friend['id'] === $input['id']) {
                        $friend = $input;
                        break;
                    }
                }
            } elseif ($action === 'delete') {
                $friends = array_filter($friends, function($friend) use ($input) {
                    return $friend['id'] !== $input['id'];
                });
                $friends = array_values($friends);
            }

            $friendsData['lastModified'] = date('c');
            $writeResult = file_put_contents($filePath, json_encode($friendsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if ($writeResult === false) {
                throw new Exception('友链文件写入失败');
            }

            // 备份失败不影响主流程
            try {
                createBackup($filePath, 'friends');
            } catch (Exception $backupError) {
                error_log('备份失败: ' . $backupError->getMessage());
            }

            echo json_encode(['success' => true, 'message' => '友链保存成功']);
            break;

        default:
            throw new Exception('无效的类型');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function createBackup($filePath, $type) {
    $backupDir = dirname($filePath) . '/backups/';
    if (!is_dir($backupDir)) {
        @mkdir($backupDir, 0755, true);
    }

    $backupFile = $backupDir . $type . '_' . date('Ymd_His') . '.json';
    $copyResult = @copy($filePath, $backupFile);
    if ($copyResult === false) {
        throw new Exception('备份文件创建失败');
    }

    // 只保留最近10个备份
    try {
        $files = glob($backupDir . $type . '_*.json');
        if ($files && count($files) > 10) {
            usort($files, function($a, $b) {
                return filemtime($a) < filemtime($b);
            });

            foreach (array_slice($files, 10) as $file) {
                @unlink($file);
            }
        }
    } catch (Exception $cleanupError) {
        // 清理失败不影响主流程
        error_log('备份清理失败: ' . $cleanupError->getMessage());
    }
}
