<div class="block block-title-cm block-categories-hm">
	<div class="container">
		<div class="block-title">
			<h2 data-text="11" <?php if($isEdit): ?> class="edit" <?php endif; ?>><?php echo $textList[11]; ?></h2>
			<p class="desc <?php if($isEdit): ?> edit <?php endif; ?>" data-text="12"><?php echo $textList[12]; ?></p>
		</div>
		<div class="block-content">
			<div class="row">
				<?php foreach($hotParent as $pa): ?>
				<div class="col-sm-6">
					<div class="item">
						<img src="<?php echo e($pa->image_url ? Helper::showImage($pa->image_url) : URL::asset('public/admin/dist/img/no-image.jpg')); ?>" alt="<?php echo $pa->name; ?>">
						<div class="des">
							<div class="box-table">
								<div class="box-td">
									<div class="box-des">
										<h3 class="title"><?php echo $pa->name; ?></h3>
										<div class="description">
											<?php echo $pa->description; ?>

										</div>
										<a href="<?php echo e(route('cate-parent', $pa->slug )); ?>" title="Xem chi tiết" class="btn-viewall btn-1e">Xem chi tiết <i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /item -->
				<?php endforeach; ?>
				<div class="clearfix"></div>
		</div>
	</div>
	</div><!-- /block_big-title -->
	</div>