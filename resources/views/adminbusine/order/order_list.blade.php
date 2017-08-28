@extends('layouts.commen')
@section('content')


<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <form action="/adminbusine/search" method="get">
    <div class="text-c"> 
        <!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;"> -->

        <input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="search" value="{{$search}}">
        <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"></i> 订单管理</a> </span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>



    <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                    <tr class="text-c">
                        
                        <th width="40">订单ID</th>
                        <th width="40">用户名</th>
                        <th width="80">订单号</th>
                        <th width="80">订单时间</th>
                        <th width="80">商品名称</th>
                        <th width="80">数量</th>
                        <th width="80">单价</th>
                        <th width="80">总价</th>
                        <th width="80">订单状态</th>                        
                        <th width="80">操作</th>
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
                                     echo '交易完成(有评价)';
                                 }
                                  ?>
                                  </td>
                       <td class="td-manage">
                             @if ($v->orders_status == 0)
                                 <a href="/adminbusine/orderupdate/{{$v->orders_id}}">发货</a>
                               @elseif ($v->orders_status == 1)
                                 等待确认收货
                           @elseif ($v->orders_status == 2)
                                   交易已完成
                              @elseif ($v->orders_status == 5)
                                等待支付
                              @else
                                 交易完成
                             @endif
                       </td> 
                   </tr>
                             @endforeach 
                </tbody>
            </table>
            {!! $orders->appends(['search' => $search])->render() !!}
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