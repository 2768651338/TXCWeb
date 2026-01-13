<?php
    
    $qq_link = "https://qm.qq.com/q/mOLOGhAQjC"; //qq链接
    
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="田小橙主页">
    <meta name="description" content="田小橙个人主页，简约而不简单。">
    <meta name="theme-color" content="#667eea">
    <link rel="shortcut icon" href="https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640" />
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/bc.css">
    
    <style>
        /* ========== 基础优化 ========== */
        :root {
            --primary-color: #667eea;
            --primary-hover: #5a6fd6;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --info-color: #4299e1;
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.85);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.2);
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius-sm: 6px;
            --border-radius-md: 10px;
            --border-radius-lg: 16px;
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 16px;
            --spacing-lg: 24px;
            
            /* 新增卡片变量 */
            --card-bg: rgba(255, 255, 255, 0.08);
            --card-hover-bg: rgba(255, 255, 255, 0.12);
            --card-border: rgba(255, 255, 255, 0.1);
        }

        /* 全局平滑滚动 */
        html {
            scroll-behavior: smooth;
        }

        /* 改善文本可读性 */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* ========== 焦点状态优化（可访问性） ========== */
        *:focus {
            outline: none;
        }

        *:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 3px;
            border-radius: var(--border-radius-sm);
        }

        /* ========== 卡片容器优化 ========== */
        .bc_box {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: transform var(--transition-normal), 
                        box-shadow var(--transition-normal),
                        background-color var(--transition-normal);
        }

        .bc_box:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* ========== 头像优化 ========== */
        .img-avatar {
            transition: transform var(--transition-normal), 
                        box-shadow var(--transition-normal);
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .img-avatar:hover {
            transform: scale(1.08) rotate(5deg);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.5);
        }

        /* ========== 新版标签和语言区域设计 ========== */
        .info-section {
            margin-top: var(--spacing-md);
        }

        .info-section-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: var(--spacing-sm);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-section-title .icon {
            width: 16px;
            height: 16px;
            opacity: 0.8;
        }

        /* 标签容器 - 采用Flex流式布局 */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
        }

        /* 新版标签设计 */
        .tag-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
        }

        .tag-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
            opacity: 0;
            transition: opacity var(--transition-fast);
        }

        .tag-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .tag-item:hover::before {
            opacity: 1;
        }

        .tag-item .tag-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .tag-item .tag-icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* 标签颜色变体 */
        .tag-item.tag-green {
            background: linear-gradient(135deg, rgba(72, 187, 120, 0.2) 0%, rgba(56, 161, 105, 0.15) 100%);
            border-color: rgba(72, 187, 120, 0.3);
        }

        .tag-item.tag-green .tag-dot {
            background: var(--success-color);
            box-shadow: 0 0 8px var(--success-color);
        }

        .tag-item.tag-green:hover {
            background: linear-gradient(135deg, rgba(72, 187, 120, 0.35) 0%, rgba(56, 161, 105, 0.25) 100%);
            border-color: rgba(72, 187, 120, 0.5);
        }

        .tag-item.tag-yellow {
            background: linear-gradient(135deg, rgba(237, 137, 54, 0.2) 0%, rgba(221, 107, 32, 0.15) 100%);
            border-color: rgba(237, 137, 54, 0.3);
        }

        .tag-item.tag-yellow .tag-dot {
            background: var(--warning-color);
            box-shadow: 0 0 8px var(--warning-color);
        }

        .tag-item.tag-yellow:hover {
            background: linear-gradient(135deg, rgba(237, 137, 54, 0.35) 0%, rgba(221, 107, 32, 0.25) 100%);
            border-color: rgba(237, 137, 54, 0.5);
        }

        .tag-item.tag-blue {
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.2) 0%, rgba(49, 130, 206, 0.15) 100%);
            border-color: rgba(66, 153, 225, 0.3);
        }

        .tag-item.tag-blue .tag-dot {
            background: var(--info-color);
            box-shadow: 0 0 8px var(--info-color);
        }

        .tag-item.tag-blue:hover {
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.35) 0%, rgba(49, 130, 206, 0.25) 100%);
            border-color: rgba(66, 153, 225, 0.5);
        }

        .tag-item.tag-purple {
            background: linear-gradient(135deg, rgba(128, 90, 213, 0.2) 0%, rgba(107, 70, 193, 0.15) 100%);
            border-color: rgba(128, 90, 213, 0.3);
        }

        .tag-item.tag-purple .tag-dot {
            background: #805ad5;
            box-shadow: 0 0 8px #805ad5;
        }

        .tag-item.tag-purple:hover {
            background: linear-gradient(135deg, rgba(128, 90, 213, 0.35) 0%, rgba(107, 70, 193, 0.25) 100%);
            border-color: rgba(128, 90, 213, 0.5);
        }

        /* 语言标签带图标版本 */
        .lang-tag {
            padding: 6px 12px;
            border-radius: var(--border-radius-sm);
        }

        .lang-tag img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        /* ========== 旗下站点图片展示优化 ========== */
        .site-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: var(--spacing-md);
            padding: var(--spacing-sm);
        }

        .site-card {
            position: relative;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            transition: all var(--transition-normal);
            text-decoration: none;
            display: block;
        }

        .site-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(102, 126, 234, 0.4);
        }

        /* 图片容器 */
        .site-card-image {
            position: relative;
            width: 100%;
            padding-top: 60%; /* 5:3 宽高比 */
            overflow: hidden;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        .site-card-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow), opacity var(--transition-normal);
            opacity: 0;
        }

        .site-card-image img.loaded {
            opacity: 1;
        }

        .site-card:hover .site-card-image img {
            transform: scale(1.08);
        }

        /* 图片加载占位符 */
        .site-card-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .site-card-placeholder .icon {
            width: 40px;
            height: 40px;
            opacity: 0.5;
            animation: pulse-icon 2s ease-in-out infinite;
        }

        @keyframes pulse-icon {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
        }

        .site-card-image img.loaded + .site-card-placeholder {
            opacity: 0;
            pointer-events: none;
        }

        /* 图片遮罩层 */
        .site-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                transparent 50%,
                rgba(0, 0, 0, 0.7) 100%
            );
            opacity: 0;
            transition: opacity var(--transition-normal);
        }

        .site-card:hover .site-card-overlay {
            opacity: 1;
        }

        /* 卡片信息 */
        .site-card-info {
            padding: var(--spacing-md);
            background: rgba(0, 0, 0, 0.3);
        }

        .site-card-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .site-card-title .icon {
            width: 18px;
            height: 18px;
            opacity: 0.8;
        }

        .site-card-desc {
            font-size: 12px;
            color: var(--text-secondary);
            opacity: 0.8;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* 访问按钮 */
        .site-card-action {
            position: absolute;
            bottom: 70px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            padding: 8px 20px;
            background: var(--primary-color);
            color: white;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            opacity: 0;
            transition: all var(--transition-normal);
            white-space: nowrap;
        }

        .site-card:hover .site-card-action {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* 状态指示器 */
        .site-card-status {
            position: absolute;
            top: var(--spacing-sm);
            right: var(--spacing-sm);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--success-color);
            box-shadow: 0 0 10px var(--success-color);
            animation: status-pulse 2s ease-in-out infinite;
        }

        @keyframes status-pulse {
            0%, 100% { box-shadow: 0 0 5px var(--success-color); }
            50% { box-shadow: 0 0 15px var(--success-color), 0 0 25px var(--success-color); }
        }

        /* ========== 友情链接样式 ========== */
        .friend-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: var(--spacing-md);
            padding: var(--spacing-sm);
        }

        .friend-card {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--border-radius-md);
            text-decoration: none;
            transition: all var(--transition-normal);
        }

        .friend-card:hover {
            transform: translateY(-4px);
            background: var(--card-hover-bg);
            border-color: rgba(102, 126, 234, 0.4);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .friend-card-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: transform var(--transition-normal);
        }

        .friend-card:hover .friend-card-avatar {
            transform: scale(1.1) rotate(5deg);
        }

        .friend-card-info {
            flex: 1;
            min-width: 0;
        }

        .friend-card-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .friend-card-desc {
            font-size: 11px;
            color: var(--text-secondary);
            opacity: 0.7;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ========== 社交链接卡片优化 ========== */
        .bc_center a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-md);
            text-decoration: none;
            transition: all var(--transition-normal);
            border-radius: var(--border-radius-md);
        }

        .bc_center a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .bc_center a:active {
            transform: scale(0.98);
        }

        .bc_center .icon {
            transition: transform var(--transition-normal);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .bc_center a:hover .icon {
            transform: scale(1.15) translateY(-3px);
        }

        .bc_center span {
            margin-top: var(--spacing-sm);
            font-weight: 500;
            letter-spacing: 1px;
            transition: all var(--transition-fast);
        }

        .bc_center a:hover span {
            text-shadow: 0 2px 10px rgba(255,255,255,0.3);
        }

        /* ========== 标题优化 ========== */
        h3.bc_box {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--text-primary);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: var(--spacing-sm);
        }

        h3.bc_box .icon {
            color: var(--primary-color);
            filter: drop-shadow(0 2px 4px rgba(102, 126, 234, 0.3));
        }

        /* 分割线优化 */
        hr {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            margin: var(--spacing-sm) 0 var(--spacing-md) 0;
        }

        /* ========== 名称和提示文字优化 ========== */
        #bc_name {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
            margin-bottom: var(--spacing-xs);
        }

        #bc_tip {
            font-size: 13px;
            color: var(--text-secondary);
            font-style: italic;
            letter-spacing: 0.5px;
            position: relative;
            padding-left: 12px;
        }

        #bc_tip::before {
            content: '💡';
            position: absolute;
            left: -4px;
            top: 50%;
            transform: translateY(-50%);
            font-style: normal;
        }

        /* ========== 时间显示优化 ========== */
        #localtime {
            display: inline-block;
            padding: var(--spacing-xs) var(--spacing-sm);
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius-sm);
            font-size: 12px;
            font-family: 'Consolas', 'Monaco', monospace;
            letter-spacing: 0.5px;
            margin: var(--spacing-sm) 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ========== Code 标签优化 ========== */
        code {
            background: rgba(102, 126, 234, 0.3);
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 12px;
            border: 1px solid rgba(102, 126, 234, 0.2);
            transition: all var(--transition-fast);
        }

        code:hover {
            background: rgba(102, 126, 234, 0.5);
        }

        /* ========== 炫彩备案优化 ========== */
        .by-p {
            font-weight: 600;
            font-size: 12px;
            background: linear-gradient(90deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5, #70f7fe);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient-flow 8s linear infinite;
            transition: all var(--transition-fast);
            padding: 4px 8px;
            border-radius: 4px;
        }

        .by-p:hover {
            background-size: 100% auto;
            text-shadow: 0 0 20px rgba(112, 247, 254, 0.5);
        }

        @keyframes gradient-flow {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* ========== 运行时间容器优化 ========== */
        #time-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 40px;
            margin: var(--spacing-md) 0;
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: 13px;
            opacity: 0.85;
            transition: all var(--transition-normal);
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius-md);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        #time-container:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.02);
        }

        #time-container #span {
            font-family: 'Consolas', 'Monaco', monospace;
            letter-spacing: 1px;
        }

        /* ========== 页脚优化 ========== */
        #bc_foot {
            text-align: center;
            padding: var(--spacing-lg);
            font-size: 13px;
            line-height: 2;
        }

        #bc_foot a {
            display: inline-block;
            margin: var(--spacing-xs) var(--spacing-sm);
            transition: transform var(--transition-fast);
        }

        #bc_foot a:hover {
            transform: translateY(-2px);
        }

        /* ========== 加载动画优化 ========== */
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
            overflow: hidden;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 120px;
            height: 120px;
            margin: -60px 0 0 -60px;
            border-radius: 50%;
            border: 4px solid transparent;
            border-top-color: var(--primary-color);
            animation: spin 1.2s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
            z-index: 100001;
        }

        #loader::before,
        #loader::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 4px solid transparent;
        }

        #loader::before {
            top: 8px;
            left: 8px;
            right: 8px;
            bottom: 8px;
            border-top-color: var(--success-color);
            animation: spin 1.8s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite reverse;
        }

        #loader::after {
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border-top-color: var(--warning-color);
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #load_title {
            position: fixed;
            top: calc(50% + 80px);
            left: 50%;
            transform: translateX(-50%);
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 2px;
            z-index: 100001;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            z-index: 100000;
            transition: all 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        .loader-section.section-left {
            left: 0;
        }

        .loader-section.section-right {
            right: 0;
        }

        .loaded .loader-section.section-left {
            transform: translateX(-100%);
            opacity: 0;
        }

        .loaded .loader-section.section-right {
            transform: translateX(100%);
            opacity: 0;
        }

        .loaded #loader-wrapper {
            visibility: hidden;
            transition: visibility 0.3s 0.8s;
        }

        .loaded #loader,
        .loaded #load_title {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* ========== 图标统一优化 ========== */
        .icon {
            width: 1.2em;
            height: 1.2em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
            transition: all var(--transition-fast);
        }

        .bc_center .icon {
            width: 2.5em;
            height: 2.5em;
        }

        /* ========== 提示卡片 ========== */
        .tip-card {
            padding: var(--spacing-md);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: var(--border-radius-md);
            line-height: 1.8;
        }

        .tip-card p {
            opacity: 0.95;
            margin: 0;
        }

        .btn-highlight {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            background: var(--success-color);
            color: white;
            font-size: 12px;
            font-weight: 500;
            border-radius: 4px;
            text-decoration: none;
            transition: all var(--transition-fast);
        }

        .btn-highlight:hover {
            background: #38a169;
            transform: translateY(-1px);
        }

        /* ========== 响应式优化 ========== */
        @media (max-width: 768px) {
            .site-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-sm);
            }

            .site-card-info {
                padding: var(--spacing-sm);
            }

            .site-card-title {
                font-size: 12px;
            }

            .site-card-desc {
                display: none;
            }

            .site-card-action {
                bottom: 50px;
                padding: 6px 14px;
                font-size: 11px;
            }

            .friend-grid {
                grid-template-columns: 1fr;
            }

            .tags-container {
                gap: 6px;
            }

            .tag-item {
                padding: 6px 10px;
                font-size: 11px;
            }

            #bc_name {
                font-size: 18px;
            }

            #time-container {
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            .site-grid {
                grid-template-columns: 1fr;
            }

            .site-card-desc {
                display: block;
            }
        }

        /* ========== 打印样式优化 ========== */
        @media print {
            .bc_box {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            #loader-wrapper {
                display: none;
            }
        }

        /* ========== 减少动画偏好 ========== */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ========== 选择文本样式 ========== */
        ::selection {
            background: rgba(102, 126, 234, 0.6);
            color: white;
        }

        ::-moz-selection {
            background: rgba(102, 126, 234, 0.6);
            color: white;
        }

        /* ========== 滚动条美化 ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color), var(--info-color));
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-hover), var(--primary-color));
        }

        /* ========== 图片加载骨架屏 ========== */
        .skeleton {
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.05) 25%,
                rgba(255, 255, 255, 0.1) 50%,
                rgba(255, 255, 255, 0.05) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
        }

        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
    
    <title>田小橙个人主页</title>
