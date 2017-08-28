<script src="/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
    $(".reply").live('click',function(){
        $(".eval").toggle();
        return false;
    });
/*
    $(".reply").live('click',function(){
//         this.parent$(".bianli").after($("#eval")).toggle();
        $(".replys").parentsUntil(".bianli").after($("#eval")).toggle();
         return false;
     });
*/


   /* $(".bianli").each(function(){
        $(this).find('.reply').click(){
            $(".eval").toggle();
            return false;
        }
    });*/

</script>
@extends('layouts.home')
<b class="line"></b>
@section('content')
    <div style="">
        <div style="width:70%;height:60px;margin-top: 10px;">
            <div style="width:20%;float:left;text-align: center;">
                <p>{{$evaluate->name}}</p>
                <p>铜牌会员</p>
            </div>
            <div style="width:50%;float:left;margin-left: 30px;">
                <p>{{$evaluate->eval_content}}</p><br>
                <p>{{$evaluate->eval_time}}</p>
            </div>
        </div>
        <div style="width:100%;text-align: center;">
            <div style="width:70%;"><img src="{{$evaluate->goods_url}}" style="padding:20px"></div>
            <div style="width:30%; position: absolute;left:70%;top:30%; text-align:left;line-height: 90px;color:red;font-size: 25px;">广告栏位招商中.....<br>联系人：胡经理<br>联系电话：18838145932</div>


        </div>
        <div style="padding: 10px;border: 1px solid #eee;background-color: #f7f7f7;width: 70%;height: 120px;">
            <div style="border: 1px solid #ddd;background-color: #fff;">
                <div style="margin: 10px;">
                    <form action="/home/reply" method="post">
                        <input type="hidden" name="eval_eid" value="{{$evaluate->eval_id}}">
                        <input type="hidden" name="goods_id" value="{{$evaluate->goods_id}}">
                        {{csrf_field()}}
                    <textarea placeholder="回复{{$evaluate->name}}:" style="display: block;border: none;line-height: 20px;font-size: 12px;resize: vertical;resize: none;" cols="128%" name="replys_content"></textarea>
                </div>
            </div>
            <div style="margin-top: 10px;text-align: right;">
                <span style="margin-right: 10px;color: #999;display: inline-block;">还可以输入<em>200</em>字</span>
                <button type="submit" style="padding: 0 28px;background: #e4393c;color: #FFF;margin-right: 0;display: inline-block;border-radius: 2px;font-family: 'Microsoft YaHei';" >提交</button>
                </form>
            </div>
        </div>


    @foreach($replys as $reply)
        <div style="width:70%;height:70px;padding:10px;margin-top: 10px;background-color: #f7f7f7;" class="bianli">
            <div style="width:100%;float:left;padding-left: 10px;padding-bottom:10px;">
                <p>{{$reply->name}} : {{$reply->replys_content}}</p><br>
                <p>{{$reply->replys_time}}{{--<a style="float:right;" href="" class="reply">回复</a>--}}</p>
            </div>
        </div>

            <div style="padding: 10px;border: 1px solid #eee;background-color: #f7f7f7;width: 70%;height: 120px;display:none;" class="eval">
                <div style="border: 1px solid #ddd;background-color: #fff;">
                    <div style="margin: 10px;">
                        <form action="/home/reply" method="post">
                            <input type="hidden" name="eval_eid" value="{{$evaluate->eval_id}}">
                            <input type="hidden" name="goods_id" value="{{$evaluate->goods_id}}">
                            {{csrf_field()}}
                            <textarea placeholder="回复{{$reply->name}}:" style="display: block;border: none;line-height: 20px;font-size: 12px;resize: vertical;resize: none;" cols="128%" name="replys_content"></textarea>
                    </div>
                </div>
                <div style="margin-top: 10px;text-align: right;">
                    <span style="margin-right: 10px;color: #999;display: inline-block;">还可以输入<em>200</em>字</span>
                    <button type="submit" style="padding: 0 28px;background: #e4393c;color: #FFF;margin-right: 0;display: inline-block;border-radius: 2px;font-family: 'Microsoft YaHei';" >提交</button>
                    </form>
                </div>
            </div>


    @endforeach



    </div>

@endsection
@section('js')

@endsection