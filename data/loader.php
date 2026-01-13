<?php
class DataLoader {
    private $dataDir;
    
    public function __construct() {
        $this->dataDir = __DIR__ . '/';
    }
    
    public function loadConfig() {
        $filePath = $this->dataDir . 'config.json';
        if (!file_exists($filePath)) {
            return $this->getDefaultConfig();
        }
        return json_decode(file_get_contents($filePath), true);
    }
    
    public function loadProfile() {
        $filePath = $this->dataDir . 'profile.json';
        if (!file_exists($filePath)) {
            return $this->getDefaultProfile();
        }
        return json_decode(file_get_contents($filePath), true);
    }
    
    public function loadSites() {
        $filePath = $this->dataDir . 'sites.json';
        if (!file_exists($filePath)) {
            return ['sites' => []];
        }
        return json_decode(file_get_contents($filePath), true);
    }
    
    public function loadFriends() {
        $filePath = $this->dataDir . 'friends.json';
        if (!file_exists($filePath)) {
            return ['friends' => []];
        }
        return json_decode(file_get_contents($filePath), true);
    }
    
    private function getDefaultConfig() {
        return [
            'site' => [
                'title' => '田小橙个人主页',
                'description' => '田小橙个人主页，简约而不简单。',
                'keywords' => '田小橙主页',
                'themeColor' => '#667eea',
                'favicon' => 'https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640',
                'copyright' => '2024-2026 田小橙主页',
                'startTime' => '02/15/2024 00:00:00'
            ],
            'contact' => [
                'qq' => '2768651338',
                'qqLink' => 'https://qm.qq.com/q/mOLOGhAQjC'
            ],
            'icp' => [
                'police' => '桂公网安备45272402000026号',
                'policeLink' => 'http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=45272402000026',
                'icp' => '桂ICP备2024037782号',
                'icpLink' => 'https://beian.miit.gov.cn/#/Integrated/index'
            ]
        ];
    }
    
    private function getDefaultProfile() {
        return [
            'avatar' => 'https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640',
            'name' => '田小橙',
            'slogan' => '始终拥抱美好的未来',
            'identityTags' => [
                ['name' => '独立软件开发者', 'color' => 'tag-green'],
                ['name' => '独立网站开发者', 'color' => 'tag-yellow'],
                ['name' => '全栈工程师', 'color' => 'tag-blue']
            ],
            'techStack' => [
                ['name' => 'PHP', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg', 'color' => 'tag-purple'],
                ['name' => 'HTML5', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-plain.svg', 'color' => 'tag-yellow'],
                ['name' => 'CSS3', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-plain.svg', 'color' => 'tag-blue'],
                ['name' => 'Java', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-plain.svg', 'color' => 'tag-green'],
                ['name' => 'C', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/c/c-plain.svg', 'color' => 'tag-blue'],
                ['name' => 'JS', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-plain.svg', 'color' => 'tag-yellow']
            ]
        ];
    }
}
