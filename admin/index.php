<?php
session_start();
require_once 'auth.php';

$auth = new AuthManager();

if (!$auth->isLoggedIn()) {
    header('Location: /admin/login.php');
    exit;
}

$currentUser = $auth->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理 - 田小橙</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
        }
        
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .sidebar-nav {
            margin-top: 20px;
        }
        
        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .nav-item.active {
            background: #667eea;
        }
        
        .nav-icon {
            width: 20px;
            height: 20px;
            font-size: 16px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .btn-logout {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
        }
        
        .page-header {
            background: white;
            padding: 24px;
            border-radius: 8px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .page-header h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 8px;
        }
        
        .page-header p {
            color: #666;
            font-size: 14px;
        }
        
        .content-panel {
            background: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: none;
        }
        
        .content-panel.active {
            display: block;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
        }
        
        .section-header h2 {
            font-size: 18px;
            color: #333;
        }
        
        .btn-primary {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        .data-list {
            display: grid;
            gap: 16px;
        }
        
        .data-item {
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .data-info h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 4px;
        }
        
        .data-info p {
            font-size: 14px;
            color: #666;
        }
        
        .data-actions {
            display: flex;
            gap: 8px;
        }
        
        .btn-edit {
            padding: 8px 16px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-delete {
            padding: 8px 16px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-delete:hover {
            background: #c0392b;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-running {
            background: #d4edda;
            color: #155724;
        }
        
        .status-stopped {
            background: #f8d7da;
            color: #721c24;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .modal-header h3 {
            font-size: 20px;
            color: #333;
        }
        
        .btn-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #eee;
        }
        
        .btn-cancel {
            padding: 10px 20px;
            background: #e0e0e0;
            color: #333;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .btn-save {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #5568d3;
        }

        .btn-save:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Toast提示样式 */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            min-width: 300px;
            padding: 16px 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .toast::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
        }

        .toast.success::before {
            background: #28a745;
        }

        .toast.error::before {
            background: #dc3545;
        }

        .toast.loading::before {
            background: #667eea;
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .toast.success .toast-icon {
            color: #28a745;
        }

        .toast.error .toast-icon {
            color: #dc3545;
        }

        .toast.loading .toast-icon {
            color: #667eea;
        }

        .toast.loading .toast-icon::after {
            content: '';
            width: 20px;
            height: 20px;
            border: 2px solid #667eea;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .toast-message {
            color: #666;
            font-size: 13px;
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #999;
            cursor: pointer;
            padding: 0 4px;
            line-height: 1;
        }

        .toast-close:hover {
            color: #333;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>田小橙后台</h2>
                <p>欢迎, <?php echo htmlspecialchars($currentUser['username']); ?></p>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-item active" data-section="dashboard">
                    <span>仪表盘</span>
                </div>
                <div class="nav-item" data-section="config">
                    <span>网站配置</span>
                </div>
                <div class="nav-item" data-section="profile">
                    <span>个人信息</span>
                </div>
                <div class="nav-item" data-section="sites">
                    <span>旗下站点</span>
                </div>
                <div class="nav-item" data-section="friends">
                    <span>友情链接</span>
                </div>
                <div class="nav-item" data-section="version">
                    <span>版本管理</span>
                </div>
            </nav>
            
            <div class="sidebar-footer">
                <button class="btn-logout" onclick="logout()">退出登录</button>
            </div>
        </aside>
        
        <main class="main-content">
            <div class="page-header">
                <h1>后台管理系统</h1>
                <p>管理网站内容、配置和数据</p>
            </div>
            
            <div id="dashboardPanel" class="content-panel active">
                <div class="section-header">
                    <h2>系统概况</h2>
                </div>
                <div class="data-list">
                    <div class="data-item">
                        <div class="data-info">
                            <h3>数据文件</h3>
                            <p>所有配置和数据以JSON格式存储在 /data 目录中</p>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-info">
                            <h3>版本信息</h3>
                            <p>系统版本: 1.0.0</p>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-info">
                            <h3>最后修改</h3>
                            <p id="lastModified">加载中...</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="configPanel" class="content-panel">
                <div class="section-header">
                    <h2>网站配置</h2>
                    <button class="btn-primary" onclick="editConfig()">编辑配置</button>
                </div>
                <div class="data-list" id="configList"></div>
            </div>
            
            <div id="profilePanel" class="content-panel">
                <div class="section-header">
                    <h2>个人信息</h2>
                    <div style="display: flex; gap: 12px;">
                        <button class="btn-primary" onclick="editProfile()">编辑信息</button>
                        <button class="btn-primary" onclick="changePassword()">修改密码</button>
                    </div>
                </div>
                <div class="data-list" id="profileList"></div>
            </div>
            
            <div id="sitesPanel" class="content-panel">
                <div class="section-header">
                    <h2>旗下站点</h2>
                    <button class="btn-primary" onclick="addSite()">添加站点</button>
                </div>
                <div class="data-list" id="sitesList"></div>
            </div>
            
            <div id="friendsPanel" class="content-panel">
                <div class="section-header">
                    <h2>友情链接</h2>
                    <button class="btn-primary" onclick="addFriend()">添加友链</button>
                </div>
                <div class="data-list" id="friendsList"></div>
            </div>
            
            <div id="versionPanel" class="content-panel">
                <div class="section-header">
                    <h2>版本管理</h2>
                    <div style="display: flex; gap: 12px;">
                        <button class="btn-primary" onclick="backupData()">备份数据</button>
                        <button class="btn-primary" onclick="importData()">导入备份</button>
                    </div>
                </div>
                <div class="data-list">
                    <div class="data-item">
                        <div class="data-info">
                            <h3>自动备份</h3>
                            <p>系统会自动保存数据修改记录</p>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-info">
                            <h3>手动备份</h3>
                            <p>点击"备份数据"按钮手动备份当前所有数据</p>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-info">
                            <h3>导入备份</h3>
                            <p>点击"导入备份"按钮上传JSON格式的备份文件来恢复数据</p>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-info">
                            <h3>备份历史</h3>
                        </div>
                    </div>
                </div>
                <div class="data-list" id="backupList" style="margin-top: 20px;"></div>
            </div>
        </main>
    </div>
    
    <div class="modal" id="editModal"></div>
    <div class="toast-container" id="toastContainer"></div>

    <script src="app.js"></script>
</body>
</html>