</head>
<body>
<!-- 加载动画 -->
<script>
    document.body.innerHTML += ('<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div><div id="load_title">精彩即将到来，请稍后</div></div>');
    window.onload = function () { document.body.className += ' loaded';}
</script>
<div class="bc_content">
    <div class="bc-fluid">
        <div class="bc-row bc-space10">
            <div class="bc-xs12 bc-sm6 bc-md6 bc-lg6">
                <div class="bc_mbl bc_box" id="bc_mobile_head">
                    <div class="bc-row">
                        <div class="bc-xs3">
                            <img class="bc_mbl bc_box img-avatar" style="border-radius: 50%;" src="https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640" alt="田小橙头像" loading="lazy">
                        </div>
                        <div class="bc-xs9">
                            <div class="bc-xs12">
                                <div id="bc_name">田小橙</div>
                                <div id="bc_tip">始终拥抱美好的未来</div>
                            </div>
                            <!-- 日期时间 -->
                            <span id="localtime" aria-live="polite" aria-label="当前日期时间"></span>
                            <script type="text/javascript">
                                function showLocale(objD) {
                                    var str,colorhead,colorfoot;
                                    var yy = objD.getFullYear();
                                    var MM = objD.getMonth()+1;
                                    if(MM<10) MM = '0' + MM;
                                    var dd = objD.getDate();
                                    if(dd<10) dd = '0' + dd;
                                    var hh = objD.getHours();
                                    if(hh<10) hh = '0' + hh;
                                    var mm = objD.getMinutes();
                                    if(mm<10) mm = '0' + mm;
                                    var ss = objD.getSeconds();
                                    if(ss<10) ss = '0' + ss;
                                    var ww = objD.getDay();
                                    var weekDays = ["星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
                                    colorhead = "<span style='color:#ffffff;'>";
                                    colorfoot = "</span>";
                                    str = colorhead + yy + "年" + MM + "月" + dd + "日 " + hh + ":" + mm + ":" + ss + " " + weekDays[ww] + colorfoot;
                                    return str;
                                }
                                function tick() {
                                    var today = new Date();
                                    document.getElementById("localtime").innerHTML = showLocale(today);
                                    window.setTimeout(tick, 1000);
                                }
                                tick();
                            </script>
                            
                            <!-- 优化后的标签区域 -->
                            <div class="info-section">
                                <div class="info-section-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-biaoqian"></use>
                                    </svg>
                                    <span>身份标签</span>
                                </div>
                                <div class="tags-container">
                                    <a href="javascript:void(0)" class="tag-item tag-green" aria-label="身份标签：独立软件开发者">
                                        <span class="tag-dot"></span>
                                        <span>独立软件开发者</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-yellow" aria-label="身份标签：独立网站开发者">
                                        <span class="tag-dot"></span>
                                        <span>独立网站开发者</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-blue" aria-label="身份标签：全栈工程师">
                                        <span class="tag-dot"></span>
                                        <span>全栈工程师</span>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- 优化后的语言区域 -->
                            <div class="info-section">
                                <div class="info-section-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-code"></use>
                                    </svg>
                                    <span>技术栈</span>
                                </div>
                                <div class="tags-container">
                                    <a href="javascript:void(0)" class="tag-item tag-purple lang-tag" aria-label="编程语言：PHP">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" alt="PHP" loading="lazy">
                                        <span>PHP</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-yellow lang-tag" aria-label="标记语言：HTML">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-plain.svg" alt="HTML5" loading="lazy">
                                        <span>HTML5</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-blue lang-tag" aria-label="样式语言：CSS">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-plain.svg" alt="CSS3" loading="lazy">
                                        <span>CSS3</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-green lang-tag" aria-label="编程语言：JAVA">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-plain.svg" alt="Java" loading="lazy">
                                        <span>Java</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-blue lang-tag" aria-label="编程语言：C">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/c/c-plain.svg" alt="C" loading="lazy">
                                        <span>C</span>
                                    </a>
                                    <a href="javascript:void(0)" class="tag-item tag-yellow lang-tag" aria-label="编程语言：JavaScript">
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-plain.svg" alt="JavaScript" loading="lazy">
                                        <span>JS</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bc-xs4 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href="#" onclick="showToast('点旁边QQ我就告诉你😏'); return false;" aria-label="微信联系方式" role="button" tabindex="0">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-weixin"></use></svg>
                        <span style="color:#FFF;">微信</span></a>
                </div>
            </div>
            <div class="bc-xs5 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href='tencent://message/?uin=2768651338' target="_blank" rel="noopener noreferrer" aria-label="点击添加QQ好友" role="button">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-QQ"></use></svg>
                        <span style="color:#FFF;">QQ</span></a>
                </div>
            </div>
            <div class="bc-xs3 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href="#" onclick="showToast('点旁边QQ我就告诉你😏'); return false;" aria-label="群聊联系方式" role="button" tabindex="0">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-gitee"></use></svg>
                        <span style="color:#FFF;">群聊</span></a>
                </div>
            </div>
            <div class="bc-sm6 bc-md4 bc-lg6 bc-hide-xs">
                <div class="bc_box bc_mbl tip-card">
                    <p>如果您喜欢我们的网站，请将本站添加到收藏夹（快捷键<code>Ctrl+D</code>），并
                        <a class="btn-highlight" href="https://jingyan.baidu.com/article/4dc40848868eba89d946f1c0.html" target="_blank" rel="noopener noreferrer">
                            <svg class="icon" style="width:14px;height:14px;" aria-hidden="true">
                                <use xlink:href="#icon-home"></use>
                            </svg>
                            设为主页
                        </a>
                        ，方便您的下次访问，感谢支持。
                    </p>
                </div>
            </div>
        </div>
        
        <!-- 旗下站点 - 图片展示优化 -->
        <div class="bc-row bc-space10">
            <div class="bc-xs12 bc-sm7 bc-md7 bc-lg7">
                <div class="bc_box bc_mbl">
                    <div class="bc-row">
                        <h3 class="bc-xs12 bc_box">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-zhandian"></use>
                            </svg>
                            <span>旗下站点</span>
                        </h3>
                        <hr aria-hidden="true">
                    </div>
                    <nav class="site-grid" aria-label="旗下站点导航">
                        <!-- 站点卡片1 -->
                        <a href="https://blog.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙博客">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://blog.txc666.cn/" 
                                     alt="田小橙博客预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-blog"></use>
                                    </svg>
                                    <span>田小橙博客</span>
                                </div>
                                <div class="site-card-desc">分享技术文章与生活感悟</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片2 -->
                        <a href="https://starboard.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问星河留言板">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://starboard.txc666.cn/" 
                                     alt="星河留言板预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-message"></use>
                                    </svg>
                                    <span>星河留言板</span>
                                </div>
                                <div class="site-card-desc">在线留言互动平台</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片3 -->
                        <a href="https://th.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问太荒后台">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://th.txc666.cn/" 
                                     alt="太荒后台预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-dashboard"></use>
                                    </svg>
                                    <span>太荒后台</span>
                                </div>
                                <div class="site-card-desc">专业的后台管理系统</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片4 -->
                        <a href="https://shop.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙云商店">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://shop.txc666.cn/" 
                                     alt="田小橙云商店预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-shop"></use>
                                    </svg>
                                    <span>田小橙云商店</span>
                                </div>
                                <div class="site-card-desc">优质数字产品交易平台</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片5 -->
                        <a href="https://pay.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问筑梦云支付">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://pay.txc666.cn/" 
                                     alt="筑梦云支付预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-pay"></use>
                                    </svg>
                                    <span>筑梦云支付</span>
                                </div>
                                <div class="site-card-desc">安全便捷的支付解决方案</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片6 -->
                        <a href="https://auth.txc666.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙授权站">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://auth.txc666.cn/" 
                                     alt="田小橙授权站预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-auth"></use>
                                    </svg>
                                    <span>田小橙授权站</span>
                                </div>
                                <div class="site-card-desc">软件正版授权管理平台</div>
                            </div>
                        </a>
                        
                        <!-- 站点卡片7 -->
                        <a href="https://www.yuncampus.cn/" class="site-card" target="_blank" rel="noopener noreferrer" aria-label="访问云枢校园">
                            <div class="site-card-image">
                                <img src="https://api.iowen.cn/doc/mshot/mshot.php?url=https://www.yuncampus.cn/" 
                                     alt="云枢校园预览" 
                                     loading="lazy"
                                     onload="this.classList.add('loaded')"
                                     onerror="this.style.display='none'">
                                <div class="site-card-placeholder skeleton">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-lianjie"></use>
                                    </svg>
                                </div>
                                <div class="site-card-overlay"></div>
                                <span class="site-card-status" title="运行中"></span>
                            </div>
                            <span class="site-card-action">立即访问</span>
                            <div class="site-card-info">
                                <div class="site-card-title">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="#icon-school"></use>
                                    </svg>
                                    <span>云枢校园</span>
                                </div>
                                <div class="site-card-desc">智慧校园综合服务平台</div>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- 友情链接 - 优化展示 -->
            <div class="bc-xs12 bc-sm5 bc-md5 bc-lg5">
                <div class="bc_box bc_mbl">
                    <div class="bc-row">
                        <h3 class="bc-xs12 bc_box">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-zhandian"></use>
                            </svg>
                            <span>友情链接</span>
                        </h3>
                        <hr aria-hidden="true">
                    </div>
                    <nav class="friend-grid" aria-label="友情链接导航">
                        <!-- 友链卡片1 -->
                        <a href="https://bit.txc666.cn/" class="friend-card" target="_blank" rel="noopener noreferrer" aria-label="访问智创比特团队">
                            <img src="https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=100" 
                                 alt="智创比特团队" 
                                 class="friend-card-avatar"
                                 loading="lazy">
                            <div class="friend-card-info">
                                <div class="friend-card-name">智创比特团队</div>
                                <div class="friend-card-desc">专业技术开发团队</div>
                            </div>
                        </a>
                        
                        <!-- 友链卡片2 - 待入驻 -->
                        <a href="#" class="friend-card" onclick="showToast('该位置正在招募友链入驻~'); return false;" aria-label="友链位置待入驻">
                            <div class="friend-card-avatar" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3)); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                ➕
                            </div>
                            <div class="friend-card-info">
                                <div class="friend-card-name">友链入驻</div>
                                <div class="friend-card-desc">期待您的加入</div>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="bc-row bc-space10">
            <div class="bc-xs12">
                <footer class="bc_mbl bc_box" id="bc_foot">
                    <p>Copyright © 2024-2026 田小橙主页<span class="btn bc-hide-xs" style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 4px; margin-left: 10px;">收藏本站（快捷键<code>Ctrl+D</code>）</span></p>
                    <p style="margin-top: 8px;">
                        <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=45272402000026" target="_blank" rel="external nofollow noopener noreferrer" aria-label="桂公网安备查询">
                            <span class="by-p">桂公网安备45272402000026号</span>
                        </a>
                        <a href="https://beian.miit.gov.cn/#/Integrated/index" target="_blank" rel="external nofollow noopener noreferrer" aria-label="ICP备案查询">
                            <span class="by-p">桂ICP备2024037782号</span>
                        </a>
                    </p>
                </footer>
                <div id="time-container" aria-live="polite">
                    <span id="span"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast 提示组件 -->
