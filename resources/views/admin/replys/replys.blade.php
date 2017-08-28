@extends('layouts.commen')
@section('content')
<title>建材列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
	<div class="page-container">
			<form action="/admin/replys" style="text-align:center" method="get">
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
						<th width="150">回复用户名</th>
						<th width="150">回复商家名</th>
						<th width="150">回复商品名</th>
						<th width="150">回复时间</th>
						<th width="150">回复内容</th>
						<th width="150">操作</th>
						
					</tr>
				</thead>
				<tbody>
				  @foreach($replys as $val)

					<tr class="text-c va-m">		
						<td>{{$val->busines_name}}</td>
						<td>{{$val->name}}</td>
						<td>{{$val->goods_name}}</td>
						<td>{{$val->replys_time}}</td>
						<td>{{$val->replys_content}}</td>
						<td>
						  <a title="删除" href="javascript:;" onclick="product_del(this,{{$val->replys_id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
						 </td>
					</tr>

				@endforeach
				</tbody>
			</table>
						 {!! $replys->appends(['search' => $search])->render() !!}	

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
/*产品-删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
 		$.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            });			
		$.ajax({
			type: 'POST',
			url: '/admin/replys/del/'+id,
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