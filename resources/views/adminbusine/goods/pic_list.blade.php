@extends('layouts.commen')
@section('content')

<title>图片展示</title>
<link href="/admin/lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片展示 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="picadd('添加产品','/adminbusine/picadd/{{$goods_id}}')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe6df;</i> 添加</a> 
	<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="portfolio-content">
		<ul class="cl portfolio-area">
		@foreach($data as $val)
			<li class="item">
				<div class="portfoliobox">
					<input class="checkbox" name="" type="checkbox" value="{{$val->id}}">
					<div class="picbox"><a href="{{$val->goods_url}}" data-lightbox="gallery" data-title="{{$val->goods_id}}"><img src="{{$val->goods_url}}"></a></div>
					<div class="textbox">{{$val->id}}</div>
				</div>
			</li>
		@endforeach
		</ul>
	</div>
</div>
@endsection

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/lightbox2/2.8.1/js/lightbox.min.js"></script>
<script type="text/javascript">
/*产品-添加*/
function picadd(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
$(function(){
	$.Huihover(".portfolio-area li");
});
/*产品-删除*/
function datadel(){
	//批量删除
	$.ajaxSetup({
	    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
	});
	var id_array=new Array();  
	$('input[type="checkbox"]:checked').each(function(){  
	    id_array.push($(this).val());//向数组中添加元素  
	});  

		var idstr=id_array.join(',');
	// }
	if(idstr.length == 0){
    	return false;
	}
		layer.confirm('确认要删除吗？',function(index){
         $.ajax({
             type: 'POST',
             url: '/adminbusine/deletes',
             data:{'idstr':idstr},
             success: function(data){ 
                 if(data){
                     layer.msg('已删除!',{icon:1,time:1000}); 
                     history.go(0);
                  }
             },
             error:function(data) {
                 console.log(data.msg);
             },
         });
	 });
}
</script>
</body>
</html>