<div id="toast-container" aria-live="polite" aria-atomic="true"></div>

<!-- 图片懒加载增强脚本 -->
<script>
    // 图片懒加载观察器
    document.addEventListener('DOMContentLoaded', function() {
        // 使用 Intersection Observer 实现更好的懒加载
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // 图片加载错误处理 - 显示默认占位图
        document.querySelectorAll('.site-card-image img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                const placeholder = this.nextElementSibling;
                if (placeholder && placeholder.classList.contains('site-card-placeholder')) {
                    placeholder.innerHTML = `
                        <svg class="icon" style="width:50px;height:50px;opacity:0.4;" aria-hidden="true">
                            <use xlink:href="#icon-lianjie"></use>
                        </svg>
                    `;
                    placeholder.classList.remove('skeleton');
                    placeholder.style.background = 'linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.1) 100%)';
                }
            });
        });

        // 标签悬停动画增强
        document.querySelectorAll('.tag-item').forEach(tag => {
            tag.addEventListener('mouseenter', function() {
                const dot = this.querySelector('.tag-dot');
                if (dot) {
                    dot.style.transform = 'scale(1.3)';
                }
            });
            tag.addEventListener('mouseleave', function() {
                const dot = this.querySelector('.tag-dot');
                if (dot) {
                    dot.style.transform = 'scale(1)';
                }
            });
        });

        // 站点卡片触摸优化（移动端）
        if ('ontouchstart' in window) {
            document.querySelectorAll('.site-card').forEach(card => {
                card.addEventListener('touchstart', function() {
                    this.style.transform = 'translateY(-4px)';
                }, { passive: true });
                card.addEventListener('touchend', function() {
                    this.style.transform = '';
                }, { passive: true });
            });
        }
    });

    // 图片预加载函数
    function preloadImage(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = resolve;
            img.onerror = reject;
            img.src = url;
        });
    }

    // 批量预加载关键图片
    const criticalImages = [
        'https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640'
    ];
    
    criticalImages.forEach(url => preloadImage(url).catch(() => {}));
