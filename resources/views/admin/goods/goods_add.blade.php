
@extends('layouts.commen')
@section('content')
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
	<form action="/admin/goodsInsert" method="post" class="form form-horizontal" id="photoForm">
			{{csrf_field()}}
            
		<div class="row cl">

			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="goods_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">原价：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="goods_price" id="" placeholder="" value="" class="input-text" style="width:90%">
				元</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">促销价：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="goods_sprice" id="" placeholder="" value="" class="input-text" style="width:90%">
                元</div>
        </div>  
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">数量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text"id="" name="goods_number" placeholder="" value="" class="input-text" style="width:90%">
                件</div>
        </div> 

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                    <select class="select" size="1" name="cats_id" id="cats_id">
                             @foreach($data as $val)
                                 @if($val->lev == 2)
                                <option value="{{$val->cats_id}}"> <?php echo '|--'.str_repeat('--',2*$val->lev);?>{{$val->cats_name}}</option>
                                @endif
                             @endforeach

                    </select>         
                </span>
            </div>
        </div> 
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
            <div class="col-sm-8">

              {{--  <textarea class="form-control" rows="5" id="myeditor" name="goods_detail"></textarea>--}}

               {{--引入百度ueditor--}}

                <!-- 加载编辑器的容器 -->
                <script id="myeditor" name="goods_detail" type="text/plain">
            
        </script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('myeditor',{
                        //自己定制配置

                    });
                </script>

            </div>
        </div>

    		<div class="row cl" style="margin-top: 10px;">
                <label class="form-label col-xs-4 col-sm-2" style="text-align: right;">缩略图：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <div class="col-sm-10">
                            <input type="file" name="img[]" multiple="multiple"/>

                        </div>
                    </div>                
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2" style="text-align: right;">预览：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <div class="col-sm-10" id="img_box">
                            
                            
                        </div>
                    </div>                
            </div>            
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="col-sm-10">
                        <button  class="btn btn-primary radius" type="button" onClick="doUpload()"><i class="Hui-iconfont" >&#xe632;</i>开始上传</button>
                    </div>
                </div>                
            </div> 
        <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont" >&#xe632;</i>提交</button>
                </div>
            </div>              
        </form>


		
</div>

@endsection

@section('js')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

    /*添加csrf——token*/

    function doUpload() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });
        var formData = new FormData($("#photoForm")[0]);
        var cats_id = $('#cats_id').val();
        console.log(formData);
        $.ajax({
            url: "{{url('/admin/goods')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (returndata) {

                var ret =eval("("+returndata+")");
              //  var data = JSON.parse(returndata);
                var row='';
                for( var i in ret.data){
                    console.log( ret.data[i]['goods_url']);
                    row += '<img src="'+ ret.data[i]['goods_url']+'" width="100";height="100">'
                    row += '<input type="hidden" name="image[]" value="'+ ret.data[i]['goods_url']+'">';
                }

                $("#img_box").html(row);
            },
            error: function (returndata) {
                console.log(returndata);
            }
        });
    }
</script>
</body>
</html>
