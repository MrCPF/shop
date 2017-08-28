@extends('layouts/commen')
@section('content')

<title>图片展示</title>
<link href="/admin/lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片展示 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<td class="td-manage">
		<a style="text-decoration:none" onClick="picture_stop(this,'10001')" href="javascript:;" title="下架">
		<i class="Hui-iconfont">&#xe6de;</i></a> 
		<a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','/adminbusin/photo','10001')" href="javascript:;" title="编辑">
		<i class="Hui-iconfont">&#xe6df;</i></a> 
		<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'10001')" href="javascript:;" title="删除">
		<i class="Hui-iconfont">&#xe6e2;</i></a>
	</td>
	<div class="portfolio-content">
		<ul class="cl portfolio-area">
			<li class="item">
				<div class="portfoliobox">
					<input class="checkbox" name="" type="checkbox" value="">
					<div class="picbox"><a href="temp/big/keting.jpg" data-lightbox="gallery" data-title="客厅1"><img src="temp/Thumb/keting.jpg"></a></div>
					<div class="textbox">客厅 </div>
				</div>
		</ul>
	</div>
</div>
@endsection

@section('js')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/lightbox2/2.8.1/js/lightbox.min.js"></script> 
<script type="text/javascript">
$(function(){
	$.Huihover(".portfolio-area li");
});
/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

</script>
@endsection