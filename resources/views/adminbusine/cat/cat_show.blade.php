@extends('layouts.commen')
@section('content')
<div class="cl pd-20" style=" background-color:#5bacb6">

    <dl style="margin-left:80px; color:#fff">
        <dt>
            <span class="f-18">{{$data->cat_name}}</span>

        </dt>
        <dd class="pt-10 f-12" style="margin-left:0">{{$data->description}}</dd>
    </dl>
</div>
<div class="pd-20">
    <table class="table">
        <tbody>
        <tr>
            <th class="text-r">添加时间：</th>
            <td>111111111</td>
        </tr>

        </tbody>
    </table>
</div>
@endsection