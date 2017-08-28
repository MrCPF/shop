@extends('layouts/commen')
@section('content')

<title>新增图片</title>
<style>form{margin: 20px;padding: 10px;}#picInput>input{display: block;margin: 10px;}</style>
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" action="/adminbusine/photo/{{$data->id}}" enctype="multipart/form-data">
	{{csrf_field()}}
	{{method_field('PATCH')}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value=""  placeholder="" id="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="" class="select">
					<option value="0">全部栏目</option>
					<option value="1">新闻资讯</option>
					<option value="11">├行业动态</option>
					<option value="12">├行业资讯</option>
					<option value="13">├行业新闻</option>
				</select>
				</span>
			</div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">图片来源：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="" name="">
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="" name="">
			</div>
		</div> -->
		<div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
				<img src="">
			</div>
		</div>
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">图片上传：</label>
			<div class="formControls col-xs-8 col-sm-9">
			<input type="file"  name="img" class="pic"value="" multiple="multiple">
			<div class="box"style="height:50px width:50px"></div>
				<!-- <div class="uploader-list-container"> 
					<div class="queueList" style="height:200px">
						
					</div>					
				</div> -->
				<div class="webuploader-pick" style="float:left"><button type="submit">上传</button></div>
			</div>
		</div>
		</form>
@endsection

@section('js')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script>  
    window.onload=function(){
		var box=document.querySelector('.box');
		var inp=document.querySelector(".pic");
    inp.onchange=function(){
    	var file=inp.files[0];
    	var reader=new FileReader();
    	reader.readAsDataURL(file);

    	reader.onload=function(){
    		var img=document.createElement('img');
    		img.src=this.result;
    		img.width=200;
    		img.onload=function(){
    			box.appendChild(img);
    		}
    	}
    }
} 
</script>   
@endsection