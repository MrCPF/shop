<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/home/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link href="/home/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
	</head>

	<body>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

		<div class="login-boxtitle">
			<a href="/home/index"><img alt="" src="/home/images/logobig.png" /></a>
            <div class="have-account" style="font-size: 16px;float: right;margin-top: 20px;color: #999;">已有账号？ <a href="/auth/login">请登录</a></div>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/home/images/big.jpg" /></div>
				<div class="login-box">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								{{--<li><a href="">手机号注册</a></li>--}}
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post" action="/auth/register">
                                        {{csrf_field()}}
										
							   <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="email" value="{{ old('email')  }}" id="email" placeholder="请输入邮箱账号">
                 </div>
                                <div class="user-email">
                                    <label for="email"><i class="am-icon-user "></i></label>
                                    <input type="text" name="name" value="{{ old('name')  }}" id="email" placeholder="请输入昵称">
                                </div>

                                <div class="user-email">
                                    <label for="email"><i class="am-icon-phone "></i></label>
                                    <input type="text" name="mobile" value="{{ old('mobile')  }}" id="email" placeholder="请输入手机号">
                                </div>

                                        <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="设置密码">
                 </div>										
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password_confirmation" id="passwordRepeat" placeholder="确认密码">
                 </div>
                                        <div class="user-email">
                                            <label for="email"><i class="am-icon-code-fork "></i></label>
                                            <input type="text" name="verify"  style="width:55%" id="email" placeholder="请输入验证码">
                                            <img src="/captcha/default?ueXnewG2" alt="" id="verify" onclick="this.src = this.src+'.'" style="vertical-align: middle">
                                        </div>

                                        {{--div class="login-links">
                                               <label for="reader-me">
                                                   <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                                               </label>
                                         </div>--}}
										<div class="am-cf">
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>

								</div>
                   </form>

								<div class="am-tab-panel">
									<form method="post">
                 <div class="user-phone">
								    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" name="" id="phone" placeholder="请输入手机号">
                 </div>																			
										<div class="verification">
											<label for="code"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="" id="code" placeholder="请输入验证码">
											<a class="btn" href="javascript:void(0);" onclick="sendMobileCode();" id="sendMobileCode">
												<span id="dyMobileButton">获取</span></a>
										</div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="password" placeholder="设置密码">
                 </div>										
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
                 </div>	
									</form>
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
								
									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

							</div>
						</div>

				</div>
			</div>
			
					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有</em>
							</p>
						</div>
					</div>
	</body>

</html>