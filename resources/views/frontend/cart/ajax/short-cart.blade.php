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
@if( !empty($listKey) )
<?php $i = 0; ?>
@foreach($listKey as $key)
<?php $i++; 
$tmp = explode('-', $key);
$product_id = $tmp[0];
$product = $arrProductInfo[$product_id];
?>
<?php $price = $product->is_sale ? $product->price_sale : $product->price; ?>
<div class="table-row clearfix">
	<div class="table-cell product-col">
		<figure class="img-prod">
			<img alt="{!! $product->name !!}" src="{{ Helper::showImage($product['image_url']) }}">
		</figure>
		<a href="{{ route('product-detail', [$product->slug]) }}" target="_blank" title="{!! $product->name !!}">{!! $product->name !!}</a>
		<p class="p-color">
			<span>Màu sắc sản phẩm:</span>
			<span>{{ $colorArr[$tmp[1]]->name }}</span>
		</p>
		<p class="p-size">
			<span>Size sản phẩm:</span>
			<span>{{ $sizeArr[$tmp[2]]->name }}</span>
			<span>|</span>
			<a href="#" title="Xóa sản phẩm">Xóa</a>
		</p>
	</div>
	<div class="table-cell numb-col t-c">
		<select data-id="{{ $key }}" class="change_quantity form-control">
			<?php 
			$soluongton = 10;
			?>
				@for($i = 1; $i <= $soluongton; $i++ )
                <option value="{{ $i }}"
                @if ($i == $getlistProduct[$key])
                  selected
                @endif
                > {{$i}}
                  @if($i == 50) + @endif
                </option>
                @endfor
			</select> 
			<?php 
		$total += $total_per_product = ($getlistProduct[$key]*$price);
		?>
	</div>
	<div class="table-cell total-col t-r">{{ number_format($total_per_product)  }}đ</div><!-- /table-cell total-col t-r -->
</div>							
@endforeach
@endif
</div><!-- tr-wrap -->
</div><!-- table cart-tbl -->
<div class="block-btn">							
	@if( !empty($listKey))
	<a title="Xóa tất cả" class="btn btn-default"  onclick="return confirm('Quý khách có chắc chắn bỏ hết hàng ra khỏi giỏ?'); " href="{{ route('empty-cart') }}">Xóa tất cả <i class="fa fa-trash-o"></i></a>
	<a href="{!! route('payment') !!}" title="Thanh toán" class="btn btn-danger">Thanh toán <i class="fa fa-angle-right"></i></a>
	@endif
</div>
</form>
</div>