<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="block block-breadcrumb">
<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo route('home'); ?>">Trang chủ</a></li>
        <li><a href="<?php echo route('cate-parent', $cateDetail->slug); ?>"><?php echo $cateDetail->name; ?></a></li>        
        <li class="active"><?php echo $detail->title; ?></li>
    </ul>
</div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
<div class="row">
    <div class="col-sm-9 col-xs-12 block-col-left">
        <div class="block block-page-common block-dt-sales">
            <div class="block block-title">
                <h2>
                    <i class="fa fa-cart-arrow-down"></i>
                    <?php echo $detail->title; ?>

                </h2>
            </div>
            <div class="block-content">
                <div class="block block-aritcle block-editor-content">
                    <?php echo $detail->content; ?>

                </div>
                <div class="block block-share" id="share-buttons">
                    <div class="share-item">
                        <div class="fb-like" data-href="<?php echo e(url()->current()); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
                    </div>
                    <div class="share-item" style="max-width: 65px;">
                        <div class="g-plus" data-action="share"></div>
                    </div>
                    <div class="share-item">
                        <a class="twitter-share-button"
                      href="https://twitter.com/intent/tweet?text=<?php echo $detail->title; ?>">
                    Tweet</a>
                    </div>
                    <div class="share-item">
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div><!-- /block-share--> 
                <?php if($tagSelected->count() > 0): ?>
                <div class="block-tags">
                    <ul>
                        <li class="tags-first">Tags:</li>
                        <?php $i = 0; ?>
                        <?php foreach($tagSelected as $tag): ?>
                        <?php $i++; ?>
                        <li class="tags-link"><a href="<?php echo e(route('tag', $tag->slug)); ?>" title="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- /block-tags -->
                <?php endif; ?>                
            </div>
        </div><!-- /block-ct-news -->
        <div class="block-page-common block-aritcle-related">
            <div class="block block-title">
                <h2>
                    <i class="fa fa-cart-arrow-down"></i>
                    TIN LIÊN QUAN
                </h2>
            </div>
            <div class="block-content">
                <ul class="list">
                    <?php foreach( $otherArr as $articles): ?>
                    <li><a href="<?php echo e(route('news-detail', ['slug' => $articles->slug, 'id' => $articles->id])); ?>" title="<?php echo $articles->title; ?>" ><?php echo $articles->title; ?></a></li>
                    <?php endforeach; ?>   
                </ul>
            </div>
        </div><!-- /block-ct-news -->
    </div><!-- /block-col-left -->
    <div class="col-sm-3 col-xs-12 block-col-right">
        <?php echo $__env->make('frontend.partials.km-hot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><!-- /block-col-right -->
</div>
</div><!-- /block_big-title -->
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>