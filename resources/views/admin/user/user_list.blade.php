@extends('layouts.commen')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="/admin/findAdmin" method="get">
        <div class="text-c">

            <input type="text" name="search" placeholder="请输入用户名称" value="{{$search}}" style="width:250px" class="input-text">

            <button type="submit" class="btn btn-success radius" id=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>

        </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','/admin/user/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
{{--                <th width="25"><input type="checkbox" name="" value=""></th>--}}
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="90">手机</th>
                <th width="150">邮箱</th>
                <th width="130">加入时间</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $val)
                <tr class="text-c">
                  {{--  <td><input type="checkbox" value="1" name=""></td>--}}
                    <td>{{$val->id}}</td>
                    <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$val->name}}','/admin/user/{{$val->id}}','10001','360','400')">{{$val->name}}</u></td>
                    <td>{{$val->mobile}}</td>
                    <td>{{$val->email}}</td>
                    <td>{{$val->created_at}}</td>
                    <td class="td-status"><span class="label label-success radius">已启用</span></td>
                    <td class="td-manage">
                        <a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                        <a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/user/{{$val->id}}/edit','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a>
                        <a title="删除" href="javascript:;" onclick="member_del(this,{{$val->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <script ></script>

        {!! $data->appends(['search'=>$search])->render() !!}


    </div>
</div>
@endsection

@section('js')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
   /* $(function(){
        $('.table-sort').dataTable({
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
            ]
        });

    });*/
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                }
            });
        });
    }

    /*用户-启用*/
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-删除*/
   function member_del(obj,id){
//        alert(id);
//        return;
         layer.confirm('确认要删除吗？',function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            });
            $.ajax({
                type: 'POST',
                url: '/admin/user/delete/'+id,
                dataType: 'json',
                success: function(data){
                    if(data){
                        if($(obj).parents("td").remove()){
                            layer.msg('已删除!',{icon:1,time:1000});
                        }
                    }
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });

    }
</script>
@endsection