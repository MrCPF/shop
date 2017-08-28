@extends('/admin/busines.busines_comment')
@section('busines_content')

    <title>添加用户 - H-ui.admin v3.0</title>
    <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
    </head>
    <body>
    <article class="page-container">
        <form action="/admin/edit" class="form form-horizontal" id="photoForm" method="post">
            {{--多图--}}{{--<input type="hidden" name="uid" value="{{$id}}">--}}
            <input type="hidden" name="busines_id" value="{{$datas->busines_id}}">
            {{csrf_field()}}
            {{--{{method_filed('PATCH')}}--}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$datas->busines_name}}" placeholder="请输入商家名" id="name" name="busines_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$datas->busines_mobile}}" placeholder="请输入手机号" id="name" name="busines_mobile">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$datas->busines_address}}" placeholder="" id="mobile" name="busines_address">
                </div>
            </div>

            <input type="hidden" value="{{$datas->busines_pic}}">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
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
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>

    @endsection


    @section('js')

            <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript">
        //单图
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        function doUpload(){
            var formData = new FormData($("#photoForm")[0]);
//        console.log(formData);
            $.ajax({
                url: "{{url('/admin/busines')}}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    /*console.log(returndata);//打印出图片数据
                     return;*/
                    var row = '';
                    /*单图阅览*/
                    row += '<img src="'+returndata+'" width="100" height="100">';
                    row += '<input type="hidden" name="busines_pic" value="'+returndata+'">';
                    $("#img_box").html(row);
                },
                error: function (returndata) {
//                console.log(returndata);
                }
            });
        }
    </script>
@endsection