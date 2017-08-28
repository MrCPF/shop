 @extends('layouts.art')
 
 @section('content')
 
 <a class="btn btn-primary" href="/art/create">添加文章</a>

@foreach($data as $val)
 <div class="panel panel-default">
  <div class="panel-body">
    {{$val->title}}
    <a href="/art/{{$val->id}}" class="btn btn-info">阅读</a>
    <a href="/art/{{$val->id}}/edit" class="btn btn-info">修改</a>

      <form action="/art/{{$val->id}}" method="post" style="display: inline-block;">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">删除</button>
        </form>
    </div>
    </div>
@endforeach
    
   {!! $data->render() !!} 
  
  @endsection