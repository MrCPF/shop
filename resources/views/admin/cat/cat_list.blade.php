@extends('layouts.commen')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 栏目中心 <span class="c-gray en">&gt;</span> 栏目管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <style>

        .page-container{
            padding:0px;
        }
    </style>

    <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="member_add('添加栏目','/admin/cat/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                <th width="150">栏目id</th>
                <th width="350">栏目名</th>
                <th width="150">父栏目id</th>
                <th width="">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $val)
                <tr class="text-c">
                    {{--<td><input type="checkbox" value="1" name=""></td>--}}
                    <td>{{$val->cats_id}}</td>
                    <td style="text-align: left;" ><u class="text-primary" onclick="member_show('{{$val->cats_name}}','/admin/cat/{{$val->cats_id}}','10001','360','400')">
                            <?php echo '|--'.str_repeat('--',2*$val->lev);?>
                            {{$val->cats_name}}</u>
                    </td>
                    <td>{{$val->cats_pid}}</td>
                    <td class="td-manage"><a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/cat/{{$val->cats_id}}/edit','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,{{$val->cats_id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <script ></script>

     {{--   {!! $data->render() !!}--}}


    </div>
</div>
@endsection

@section('js')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}
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
                },
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
       $.ajaxSetup({
           headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
       });
       layer.confirm('确认要删除吗？',function(){
            $.ajax({
                type: 'POST',
                url: '/admin/cat/delete/'+id,
                dataType: 'json',
                success: function(data){
                    if(data){
                        if($(obj).parents("tr").remove()){
                            layer.msg('已删除!',{icon:1,time:1000});
                            location.reload();
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