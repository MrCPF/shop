<style>

.go-btn-wrap{
	color: red;
	width:65px;
	margin-top:20px; 
}

</style>
@extends('layouts.home_person')

@section('js')
<link href="/home/css/sustyle.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="clear"></div>



<div class="take-delivery">
 <div class="status">
   <h2>订单详情</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥{{$pay}}</em></li>
       <div class="user-info">
         <p>收货人：{{$userInfo->name}}</p>
         <p>联系电话：{{$userInfo->mobile}}</p>
         <p>收货地址：{{$userInfo->address}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
      <div class="user-email" style="width:350px">

            <form action="/home/dopay" method="post">
           		 {!! csrf_field() !!}

			 <input type="text" name="verify"  style="height:30px;width:55%" id="verify" placeholder="请输入验证码,点击更换验证码">
				<img src="/captcha/default?ueXnewG2" alt="" id="verify1" onclick="this.src = this.src+'.'" style="vertical-align: middle">
            <input type="hidden" name="orders_id" id="orders_id" value="{{$orders->orders_id}}">
            <p id="error" style="color:red"></p>
            @if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

        </div>
		<div class="go-btn-wrap" style="width:100%">
			<button type="button" id="paysuccess" onClick="doUpload()" class="am-btn am-btn-secondary" tabindex="0" title="点击此按钮，确认支付">确认支付</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/home/userinfo" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
		</form>
		</div>
		 <br>


     </div>
    </div>
  </div>
</div>

 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
 	<script type="text/javascript">
		function doUpload(){
			$.ajaxSetup({
			        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
			    }); 				
 				var verify = $('#verify').val();
 				var orders_id = $('#orders_id').val();
 				$.post('/home/dopay',{'verify':verify,'orders_id':orders_id},function(data){
 				/*	console.log(data);
 					return;*/
 					if(data == 0){
 						$('#error').html('密码错误，请重新输入！');
 						$('#verify1').attr('src',($('#verify1').attr('src')+'.'));
 					}else if(data == 1){
 						$('#error').html('支付成功！');
 						$('#verify').hide();
						$('#paysuccess').hide();
						$('#verify1').hide();
 					}
 				});
 		}
		window.document.onkeydown = function(ent){
			var event = window.event || ent;
//			alert(event.keyCode);
			switch(event.keyCode){
				case 13 :  //左
					$('#paysuccess').click(doUpload());
                        return false;
					break;
			}
		}
 	</script>
 @endsection
