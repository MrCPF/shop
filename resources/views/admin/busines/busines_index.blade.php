@extends('/admin/busines.busines_comment')
@section('busines_content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商家管理中心 <span class="c-gray en">&gt;</span> 商家管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="text-c">
        <form action="/admin/find" method="get">

            <input type="text" name="search" placeholder="请输入商家名"value="{{$search}}" style="width:250px" class="input-text">

            <button type="submit" class="btn btn-success radius" id=""><i class="Hui-iconfont">&#xe665;</i> 搜商家</button>
        </form>
    </div>

    {{--<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加商家','/admin/busines/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加商家</a></span>--}}
        <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                <th width="80">ID</th>
                <th width="100">商家名称</th>
                <th width="150">商家图片</th>
                <th width="90">地址</th>
                <th width="90">手机</th>
                <th width="130">描述</th>
                <th width="130">加入时间</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr class="text-c">
                {{--<td><input type="checkbox" value="1" name=""></td>--}}
                <td>{{$user->busines_id}}</td>
                <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$user->busines_name}}','busines/{{$user->busines_id}}','10001','360','400')">{{$user->busines_name}}</u></td>
                <td><img src="{{$user->busines_pic}}" alt="" width="100" height="75"></td>
                <td>{{$user->busines_address}}</td>
                <td>{{$user->busines_mobile}}</td>
                <td>{{$user->busines_desc}}</td>
                <td>{{$user->updated_at}}</td>
                <td class="td-status"><span class="label label-success radius"><?php echo ($user->busines_status  ? '禁用' : '启用') ?></span></td>
                <td class="td-manage">
                    <a href="/admin/busines/doEditStatus/{{$user->busines_id}}"   style="text-decoration: none"><?php echo ($user->busines_status  ? '<i class="Hui-iconfont" title="启用">&#xe6e1;</i>' : '<i class="Hui-iconfont" title="禁用">&#xe631;</i>') ?></a>
                    <a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/busines/{{$user->busines_id}}/edit','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    {{--<a title="删除" href="javascript:;" onclick="member_del(this,{{$user->busines_id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>--}}
                    <a title="删除" href="/admin/busines/del/{{$user->busines_id}}" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {!! $users->appends(['search' => $search])->render() !!}
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('js')


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    /*用户-编辑*/
    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }

/*function member_del(obj,id){
        $.ajaxSetup({
            {{--headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }--}}
        });
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '/admin/busines/delete/'+id,
                dataType: 'json',
                success: function(data){
                   /!* console.log(data);
                     return;*!/
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                }
            });
        });
    }*/
</script>
</body>
</html>
@endsection