<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="block block-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
            <li class="active">Liên hệ</li>
        </ul>
    </div>
    </div><!-- /block-breadcrumb -->
    <div class="block block-two-col container">
    <div class="row">
        <div class="col-sm-9 col-xs-12 block-col-left">
            <div class="block-page-common clearfix">
                <div class="block block-title">
                    <h2>
                        <i class="fa fa-home"></i>
                        LIÊN HỆ
                    </h2>
                </div>
                <div class="block-content">
                    <?php echo $settingArr['thong_tin_cong_ty']; ?>

					
                    <div class="block block-map" style="margin-top:20px">
                        <?php 
					if($settingArr['maps'] != ''){
					$str_maps = $settingArr['maps'];
		            $tmp = explode('src="', $str_maps);
		            $tmp2 = explode('"', $tmp[1]);		            
					?>
						<object data="<?php echo e($tmp2[0]); ?>"></object>
						<?php } ?>
                    </div>
                    <div id="showmess" class="clearfix"></div>
                        <?php if(Session::has('message')): ?>
                        
                        <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
                        
                        <?php endif; ?>
                        <?php if(count($errors) > 0): ?>                        
                          <div class="alert alert-danger ">
                            <ul>                           
                                <li>Vui lòng nhập đầy đủ thông tin.</li>                            
                            </ul>
                          </div>                        
                        <?php endif; ?>  
                        <form class="block-form" action="<?php echo e(route('send-contact')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Họ tên khách hàng" value="<?php echo e(old('full_name')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="<?php echo e(old('phone')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <textarea name="content" id="content" rowspan="300" class="form-control" placeholder="Ghi chú"><?php echo e(old('content')); ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                    <button type="submit" id="btnSave" class="btn btn-prmary btn-view">Gửi liên hệ</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div><!-- /block-ct-news -->
        </div><!-- /block-col-left -->
        <div class="col-sm-3 col-xs-12 block-col-right">            
            <?php echo $__env->make('frontend.partials.km-hot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div><!-- /block-col-right -->
    </div>
    </div><!-- /block_big-title -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    <?php if(count($errors) > 0 || Session::has('message')): ?>      
    $(document).ready(function(){
        $('html, body').animate({
            scrollTop: $("#showmess").offset().top
        });
    });
    <?php endif; ?>
    $(document).ready(function(){
        $('#btnSave').click(function(){
            $(this).parents('form').submit();
            $('#btnSave').attr('disabled', 'disabled').html('<i class="fa fa-spin fa-spinner"></i>');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>