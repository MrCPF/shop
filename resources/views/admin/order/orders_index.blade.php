@extends('layouts.commen')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单中心 <span class="c-gray en">&gt;</span> 订单管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
        <div class="text-c">

            <form action="/admin/findOrder" method="get">
            <input type="text" name="search" value="{{$search}}" placeholder="请输入商品订单号" style="width:250px" class="input-text">

            <button type="submit" class="btn btn-success radius" id=""><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>

        </div>
    </form>

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"></i> 订单管理</a> </span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
    <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                    <tr class="text-c">
                        
                        <th width="40">订单id</th>
                        <th width="40">用户名</th>
                        <th width="80">订单号</th>
                        <th width="80">订单时间</th>
                        <th width="80">商品名称</th>
                        <th width="80">数量</th>
                        <th width="80">单价</th>
                        <th width="80">总价</th>
                        <th width="80">订单状态</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($orders as $v)
                    
                
                    <tr class="text-c va-m">
                        
                        <td>{{$v->orders_id}}</td>
                        <td>{{$v->name}}</td>
                        <td>{{$v->orders_sign}}</td>
                        <td>{{$v->orders_time}}</td>
                        <td>{{$v->goods_name}}</td>
                        <td>{{$v->orders_gnum}}</td>
                        <td>{{$v->orders_gprice}}</td>
                        <td>{{$v->orders_total}}</td>
                        <td><?php 
                                  if($v->orders_status == 0){
                                    echo '买家已付款';
                                  }else if($v->orders_status == 1){
                                    echo '卖家已发货';
                                  }else if($v->orders_status == 2){
                                    echo '交易完成';
                                  }else if($v->orders_status == 5){
                                    echo '未支付';
                                  }else if($v->orders_status == 4){
                                      echo '交易完成（有评价）';
                                  }
                                   ?>
                                   </td>

								                      
                    </tr>
              @endforeach
                </tbody>
            </table>
        {!! $orders->appends(['search' => $search])->render() !!}
        </div>
<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeall">关闭全部 </li>
</ul>
</div>
@endsection
@section('js')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.contextmenu/
jquery.contextmenu.r2.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
    /*$("#min_title_list li").contextMenu('Huiadminmenu', {
        bindings: {
            'closethis': function(t) {
                console.log(t);
                if(t.find("i")){
                    t.find("i").trigger("click");
                }       
            },
            'closeall': function(t) {
                alert('Trigger was '+t.id+'\nAction was Email');
            },
        }
    });*/
});
/*个人信息*/
function myselfinfo(){
    layer.open({
        type: 1,
        area: ['300px','200px'],
        fix: false, //不固定
        maxmin: true,
        shade:0.4,
        title: '查看信息',
        content: '<div>管理员信息</div>'
    });
}

/*资讯-添加*/
function article_add(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
    layer_show(title,url,w,h);
}


</script> 
@endsection