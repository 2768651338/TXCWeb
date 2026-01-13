<?php
session_start();

class AuthManager {
    private $adminFile;
    private $sessionKey = 'admin_logged_in';
    private $sessionTimeout = 7200; // 2小时
    
    public function __construct() {
        $this->adminFile = __DIR__ . '/../data/admin.json';
        $this->checkSessionTimeout();
    }
    
    public function login($username, $password) {
        $users = $this->loadUsers();
        
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                if ($this->verifyPassword($password, $user['passwordHash'])) {
                    $_SESSION[$this->sessionKey] = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'login_time' => time()
                    ];
                    
                    $this->updateLastLogin($user['id']);
                    return ['success' => true, 'message' => '登录成功'];
                }
            }
        }
        
        return ['success' => false, 'message' => '用户名或密码错误'];
    }
    
    public function logout() {
        unset($_SESSION[$this->sessionKey]);
        session_destroy();
    }
    
    public function isLoggedIn() {
        return isset($_SESSION[$this->sessionKey]);
    }
    
    public function requireAuth() {
        if (!$this->isLoggedIn()) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => '未授权', 'redirect' => 'login.php']);
            exit;
        }
    }
    
    public function getCurrentUser() {
        return $_SESSION[$this->sessionKey] ?? null;
    }
    
    public function hasPermission($role = 'super_admin') {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        $currentUser = $this->getCurrentUser();
        if ($currentUser['role'] === 'super_admin') {
            return true;
        }
        
        return $currentUser['role'] === $role;
    }
    
    private function loadUsers() {
        if (!file_exists($this->adminFile)) {
            return [];
        }
        
        $content = file_get_contents($this->adminFile);
        $data = json_decode($content, true);
        
        return $data['users'] ?? [];
    }
    
    private function verifyPassword($password, $hash) {
        return hash('sha256', $password) === $hash;
    }
    
    private function updateLastLogin($userId) {
        $users = $this->loadUsers();
        
        foreach ($users as &$user) {
            if ($user['id'] === $userId) {
                $user['lastLogin'] = date('c');
                break;
            }
        }
        
        $this->saveUsers($users);
    }
    
    private function saveUsers($users) {
        $data = [
            'version' => '1.0.0',
            'users' => $users
        ];
        
        file_put_contents($this->adminFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    private function checkSessionTimeout() {
        if (isset($_SESSION[$this->sessionKey])) {
            $loginTime = $_SESSION[$this->sessionKey]['login_time'] ?? 0;
            if (time() - $loginTime > $this->sessionTimeout) {
                $this->logout();
            }
        }
    }
    
    public function changePassword($oldPassword, $newPassword) {
        if (!$this->isLoggedIn()) {
            return ['success' => false, 'message' => '未登录'];
        }
        
        $currentUser = $this->getCurrentUser();
        $users = $this->loadUsers();
        
        foreach ($users as &$user) {
            if ($user['id'] === $currentUser['user_id']) {
                if (!$this->verifyPassword($oldPassword, $user['passwordHash'])) {
                    return ['success' => false, 'message' => '原密码错误'];
                }
                
                if (strlen($newPassword) < 6) {
                    return ['success' => false, 'message' => '新密码长度不能少于6位'];
                }
                
                $user['passwordHash'] = hash('sha256', $newPassword);
                $this->saveUsers($users);
                
                return ['success' => true, 'message' => '密码修改成功'];
            }
        }
        
        return ['success' => false, 'message' => '用户不存在'];
    }
}
