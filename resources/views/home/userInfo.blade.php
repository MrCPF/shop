@extends('layouts.home_person')
    @section('js')
        <link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
        <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
    @endsection
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="center">
    <div class="col-main">
        <div class="main-wrap" style="background-color:#fff;">

            <div class="user-info" style="background-color:#fff;">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>个人信息</small></div>
                </div>
                <hr/>

                <!--头像 -->
                <form class="am-form am-form-horizontal" action="image/{{$userInfo->id}}" id="photoForm" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{--{{method_field('PATCH')}}--}}

                        @include('layouts.home_user')
                </form>
                <form action="image/{{$userInfo->id}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                <!--个人信息 -->
                <div class="info-main">
                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">用户名</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="name" value="{{$userInfo->name}}">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-form-label">性别</label>
                            <div class="am-form-content sex">
                                <label class="am-radio-inline">
                                   <input type="radio" name="sex" value="1" data-am-ucheck checked> 男
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="2" data-am-ucheck> 女
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="3" data-am-ucheck> 保密
                                </label>
                            </div>
                        </div>


                        <div class="am-form-group">
                            <label for="user-phone" class="am-form-label">电话</label>
                            <div class="am-form-content">
                                <input id="user-phone" name="mobile" value="{{$userInfo->mobile}}" type="tel">

                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-form-label">电子邮件</label>
                            <div class="am-form-content">
                                <input id="user-email" name="email" value="{{$userInfo->email}}" type="email">

                            </div>
                        </div>
                        <div class="am-form-group address">
                            <label for="user-address" class="am-form-label">收货地址</label>
                            <div class="am-form-content address">
                                <a href="address.html">
                                    <p class="new-mu_l2cw">
                                        <span class="province">湖北</span>省
                                        <span class="city">武汉</span>市
                                        <span class="dist">洪山</span>区
                                        <span class="street">雄楚大道666号(中南财经政法大学)</span>
                                        <span class="am-icon-angle-right"></span>
                                    </p>
                                </a>

                            </div>
                        </div>
                        <div class="am-form-group safety">
                            <label for="user-safety" class="am-form-label">账号安全</label>
                            <div class="am-form-content safety">
                                <a href="safety.html">

                                    <span class="am-icon-angle-right"></span>

                                </a>

                            </div>
                        </div>
                        <div class="info-btn">
                            <button class="am-btn am-btn-danger" type="submit" id="bid">保存修改</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>

       </html>
@endsection
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function doUpload() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
        });
        var formData = new FormData($("#photoForm")[0]);
        console.log(formData);
//        var formData = $('#photoForm').serialize();
            $.ajax({
                url: "{{url('home/image')}}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    $("#avatar_url").attr('src',returndata);
                },
                error: function (returndata) {
                    console.log(returndata);
                }
            });
        }
</script>
