@extends('layouts.commen')
@section('content')
<div class="cl pd-20" style=" background-color:#5bacb6">

    <dl style="margin-left:80px; color:#fff">
        <dt>
            <span class="f-18">{{$data->cats_name}}</span>

        </dt>
        <dd class="pt-10 f-12" style="margin-left:0">{{$data->cats_desc}}</dd>
    </dl>
</div>
<div class="pd-20">
    <table class="table">
        <tbody>
        <tr>
            <th class="text-r">添加时间：</th>
            <td>{{$data->created_at}}</td>
        </tr>

        </tbody>
    </table>
</div>
@endsection