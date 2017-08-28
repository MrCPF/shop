@extends('layouts.commen')
@section('content')
<div class="cl pd-20" style=" background-color:#5bacb6">
    <dl style="margin-left:80px; color:#fff">
        <dt>
            <span class="f-18">{{$data->goods_name}}</span>
            <span class="pl-10 f-12">余额：40</span>
        </dt>
        <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
    </dl>
</div>
<div class="pd-20">
    <table class="table">
        <tbody>      
        <tr>
            <th class="text-r">单价：</th>
            <td>{{$data->goods_price}}</td>
        </tr>
        <tr>
            <th class="text-r">库存：</th>
            <td>{{$data->goods_number}}</td>
        </tr>
        <tr>
            <th class="text-r">描述：</th>
            <td>{{$data->goods_detail}}</td>
        </tr>
        </tbody>
    </table>
</div>
@endsection