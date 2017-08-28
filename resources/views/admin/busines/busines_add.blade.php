@extends('/admin/busines.busines_comment')
@section('busines_content')
    <article class="page-container">
        <form action="/admin/busines" method="post" class="form form-horizontal" id="form-member-add"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="请输入商家名" id="name" name="busines_name">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录账号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="请输入" id="name" name="busines_aname">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="请输入" id="name" name="busines_apassword">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="请输入手机号" id="name" name="busines_mobile">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商家图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="file" class="input-text" multiple="multiple" id="mobile" name="busines_pic">
                </div>
            </div>

            {{--<div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>yulan图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <img src="" id="avatar_url">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="button" value="上传" onclick="doUpload()" />
                </div>
            </div>--}}

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="mobile" name="busines_address">
                </div>
            </div>




             <div class="row cl">
                 <label class="form-label col-xs-4 col-sm-3">描述：</label>
                 <div class="formControls col-xs-8 col-sm-9">
                     <textarea name="busines_desc" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
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
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript">
//        $(function(){
//            $('.skin-minimal input').iCheck({
//                checkboxClass: 'icheckbox-blue',
//                radioClass: 'iradio-blue',
//                increaseArea: '20%'
//            });
//
//
//        });
    /*function doUpload(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });

            var formData = new FormData($("#form-member-add")[0]);
            console.log(formData);
            $.ajax({
                url: "{{url('admin/busines')}}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (returndata) {
                                 console.log(returndata);//打印出图片数据
//                                 $("#avatar_url").attr('src',returndata);//单图阅览
                    $("#avatar_url").attr('src',returndata);
                },
                error: function (returndata) {
                    console.log(returndata);
                }
            });
        }*/
    </script>
@endsection