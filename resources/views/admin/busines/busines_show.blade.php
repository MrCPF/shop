
@extends('/admin/busines.busines_comment')
@section('busines_content')
    <div class="cl pd-20" style=" background-color:#5bacb6">
        <img class="avatar size-XL l" src="{{$users->busines_pic}}">
        <dl style="margin-left:80px; color:#fff">
            <dt>
                <span class="f-18">{{$users->busines_name}}</span>
                <span class="pl-10 f-12">等级：{{$users->busines_level}}</span>
            </dt>
            <dd class="pt-10 f-12" style="margin-left:0">{{$users->busines_desc}}</dd>
        </dl>
    </div>
    <div class="pd-20">
        <table class="table">
            <tbody>
            <tr>
                <th class="text-r">注册时间：</th>
                <td>{{$users->created_at}}</td>
            </tr>
            <tr>
                <th class="text-r">联系方式：</th>
                <td>{{$users->busines_mobile}}</td>
            </tr>

            <tr>
                <th class="text-r">商家描述：</th>
                <td>{{$users->busines_desc}}</td>
            </tr>


            </tbody>
        </table>
    </div>
@endsection