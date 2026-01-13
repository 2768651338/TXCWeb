<?php
/**
 * TXCWeb - 田小橙个人主页
 *
 * Copyright (c) 2024-2026 田小橙 (TXC)
 * Licensed under the MIT License
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Project URL: https://github.com/yourusername/TXCWeb
 * Author Website: https://txc666.cn
 */

    $qq_link = "https://qm.qq.com/q/mOLOGhAQjC"; //qq链接

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="田小橙主页">
    <meta name="description" content="田小橙个人主页，简约而不简单。">
    <link rel="shortcut icon" href="https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640" />
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/bc.css">
    
    <!-- 网站炫彩备案 -->
    <style>
        .by-p {
        font-weight: 600;
        color: #8c888b;
        background: -webkit-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5);
        background: -moz-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5);
        background: -ms-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5);
        color: transparent;
        -webkit-background-clip: text;
        animation: ran 20s linear infinite;
        }
        @keyframes ran {
            from {
                background-position: 0;
            }
            to {
                background-position: 2000px 0;
            }
        }
    </style>
    
    <!-- 网站运行时间 -->
    <style>
        #time-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 5vh;
            margin: 0;
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
                            <img class="bc_mbl bc_box img-avatar" style="border-radius: 50%;" src="https://q1.qlogo.cn/g?b=qq&nk=2768651338&s=640">
                        </div>
                        <div class="bc-xs9">
                            <div class="bc-xs12">
                                <div id="bc_name">田小橙</div>
                                <div id="bc_tip">Tips：始终拥抱美好的未来</div>
                            </div>
                            <!-- 日期时间 -->
                            <span id=localtime></span>
                            <script type="text/javascript">
                                function showLocale(objD) {
                                    var str,colorhead,colorfoot;
                                    var yy = objD.getYear();
                                    if(yy<1900) yy = yy+1900;
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
                                    if ( ww==0 ) colorhead="<font color=\"#ffffff\">";
                                    if ( ww > 0 && ww < 6 ) colorhead="<font color=\"#ffffff\">";
                                    if ( ww==6 ) colorhead="<font color=\"#ffffff\">";
                                    if (ww==0) ww="星期天";
                                    if (ww==1) ww="星期一";
                                    if (ww==2) ww="星期二";
                                    if (ww==3) ww="星期三";
                                    if (ww==4) ww="星期四";
                                    if (ww==5) ww="星期五";
                                    if (ww==6) ww="星期六";
                                    colorfoot="</font>"
                                    str = colorhead + yy + "年" + MM + "月" + dd + " " + hh + "点" + mm + "分" + ss + " " + ww + colorfoot;
                                    return(str);}
                                function tick() {
                                    var today;
                                    today = new Date();
                                    document.getElementById("localtime").innerHTML = showLocale(today);
                                    window.setTimeout("tick()", 1000);}
                                tick();
                            </script>
                            <div class="bc-xs12">
                                <a class="btn">标签：</a>
                                <p></p>
                                <a class="btn btn-green">独立软件开发者</a>
                                <a class="btn btn-yellow">独立网站开发者</a>
                                <a class="btn btn-blue">全栈工程师</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bc-xs4 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href="#" onclick="tip()">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-weixin"></use></svg>
                        <span style="color:#FFF;">微信</span></a>
                </div>
            </div>
            <div class="bc-xs5 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href='<?= $qq_link; ?>'>
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-QQ"></use></svg>
                        <span style="color:#FFF;">QQ</span></a>
                </div>
            </div>
            <div class="bc-xs3 bc-sm2 bc-md2 bc-lg2">
                <div class="bc_box bc_mbl bc_center">
                    <a href="#" onclick="tip()">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-gitee"></use></svg>
                        <span style="color:#FFF;">群聊</span></a>
                </div>
            </div>
            <div class="bc-sm6 bc-md4 bc-lg6 bc-hide-xs">
                <div class="bc_box bc_mbl">
                    <div class="bc_box bc_mbl">
                        <p>如果您喜欢我们的网站，请将本站添加到收藏夹（快捷键<code>Ctrl+D</code>），并<a class="btn btn-green" href="https://jingyan.baidu.com/article/4dc40848868eba89d946f1c0.html" target="_blank">设为浏览器主页</a>，方便您的下次访问，感谢支持。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bc-row bc-space10">
            <div class="bc-xs12 bc-sm7 bc-md7 bc-lg7">
                <div class="bc_box bc_mbl">
                    <div class="bc-row">
                        <h3 class="bc-xs12 bc_box"><svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-zhandian"></use>
                            </svg>旗下站点</h3><hr>
                    </div>
                    <div class="bc-row bc-space10" style="word-wrap:break-word;">
                        <a href="https://blog.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>田小橙博客</div></a>
                        <a href="https://starboard.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>星河留言板</div></a>
                        <a href="https://th.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>太荒后台</div></a>
                        <a href="https://shop.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>田小橙云商店</div></a>
                        <a href="https://pay.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>筑梦云支付</div></a>
                        <a href="https://auth.txc666.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>田小橙授权站</div></a>
                        <a href="https://www.yuncampus.cn/" class="bc-xs6 bc-sm4 bc-md4 bc-lg4">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>云枢校园</div></a>
                    </div>
                </div>
            </div>
            <div class="bc-xs12 bc-sm5 bc-md5 bc-lg5">
                <div class="bc_box bc_mbl">
                    <div class="bc-row">
                        <h3 class="bc-xs12 bc_box"><svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-zhandian"></use>
                            </svg>友情链接</h3><hr>
                    </div>
                    <div class="bc-row bc-space10" style="word-wrap:break-word;">
                        <a href="https://bit.txc666.cn/" class="bc-xs6 bc-sm6 bc-md6 bc-lg6">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>智创比特团队</div></a>
                        <a href="#" class="bc-xs6 bc-sm6 bc-md6 bc-lg6">
                            <div class="bc_a btn-blue bc_center"><svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-lianjie"></use>
                                </svg>待入驻</div></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bc-row bc-space10">
            <div class="bc-xs12">
                <div class="bc_mbl bc_box" id="bc_foot">Copyright © 2024-2025 田小橙主页<span class="btn bc-hide-xs">收藏本站（快捷键<code>Ctrl+D</code>）</span>
                <p></p>
                <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=45272402000026"  rel="external nofollow"  rel="external nofollow" ><span class="by-p">桂公网安备45272402000026号</span></a>
                <a href="https://beian.miit.gov.cn/#/Integrated/index"  rel="external nofollow"  rel="external nofollow" ><span class="by-p">桂ICP备2024037782号</span></a>
                </div>
                <div id="time-container">
                    <span id="span"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="asset/js/iconfont.js"></script>
<script>
    function tip() {
        alert("点旁边QQ我就告诉你😏");
    }
</script>
<span id="span"></span>
<script type="text/javascript">
        function runtime() {
            var startTime = new Date("02/15/2024 00:00:00");
            var currentTime = new Date();
            var timeDiff = currentTime.getTime() - startTime.getTime();
            var days = Math.floor(timeDiff / (24 * 60 * 60 * 1000));
            var hours = Math.floor((timeDiff % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
            var minutes = Math.floor((timeDiff % (60 * 60 * 1000)) / (60 * 1000));
            var seconds = Math.floor((timeDiff % (60 * 1000)) / 1000);
            document.getElementById("span").innerHTML = "本网站已运行: " + days + "天" + hours + "小时" + minutes + "分" + seconds + "秒";
        }
        setInterval(runtime, 1000);
</script>
</body>
</html>