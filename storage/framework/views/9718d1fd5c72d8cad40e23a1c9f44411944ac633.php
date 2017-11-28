<ul>
<?php foreach($sizeSelected as $size): ?>
<li class="choose-size <?php echo e($rsIvt[$size] == 0 ? " out-of-stock" : ""); ?>" data-value="<?php echo e($size); ?>" data-ivt="<?php echo e($rsIvt[$size]); ?>" ><?php echo e($sizeArr[$size]['name']); ?></li>
<?php endforeach; ?>
</ul>