<div class="user-infoPic">

    <div class="filePic">

        <input type="file" class="inputPic am-img-circle" name="photo" allowexts="gif,jpeg,jpg,png,bmp" id="" accept="image/*" width="100" height="100" onchange="doUpload()">
        <!-- <img class="am-circle am-img-thumbnail" id="avatar_url" src="/upload/images/origin_150271039152.jpg" alt="" /> -->
        <img class="am-circle am-img-thumbnail" id="avatar_url" src="{{$userInfo2->pic}}" alt="" />
        <!-- <img class="am-circle am-img-thumbnail" id="avatar_url" src="{{$userInfo2->pic}}" alt="" /> -->

    </div>

    <p class="am-form-help">头像</p>

    <div class="info-m">
        <div><b>用户名：<i>{{$userInfo->name}}</i></b></div>
        <div class="u-level">
                                    <span class="rank r2">
                                         <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                                    </span>
        </div>
        <div class="u-safety">
            <a href="safety.html">
                账户安全
                <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
            </a>
        </div>
    </div>
</div>