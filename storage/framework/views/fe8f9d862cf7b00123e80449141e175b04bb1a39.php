<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Quản lý kho
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'inventory.index' )); ?>">Quản lý kho</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12">
      <?php if(Session::has('message')): ?>
      <p class="alert alert-info" ><?php echo e(Session::get('message')); ?></p>
      <?php endif; ?>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo e(route('inventory.index')); ?>">
           
            <div class="form-group">
             
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">--Danh mục cha--</option>
                <?php foreach( $loaiSpArr as $value ): ?>
                <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $arrSearch['parent_id'] ? "selected" : ""); ?>><?php echo e($value->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
              <div class="form-group">
              

              <select class="form-control" name="cate_id" id="cate_id">
                <option value="">--Danh mục con--</option>
                <?php foreach( $cateArr as $value ): ?>
                <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $arrSearch['cate_id'] ? "selected" : ""); ?>><?php echo e($value->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">              
              <input type="text" class="form-control" name="name" value="<?php echo e($arrSearch['name']); ?>" placeholder="Tên sản phẩm...">
            </div>           
            <div class="form-group">
              <label><input type="checkbox" name="is_hot" value="1" <?php echo e($arrSearch['is_hot'] == 1 ? "checked" : ""); ?>> Nổi bật</label>              
            </div>
            <div class="form-group">
              <label><input type="checkbox" name="is_sale" value="1" <?php echo e($arrSearch['is_sale'] == 1 ? "checked" : ""); ?>> SALE</label>              
            </div>
               
            <button type="submit" style="margin-top:-5px" class="btn btn-primary btn-sm">Lọc</button>
          </form>         

        </div>

      </div>
      <div class="box">
        <a href="<?php echo e(route('inventory-export')); ?>" class="btn btn-info btn-sm" style="margin-bottom:5px;float:left" target="_blank">Xuất Excel</a>
        <div class="clearfix"></div>
        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <?php echo e($items->total()); ?> sản phẩm )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           <?php echo e($items->appends( $arrSearch )->links()); ?>

          </div>  
          <form action="<?php echo e(route('cap-nhat-thu-tu')); ?>" method="POST">
           <?php if( $items->count() > 0 && $arrSearch['is_hot'] == 1 && $arrSearch['parent_id'] > 0): ?> 
          <button type="submit" class="btn btn-warning btn-sm">Cập nhật thứ tự</button>
          <?php endif; ?>
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="table" value="product">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>              
              <th style="text-align:left;width:150px;">Tên SP</th>
              <th style="text-align:right;width:150px;">Giá</th>
              <th style="text-align:left;width:150px;">Màu</th>
              <?php foreach($sizeArr as $size): ?>                   
              <th class="text-right"><?php echo e($size['name']); ?></th>
              <?php endforeach; ?>                           
            </tr>
            <tbody>
            <?php if( $items->count() > 0 ): ?>
              <?php $i = 0; ?>
              <?php foreach( $items as $item ): ?>
                <?php $i ++; 

                ?>
               <?php $k = 0; ?>
                <?php foreach($item->colors as $color): ?> 
                <?php $k++; ?>
              <tr id="row-<?php echo e($item->id); ?>">
                <?php if($k == 1): ?>
                <td rowspan="<?php echo e($item->colors->count()); ?>"><span class="order"><?php echo e($i); ?></span></td>                
                <td rowspan="<?php echo e($item->colors->count()); ?>">                  
                  <a style="color:#333;font-weight:bold" href="<?php echo e(route( 'inventory.edit', [ 'id' => $item->id ])); ?>"><?php echo e($item->name); ?> </a>
                </td>
                <td class="text-right" rowspan="<?php echo e($item->colors->count()); ?>"><?php echo e(number_format($item->price_sell)); ?></td>
                <?php endif; ?>
                <td> <?php echo e($colorArr[$color->color_id]->name); ?></td>
                <?php foreach($sizeArr as $size): ?>                               
                  <?php 
                  $arrInv = [];
                  //get inventory
                  $rsInv = DB::table('product_inventory')->where('product_id', $item->id)->orderBy('color_id')->orderBy('size_id')->get();
                  foreach($rsInv as $inv){
                      $arrInv[$inv->color_id][$inv->size_id] = $inv->amount;
                  }  
                  $valueAmount = !empty($arrInv) && isset($arrInv[$color->color_id][$size->id]) ? $arrInv[$color->color_id][$size->id] : "";
                  ?>               
                  <td style="text-align:right">
                    <strong><?php echo e($valueAmount ? number_format($valueAmount) : ''); ?></strong>
                  </td>
                  <?php endforeach; ?>
                
              </tr> 
              <?php endforeach; ?>
              <?php endforeach; ?>            
            <?php endif; ?>

          </tbody>
          </table>
          </form>
          <div style="text-align:center">
           <?php echo e($items->appends( $arrSearch )->links()); ?>

          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
<style type="text/css">
#searchForm div{
  margin-right: 7px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('.change-value').change(function(){
    var obj = $(this);
    var val = 0;
    if(obj.prop('checked') == true){
      var val = 1;
    }
    $.ajax({
      url : "<?php echo e(route('change-value')); ?>",
      type :'POST',
      data : {
        id : obj.data('id'),
        value : val,
        column : obj.data('col'),
        table : obj.data('table')
      },
      success : function(data){
        console.log(data);
      }
    });
  });
  $('input.submitForm').click(function(){
    var obj = $(this);
    if(obj.prop('checked') == true){
      obj.val(1);      
    }else{
      obj.val(0);
    } 
    obj.parent().parent().parent().submit(); 
  });
  
  $('#parent_id').change(function(){
    $('#cate_id').val('');
    $('#searchForm').submit();
  });
  $('#cate_id').change(function(){
    $('#searchForm').submit();
  });
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("product", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>