</script>

<script src="asset/js/iconfont.js"></script>

<!-- 额外的SVG图标定义（如果iconfont.js中没有这些图标） -->
<svg style="display:none;" aria-hidden="true">
    <symbol id="icon-biaoqian" viewBox="0 0 1024 1024">
        <path d="M483.2 976c-25.6 0-51.2-9.6-70.4-28.8L76.8 611.2c-19.2-19.2-28.8-44.8-28.8-70.4V176c0-54.4 44.8-99.2 99.2-99.2h364.8c25.6 0 51.2 9.6 70.4 28.8l336 336c38.4 38.4 38.4 102.4 0 140.8L553.6 947.2c-19.2 19.2-44.8 28.8-70.4 28.8zM147.2 140.8c-19.2 0-35.2 16-35.2 35.2v364.8c0 9.6 3.2 16 9.6 22.4l336 336c12.8 12.8 32 12.8 44.8 0l364.8-364.8c12.8-12.8 12.8-32 0-44.8l-336-336c-6.4-6.4-12.8-9.6-22.4-9.6H147.2v-3.2z"/>
        <path d="M275.2 460.8c-51.2 0-92.8-41.6-92.8-92.8s41.6-92.8 92.8-92.8 92.8 41.6 92.8 92.8-41.6 92.8-92.8 92.8z m0-121.6c-16 0-28.8 12.8-28.8 28.8s12.8 28.8 28.8 28.8 28.8-12.8 28.8-28.8-12.8-28.8-28.8-28.8z"/>
    </symbol>
    <symbol id="icon-code" viewBox="0 0 1024 1024">
        <path d="M153.6 716.8c-9.6 0-16-3.2-22.4-9.6-12.8-12.8-12.8-32 0-44.8l192-192-192-192c-12.8-12.8-12.8-32 0-44.8s32-12.8 44.8 0l214.4 214.4c12.8 12.8 12.8 32 0 44.8L176 707.2c-6.4 6.4-12.8 9.6-22.4 9.6zM416 704c-19.2 0-32-12.8-32-32s12.8-32 32-32h256c19.2 0 32 12.8 32 32s-12.8 32-32 32H416z"/>
    </symbol>
    <symbol id="icon-blog" viewBox="0 0 1024 1024">
        <path d="M864 96H160c-35.2 0-64 28.8-64 64v704c0 35.2 28.8 64 64 64h704c35.2 0 64-28.8 64-64V160c0-35.2-28.8-64-64-64z m0 768H160V160h704v704z"/>
        <path d="M288 352h448v64H288zM288 512h448v64H288zM288 672h256v64H288z"/>
    </symbol>
    <symbol id="icon-message" viewBox="0 0 1024 1024">
        <path d="M512 64C264.6 64 64 238.6 64 454.5c0 118.8 62.8 225.2 161.1 295.9l-40.5 156.5c-3.3 12.8 1.5 26.5 12 34.8 6.3 5 14 7.5 21.7 7.5 5.8 0 11.6-1.4 17-4.2L416 848.6c31.1 6.4 63.2 9.9 96 9.9 247.4 0 448-174.6 448-390.5S759.4 64 512 64z m0 717c-32.4 0-64.3-4-95.1-12.1l-23.5-6.2-152.5 82.4 32.4-125.2-21.5-15.6c-89.2-64.5-140.3-160.7-140.3-263.8C111.5 264.5 289.8 128 512 128c222.2 0 400.5 136.5 400.5 326.5S734.2 781 512 781z"/>
    </symbol>
    <symbol id="icon-dashboard" viewBox="0 0 1024 1024">
        <path d="M924.8 385.6c-22.6-53.4-54.8-101.4-96-142.4-41.2-41.2-89.2-73.4-142.4-96C631.2 123.8 572.8 112 512 112s-119.2 11.8-174.4 35.2c-53.4 22.6-101.4 54.8-142.4 96-41.2 41.2-73.4 89.2-96 142.4C75.8 440.8 64 499.2 64 560c0 132.6 52.8 259.8 146.6 353.6l45.2-45.2C176.4 789.2 128 677.6 128 560c0-212 172-384 384-384s384 172 384 384c0 117.6-48.4 229.2-127.8 308.4l45.2 45.2C907.2 819.8 960 692.6 960 560c0-60.8-11.8-119.2-35.2-174.4z"/>
        <path d="M512 272c-159.1 0-288 128.9-288 288s128.9 288 288 288 288-128.9 288-288-128.9-288-288-288z m0 512c-123.5 0-224-100.5-224-224s100.5-224 224-224 224 100.5 224 224-100.5 224-224 224z"/>
        <path d="M512 432c-70.7 0-128 57.3-128 128s57.3 128 128 128 128-57.3 128-128-57.3-128-128-128z m0 192c-35.3 0-64-28.7-64-64s28.7-64 64-64 64 28.7 64 64-28.7 64-64 64z"/>
    </symbol>
    <symbol id="icon-shop" viewBox="0 0 1024 1024">
        <path d="M922.9 318.1l-67.8-161.5c-6.4-15.2-21.2-25.1-37.8-25.1H206.7c-16.6 0-31.4 9.9-37.8 25.1L101.1 318.1c-4.1 9.8-4.1 20.8 0 30.6 4.1 9.8 12.1 17.2 22.1 20.5v459.3c0 22.1 17.9 40 40 40h697.6c22.1 0 40-17.9 40-40V369.2c10-3.3 18-10.7 22.1-20.5 4.1-9.8 4.1-20.8 0-30.6zM836.8 804.5H187.2V385.4h649.6v419.1zM223.7 195.5h576.6l50.5 120.2H173.2l50.5-120.2z"/>
        <path d="M352 512h320v64H352z"/>
    </symbol>
    <symbol id="icon-pay" viewBox="0 0 1024 1024">
        <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64z m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"/>
        <path d="M512 288c-17.7 0-32 14.3-32 32v96h-96c-17.7 0-32 14.3-32 32s14.3 32 32 32h96v96c0 17.7 14.3 32 32 32s32-14.3 32-32v-96h96c17.7 0 32-14.3 32-32s-14.3-32-32-32h-96v-96c0-17.7-14.3-32-32-32z"/>
    </symbol>
    <symbol id="icon-auth" viewBox="0 0 1024 1024">
        <path d="M512 64L128 192v256c0 212.1 165.1 390.3 384 447.9 218.9-57.6 384-235.8 384-447.9V192L512 64z m320 384c0 164.5-121.5 310.4-320 369.6-198.5-59.2-320-205.1-320-369.6V241.8l320-99.6 320 99.6V448z"/>
        <path d="M438.4 497.6L358.4 577.6l45.2 45.2 80-80L668.8 358.4l-45.2-45.2z"/>
    </symbol>
    <symbol id="icon-school" viewBox="0 0 1024 1024">
        <path d="M512 128L64 320l448 192 448-192-448-192z m0 73.6l292.8 126.4L512 454.4 219.2 328 512 201.6z"/>
        <path d="M128 416v256l384 160 384-160V416L512 576 128 416z m704 203.2L512 760l-320-140.8V475.2l320 140.8 320-140.8v144z"/>
        <path d="M896 416v384h64V416z"/>
    </symbol>
    <symbol id="icon-home" viewBox="0 0 1024 1024">
        <path d="M946.5 505L560.1 118.8l-25.9-25.9c-12.3-12.2-32.1-12.2-44.4 0L77.5 505c-12.3 12.3-18.9 28.6-18.8 46 0.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8 12.1-12.1 18.7-28.2 18.7-45.3 0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204z m217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z"/>
    </symbol>
