@extends('layouts.commen')
@section('content')
<title>建材列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
	<div class="page-container">
		<form action="/adminbusine/find" method="get">
		
		<div class="text-c">
			<!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
			<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;"> -->
			<input type="text" name="search" id="" value="{{$search}}" placeholder="请输入你要查询的商品名" style="width:250px" class="input-text">
			
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
			
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</div>
		</form>
		<div class="cl pd-5 bg-1 bk-gray mt-20"><a class="btn btn-primary radius" onclick="product_add('添加产品','/adminbusine/goods/create')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead
					<tr class="text-c">
						<th width="60">ID</th>
						<th width="60">栏目ID</th>
						<th width="60">名称</th>
						<th width="100">原价</th>
						<th width="100">促销价</th>
						<th width="100">数量</th>
						{{--<th width="60">商品上架时间</th>--}}
						<th width="100">缩略图</th>
						<th width="100">详细内容</th>
						<th width="100">发布状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				  @foreach($goods as $val)
					<tr class="text-c va-m">		
						<td>{{$val->goods_id}}</td>
						<td>{{$val->cats_id}}</td>
						<td>{{$val->goods_name}}</a></td>
						<td>{{$val->goods_price}}</span>元</td>
						<td>{{$val->goods_sprice}}</span>元</td>
						<td>{{$val->goods_number}}</td>
						{{--<td>{{$val->created_at}}</td>--}}
						@if($val->goods_url)
					
						<td><a href="javascript:;" onClick="picture_edit('图库编辑','/adminbusine/picedit/{{$val->goods_id}}','/adminbusine/picedit/{{$val->goods_id}}')"><img src="{{$val->goods_url}}"  id="avatar_url" width="210";height="30"></a></td>
						@else
						<td> <a href="javascript:;" onClick="picture_edit('图库编辑','/adminbusine/picedit','{{$val->goods_id}}')"><img src="" alt="" id="avatar_url" width="30";height="30"></td>
						@endif

						<td class="text-l"><a style="text-decoration:none"  href="javascript:;"><b class="text-success"><?php echo html_entity_decode($val->goods_detail); ?></td>
						@if($val->goods_status == 0)
						<td class="td-status"><span class="label label-success radius">已发布</span></td>
						 @else
						<td class="td-status"><span class="label label-danger radius">已下架</span></td>
						@endif	
						<td class="td-manage">	
						@if($val->goods_status == 0)

						<a style="text-decoration:none" onClick= 'product_stop(this,{{$val->goods_id}})' href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
					    
					    @else
						
						<a style="text-decoration:none" onClick="product_start(this,{{$val->goods_id}})" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>
						@endif
						 <a style="text-decoration:none" class="ml-5" onClick="product_edit('产品编辑','/adminbusine/goods/{{$val->goods_id}}/edit',)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
						  <a title="删除" href="javascript:;" onclick="product_del(this,{{$val->goods_id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				@endforeach		
				</tbody>
			</table>

			{!! $goods->appends(['search' => $search])->render() !!}
		</div>
	</div>
</div>

@endsection

@section('js')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 

<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 

<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript">

/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				//demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-审核*/
function product_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*产品-下架*/
function product_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            });			
		$.ajax({
			type: 'POST',
			url: '/adminbusine/under/'+id,
			success: function(data){
			 location.reload();
		layer.msg('已下架!',{icon: 5,time:1000});
			}
		});	
	});
}

/*产品-发布*/
function product_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            });			
		$.ajax({
			type: 'POST',
			url: '/adminbusine/under/'+id,
			success: function(data){
		    location.reload();
		layer.msg('已发布!',{icon: 6,time:1000});
	}
	});
	});
}

/*产品-申请上线*/
function product_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*产品-编辑*/
function product_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*产品-删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
 		$.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            });			
		$.ajax({
			type: 'POST',
			url: '/admin/goods/del/'+id,
			dataType: 'json',
			success: function(data){
				console.log(data);
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
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