@if(!(isset(Session::get('user')->id) ? (Session::get('user')->id) : ''))
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <a href="/auth/login" target="_top" class="h">亲，请登录</a>
                <a href="/auth/register" target="_top">免费注册</a>
            </div>
        </div>
    </ul>

    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="/home/index" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="/auth/login" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="/home/cart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        
        {{--<div class="topMessage busines_entry">--}}
            {{--<div class="menu-hd busines_entry"><a href="/home/entry" target="_top" class="am-icon-github"><i class="icon Hui-iconfont"></i>商家认证</a></div>--}}
        {{--</div>--}}

        {{--<div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>--}}
    </ul>

@else

    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <a href="/home/user" target="_top" class="h">欢迎&nbsp;&nbsp;{{Session::get('user')->name}}</a>
                <a href="/auth/logout" target="_top">退出</a>
            </div>
        </div>
    </ul>
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="/home/index" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="/home/user" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="/home/cart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        {{--认证--}}
        <div class="topMessage busines_entry">
            <div class="menu-hd busines_entry"><a href="/home/entry" target="_top" class="am-icon-github"><i class="icon Hui-iconfont"></i>商家认证</a></div>
        </div>
        {{--<div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
        </div>--}}

    </ul>

@endif