</svg>

<script>
    // 优化后的 Toast 提示函数
    function showToast(message, duration = 3000) {
        const container = document.getElementById('toast-container');
        
        // 创建 toast 元素
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <span class="toast-icon">💬</span>
            <span class="toast-message">${message}</span>
            <button class="toast-close" aria-label="关闭提示">&times;</button>
        `;
        
        // 添加样式
        if (!document.getElementById('toast-styles')) {
            const styles = document.createElement('style');
            styles.id = 'toast-styles';
            styles.textContent = `
                #toast-container {
                    position: fixed;
                    top: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    z-index: 10000;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    pointer-events: none;
                }
                
                .toast-notification {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
                    color: #1a202c;
                    padding: 14px 20px;
                    border-radius: 16px;
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 
                                0 2px 10px rgba(0, 0, 0, 0.1),
                                inset 0 1px 0 rgba(255, 255, 255, 0.5);
                    font-size: 14px;
                    font-weight: 500;
                    pointer-events: auto;
                    animation: toastSlideIn 0.4s cubic-bezier(0.21, 1.02, 0.73, 1);
                    border: 1px solid rgba(102, 126, 234, 0.2);
                    max-width: 90vw;
                }
                
                .toast-notification.hiding {
                    animation: toastSlideOut 0.3s ease forwards;
                }
                
                .toast-icon {
                    font-size: 20px;
                    flex-shrink: 0;
                }
                
                .toast-message {
                    flex: 1;
                    line-height: 1.4;
                }
                
                .toast-close {
                    background: none;
                    border: none;
                    color: #a0aec0;
                    font-size: 20px;
                    cursor: pointer;
                    padding: 0 4px;
                    line-height: 1;
                    transition: color 0.2s ease, transform 0.2s ease;
                    flex-shrink: 0;
                }
                
                .toast-close:hover {
                    color: #4a5568;
                    transform: scale(1.2);
                }
                
                .toast-close:focus {
                    outline: 2px solid #667eea;
                    outline-offset: 2px;
                    border-radius: 4px;
                }
                
                @keyframes toastSlideIn {
                    from {
                        opacity: 0;
                        transform: translateY(-30px) scale(0.9);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }
                
                @keyframes toastSlideOut {
                    from {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                    to {
                        opacity: 0;
                        transform: translateY(-20px) scale(0.9);
                    }
                }

                @media (prefers-reduced-motion: reduce) {
                    .toast-notification {
                        animation: none;
                    }
                    .toast-notification.hiding {
                        animation: none;
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(styles);
        }
        
        // 关闭按钮事件
        const closeBtn = toast.querySelector('.toast-close');
        const closeToast = () => {
            toast.classList.add('hiding');
            setTimeout(() => toast.remove(), 300);
        };
        
        closeBtn.addEventListener('click', closeToast);
        
        // 键盘支持
        toast.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' || e.key === 'Enter') {
                closeToast();
            }
        });
        
        container.appendChild(toast);
        
        // 自动关闭
        setTimeout(closeToast, duration);
    }

    // 保持向后兼容
    function tip() {
        showToast('点旁边QQ我就告诉你😏');
    }
