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

        /* ========== 标签按钮优化 ========== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-xs) var(--spacing-sm);
            margin: 3px;
            border-radius: var(--border-radius-sm);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all var(--transition-fast);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left var(--transition-slow);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-green {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
        }

        .btn-green:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.5);
            filter: brightness(1.1);
        }

        .btn-yellow {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(237, 137, 54, 0.3);
        }

        .btn-yellow:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(237, 137, 54, 0.5);
            filter: brightness(1.1);
        }

        .btn-blue {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(66, 153, 225, 0.3);
        }

        .btn-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.5);
            filter: brightness(1.1);
        }

        /* 按钮点击效果 */
        .btn:active {
            transform: translateY(0) scale(0.98);
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

        /* ========== 站点链接卡片优化 ========== */
        .bc_a {
            padding: var(--spacing-md);
            margin: var(--spacing-xs);
            border-radius: var(--border-radius-md);
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.9) 0%, rgba(49, 130, 206, 0.9) 100%);
            color: white;
            font-weight: 500;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
            position: relative;
            overflow: hidden;
        }

        .bc_a::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .bc_a:hover::after {
            width: 300px;
            height: 300px;
        }

        .bc_a:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(66, 153, 225, 0.4);
            background: linear-gradient(135deg, rgba(76, 163, 235, 1) 0%, rgba(59, 140, 216, 1) 100%);
        }

        .bc_a:active {
            transform: translateY(-2px) scale(0.98);
        }

        .bc_a .icon {
            transition: transform var(--transition-fast);
            position: relative;
            z-index: 1;
        }

        .bc_a:hover .icon {
            transform: rotate(-10deg) scale(1.1);
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

        /* ========== 响应式优化 ========== */
        @media (max-width: 768px) {
            .bc_a {
                font-size: 12px;
                padding: var(--spacing-sm) var(--spacing-md);
            }

            #bc_name {
                font-size: 18px;
            }

            .btn {
                font-size: 11px;
                padding: 3px 6px;
            }

            #time-container {
                font-size: 11px;
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
                            <div class="bc-xs12">
                                <span class="btn" aria-hidden="true">标签：</span>
                                <a class="btn btn-green" href="javascript:void(0)" aria-label="身份标签：独立软件开发者">独立软件开发者</a>
                                <a class="btn btn-yellow" href="javascript:void(0)" aria-label="身份标签：独立网站开发者">独立网站开发者</a>
                                <a class="btn btn-blue" href="javascript:void(0)" aria-label="身份标签：全栈工程师">全栈工程师</a>
                            </div>
                            <div class="bc-xs12">
                                <span class="btn" aria-hidden="true">语言：</span>
                                <a class="btn btn-green" href="javascript:void(0)" aria-label="编程语言：PHP">PHP</a>
                                <a class="btn btn-yellow" href="javascript:void(0)" aria-label="标记语言：HTML">HTML</a>
                                <a class="btn btn-blue" href="javascript:void(0)" aria-label="样式语言：CSS">CSS</a>
                                <a class="btn btn-green" href="javascript:void(0)" aria-label="编程语言：JAVA">JAVA</a>
                                <a class="btn btn-yellow" href="javascript:void(0)" aria-label="编程语言：C">C</a>
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
                    <a href='<?= htmlspecialchars($qq_link, ENT_QUOTES, 'UTF-8'); ?>' target="_blank" rel="noopener noreferrer" aria-label="点击添加QQ好友" role="button">
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
                <div class="bc_box bc_mbl">
                    <p style="line-height: 1.8; opacity: 0.95;">如果您喜欢我们的网站，请将本站添加到收藏夹（快捷键<code>Ctrl+D</code>），并<a class="btn btn-green" href="https://jingyan.baidu.com/article/4dc40848868eba89d946f1c0.html" target="_blank" rel="noopener noreferrer">设为浏览器主页</a>，方便您的下次访问，感谢支持。</p>
                </div>
            </div>
        </div>
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
                    <nav class="bc-row bc-space10" style="word-wrap:break-word;" aria-label="旗下站点导航">
                        <a href="https://blog.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙博客">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>田小橙博客</span>
                            </div>
                        </a>
                        <a href="https://starboard.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问星河留言板">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>星河留言板</span>
                            </div>
                        </a>
                        <a href="https://th.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问太荒后台">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>太荒后台</span>
                            </div>
                        </a>
                        <a href="https://shop.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙云商店">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>田小橙云商店</span>
                            </div>
                        </a>
                        <a href="https://pay.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问筑梦云支付">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>筑梦云支付</span>
                            </div>
                        </a>
                        <a href="https://auth.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问田小橙授权站">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>田小橙授权站</span>
                            </div>
                        </a>
                        <a href="https://www.yuncampus.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4" target="_blank" rel="noopener noreferrer" aria-label="访问云枢校园">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>云枢校园</span>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
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
                    <nav class="bc-row bc-space10" style="word-wrap:break-word;" aria-label="友情链接导航">
                        <a href="https://bit.txc666.cn/" class="bc-xs6 bc-sm6 bc-md6 bc-lg6" target="_blank" rel="noopener noreferrer" aria-label="访问智创比特团队">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>智创比特团队</span>
                            </div>
                        </a>
                        <a href="#" class="bc-xs6 bc-sm6 bc-md6 bc-lg6" onclick="showToast('该位置正在招募友链入驻~'); return false;" aria-label="友链位置待入驻">
                            <div class="bc_a btn-blue bc_center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>
                                <span>待入驻</span>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bc-row bc-space10">
            <div class="bc-xs12">
                <footer class="bc_mbl bc_box" id="bc_foot">
                    <p>Copyright © 2024-2026 田小橙主页<span class="btn bc-hide-xs">收藏本站（快捷键<code>Ctrl+D</code>）</span></p>
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

<script src="asset/js/iconfont.js"></script>
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
        toast.addEventListener('click', closeToast);
        
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
</body>
</html>
