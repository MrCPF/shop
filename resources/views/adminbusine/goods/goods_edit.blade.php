@extends('layouts.commen')
@section('content')
<body>
<article class="page-container">
	<form action="/adminbusine/goods/{{$goods->goods_id}}" method="post" class="form form-horizontal" id="form-member-add">
		{{csrf_field()}}
        {{method_field('PATCH')}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>商品名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$goods->goods_name}}" placeholder="" id="username" name="goods_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>单价：</label>
			<div class="formControls col-xs-4 col-sm-3">
				<input type="text" class="input-text" value="{{$goods->goods_price}}" placeholder="" id="mobile" name="goods_price">
			</div>
		</div>
		<div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">促销价：</label>
            <div class="formControls col-xs-4 col-sm-3">
                <input type="text" name="goods_sprice" id="" placeholder="" value="{{$goods->goods_sprice}}" class="input-text" style="width:90%">
                </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>库存：</label>
			<div class="formControls col-xs-4 col-sm-3">
				<input type="text" class="input-text" placeholder="" value="{{$goods->goods_number}}" name="goods_number" id="email">
			</div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">附件：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
				<input class="input-text upload-url" type="text" name="uploadfile" id="uploadfile" readonly nullmsg="请添加附件！" style="width:200px">
				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
				<input type="file" multiple name="file-2" class="input-file">
				</span> </div>
		</div> -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">产品描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="goods_detail" cols="" rows="" class="textarea"  placeholder="请输入商品描述...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
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
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:16
			},
			sex:{
				required:true,
			},
			mobile:{
				required:true,
				isMobile:true,
			},
			email:{
				required:true,
				email:true,
			},
			uploadfile:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script> 
</body>
</html>
