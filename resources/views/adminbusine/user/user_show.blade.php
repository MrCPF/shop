@extends('layouts.commen')
@section('content')
<div class="cl pd-20" style=" background-color:#5bacb6">
    <img class="avatar size-XL l" src="/admin/static/h-ui/images/ucnter/avatar-default.jpg">
    <dl style="margin-left:80px; color:#fff">
        <dt>
            <span class="f-18">{{$data->busines_aname}}</span>
            <!-- <span class="pl-10 f-12">余额：40</span> -->
        </dt>
        <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
    </dl>
</div>
<div class="pd-20">
    <table class="table">
        <tbody>      
        <tr>
            <th class="text-r">注册时间：</th>
            <td>{{$data->created_at}}</td>
        </tr>
        <tr>
            <th class="text-r">注册时间：</th>
            <td>{{$data->updated_at}}</td>
        </tr>

        </tbody>
    </table>
</div>
@endsection