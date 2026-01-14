// 导航切换
document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        const section = this.dataset.section;
        document.querySelectorAll('.content-panel').forEach(p => p.classList.remove('active'));
        document.getElementById(section + 'Panel').classList.add('active');
        
        // 加载对应数据
        loadData(section);
    });
});

// 加载数据
async function loadData(section) {
    switch(section) {
        case 'dashboard':
            loadDashboard();
            break;
        case 'config':
            loadConfig();
            break;
        case 'profile':
            loadProfile();
            break;
        case 'sites':
            loadSites();
            break;
        case 'friends':
            loadFriends();
            break;
        case 'version':
            loadBackups();
            break;
    }
}

// 加载仪表盘
async function loadDashboard() {
    try {
        const response = await fetch('api/data.php?type=config');
        const data = await response.json();
        
        if (data.success && data.data) {
            document.getElementById('lastModified').textContent = 
                new Date(data.data.lastModified).toLocaleString('zh-CN');
        }
    } catch (error) {
        console.error('加载仪表盘失败:', error);
    }
}

// 加载配置
async function loadConfig() {
    try {
        const response = await fetch('api/data.php?type=config');
        const result = await response.json();

        if (result.success && result.data) {
            const config = result.data;
            const list = document.getElementById('configList');
            list.innerHTML = `
                <div class="data-item">
                    <div class="data-info">
                        <h3>网站标题</h3>
                        <p>${config.site?.title || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>网站描述</h3>
                        <p>${config.site?.description || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>关键词</h3>
                        <p>${config.site?.keywords || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>主题颜色</h3>
                        <p>${config.site?.themeColor || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>版权信息</h3>
                        <p>${config.site?.copyright || ''}</p>
                    </div>
                </div>
            `;
        }
    } catch (error) {
        console.error('加载配置失败:', error);
        showToast('加载配置失败，请检查网络连接', 'error');
    }
}

// 加载个人信息
async function loadProfile() {
    try {
        const response = await fetch('api/data.php?type=profile');
        const result = await response.json();

        if (result.success && result.data) {
            const profile = result.data;
            const list = document.getElementById('profileList');
            list.innerHTML = `
                <div class="data-item">
                    <div class="data-info">
                        <h3>头像</h3>
                        <p><img src="${profile.avatar}" style="width: 50px; height: 50px; border-radius: 50%;"></p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>名称</h3>
                        <p>${profile.name || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info">
                        <h3>口号</h3>
                        <p>${profile.slogan || ''}</p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info" style="flex: 1;">
                        <h3>身份标签 (${profile.identityTags?.length || 0})</h3>
                        <p>${profile.identityTags?.map(t => t.name).join(', ') || ''}</p>
                    </div>
                    <div class="data-actions">
                        <button class="btn-edit" onclick="editIdentityTags()">编辑</button>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-info" style="flex: 1;">
                        <h3>技术栈 (${profile.techStack?.length || 0})</h3>
                        <p>${profile.techStack?.map(t => t.name).join(', ') || ''}</p>
                    </div>
                    <div class="data-actions">
                        <button class="btn-edit" onclick="editTechStack()">编辑</button>
                    </div>
                </div>
            `;
        }
    } catch (error) {
        console.error('加载个人信息失败:', error);
        showToast('加载个人信息失败，请检查网络连接', 'error');
    }
}

