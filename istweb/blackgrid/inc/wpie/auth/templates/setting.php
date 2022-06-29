<form method="post" class="form-update-user p-sm-6 p-3">
    <div class="form-item mb-6">
        <label for="nickname" class="form-label col-md-2">昵称</label>
        <div class="col-md-10">
            <input placeholder="添加昵称" id="nickname" class="form-field nickname" name="nickname" value="<?php echo $current_user->display_name; ?>"/>
        </div>
    </div>
    <div class="form-item mb-6">
        <label for="email" class="form-label col-md-2">邮箱</label>
        <div class="col-md-10">
            <input placeholder="添加邮箱" id="email" class="form-field email" name="email" value="<?php echo $current_user->user_email; ?>"/>
        </div>
    </div>
    <div class="form-item mb-6">
        <label for="homepage" class="form-label col-md-2">个人主页</label>
        <div class="col-md-10">
            <input placeholder="添加个人主页" id="homepage" class="form-field homepage" name="homepage" value="<?php echo $current_user->user_url; ?>"/>
        </div>
    </div>
    <div class="form-item mb-6">
        <label for="description" class="form-label col-md-2">个人简介</label>
        <div class="col-md-10">
            <input placeholder="添加个人简介" id="description" class="form-field description" name="description" value="<?php echo $current_user->description; ?>"/>
        </div>
    </div>
    <input type="hidden" name="id" class="user-id" value="<?php echo $current_user->ID; ?>">
    <div class="form-item text-right pr-3">
        <button type="submit" class="btn btn-primary">更新</button>
    </div>
</form>
