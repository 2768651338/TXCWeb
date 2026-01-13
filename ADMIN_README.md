# 田小橙后台管理系统

## 系统概述

这是一个无需数据库的后台管理系统，所有数据以JSON格式存储在`data/`目录中。

## 目录结构

```
TXCWeb/
├── admin/              # 后台管理目录
│   ├── index.php      # 后台主页面
│   ├── login.php      # 登录页面
│   ├── auth.php       # 认证管理类
│   ├── app.js         # 前端交互脚本
│   └── api/           # API接口
│       ├── login.php  # 登录接口
│       ├── logout.php # 退出接口
│       ├── data.php   # 数据读取接口
│       ├── save.php   # 数据保存接口
│       └── backup.php # 备份接口
├── data/              # 数据存储目录
│   ├── config.json    # 网站配置
│   ├── profile.json   # 个人信息
│   ├── sites.json     # 旗下站点
│   ├── friends.json   # 友情链接
│   ├── admin.json     # 管理员账号
│   ├── loader.php     # 数据加载类
│   └── backups/       # 备份目录（自动创建）
├── index.php          # 前端主页
└── .htaccess          # 安全配置
```

## 功能特性

### 1. 用户认证
- 登录/登出功能
- Session会话管理
- 密码加密存储（SHA256）
- 会话超时自动退出（2小时）

### 2. 数据管理
- **网站配置**：标题、描述、关键词、主题颜色、版权信息
- **个人信息**：头像、名称、口号、身份标签、技术栈
- **旗下站点**：添加、编辑、删除、状态管理（运行中/已停止）
- **友情链接**：添加、编辑、删除友链

### 3. 版本管理
- 自动备份：每次数据修改自动创建备份
- 手动备份：可随时备份全部数据
- 备份保留：每种数据类型保留最近10个备份，完整备份保留最近5个

### 4. 安全特性
- 所有API接口需要登录验证
- JSON数据文件禁止直接访问
- XSS防护（输出转义）
- CSRF保护（建议在生产环境添加）

## 默认账号

```
用户名：admin
密码：admin
```

首次登录后建议立即修改密码。

## 使用方法

### 1. 访问后台

在浏览器中访问：
```
http://你的域名/admin/
```

### 2. 登录系统

使用默认账号登录（首次登录请修改密码）

### 3. 管理内容

- **仪表盘**：查看系统概况
- **网站配置**：编辑网站基本信息
- **个人信息**：管理个人资料和技术栈
- **旗下站点**：管理您的网站列表
- **友情链接**：管理友情链接
- **版本管理**：查看和管理数据备份

### 4. 备份数据

系统会在每次数据修改时自动创建备份。您也可以在"版本管理"页面手动备份所有数据。

## 数据文件说明

### config.json
网站基本配置信息，包括：
- 网站标题、描述、关键词
- 主题颜色
- 版权信息
- 联系方式（QQ、微信、群聊）
- ICP备案信息

### profile.json
个人资料信息，包括：
- 头像URL
- 名称和口号
- 身份标签列表
- 技术栈列表

### sites.json
旗下站点列表，每个站点包含：
- ID
- 名称
- URL
- 描述
- 图标类型
- 状态（running/stopped）

### friends.json
友情链接列表，每个链接包含：
- ID
- 名称
- URL
- 描述
- 头像URL
- 状态

### admin.json
管理员账号信息，包含：
- 用户名
- 密码哈希（SHA256）
- 邮箱
- 角色
- 创建时间
- 最后登录时间

## 安全建议

1. **修改默认密码**：首次登录后立即修改管理员密码
2. **保护数据目录**：确保`data/`目录不可通过Web直接访问（已通过.htaccess配置）
3. **定期备份**：定期手动备份重要数据
4. **HTTPS**：在生产环境使用HTTPS加密传输
5. **文件权限**：设置正确的文件权限（通常644 for files, 755 for directories）

## API接口说明

### POST /admin/api/login.php
登录接口
```json
{
  "username": "admin",
  "password": "admin"
}
```

### POST /admin/api/logout.php
退出登录（需要认证）

### GET /admin/api/data.php?type=config|profile|sites|friends
读取数据（需要认证）

### POST /admin/api/save.php
保存数据（需要认证）
- `type=config`: 保存网站配置
- `type=site&action=add`: 添加站点
- `type=site&action=update`: 更新站点
- `type=site&action=delete`: 删除站点
- `type=friend&action=add`: 添加友链
- `type=friend&action=update`: 更新友链
- `type=friend&action=delete`: 删除友链

### GET /admin/api/backup.php
创建完整备份（需要认证）

## 故障排查

### 登录失败
- 检查用户名和密码是否正确
- 确认PHP Session功能正常
- 检查浏览器Cookie是否启用

### 数据无法保存
- 检查`data/`目录是否有写入权限
- 查看PHP错误日志
- 确认JSON文件格式正确

### 页面显示异常
- 检查`data/`目录下的JSON文件是否存在
- 确认JSON文件格式正确
- 清除浏览器缓存

## 扩展开发

如需添加新的数据类型：

1. 在`data/`目录创建对应的JSON文件
2. 在`data/loader.php`中添加加载方法
3. 在`admin/api/data.php`中添加读取接口
4. 在`admin/api/save.php`中添加保存接口
5. 在`admin/index.php`中添加管理界面
6. 在`admin/app.js`中添加前端逻辑

## 许可证

本系统基于MIT许可证开源。

## 技术支持

如有问题，请联系：
- QQ: 2768651338
- 博客: https://blog.txc666.cn/
