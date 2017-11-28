<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('header'); ?>
  <?php echo $__env->make('frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="block block-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo e(route('home')); ?>" title="Trở về trang chủ">Trang chủ</a></li>
            <li><a href="<?php echo e(route('cate-parent', $loaiDetail->slug)); ?>" title="<?php echo $loaiDetail->name; ?>"><?php echo $loaiDetail->name; ?> </a></li>
            <li><a href="<?php echo e(route('cate', [$loaiDetail->slug, $cateDetail->slug])); ?>" title="<?php echo $cateDetail->name; ?>"><?php echo $cateDetail->name; ?> </a></li>
            <li class="active"><?php echo $detail->name; ?></li>
        </ul>
    </div>
</div><!-- /block-breadcrumb -->
<div class="block block-two-col container">
    <div class="row">
        <div class="col-sm-9 col-xs-12 block-col-left">
            <div class="block-title-commom block-detail">
                <div class="block-content">
                    <div class="block row">
                        <div class="col-sm-5">
                            <div class="block block-slide-detail" id="load-slider">
                                <!-- Place somewhere in the <body> of your page -->
                                <div id="slider" class="flexslider">
                                    <ul class="slides slides-large">
                                        <?php foreach( $hinhArr as $hinh ): ?>                                        
                                            <li><img src="<?php echo e(Helper::showImage($hinh['image_url'])); ?>" alt=" hinh anh <?php echo $detail->name; ?>" /></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div id="carousel" class="flexslider">
                                    <ul class="slides">
                                        <?php foreach( $hinhArr as $hinh ): ?>                                        
                                            <li><img src="<?php echo e(Helper::showImageThumb($hinh['image_url'])); ?>" alt=" hinh anh <?php echo $detail->name; ?>" /></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div><!-- /block-slide-detail -->
                        </div>
                        <div class="col-sm-7">
                            <div class="block-page-common clearfix">
                                <div class="block block-title">
                                    <h2>
                                        <i class="fa fa-shopping-cart"></i>
                                        <?php echo $detail->name; ?>

                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="block block-product-options clearfix">
                                        <div class="bl-modul-cm bl-price">
                                            <p class="title">Giá sản phẩm:</p>
                                            <p class="des"><?php echo $detail->is_sale == 1 ? number_format($detail->price_sale ) : number_format($detail->price); ?>₫</p>
                                        </div>
                                        <div class="bl-modul-cm bl-color">
                                            <p class="title">Màu sắc sản phẩm:</p>
                                            <div class="des">
                                                <ul>
                                                    <?php foreach($colorSelected as $color): ?>
                                                    <li data-value="<?php echo e($color); ?>" class="choose-color <?php echo e($color == $detail->color_id_main ? "active" : ''); ?>">
                                                        <img src="<?php echo e(Helper::showImage($colorArr[$color]->image_url)); ?>" alt="<?php echo e($colorArr[$color]['name']); ?>">
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="bl-modul-cm bl-size">
                                            <p class="title">Size sản phẩm:</p>
                                            <div class="des" id="size-div">
                                                <ul>
                                                    <?php foreach($sizeSelected as $size): ?>
                                                    <li class="choose-size" data-value="<?php echo e($size); ?>"><?php echo e($sizeArr[$size]['name']); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--<div class="bl-modul bl-show-option">
                                            <span class="title">Vòng eo sản phẩm:</span>
                                            <div class="des">
                                                <b>56cm</b>
                                                <b>56cm</b>
                                            </div>
                                        </div>-->
                                        <?php if($tagSelected->count() > 0): ?>
                                        <div class="bl-modul bl-show-option">
                                            <span class="title">Phong cách sản phẩm:</span>
                                            <div class="des">
                                               <?php if($tagSelected->count() > 0): ?>
                                                
                                                        <?php $i = 0; ?>
                                                        <?php foreach($tagSelected as $tag): ?>
                                                        <?php $i++; ?>
                                                        
                                                        <a href="<?php echo e(route('tag', $tag->slug)); ?>" title="<?php echo $tag->name; ?>"><b><?php echo $tag->name; ?>, </b></a> 
                                                        <?php endforeach; ?>
                                                  
                                                <?php endif; ?>      

                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <input type="hidden" name="" id="color_id" value="<?php echo e($detail->color_id_main); ?>">
                                        <input type="hidden" name="" id="size_id" value="">
                                    </div><!-- /block-datail-if -->
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
                                    
                                    <button type="button" class="btn btn-addcart-product" data-id="<?php echo e($detail->id); ?>">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($detail->chi_tiet != ''): ?>
                    <div class="block block-datail-atc block-page-common">
                        <div class="block block-title">
                            <h2>
                                <i class="fa fa-shopping-cart"></i>
                                MÔ TẢ CHI TIẾT
                            </h2>
                        </div>
                        <div class="block-content block-editor-content">                           
                            <?php echo $detail->chi_tiet; ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($otherList->count() > 0): ?>
                    <div class="block-datail-atc block-page-common">
                        <div class="block block-title">
                            <h2>
                                <i class="fa fa-shopping-cart"></i>
                                SẢN PHẨM LIÊN QUAN
                            </h2>
                        </div>
                        <div class="block-content product-list">
                            <ul class="owl-carousel owl-theme owl-style2" data-nav="true" data-dots="false" data-autoplay="true" data-autoplayTimeout="500" data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"480":{"items":2},"600":{"items":2},"768":{"items":3},"800":{"items":3},"992":{"items":4}}'>
                                <?php $i = 0;?>
                                <?php foreach($otherList as $product): ?>
                                <?php $i++; ?>
                                <li class="product-item">
                                    <div class="product-img">
                                        <a href="<?php echo e(route('product-detail', [$product->slug])); ?>" class="product-item-photo">
                                            <img alt="<?php echo $product->name; ?>" src="<?php echo e($product->image_url ? Helper::showImageThumb($product->image_url) : URL::asset('admin/dist/img/no-image.jpg')); ?>">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h2 class="title"><a href="#" title=""><?php echo $product->name; ?></a></h2>
                                        <div class="product-price">
                                            <span class="price-new"><?php echo e($product->is_sale == 1 ? number_format($product->price_sale) : number_format($product->price)); ?>đ</span>
                  <?php if($product->is_sale): ?>
                  <span class="price-old"><?php echo e(number_format($product->price)); ?>đ</span>
                  <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                                 <?php endforeach; ?>   
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div><!-- /block-detail -->
        </div><!-- /block-col-left -->
        <div class="col-sm-3 col-xs-12 block-col-right">
           <?php echo $__env->make('frontend.partials.km-hot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div><!-- /block-col-right -->
    </div>
</div><!-- /block_big-title -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(URL::asset('public/assets/lib/jquery.zoom.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/assets/lib/flexslider/jquery.flexslider-min.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function($){  
    $.ajax({
        url : "<?php echo e(route('get-ivt-of-color')); ?>",
        type :'GET',
        dataType :'html',
        data : {
            color_id : <?php echo e($detail->color_id_main); ?>,
            product_id : <?php echo e($detail->id); ?>

        }, 
        success : function(data){
            $('#size-div').html(data);
        }
    });
    $('.choose-color').click(function(){
        var obj = $(this);
        $('.choose-color').removeClass('active');
        obj.addClass('active');
        $('#color_id').val(obj.data('value'));
        $.ajax({
            url : "<?php echo e(route('get-ivt-of-color')); ?>",
            type :'GET',
            dataType :'html',
            data : {
                color_id : obj.data('value'),
                product_id : <?php echo e($detail->id); ?>

            }, 
            success : function(data){
                $('#size-div').html(data);
                $('#size_id').val('');
            }
        });
        $.ajax({
            url : "<?php echo e(route('get-image-of-color')); ?>",
            type :'GET',
            dataType :'html',
            data : {
                color_id : obj.data('value'),
                product_id : <?php echo e($detail->id); ?>

            }, 
            success : function(data){
                $('#load-slider').html(data);
                // The slider being synced must be initialized first
                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: true,
                    slideshow: false,
                    itemWidth: 75,
                    itemMargin: 15,
                    nextText: "",
                    prevText: "",
                    asNavFor: '#slider',
                    adaptiveHeight: true
                });

                $('#slider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    animationLoop: false,
                    slideshow: false,
                    animationSpeed: 500,
                    sync: "#carousel",
                    adaptiveHeight: true
                });

                $('.slides-large li').each(function () {
                    $(this).zoom();
                });
            }
        });
    });
    $(document).on('click', '.choose-size', function(){
        var obj = $(this);
        if(!obj.hasClass('out-of-stock')){
            $('.choose-size').removeClass('active');
            obj.addClass('active');
            $('#size_id').val(obj.data('value'));
        }
    });
    // The slider being synced must be initialized first
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 75,
        itemMargin: 15,
        nextText: "",
        prevText: "",
        asNavFor: '#slider'
    });

    $('#slider').flexslider({
        animation: "fade",
        controlNav: false,
        directionNav: false,
        animationLoop: false,
        slideshow: false,
        animationSpeed: 500,
        sync: "#carousel"
    });

    $('.slides-large li').each(function () {
        $(this).zoom();
    });
  $('.btn-addcart-product').click(function() {
        var product_id = $(this).data('id');
        var size_id = $('#size_id').val();
        var color_id = $('#color_id').val();
        if(size_id == ''){
            alert('Vui lòng chọn size.'); return false;
        }
        if(color_id == ''){
            alert('Vui lòng chọn màu sắc.'); return false;
        }
        add_product_to_cart(product_id, color_id, size_id);
        
      });
});
function add_product_to_cart(product_id, color_id, size_id) {
  $.ajax({
    url: $('#route-add-to-cart').val(),
    method: "GET",
    data : {
      id: product_id,
      color_id : color_id,
      size_id : size_id
    },
    success : function(data){
       $('.cart-link').click();
    }
  });
}
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>