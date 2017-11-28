<div class="modal-body">
<form action="#" method="POST" id="frm_order_items">
	<div class="table cart-tbl">
		<div class="table-row thead">
			<div class="table-cell product-col t-c">Sản phẩm</div>
			<div class="table-cell numb-col t-c">Số lượng</div>
			<div class="table-cell total-col t-c">Thành tiền</div>
		</div><!-- table-row thead -->
		<div class="tr-wrap" id="short-cart-content">
		
<?php 
$total = 0;
?>
<?php if( !empty($listKey) ): ?>
<?php $i = 0; ?>
<?php foreach($listKey as $key): ?>
<?php $i++; 
$tmp = explode('-', $key);
$product_id = $tmp[0];
$product = $arrProductInfo[$product_id];
?>
<?php $price = $product->is_sale ? $product->price_sale : $product->price; ?>
<div class="table-row clearfix">
	<div class="table-cell product-col">
		<figure class="img-prod">
			<img alt="<?php echo $product->name; ?>" src="<?php echo e(Helper::showImage($product['image_url'])); ?>">
		</figure>
		<a href="<?php echo e(route('product-detail', [$product->slug])); ?>" target="_blank" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a>
		<p class="p-color">
			<span>Màu sắc sản phẩm:</span>
			<span><?php echo e($colorArr[$tmp[1]]->name); ?></span>
		</p>
		<p class="p-size">
			<span>Size sản phẩm:</span>
			<span><?php echo e($sizeArr[$tmp[2]]->name); ?></span>
			<span>|</span>
			<a href="#" title="Xóa sản phẩm">Xóa</a>
		</p>
	</div>
	<div class="table-cell numb-col t-c">
		<select data-id="<?php echo e($key); ?>" class="change_quantity form-control">
			<?php 
			$soluongton = 10;
			?>
				<?php for($i = 1; $i <= $soluongton; $i++ ): ?>
                <option value="<?php echo e($i); ?>"
                <?php if($i == $getlistProduct[$key]): ?>
                  selected
                <?php endif; ?>
                > <?php echo e($i); ?>

                  <?php if($i == 50): ?> + <?php endif; ?>
                </option>
                <?php endfor; ?>
			</select> 
			<?php 
		$total += $total_per_product = ($getlistProduct[$key]*$price);
		?>
	</div>
	<div class="table-cell total-col t-r"><?php echo e(number_format($total_per_product)); ?>đ</div><!-- /table-cell total-col t-r -->
</div>							
<?php endforeach; ?>
<?php endif; ?>
</div><!-- tr-wrap -->
</div><!-- table cart-tbl -->
<div class="block-btn">							
	<?php if( !empty($listKey)): ?>
	<a title="Xóa tất cả" class="btn btn-default"  onclick="return confirm('Quý khách có chắc chắn bỏ hết hàng ra khỏi giỏ?'); " href="<?php echo e(route('empty-cart')); ?>">Xóa tất cả <i class="fa fa-trash-o"></i></a>
	<a href="<?php echo route('payment'); ?>" title="Thanh toán" class="btn btn-danger">Thanh toán <i class="fa fa-angle-right"></i></a>
	<?php endif; ?>
</div>
</form>
</div>