// 加载站点
async function loadSites() {
    try {
        const response = await fetch('api/data.php?type=sites');
        const result = await response.json();

        if (result.success && result.data) {
            const sites = result.data.sites || [];
            const list = document.getElementById('sitesList');
            list.innerHTML = sites.map(site => `
                <div class="data-item">
                    <div class="data-info">
                        <h3>${site.name}</h3>
                        <p>${site.description || ''}</p>
                        <p style="margin-top: 4px; color: #999;">
                            <a href="${site.url}" target="_blank" style="color: #667eea;">${site.url}</a>
                            <span class="status-badge ${site.status === 'running' ? 'status-running' : 'status-stopped'}"
                                  style="margin-left: 10px;">
                                ${site.status === 'running' ? '运行中' : '已停止'}
                            </span>
                        </p>
                    </div>
                    <div class="data-actions">
                        <button class="btn-edit" onclick="editSite('${site.id}')">编辑</button>
                        <button class="btn-delete" onclick="deleteSite('${site.id}')">删除</button>
                    </div>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('加载站点失败:', error);
        showToast('加载站点失败，请检查网络连接', 'error');
    }
}

// 加载友情链接
async function loadFriends() {
    try {
        const response = await fetch('api/data.php?type=friends');
        const result = await response.json();

        if (result.success && result.data) {
            const friends = result.data.friends || [];
            const list = document.getElementById('friendsList');
            list.innerHTML = friends.map(friend => `
                <div class="data-item">
                    <div class="data-info">
                        <h3>${friend.name}</h3>
                        <p>${friend.description || ''}</p>
                        <p style="margin-top: 4px; color: #999;">
                            <a href="${friend.url}" target="_blank" style="color: #667eea;">${friend.url}</a>
                        </p>
                    </div>
                    <div class="data-actions">
                        ${friend.status !== 'recruiting' ? `
                        <button class="btn-edit" onclick="editFriend('${friend.id}')">编辑</button>
                        <button class="btn-delete" onclick="deleteFriend('${friend.id}')">删除</button>
                        ` : '<span style="color: #999; padding: 8px;">招募中</span>'}
                    </div>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('加载友情链接失败:', error);
        showToast('加载友情链接失败，请检查网络连接', 'error');
    }
}

// 编辑配置
function editConfig() {
    showModal('编辑网站配置', `
        <div class="form-group">
            <label>网站标题</label>
            <input type="text" id="edit_title" value="">
        </div>
        <div class="form-group">
            <label>网站描述</label>
            <input type="text" id="edit_description" value="">
        </div>
        <div class="form-group">
            <label>关键词</label>
            <input type="text" id="edit_keywords" value="">
        </div>
        <div class="form-group">
            <label>主题颜色</label>
            <input type="color" id="edit_themeColor" value="#667eea">
        </div>
        <div class="form-group">
            <label>版权信息</label>
            <input type="text" id="edit_copyright" value="">
        </div>
    `, async () => {
        const data = {
            title: document.getElementById('edit_title').value,
            description: document.getElementById('edit_description').value,
            keywords: document.getElementById('edit_keywords').value,
            themeColor: document.getElementById('edit_themeColor').value,
            copyright: document.getElementById('edit_copyright').value
        };

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const loadingToast = showToast('正在保存配置...', 'loading');

        try {
            const response = await fetch('api/save.php?type=config', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            // 检查 HTTP 状态码
            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            // 解析 JSON 响应
            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            // 检查业务逻辑是否成功
            if (result.success) {
                loadingToast.success('配置保存成功');
                loadConfig();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || '保存失败');
            }
        } catch (error) {
            console.error('保存配置失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('保存失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });

    // 加载当前值
    fetch('api/data.php?type=config')
        .then(r => r.json())
        .then(result => {
            if (result.success && result.data) {
                document.getElementById('edit_title').value = result.data.site?.title || '';
                document.getElementById('edit_description').value = result.data.site?.description || '';
                document.getElementById('edit_keywords').value = result.data.site?.keywords || '';
                document.getElementById('edit_themeColor').value = result.data.site?.themeColor || '#667eea';
                document.getElementById('edit_copyright').value = result.data.site?.copyright || '';
            }
        });
}

// 编辑个人信息
async function editProfile() {
    const response = await fetch('api/data.php?type=profile');
    const result = await response.json();

    if (!result.success || !result.data) {
        showToast('加载个人信息失败', 'error');
        return;
    }

    const profile = result.data;

    showModal('编辑个人信息', `
        <div class="form-group">
            <label>头像URL</label>
            <input type="url" id="edit_avatar" value="${profile.avatar || ''}">
        </div>
        <div class="form-group">
            <label>名称</label>
            <input type="text" id="edit_name" value="${profile.name || ''}">
        </div>
        <div class="form-group">
            <label>口号</label>
            <input type="text" id="edit_slogan" value="${profile.slogan || ''}">
        </div>
    `, async () => {
        const data = {
            avatar: document.getElementById('edit_avatar').value,
            name: document.getElementById('edit_name').value,
            slogan: document.getElementById('edit_slogan').value,
            identityTags: profile.identityTags || [],
            techStack: profile.techStack || []
        };

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const loadingToast = showToast('正在保存个人信息...', 'loading');

        try {
            const response = await fetch('api/save.php?type=profile', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success('个人信息保存成功');
                loadProfile();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || '保存失败');
            }
        } catch (error) {
            console.error('保存个人信息失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('保存失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });
}

// 编辑身份标签
async function editIdentityTags() {
    const response = await fetch('api/data.php?type=profile');
    const result = await response.json();

    if (!result.success || !result.data) {
        showToast('加载个人信息失败', 'error');
        return;
    }

    const profile = result.data;
    const tags = profile.identityTags || [];

    showModal('编辑身份标签', `
        <div id="identityTagsList">
            ${tags.map((tag, index) => `
                <div class="tag-item-edit" data-index="${index}" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 6px;">
                    <div class="form-row">
                        <div class="form-group">
                            <label>标签名称</label>
                            <input type="text" class="tag-name" value="${tag.name || ''}" placeholder="例如：独立开发者">
                        </div>
                        <div class="form-group">
                            <label>标签颜色</label>
                            <select class="tag-color">
                                <option value="tag-green" ${tag.color === 'tag-green' ? 'selected' : ''}>绿色</option>
                                <option value="tag-blue" ${tag.color === 'tag-blue' ? 'selected' : ''}>蓝色</option>
                                <option value="tag-yellow" ${tag.color === 'tag-yellow' ? 'selected' : ''}>黄色</option>
                                <option value="tag-purple" ${tag.color === 'tag-purple' ? 'selected' : ''}>紫色</option>
                                <option value="tag-red" ${tag.color === 'tag-red' ? 'selected' : ''}>红色</option>
                                <option value="tag-gray" ${tag.color === 'tag-gray' ? 'selected' : ''}>灰色</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn-delete" onclick="this.closest('.tag-item-edit').remove()" style="margin-top: 10px;">删除</button>
                </div>
            `).join('')}
        </div>
        <button type="button" class="btn-primary" onclick="addIdentityTagItem()" style="margin-top: 10px; width: 100%;">+ 添加标签</button>
    `, async () => {
        const tagItems = document.querySelectorAll('#identityTagsList .tag-item-edit');
        const identityTags = [];
        
        tagItems.forEach((item, index) => {
            const name = item.querySelector('.tag-name').value.trim();
            const color = item.querySelector('.tag-color').value;
            const id = tags[index]?.id || 'tag-' + Date.now() + '-' + index;
            
            if (name) {
                identityTags.push({ id, name, color });
            }
        });

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const loadingToast = showToast('正在保存身份标签...', 'loading');

        try {
            const response = await fetch('api/save.php?type=profile', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    avatar: profile.avatar,
                    name: profile.name,
                    slogan: profile.slogan,
                    identityTags: identityTags,
                    techStack: profile.techStack
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success('身份标签保存成功');
                loadProfile();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || '保存失败');
            }
        } catch (error) {
            console.error('保存身份标签失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('保存失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });
}

// 添加身份标签项
function addIdentityTagItem() {
    const list = document.getElementById('identityTagsList');
    const newItem = document.createElement('div');
    newItem.className = 'tag-item-edit';
    newItem.style = 'border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 6px;';
    newItem.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>标签名称</label>
                <input type="text" class="tag-name" value="" placeholder="例如：独立开发者">
            </div>
            <div class="form-group">
                <label>标签颜色</label>
                <select class="tag-color">
                    <option value="tag-green">绿色</option>
                    <option value="tag-blue">蓝色</option>
                    <option value="tag-yellow">黄色</option>
                    <option value="tag-purple">紫色</option>
                    <option value="tag-red">红色</option>
                    <option value="tag-gray">灰色</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn-delete" onclick="this.closest('.tag-item-edit').remove()" style="margin-top: 10px;">删除</button>
    `;
    list.appendChild(newItem);
}

// 编辑技术栈
async function editTechStack() {
    const response = await fetch('api/data.php?type=profile');
    const result = await response.json();

    if (!result.success || !result.data) {
        showToast('加载个人信息失败', 'error');
        return;
    }

    const profile = result.data;
    const techStack = profile.techStack || [];

    showModal('编辑技术栈', `
        <div id="techStackList">
            ${techStack.map((tech, index) => `
                <div class="tech-item-edit" data-index="${index}" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 6px;">
                    <div class="form-row">
                        <div class="form-group">
                            <label>技术名称</label>
                            <input type="text" class="tech-name" value="${tech.name || ''}" placeholder="例如：PHP">
                        </div>
                        <div class="form-group">
                            <label>图标URL</label>
                            <input type="url" class="tech-icon" value="${tech.icon || ''}" placeholder="图标地址">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>颜色</label>
                            <select class="tech-color">
                                <option value="tag-green" ${tech.color === 'tag-green' ? 'selected' : ''}>绿色</option>
                                <option value="tag-blue" ${tech.color === 'tag-blue' ? 'selected' : ''}>蓝色</option>
                                <option value="tag-yellow" ${tech.color === 'tag-yellow' ? 'selected' : ''}>黄色</option>
                                <option value="tag-purple" ${tech.color === 'tag-purple' ? 'selected' : ''}>紫色</option>
                                <option value="tag-red" ${tech.color === 'tag-red' ? 'selected' : ''}>红色</option>
                                <option value="tag-gray" ${tech.color === 'tag-gray' ? 'selected' : ''}>灰色</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>类型</label>
                            <select class="tech-type">
                                <option value="programming" ${tech.type === 'programming' ? 'selected' : ''}>编程语言</option>
                                <option value="markup" ${tech.type === 'markup' ? 'selected' : ''}>标记语言</option>
                                <option value="style" ${tech.type === 'style' ? 'selected' : ''}>样式语言</option>
                                <option value="framework" ${tech.type === 'framework' ? 'selected' : ''}>框架</option>
                                <option value="database" ${tech.type === 'database' ? 'selected' : ''}>数据库</option>
                                <option value="tool" ${tech.type === 'tool' ? 'selected' : ''}>工具</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn-delete" onclick="this.closest('.tech-item-edit').remove()" style="margin-top: 10px;">删除</button>
                </div>
            `).join('')}
        </div>
        <button type="button" class="btn-primary" onclick="addTechStackItem()" style="margin-top: 10px; width: 100%;">+ 添加技术</button>
    `, async () => {
        const techItems = document.querySelectorAll('#techStackList .tech-item-edit');
        const techStackData = [];
        
        techItems.forEach((item, index) => {
            const name = item.querySelector('.tech-name').value.trim();
            const icon = item.querySelector('.tech-icon').value.trim();
            const color = item.querySelector('.tech-color').value;
            const type = item.querySelector('.tech-type').value;
            const id = techStack[index]?.id || 'tech-' + Date.now() + '-' + index;
            
            if (name) {
                techStackData.push({ id, name, icon, color, type });
            }
        });

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const loadingToast = showToast('正在保存技术栈...', 'loading');

        try {
            const response = await fetch('api/save.php?type=profile', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    avatar: profile.avatar,
                    name: profile.name,
                    slogan: profile.slogan,
                    identityTags: profile.identityTags,
                    techStack: techStackData
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success('技术栈保存成功');
                loadProfile();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || '保存失败');
            }
        } catch (error) {
            console.error('保存技术栈失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('保存失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });
}

// 添加技术栈项
function addTechStackItem() {
    const list = document.getElementById('techStackList');
    const newItem = document.createElement('div');
    newItem.className = 'tech-item-edit';
    newItem.style = 'border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 6px;';
    newItem.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>技术名称</label>
                <input type="text" class="tech-name" value="" placeholder="例如：PHP">
            </div>
            <div class="form-group">
                <label>图标URL</label>
                <input type="url" class="tech-icon" value="" placeholder="图标地址">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>颜色</label>
                <select class="tech-color">
                    <option value="tag-green">绿色</option>
                    <option value="tag-blue">蓝色</option>
                    <option value="tag-yellow">黄色</option>
                    <option value="tag-purple">紫色</option>
                    <option value="tag-red">红色</option>
                    <option value="tag-gray">灰色</option>
                </select>
            </div>
            <div class="form-group">
                <label>类型</label>
                <select class="tech-type">
                    <option value="programming">编程语言</option>
                    <option value="markup">标记语言</option>
                    <option value="style">样式语言</option>
                    <option value="framework">框架</option>
                    <option value="database">数据库</option>
                    <option value="tool">工具</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn-delete" onclick="this.closest('.tech-item-edit').remove()" style="margin-top: 10px;">删除</button>
    `;
    list.appendChild(newItem);
}

// 添加站点
function addSite() {
    showSiteModal('添加站点', null);
}

// 编辑站点
async function editSite(id) {
    const response = await fetch('api/data.php?type=sites');
    const result = await response.json();
    
    if (result.success && result.data) {
        const site = result.data.sites.find(s => s.id === id);
        if (site) {
            showSiteModal('编辑站点', site);
        }
    }
}

function showSiteModal(title, site) {
    const isEdit = site !== null;
    showModal(title, `
        <div class="form-group">
            <label>站点名称</label>
            <input type="text" id="site_name" value="${site?.name || ''}">
        </div>
        <div class="form-group">
            <label>站点URL</label>
            <input type="url" id="site_url" value="${site?.url || ''}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <textarea id="site_description">${site?.description || ''}</textarea>
        </div>
        <div class="form-group">
            <label>图标</label>
            <select id="site_icon">
                <option value="icon-blog" ${site?.icon === 'icon-blog' ? 'selected' : ''}>博客</option>
                <option value="icon-message" ${site?.icon === 'icon-message' ? 'selected' : ''}>留言板</option>
                <option value="icon-dashboard" ${site?.icon === 'icon-dashboard' ? 'selected' : ''}>后台</option>
                <option value="icon-shop" ${site?.icon === 'icon-shop' ? 'selected' : ''}>商店</option>
                <option value="icon-pay" ${site?.icon === 'icon-pay' ? 'selected' : ''}>支付</option>
                <option value="icon-auth" ${site?.icon === 'icon-auth' ? 'selected' : ''}>授权</option>
                <option value="icon-school" ${site?.icon === 'icon-school' ? 'selected' : ''}>校园</option>
            </select>
        </div>
        <div class="form-group">
            <label>状态</label>
            <select id="site_status">
                <option value="running" ${site?.status === 'running' ? 'selected' : ''}>运行中</option>
                <option value="stopped" ${site?.status === 'stopped' ? 'selected' : ''}>已停止</option>
            </select>
        </div>
    `, async () => {
        const data = {
            id: site?.id || 'site-' + Date.now(),
            name: document.getElementById('site_name').value,
            url: document.getElementById('site_url').value,
            description: document.getElementById('site_description').value,
            icon: document.getElementById('site_icon').value,
            status: document.getElementById('site_status').value
        };

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const action = isEdit ? '更新' : '添加';
        const loadingToast = showToast(`正在${action}站点...`, 'loading');

        try {
            const response = await fetch('api/save.php?type=site&action=' + (isEdit ? 'update' : 'add'), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success(`站点${action}成功`);
                loadSites();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || `站点${action}失败`);
            }
        } catch (error) {
            console.error('保存站点失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('操作失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });
}

// 删除站点
async function deleteSite(id) {
    if (!confirm('确定要删除这个站点吗？')) return;

    const loadingToast = showToast('正在删除站点...', 'loading');

    try {
        const response = await fetch('api/save.php?type=site&action=delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        if (!response.ok) {
            throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
        }

        let result;
        try {
            result = await response.json();
        } catch (jsonError) {
            throw new Error('服务器响应格式错误');
        }

        if (result.success) {
            loadingToast.success('站点删除成功');
            loadSites();
        } else {
            loadingToast.error(result.message || '站点删除失败');
        }
    } catch (error) {
        console.error('删除站点失败:', error);
        if (error.message.includes('HTTP 错误')) {
            loadingToast.error('服务器错误: ' + error.message);
        } else if (error.message.includes('响应格式')) {
            loadingToast.error('服务器返回数据格式错误');
        } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
            loadingToast.error('网络连接失败,请检查网络');
        } else {
            loadingToast.error('删除失败: ' + error.message);
        }
    }
}

// 添加友链
function addFriend() {
    showFriendModal('添加友链', null);
}

// 编辑友链
async function editFriend(id) {
    const response = await fetch('api/data.php?type=friends');
    const result = await response.json();
    
    if (result.success && result.data) {
        const friend = result.data.friends.find(f => f.id === id);
        if (friend) {
            showFriendModal('编辑友链', friend);
        }
    }
}

function showFriendModal(title, friend) {
    const isEdit = friend !== null;
    showModal(title, `
        <div class="form-group">
            <label>名称</label>
            <input type="text" id="friend_name" value="${friend?.name || ''}">
        </div>
        <div class="form-group">
            <label>URL</label>
            <input type="url" id="friend_url" value="${friend?.url || ''}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <textarea id="friend_description">${friend?.description || ''}</textarea>
        </div>
        <div class="form-group">
            <label>头像URL</label>
            <input type="url" id="friend_avatar" value="${friend?.avatar || ''}">
        </div>
    `, async () => {
        const data = {
            id: friend?.id || 'friend-' + Date.now(),
            name: document.getElementById('friend_name').value,
            url: document.getElementById('friend_url').value,
            description: document.getElementById('friend_description').value,
            avatar: document.getElementById('friend_avatar').value,
            status: 'active'
        };

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const action = isEdit ? '更新' : '添加';
        const loadingToast = showToast(`正在${action}友情链接...`, 'loading');

        try {
            const response = await fetch('api/save.php?type=friend&action=' + (isEdit ? 'update' : 'add'), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success(`友情链接${action}成功`);
                loadFriends();
                setTimeout(closeModal, 500);
            } else {
                loadingToast.error(result.message || `友情链接${action}失败`);
            }
        } catch (error) {
            console.error('保存友情链接失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('操作失败: ' + error.message);
            }
        } finally {
            saveBtn.disabled = false;
        }
    });
}

// 删除友链
async function deleteFriend(id) {
    if (!confirm('确定要删除这个友情链接吗？')) return;

    const loadingToast = showToast('正在删除友情链接...', 'loading');

    try {
        const response = await fetch('api/save.php?type=friend&action=delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        if (!response.ok) {
            throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
        }

        let result;
        try {
            result = await response.json();
        } catch (jsonError) {
            throw new Error('服务器响应格式错误');
        }

        if (result.success) {
            loadingToast.success('友情链接删除成功');
            loadFriends();
        } else {
            loadingToast.error(result.message || '友情链接删除失败');
        }
    } catch (error) {
        console.error('删除友情链接失败:', error);
        if (error.message.includes('HTTP 错误')) {
            loadingToast.error('服务器错误: ' + error.message);
        } else if (error.message.includes('响应格式')) {
            loadingToast.error('服务器返回数据格式错误');
        } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
            loadingToast.error('网络连接失败,请检查网络');
        } else {
            loadingToast.error('删除失败: ' + error.message);
        }
    }
}

// 备份数据
async function backupData() {
    if (!confirm('确定要备份所有数据吗？')) return;

    const loadingToast = showToast('正在备份数据...', 'loading');

    try {
        const response = await fetch('api/backup.php');

        if (!response.ok) {
            throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
        }

        let result;
        try {
            result = await response.json();
        } catch (jsonError) {
            throw new Error('服务器响应格式错误');
        }

        if (result.success) {
            loadingToast.success('数据备份成功');
        } else {
            loadingToast.error(result.message || '数据备份失败');
        }
    } catch (error) {
        console.error('备份数据失败:', error);
        if (error.message.includes('HTTP 错误')) {
            loadingToast.error('服务器错误: ' + error.message);
        } else if (error.message.includes('响应格式')) {
            loadingToast.error('服务器返回数据格式错误');
        } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
            loadingToast.error('网络连接失败,请检查网络');
        } else {
            loadingToast.error('备份失败: ' + error.message);
        }
    }
}

// 导入备份数据
async function importData() {
    // 创建文件选择器
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'application/json';

    fileInput.onchange = async (e) => {
        const file = e.target.files[0];
        if (!file) return;

        // 验证文件扩展名
        const fileName = file.name.toLowerCase();
        if (!fileName.endsWith('.json')) {
            showToast('请选择JSON格式的备份文件', 'error');
            return;
        }

        // 验证文件名格式（可选：检查是否为标准备份文件名）
        const isValidBackupName = fileName.match(/^full_backup_\d{8}_\d{6}\.json$/) ||
                                   fileName.endsWith('_backup.json') ||
                                   fileName.endsWith('.json');

        if (!isValidBackupName) {
            if (!confirm('文件名可能不是标准备份文件格式，是否继续导入？')) {
                return;
            }
        }

        // 确认导入
        if (!confirm(`确定要导入备份文件 "${file.name}" 吗？\n\n此操作将覆盖当前数据，导入前系统会自动备份当前数据。`)) {
            return;
        }

        const loadingToast = showToast('正在导入备份数据...', 'loading');

        try {
            const formData = new FormData();
            formData.append('backupFile', file);

            const response = await fetch('api/import.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                let message = '数据导入成功！';
                if (result.importedFiles && result.importedFiles.length > 0) {
                    message += `\n已导入: ${result.importedFiles.join(', ')}`;
                }
                if (result.backupVersion) {
                    message += `\n备份版本: ${result.backupVersion}`;
                }
                if (result.backupTimestamp) {
                    const backupDate = new Date(result.backupTimestamp).toLocaleString('zh-CN');
                    message += `\n备份时间: ${backupDate}`;
                }
                if (result.warnings && result.warnings.length > 0) {
                    message += `\n\n警告:\n${result.warnings.join('\n')}`;
                }
                loadingToast.success(message);

                // 重新加载当前页面数据
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                loadingToast.error(result.message || '数据导入失败');
            }
        } catch (error) {
            console.error('导入备份数据失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('导入失败: ' + error.message);
            }
        }
    };

    fileInput.click();
}

// 加载备份列表
async function loadBackups() {
    const backupList = document.getElementById('backupList');
    backupList.innerHTML = '<div class="data-item"><div class="data-info"><p>加载中...</p></div></div>';

    try {
        const response = await fetch('api/backups.php');

        if (!response.ok) {
            throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
        }

        const result = await response.json();

        if (result.success && result.backups) {
            if (result.backups.length === 0) {
                backupList.innerHTML = '<div class="data-item"><div class="data-info"><p>暂无备份文件</p></div></div>';
                return;
            }

            let html = '';
            result.backups.forEach((backup) => {
                const filesIncluded = [];
                if (backup.hasConfig) filesIncluded.push('配置');
                if (backup.hasProfile) filesIncluded.push('个人信息');
                if (backup.hasSites) filesIncluded.push('站点');
                if (backup.hasFriends) filesIncluded.push('友情链接');

                html += `
                    <div class="data-item">
                        <div class="data-info">
                            <h3>${backup.fileName}</h3>
                            <p>
                                大小: ${backup.fileSizeFormatted} |
                                时间: ${backup.modifiedTimeFormatted}
                                ${backup.version ? ` | 版本: ${backup.version}` : ''}
                            </p>
                            <p style="margin-top: 4px; color: #999;">
                                包含: ${filesIncluded.join(', ') || '无数据'}
                            </p>
                        </div>
                        <div class="data-actions">
                            <button class="btn-edit" onclick="downloadBackup('${backup.fileName}')">下载</button>
                        </div>
                    </div>
                `;
            });

            backupList.innerHTML = html;
        } else {
            backupList.innerHTML = '<div class="data-item"><div class="data-info"><p>加载备份列表失败</p></div></div>';
        }
    } catch (error) {
        console.error('加载备份列表失败:', error);
        backupList.innerHTML = '<div class="data-item"><div class="data-info"><p>加载备份列表失败，请检查网络连接</p></div></div>';
    }
}

// 下载备份文件
function downloadBackup(fileName) {
    const url = `../data/backups/${fileName}`;
    const a = document.createElement('a');
    a.href = url;
    a.download = fileName;
    a.style.display = 'none';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    showToast('开始下载备份文件', 'success');
}


// 显示模态框
function showModal(title, content, onSave) {
    const modal = document.getElementById('editModal');
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h3>${title}</h3>
                <button class="btn-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                ${content}
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal()">取消</button>
                <button class="btn-save" id="modalSave">保存</button>
            </div>
        </div>
    `;
    
    document.getElementById('modalSave').addEventListener('click', onSave);
    modal.classList.add('active');
}

// 关闭模态框
function closeModal() {
    document.getElementById('editModal').classList.remove('active');
}

// Toast提示
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    const iconMap = {
        success: '✓',
        error: '✕',
        loading: ''
    };

    const titleMap = {
        success: '操作成功',
        error: '操作失败',
        loading: '处理中'
    };

    toast.innerHTML = `
        <div class="toast-icon">${iconMap[type]}</div>
        <div class="toast-content">
            <div class="toast-title">${titleMap[type]}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;

    container.appendChild(toast);

    // 返回一个对象,用于后续更新状态
    const toastObj = {
        element: toast,
        success: function(msg) {
            this.changeState('success', msg || message);
            return this;
        },
        error: function(msg) {
            this.changeState('error', msg || message);
            return this;
        },
        changeState: function(newType, newMessage) {
            this.element.classList.remove('loading', 'success', 'error');
            this.element.classList.add(newType);
            const iconEl = this.element.querySelector('.toast-icon');
            const titleEl = this.element.querySelector('.toast-title');
            const messageEl = this.element.querySelector('.toast-message');
            iconEl.textContent = iconMap[newType];
            titleEl.textContent = titleMap[newType];
            messageEl.textContent = newMessage || message;

            // 非loading状态下自动消失
            if (newType !== 'loading') {
                setTimeout(() => {
                    this.element.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (this.element.parentNode) {
                            this.element.remove();
                        }
                    }, 300);
                }, 3000);
            }
        }
    };

    // loading状态下不自动消失
    if (type !== 'loading') {
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    return toastObj;
}

// 统一的请求处理函数
async function handleRequest(url, options, loadingToast) {
    try {
        const response = await fetch(url, options);

        // 检查 HTTP 状态码
        if (!response.ok) {
            throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
        }

        // 解析 JSON 响应
        let result;
        try {
            result = await response.json();
        } catch (jsonError) {
            throw new Error('服务器响应格式错误');
        }

        return result;
    } catch (error) {
        console.error('请求失败:', error);

        // 根据错误类型显示不同的提示
        if (error.message.includes('HTTP 错误')) {
            throw new Error('服务器错误: ' + error.message);
        } else if (error.message.includes('响应格式')) {
            throw new Error('服务器返回数据格式错误');
        } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
            throw new Error('网络连接失败,请检查网络');
        } else {
            throw new Error('操作失败: ' + error.message);
        }
    }
}

// 退出登录
async function logout() {
    if (!confirm('确定要退出登录吗？')) return;

    await fetch('api/logout.php', { method: 'POST' });
    window.location.href = 'login.php';
}

// 修改密码
function changePassword() {
    showModal('修改密码', `
        <div class="form-group">
            <label>当前密码</label>
            <input type="password" id="currentPassword" placeholder="请输入当前密码" autocomplete="current-password">
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" id="newPassword" placeholder="请输入新密码（至少8位）" autocomplete="new-password" oninput="checkPasswordStrength()">
            <div id="passwordStrength" style="margin-top: 8px; display: flex; gap: 4px;">
                <div class="strength-bar" style="flex: 1; height: 4px; background: #e0e0e0; border-radius: 2px; transition: all 0.3s;"></div>
                <div class="strength-bar" style="flex: 1; height: 4px; background: #e0e0e0; border-radius: 2px; transition: all 0.3s;"></div>
                <div class="strength-bar" style="flex: 1; height: 4px; background: #e0e0e0; border-radius: 2px; transition: all 0.3s;"></div>
                <div class="strength-bar" style="flex: 1; height: 4px; background: #e0e0e0; border-radius: 2px; transition: all 0.3s;"></div>
            </div>
            <div id="passwordStrengthText" style="margin-top: 4px; font-size: 12px; color: #999;"></div>
        </div>
        <div class="form-group">
            <label>确认新密码</label>
            <input type="password" id="confirmPassword" placeholder="请再次输入新密码" autocomplete="new-password" oninput="checkPasswordMatch()">
            <div id="passwordMatchText" style="margin-top: 4px; font-size: 12px;"></div>
        </div>
    `, async () => {
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        // 前端验证
        if (!currentPassword) {
            showToast('请输入当前密码', 'error');
            return;
        }

        if (!newPassword) {
            showToast('请输入新密码', 'error');
            return;
        }

        if (newPassword.length < 8) {
            showToast('新密码长度不能少于8位', 'error');
            return;
        }

        if (newPassword === currentPassword) {
            showToast('新密码不能与当前密码相同', 'error');
            return;
        }

        if (newPassword !== confirmPassword) {
            showToast('两次输入的新密码不一致', 'error');
            return;
        }

        // 检查密码强度
        const strength = getPasswordStrength(newPassword);
        if (strength.score < 2) {
            showToast('密码强度过低，请使用更强的密码', 'error');
            return;
        }

        const saveBtn = document.getElementById('modalSave');
        saveBtn.disabled = true;
        const loadingToast = showToast('正在修改密码...', 'loading');

        try {
            const response = await fetch('api/change-password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    currentPassword,
                    newPassword
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP 错误: ${response.status} ${response.statusText}`);
            }

            let result;
            try {
                result = await response.json();
            } catch (jsonError) {
                throw new Error('服务器响应格式错误');
            }

            if (result.success) {
                loadingToast.success('密码修改成功，请重新登录');
                setTimeout(() => {
                    closeModal();
                    // 2秒后跳转到登录页
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                }, 500);
            } else {
                loadingToast.error(result.message || '密码修改失败');
                saveBtn.disabled = false;
            }
        } catch (error) {
            console.error('修改密码失败:', error);
            if (error.message.includes('HTTP 错误')) {
                loadingToast.error('服务器错误: ' + error.message);
            } else if (error.message.includes('响应格式')) {
                loadingToast.error('服务器返回数据格式错误');
            } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                loadingToast.error('网络连接失败,请检查网络');
            } else {
                loadingToast.error('修改密码失败: ' + error.message);
            }
            saveBtn.disabled = false;
        }
    });
}

// 检查密码强度
function checkPasswordStrength() {
    const password = document.getElementById('newPassword').value;
    const strength = getPasswordStrength(password);
    const bars = document.querySelectorAll('.strength-bar');
    const strengthText = document.getElementById('passwordStrengthText');

    // 更新强度条颜色
    const colors = ['#e74c3c', '#e67e22', '#f1c40f', '#2ecc71'];
    const labels = ['弱', '一般', '中等', '强'];

    bars.forEach((bar, index) => {
        bar.style.background = index < strength.score ? colors[strength.score - 1] : '#e0e0e0';
    });

    // 更新强度文字
    if (password) {
        strengthText.textContent = `密码强度: ${labels[strength.score - 1] || '非常弱'}`;
        strengthText.style.color = colors[strength.score - 1] || '#999';
    } else {
        strengthText.textContent = '';
    }
}

// 计算密码强度
function getPasswordStrength(password) {
    let score = 0;

    if (!password) return { score: 0, text: '' };

    // 长度检查
    if (password.length >= 8) score++;
    if (password.length >= 12) score++;

    // 复杂度检查
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^a-zA-Z0-9]/.test(password)) score++;

    // 根据总分返回强度等级（1-4）
    const finalScore = Math.min(4, Math.ceil(score / 2));

    return {
        score: finalScore,
        text: ['非常弱', '弱', '一般', '中等', '强'][finalScore]
    };
}

// 检查密码是否匹配
function checkPasswordMatch() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const matchText = document.getElementById('passwordMatchText');

    if (!confirmPassword) {
        matchText.textContent = '';
        return;
    }

    if (newPassword === confirmPassword) {
        matchText.textContent = '✓ 密码一致';
        matchText.style.color = '#28a745';
    } else {
        matchText.textContent = '✗ 密码不一致';
        matchText.style.color = '#dc3545';
    }
}

// 页面加载时加载仪表盘
document.addEventListener('DOMContentLoaded', () => {
    loadDashboard();
});
