 @extends('layouts.art')
 @section('content')
<!-- 配置文件 -->
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
<div id="aid">
     <form class="form-horizontal" method="post" action="/art" >
           {{ csrf_field() }}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
        <div class="col-sm-8">
          <input type="title" class="form-control" id="title" name="title">
        </div>
      </div>
    
    
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-8">
          <!--  <textarea class="form-control" rows="5" id="content" name="content"></textarea> -->
          
           <!-- 加载编辑器容器 -->
           <script id="container" name="content" type="text/plain">
            
       </script>	
           
           <!-- 实例化编辑器 -->
           <script type="text/javascript">
           		var ue = UE.getEditor('container');
           </script>
        </div>
      </div>
       
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">创建</button>
          <button class="btn btn-default" id="yid" type="button">预览</button>
        </div>
      </div>
    </form>
</div>

<!-- 这里是预览显示的页面 -->
<div id="sid" style="display:none;">
    	<h3></h3>
    
        <p></p>
        <span id="uid" style="display:none"></span>
        <button class="btn btn-default" id="qid" type="button" onclick="location.href='{{url('/art')}}'">确定</button>
        <button class="btn btn-default" id="fid" type="button">修改</button>
</div>

<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
 	$("#yid").click(function(){ 
  		var title = $("#title").val(); 
  		
		/* 获取ueditor中的值  */
  		var ue = UE.getEditor('container');
  		var content = ue.getContent();

  		/* 设置全局 AJAX 默认选项  */
  		$.ajaxSetup({
  			headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
  	    });

  	    /* 发送ajax请求 */
  	    $.post(
			"{{url('/art')}}",{'title':title,'content':content},function(data){
				$('#aid').css('display','none');
 				$('#sid').css('display',"block");
 				$('h3').html(data.title);
 				$('p').html(data.content);
 				$('span').html(data.id);
 				
  	  	});
  	});

  	/* 事件委派，预览页面的修改按钮增加事件  */
  	$("#fid").live('click',function(){
      	var id = $('#uid').html();
  	  	location.href="/art/"+id+"/edit";
  	})
</script> 
@endsection





