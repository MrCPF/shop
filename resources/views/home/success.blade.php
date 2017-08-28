@extends('layouts.home_person')
@section('js')
    <link href="/home/css/stepstyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
@endsection
@section('content')
    <div class="center">
        <div class="col-main">
            <div class="main-wrap" style="background-color:#fff;">

                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">安全设置</strong> / <small>修改密码</small></div>
                </div>
                <hr/>
                <!--进度条-->
                <div class="m-progress">
                    <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                        <span class="u-progress-placeholder"></span>
                    </div>
                    <div class="u-progress-bar total-steps-2">
                        <div class="u-progress-bar-inner"></div>
                    </div>
                </div>

                <form class="am-form am-form-horizontal" action="">
                    <div class="am-form-group">
                        <div class="am-form-content">
                            恭喜！密码发送成功，请前往邮箱验证..................
                        </div>
                    </div>

                    <div class="info-btn">
                        <a class="am-btn am-btn-danger" href="/password/email">点此重新输入邮箱</a>
                    </div>

                </form>

            </div>
@endsection