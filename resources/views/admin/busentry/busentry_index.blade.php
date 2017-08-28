<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>审核列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商家审核管理 <span class="c-gray en">&gt;</span> 审核列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="/admin/findApply" >
                <input type="text" placeholder="请输入商家名" name="search" value="{{$search}}" style="width:250px" class="input-text">
                <button name="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>

        </form>
    </div>
    {{--<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <span class="r">共有数据：<strong>54</strong> 条</span> </div>--}}
    <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                {{--<th width="25"><input type="checkbox" name="" value=""></th>--}}
                <th width="80">ID</th>
                <th width="100">商家名称</th>
                <th width="150">商家图片</th>
                <th width="90">地址</th>
                <th width="80">手机</th>
                <th width="120">创建时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($datas as $data)
            <tr class="text-c">
                {{--<td><input type="checkbox" value="" name=""></td>--}}
                <td>{{$data->busines_id}}</td>
                <td>{{$data->busines_name}}</td>
                <td>
                    <img src="{{$data->busines_pic}}" width="80" height="60">
                </td>
                <td>{{$data->busines_address}}</td>
                <td>{{$data->busines_mobile}}</td>
                <td>{{$data->created_at}}</td>
                <td class="f-14 td-manage">
                    <a href="/admin/busentry/status/{{$data->busines_id}}"  class="add btn btn-success" >通过</a>
                    <a href="" class="btn btn-warning">不通过</a>
                    <a href="/admin/busentry/del/{{$data->busines_id}}" class="add btn btn-danger">删除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {!! $datas->appends(['search' => $search])->render() !!}
        </ul>
    </nav>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">


    /*资讯-删除*/
    function article_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
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