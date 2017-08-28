@extends('layouts.home_person')
@section('js')
    <link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
@endsection
@section('content')

    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <style>
        .menu{
            display:none;
        }
    </style>
    {{--表单部分--}}
    <div class="center">
        <div class="col-main">
            {{--<div class="main-wrap" style="background-color:#fff;">--}}
            <article class="page-container">
                <form action="/home/entryInsert" class="form form-horizontal" id="photoForm" method="post">
                    {{--多图--}}{{--<input type="hidden" name="uid" value="{{$id}}">--}}
                    <input type="hidden" name="uid" value="{{$uid}}">
                    {{csrf_field()}}
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入商家名" id="name" name="busines_name">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入手机号" id="name" name="busines_mobile">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入您的地址" id="mobile" name="busines_address">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家图片：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            {{--多图--}}
                            {{--<input type="file" class="input-text" multiple="multiple" name="img[]">--}}
                            {{--单图--}}
                            <input type="file" class="input-text" name="img">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>预览图片：</label>
                        <div class="formControls col-xs-8 col-sm-9" id="img_box">

                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开始上传：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <button  class="btn btn-primary radius" type="button" onClick="doUpload()"><i class="Hui-iconfont" >&#xe632;</i>开始上传</button>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">商家描述：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            {{--onKeyUp="$.Huitextarealength(this,100)--}}
                            <textarea name="busines_desc" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
                            <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>验证码：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" name="verify" style="width:15%" id="verify" placeholder="请输入验证码">
                            <img src="/captcha/default?ueXnewG2" alt="" id="verify" onclick="this.src = this.src+''" style="vertical-align: middle">
                        </div>
                    </div>

                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                            <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                        </div>
                    </div>
                </form>
            </article>
        </div>
    </div>

    </html>
@endsection

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //单图
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });
    function doUpload(){
        var formData = new FormData($("#photoForm")[0]);
//        console.log(formData);
        $.ajax({
            url: "{{url('/home/entry')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (returndata) {
                /*console.log(returndata);//打印出图片数据
                return;*/
                var row = '';
                row += '<img src="'+returndata+'" width="100";height="100">'//单图阅览
                row += '<input type="hidden" name="busines_pic" value="'+returndata+'">';
                $("#img_box").html(row);
            },
            error: function (returndata) {
//                console.log(returndata);
            }
        });
    }
</script>
</body>
</html>