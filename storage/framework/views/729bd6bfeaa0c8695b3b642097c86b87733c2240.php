 <?php if( $imageList->count() > 0 ): ?>
 <div id="slider" class="flexslider">
    <ul class="slides slides-large">
        <?php  $i = 0; ?>
        <?php foreach( $imageList as $img ): ?>                                        
        <?php $i++; ?>
            <li><img src="<?php echo e(Helper::showImage($img->image_url)); ?>" alt=" hinh anh <?php echo e($i); ?>" /></li>
        <?php endforeach; ?>
    </ul>
</div>
<div id="carousel" class="flexslider">
    <ul class="slides">
        <?php foreach( $imageList as $img ): ?>                                        
            <li><img src="<?php echo e(Helper::showImageThumb($img->image_url)); ?>" alt=" hinh anh thumb" /></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>