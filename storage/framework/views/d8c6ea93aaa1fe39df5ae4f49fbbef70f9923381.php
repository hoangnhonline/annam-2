<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Đơn hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo e(route( 'orders.index' )); ?>">Đơn hàng</a></li>
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
          <form class="form-inline" id="searchForm" role="form" method="GET" action="<?php echo e(route('orders.index')); ?>">            
            <div class="form-group">              
              <select class="form-control" name="status" id="status">
                <option value="-1"
                <?php if(-1 == $s['status']): ?>
                  selected 
                  <?php endif; ?>   
                >--Tất cả trạng thái--</option>
                 <?php foreach($list_status as $index => $status): ?>
                  <option value="<?php echo e($index); ?>" 
                  <?php if($index == $s['status']): ?>
                  selected 
                  <?php endif; ?>                    
                    ><?php echo e($status); ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
             
            <div class="form-group">              
              <input type="text" class="form-control" name="name" placeholder="Email hoặc Tên khách hàng" value="<?php echo e($s['name']); ?>" style="width:250px">
            </div>  
            <div class="form-group">              
              <input type="text" class="form-control datepicker" placeholder="Từ ngày" name="date_from" value="<?php echo e($s['date_from']); ?>">
            </div> 
            <div class="form-group">              
              <input type="text" class="form-control datepicker" placeholder="Đến ngày" name="date_to" value="<?php echo e($s['date_to']); ?>">
            </div>                 
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <?php echo e($orders->total()); ?> đơn hàng )</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           <?php echo e($orders->appends( $s )->links()); ?>

          </div>  
          <table class="table table-bordered" id="table-list-data">           
             <tr>
              <th style="width: 1%">No.</th>
              <th style="width: 1%;white-space:nowrap;width:200px"> Đơn hàng</th>
              <th style="text-align:center;width:150px">Ngày đặt hàng</th>
              <th style="text-align:right;width:200px">Giao hàng đến</th>           
              <th style="text-align:right;width:100px">Tổng hoá đơn</th>
              <th width="120px" style="white-space:nowrap">Trạng thái</th>
              <th width="1%" style="white-space:nowrap"> </th>
            </tr>
            <tbody>

              <?php if($orders->count() > 0): ?>
              <?php $i = 0; ?>
                <?php foreach($orders as $order): ?>
                <?php $i++; ?>
                <tr>
                <td style="text-align:center"><?php echo e($i); ?></td>                
                <td>
                <a href="" style="font-size:14px; font-weight:bold">
                <?php 

                ?>
                #<?php echo e(str_pad($order->id, 6,'0', STR_PAD_LEFT)); ?></a> 
                <span style="color:#555"> bởi <?php echo e($order->full_name); ?></span>
                <br>
                <a href="mailto:"><?php echo e($order->email); ?></a>
                <br>
                <?php echo e($order->phone); ?>

                </td>
                <td style="text-align:center;width:150px;white-space:nowrap"><?php echo e(date('d-m-Y H:i ', strtotime($order->created_at))); ?></td>
                <td>

                <a href="http://maps.google.com/maps?&q=<?php echo e($order->address); ?>" target="_blank"> 
                <?php echo e($order->full_name); ?>, <?php echo e($order->address); ?></a>
                </td>
                             
                <td style="text-align:right;width:100px"><?php echo e(number_format($order->tong_tien)); ?></td>
                <td>
                  <select class="select-change-status form-control" order-id="<?php echo e($order->id); ?>" customer-id="<?php echo e($order->customer_id); ?>" >
                    <?php foreach($list_status as $index => $status): ?>
                    <option value="<?php echo e($index); ?>"
                      <?php if($index == $order->status): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($status); ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td style="text-align:right">
                  <?php if($order->customer_id > 0): ?>
                  <button class="btn btn-danger btn-sm sendNoti" data-type="2" data-customer-id="<?php echo e($order->customer_id); ?>" data-order-id="<?php echo e($order->id); ?>" >Gửi tin nhắn 
                  <?php 
                  $countMess = App\Models\CustomerNotification::countMessOrderCustomer($order->customer_id, $order->id);

                  ?>
                  <?php if($countMess > 0): ?>
                  <span class="badge"><?php echo e($countMess); ?></span>
                  <?php endif; ?>
                  </button>  
                   <?php endif; ?>  
                  <a href="<?php echo e(route('order.detail', $order->id)); ?>?status=<?php echo e($s['status']); ?>&name=<?php echo e($s['name']); ?>&date_from=<?php echo e($s['date_from']); ?>&date_to=<?php echo e($s['date_to']); ?>" class="btn btn-info btn-sm">Chi tiết</a>
                                 
               
                </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="5">Không có dữ liệu.</td>
              </tr>
              <?php endif; ?>
          </tbody>
          </table>
          <div style="text-align:center">
           <?php echo e($orders->appends( $s )->links()); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">

$(document).ready(function(){
  $('#status').change(function(){
    $('#searchForm').submit();

  });
  $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
  $('.select-change-status').change(function(){
    var status_id = $(this).val();
    var order_id  = $(this).attr('order-id');
    var customer_id = $(this).attr('customer-id');
    update_status_orders(status_id, order_id, customer_id);
  });

  function update_status_orders(status_id, order_id, customer_id) {
    $.ajax({
      url: '<?php echo e(route('orders.update')); ?>',
      type: "POST",
      data: {
        status_id : status_id,
        order_id : order_id,
        customer_id : customer_id
      },
      success: function (response) {
        location.reload()
      },
      error: function(response){

      }
    });
  }

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>