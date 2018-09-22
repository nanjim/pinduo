

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('重置密码'), false); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('password.postReset'), false); ?>">
                            <?php echo csrf_field(); ?>

                            

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right"><?php echo e(__('手机号'), false); ?></label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : '', false); ?>" name="mobile" autofocus autocomplete="off" value="<?php echo e(old('mobile'), false); ?>">

                                    <?php if($errors->has('mobile')): ?>
                                        <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('mobile'), false); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><?php echo e(__('验证码'), false); ?></label>
                                <div class="col-md-3">
                                    <input  type="text" class="form-control<?php echo e($errors->has('verify') ? ' is-invalid' : '', false); ?>" name="verify" autocomplete="off" value="<?php echo e(old('verify'), false); ?>">
                                    <?php if($errors->has('verify')): ?>
                                        <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('verify'), false); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary get-code">获取验证码</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('密码'), false); ?></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : '', false); ?>" name="password" autocomplete="off">

                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password'), false); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('确认密码'), false); ?></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('重置密码'), false); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <script>
        var seconds;
        $("body").on('click','.get-code',function () {

            var mobile = $("input[name=mobile]").val();
            isPhone = isPhoneNum(mobile);

            if(!isPhone){
                return;
            }

            seconds=getCookie("secondsremained");

            if(seconds==''){
                setCookie('secondsremained', 60, 10);
                var token = '<?php echo e(csrf_token(), false); ?>';
                $.ajax({
                    type:"post",
                    url:"/sendMessage",
                    data:{'mobile': mobile, '_token': token, 'type': 2},
                    success:function (data) {
                        // console.log(data);
                        if (!data.status) {
                            alert(data.msg);
                        }
                    }
                });
            }

            settime($(".get-code"));

        });

        function getCookie(c_name)
        {
            if (document.cookie.length>0)
            {
                c_start=document.cookie.indexOf(c_name + "=");
                if (c_start!=-1)
                {
                    c_start=c_start + c_name.length+1;
                    c_end=document.cookie.indexOf(";",c_start);
                    if (c_end==-1) c_end=document.cookie.length;
                    return document.cookie.substring(c_start,c_end);
                }
            }
            return "";
        }

        function setCookie(c_name,value,expires)
        {
            var exdate=new Date();
            exdate.setTime(exdate.getTime()+expires*1000);
            document.cookie=c_name+ "=" +value+((expires==null) ? "" : ";expires="+exdate.toGMTString());
        }

        function settime(obj) {

            seconds = getCookie("secondsremained");
            if (seconds == '') {
                obj.removeAttr("disabled");
                obj.text("获取验证码");
                return;
            } else {
                setCookie('secondsremained', seconds-1, seconds);
                obj.attr("disabled", true);
                obj.text("重新发送(" + seconds + ")");
            }
            setTimeout(function() { settime(obj) }, 1000) //每1000毫秒执行一次

        }
        //校验手机号是否合法
        function isPhoneNum(mobile){
            var myreg = /^(((1[0-9]{2})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test(mobile)){
                alert('请输入有效的手机号码！');
                return false;
            }else{
                return true;
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>