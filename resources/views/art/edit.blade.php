 @extends('layouts.art')
 @section('content')
 <!-- 配置文件 -->
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>

 <form class="form-horizontal" method="post" action="/art/{{$data->id}}">
       {{ csrf_field() }}
         {{ method_field('PATCH') }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-8">
      <input type="title" class="form-control" id="title" name="title" value="{{$data->title}}">
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-8">
       <!-- <textarea class="form-control" rows="5" id="content" name="content">{{$data->content}}</textarea> -->
       
       <!-- 加载编辑器容器 -->
       <script id="container" name="content" type="text/plain">
            <?php echo html_entity_decode($data->content)?>
       </script>	
       
       <!-- 实例化编辑器 -->
       <script type="text/javascript">
       		var ue = UE.getEditor('container');
       </script>
       
    </div>
  </div>
   
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">确认修改</button>
    </div>
  </div>
</form>

@endsection