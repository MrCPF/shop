@extends('layouts.commen')
@section('content')
<title>建材列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
	<div class="page-container">
		
		<form action="/admin/eval" style="text-align:center" method="get">
                <input id="searchInput" name="search" value="{{$search}}" style="width:250px" class="input-text"  type="text" placeholder="回复内容" autocomplete="off">
               <button type="submit" class="btn btn-success radius" id=""><i class="Hui-iconfont">&#xe665;</i> 搜内容</button>
            </form>			
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"><span class="r">共有数据：<strong>54</strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead
					<tr class="text-c">
						<th width="150">用户名</th>
						<th width="150">商家名</th>
						<th width="150">商品名</th>
						<th width="150">评论时间</th>
						<th width="150">评论内容</th>
						<th width="150">等级</th>
						<th width="150">操作</th>
						
					</tr>
				</thead>
				<tbody>
				  @foreach($eval as $val)

					<tr class="text-c va-m">		
						<td>{{$val->name}}</td>
						<td>{{$val->goods_name}}</td>
						<td>{{$val->busines_name}}</td>
						<td>{{$val->eval_time}}</td>
						<td>{{$val->eval_content}}</td>
						<td><?php 
                                if($val->eval_level == 1){
                                    echo '好评';
                                  }else if($val->eval_level  == 2){
                                    echo '中评';
                                  }else if($val->eval_level  == 3){
                                    echo '差评';
                                  }
                                   ?>
                                   </td>
						<td>
						  <a title="删除" href="javascript:;" onclick="product_del(this,{{$val->eval_id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</td>
					</tr>

				@endforeach
						
				</tbody>
			</table>
			 {!! $eval->appends(['search' => $search])->render() !!}		
			 
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

/*图片-添加*/
function picture_add(title,url,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url,
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
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*产品-发布*/
function product_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
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
			url: '/admin/eval/del/'+id,
			dataType: 'json',
			success: function(data){
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