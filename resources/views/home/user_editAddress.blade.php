@extends('layouts.home_person')
@section('js')
    <link href="/home/css/addstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
@endsection
@section('content')
    <div class="center">
        <div class="col-main">
            <div class="main-wrap" style="background-color: #fff;">

                <div class="user-address">
                    <!--例子-->
                    <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                        <div class="add-dress">

                            <!--标题 -->
                            <div class="am-cf am-padding">
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">收货地址</strong> / <small>编辑地址</small></div>
                            </div>
                            <hr/>

                            <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                <form class="am-form am-form-horizontal" action="/home/address/edit/{{$addressInfo->id}}" method="post">
                                    {{csrf_field()}}

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-form-label">收货人</label>
                                        <div class="am-form-content">
                                            <input type="text" id="user-name" value="{{$addressInfo->name}}" placeholder="收货人" name="name">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-form-label">手机号码</label>
                                        <div class="am-form-content">
                                            <input id="user-phone" placeholder="手机号必填" type="text" value="{{$addressInfo->mobile}}" name="mobile">
                                        </div>

                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-address" class="am-form-label">所在地</label>
                                        <div class="am-form-content address">
                                            <select id="s_province" name="s_province"></select>
                                            <select id="s_city" name="s_city" ></select>
                                            <select id="s_county" name="s_county"></select>
                                            <script class="resources library" src="/home/js/area.js" type="text/javascript"></script>
                                            <script type="text/javascript">_init_area();</script>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-form-label">详细地址</label>
                                        <div class="am-form-content">
                                            <textarea class="" rows="3" name="address" id="user-intro" value="{{old('address')}}" placeholder="输入详细地址"></textarea>
                                            <small>100字以内写出你的详细地址...</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" id="save" class="am-btn am-btn-danger" >保存</button>
                                            <a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".new-option-r").click(function() {
                            $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                        });

                        var $ww = $(window).width();
                        if($ww>640) {
                            $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                        }

                    })
                </script>

                <div class="clear"></div>

            </div>
@endsection