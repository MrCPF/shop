@extends('layouts.commen')
@section('content')

    <title>添加栏目 - H-ui.admin v3.0</title>
    <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form action="/admin/cat" method="post" class="form form-horizontal" id="form-member-add">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('cats_name')}}" placeholder="请输入栏目名" id="cats_name" name="cats_name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">选择父栏目：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select class="select" size="1" name="cats_pid">
                    <option value="0" selected>顶级栏目</option>
                @foreach($data as $val)
                    <option value="{{$val->cats_id}}"><?php echo '|-'.str_repeat('--',$val->lev);?>{{$val->cats_name}}</option>
                @endforeach
                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="cats_desc" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" onclick="subform();" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
    function subform(){
        var form = document.getElementById('form-member-add');//获取表单dom
        form.action="/admin/cat";//重新设置提交url
        if(form.submit()){
            window.parent;//关闭窗口
        }//提交表单
    }
</script>
@endsection