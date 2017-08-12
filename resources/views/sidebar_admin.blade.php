<div class="sidebar">
    <div class="item-nav">
        <ul>
            <li>
                <?php $userType = ['', '超级管理员', '管理员', '企业用户'];?>
                <p style="text-align:center; margin-top:10px; font-size:12px;
">
                    您好：{{ Auth::user()->name }}
                    <br/>
                    {{$userType[$type]}}
                </p>
            </li>

            <li style="display:none">
                <form>
                    <input type="text" placeholder="请输入单位名称" class="inp">
                </form>
                <button class="search-btn">搜索单位</button>
                <ul>
                    <li>
                        <ul>
                            <li><a href="#">华为集团</a></li>
                            <li><a href="#">小米集团</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a class="parent1" href="#">信息管理</a>
                	<ul>
                    	<li><a href="/admin/area">区域信息</a></li>
                            <li><a href="/admin/company">企业信息</a></li>
                            <li><a href="/admin/approval">审批信息</a></li>
                            <li><a href="/admin/acceptance">验收信息</a></li>
                           <li> <a href="/admin/check">执法检查信息</a></li>
                           <li> <a href="/admin/terminal">设备信息</a></li>
                           <li> <a href="/admin/station">监测点</a></li>
                    </ul>
            </li>
        </ul>
    </div>
</div>

