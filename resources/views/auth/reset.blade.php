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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="am-form am-form-horizontal" action="/password/reset" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="am-form-group">
                        <label for="user-old-password" class="am-form-label">邮箱</label>
                        <div class="am-form-content">
                            <input type="email" name="email" value="{{ old('email') }}" id="user-old-password" placeholder="请输入注册邮箱">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-old-password" class="am-form-label">新密码</label>
                        <div class="am-form-content">
                            <input type="password" name="password" id="user-old-password" placeholder="请输入新密码">
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-old-password" class="am-form-label">邮箱</label>
                        <div class="am-form-content">
                            <input type="password" name="password_confirmation" id="user-old-password" placeholder="请重复新密码">
                        </div>
                    </div>


                    <div class="info-btn">
                        <button class="am-btn am-btn-danger" type="submit">重置密码</button>
                    </div>

                </form>

            </div>
@endsection