</script>

<script type="text/javascript">
    function runtime() {
        var startTime = new Date("02/15/2024 00:00:00");
        var currentTime = new Date();
        var timeDiff = currentTime.getTime() - startTime.getTime();
        
        var days = Math.floor(timeDiff / (24 * 60 * 60 * 1000));
        var hours = Math.floor((timeDiff % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
        var minutes = Math.floor((timeDiff % (60 * 60 * 1000)) / (60 * 1000));
        var seconds = Math.floor((timeDiff % (60 * 1000)) / 1000);
        
        var spanElement = document.getElementById("span");
        if (spanElement) {
            spanElement.innerHTML = `🚀 本网站已运行: <strong>${days}</strong>天 <strong>${hours}</strong>小时 <strong>${minutes}</strong>分 <strong>${seconds}</strong>秒`;
        }
    }
    
    // 确保 DOM 加载完成后再运行
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            runtime();
            setInterval(runtime, 1000);
        });
    } else {
        runtime();
        setInterval(runtime, 1000);
    }
</script>

<!-- 页面性能优化脚本 -->
<script>
    // 延迟加载非关键资源
    document.addEventListener('DOMContentLoaded', function() {
        // 网站截图图片使用备用方案
        const siteImages = document.querySelectorAll('.site-card-image img');
        
        siteImages.forEach((img, index) => {
            // 设置加载超时，如果10秒内没有加载成功则显示占位符
            const timeout = setTimeout(() => {
                if (!img.classList.contains('loaded')) {
                    img.style.display = 'none';
                    const placeholder = img.nextElementSibling;
                    if (placeholder) {
                        placeholder.classList.remove('skeleton');
                        placeholder.style.background = 'linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.15) 100%)';
                    }
                }
            }, 10000);

            img.addEventListener('load', function() {
                clearTimeout(timeout);
                this.classList.add('loaded');
            });
        });

        // 平滑滚动到锚点
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // 添加页面可见性变化处理（节省资源）
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // 页面不可见时暂停动画
                document.body.style.setProperty('--animation-play-state', 'paused');
            } else {
                // 页面可见时恢复动画
                document.body.style.setProperty('--animation-play-state', 'running');
            }
        });
    });

    // 控制台欢迎信息
    console.log('%c 欢迎访问田小橙个人主页 ', 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px 20px; border-radius: 8px; font-size: 16px; font-weight: bold;');
    console.log('%c 如有问题请联系QQ: 2768651338 ', 'color: #667eea; font-size: 12px;');
</script>

<!-- 可选：添加页面进入动画 -->
<style>
    /* 页面元素进入动画 */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bc_box {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .bc-row > div:nth-child(1) .bc_box { animation-delay: 0.1s; }
    .bc-row > div:nth-child(2) .bc_box { animation-delay: 0.15s; }
    .bc-row > div:nth-child(3) .bc_box { animation-delay: 0.2s; }
    .bc-row > div:nth-child(4) .bc_box { animation-delay: 0.25s; }
    .bc-row > div:nth-child(5) .bc_box { animation-delay: 0.3s; }
    .bc-row > div:nth-child(6) .bc_box { animation-delay: 0.35s; }

    /* 站点卡片依次进入动画 */
    .site-card {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .site-grid .site-card:nth-child(1) { animation-delay: 0.1s; }
    .site-grid .site-card:nth-child(2) { animation-delay: 0.15s; }
    .site-grid .site-card:nth-child(3) { animation-delay: 0.2s; }
    .site-grid .site-card:nth-child(4) { animation-delay: 0.25s; }
    .site-grid .site-card:nth-child(5) { animation-delay: 0.3s; }
    .site-grid .site-card:nth-child(6) { animation-delay: 0.35s; }
    .site-grid .site-card:nth-child(7) { animation-delay: 0.4s; }

    /* 标签进入动画 */
    .tag-item {
        animation: fadeInUp 0.4s ease-out forwards;
        opacity: 0;
    }

    .tags-container .tag-item:nth-child(1) { animation-delay: 0.05s; }
    .tags-container .tag-item:nth-child(2) { animation-delay: 0.1s; }
    .tags-container .tag-item:nth-child(3) { animation-delay: 0.15s; }
    .tags-container .tag-item:nth-child(4) { animation-delay: 0.2s; }
    .tags-container .tag-item:nth-child(5) { animation-delay: 0.25s; }
    .tags-container .tag-item:nth-child(6) { animation-delay: 0.3s; }

    /* 减少动画偏好时禁用所有动画 */
    @media (prefers-reduced-motion: reduce) {
        .bc_box,
        .site-card,
        .tag-item,
        .friend-card {
            animation: none;
            opacity: 1;
        }
    }

    /* 友链卡片动画 */
    .friend-card {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .friend-grid .friend-card:nth-child(1) { animation-delay: 0.1s; }
    .friend-grid .friend-card:nth-child(2) { animation-delay: 0.15s; }
</style>

</body>
</html>

