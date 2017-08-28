@if(!(isset(Session::get('user')->id) ? (Session::get('user')->id) : ''))
    <div class="marqueen">
        <span class="marqueen-title">商城头条</span>
        <div class="demo">

            <ul>
                <li class="title-first"><a target="_blank" href="#">
                        <img src="/home/images/TJ2.jpg"></img>
                        <span>[特惠]</span>商城爆品1分秒
                    </a></li>
                <li class="title-first"><a target="_blank" href="#">
                        <span>[公告]</span>商城与广州市签署战略合作协议
                        <img src="/home/images/TJ.jpg"></img>
                        <p>XXXXXXXXXXXXXXXXXX</p>
                    </a></li>

                <div class="mod-vip">
                    <div class="m-baseinfo">
                        <a href="">
                            <img src="/home/images/getAvatar.do.jpg">
                        </a>
                        <em>
                            Hi,<span class="s-name">您还没有登录哟</span>
                            <a href="#"><p>点击更多优惠活动</p></a>
                        </em>
                    </div>
                    <div class="member-logout">
                        <a class="am-btn-warning btn" href="/auth/login">登录</a>
                        <a class="am-btn-warning btn" href="/auth/register">注册</a>
                    </div>
                    <div class="member-login">
                        <a href="#"><strong>0</strong>待收货</a>
                        <a href="#"><strong>0</strong>待发货</a>
                        <a href="#"><strong>0</strong>待付款</a>
                        <a href="#"><strong>0</strong>待评价</a>
                    </div>
                    <div class="clear"></div>
                </div>

                <li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
                <li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
                <li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>

            </ul>
            <div class="advTip"><img src="/home/images/advTip.jpg"/></div>
        </div>
    </div>
@else
    <div class="marqueen">
        <span class="marqueen-title">商城头条</span>
            <div class="demo">

                <ul>
                    <li class="title-first"><a target="_blank" href="#">
                            <img src="/home/images/TJ2.jpg"></img>
                            <span>[特惠]</span>商城爆品1分秒
                        </a></li>
                    <li class="title-first"><a target="_blank" href="#">
                            <span>[公告]</span>商城与广州市签署战略合作协议
                            <img src="/home/images/TJ.jpg"></img>
                            <p>XXXXXXXXXXXXXXXXXX</p>
                        </a></li>

                    <div class="mod-vip">
                        <div class="m-baseinfo">
                            <a href="">
                                <img src="{{Session::get('user')->pic}}">
                            </a>
                            <em>
                                Hi,<span class="s-name">{{Session::get('user')->name}}</span>
                                {{--<a href="#"><p>点击更多优惠活动</p></a>--}}
                            </em>
                        </div>
                        <div class="member-logout">
                            {{--<a class="am-btn-warning btn" href="/auth/login">新人福利</a>--}}
                            <a class="am-btn-warning btn" href="/auth/logout">退出</a>
                        </div>
                        <div class="member-login">
                            <a href="#"><strong>0</strong>待收货</a>
                            <a href="#"><strong>0</strong>待发货</a>
                            <a href="#"><strong>0</strong>待付款</a>
                            <a href="#"><strong>0</strong>待评价</a>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
                    <li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
                    <li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>

                </ul>
                <div class="advTip"><img src="/home/images/advTip.jpg"/></div>
            </div>
        </div>
    @endif