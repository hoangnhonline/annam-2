<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="block block-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
             <li><a href="<?php echo route('home'); ?>">Trang chủ</a></li>         
        <li class="active"><?php echo $detailPage->title; ?></li>
        </ul>
    </div>
</div><!-- /block-breadcrumb -->
<div class="container">
    <div class="block-page-about">
        <div class="block-page-common">
            <div class="block block-title">
                <h2>
                    <i class="fa fa-address-card-o"></i>
                    <?php echo $detailPage->title; ?>

                </h2>
            </div>
        </div>
        <div class="block-article">
            <div class="block block-content block-editor-content">
                <?php echo $detailPage->content; ?>

            </div>
        </div>
    </div>
</div><!-- /container-->
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>