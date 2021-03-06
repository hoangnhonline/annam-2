<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">              
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Danh mục sản phẩm
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <ul>
        <?php 
          $parentList = DB::table('cate_parent')->orderBy('display_order')->get();

          ?>
          <?php foreach($parentList as $parent): ?>
          <?php 
              $cateList = DB::table('cate')->where('parent_id', $parent->id)->orderBy('display_order')->get();

              ?>
          <li>
            <label>
            <input type="radio" name="menu_select" data-title="<?php echo e($parent->name); ?>" data-link="<?php echo e(route('cate-parent', $parent->slug)); ?>" data-value="<?php echo e($parent->id); ?>" data-type="1" class="menu_select"> <?php echo e($parent->name); ?>

            </label>       
              <?php if($cateList): ?>

            <ul class="level0 submenu">     
              <?php foreach($cateList as $cate): ?>
              
              <li class="level1">
               <label> <input type="radio" name="menu_select" data-title="<?php echo e($cate->name); ?>" data-link="<?php echo e(route('cate', [$parent->slug, $cate->slug])); ?>" data-value="<?php echo e($cate->id); ?>" data-type="2" class="menu_select"><?php echo $cate->name; ?></label>                
               
              </li>
              <?php endforeach; ?>
            </ul>
            
            <?php endif; ?>                  
          </li>
          <?php endforeach; ?>
        </ul>                             
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Danh mục bài viết
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <ul>
          <?php foreach($articlesCateList as $value): ?>
          <li>
            <label>
            <input type="radio" name="menu_select" data-link="<?php echo e(route('cate-parent', $value->slug)); ?>" data-value="<?php echo e($value->id); ?>" data-type="5" data-title="<?php echo e($value->name); ?>" class="menu_select"> <?php echo e($value->name); ?>

            </label>            
          </li>
          <?php endforeach; ?>
        </ul>                             
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Trang
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
       <ul>
          <?php foreach($pageList as $value): ?>
          <li>
          <label>
            <input type="radio" name="menu_select" data-link="<?php echo e(route('pages', $value->slug)); ?>" data-value="<?php echo e($value->id); ?>" data-type="4" data-title="<?php echo e($value->title); ?>" class="menu_select"> <?php echo e($value->title); ?>            
          </label>
          </li>
          <?php endforeach; ?>
        </ul>                              
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" id="">
      <h4 class="panel-title">
        <a>
          Tùy chỉnh
        </a>
      </h4>
    </div>
    <div>
      <div class="panel-body" id="collapseFour">
        <div class="form-group">
          <label>Text hiển thị <span class="red-star">*</span></label>
          <input type="text" class="form-control" name="title_custom" id="title_custom"  value="<?php echo e(old('title_custom')); ?>">
        </div>
        <input type="hidden" name="type" value="3">
        <input type="hidden" name="custom" value="1">
         <div class="form-group">
          <label>URL <span class="red-star">*</span></label>
          <input type="text" class="form-control" name="url_custom" id="url_custom" value="<?php echo e(old('url_custom')); ?>">
        </div>
        <button type="button" class="btnAddToMenuCustom btn btn-sm btn-info" style="float:right" data-parent="collapseFour">Thêm vào menu</button>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>  
<form method="POST" action="<?php echo e(route('menu.store')); ?>" id="formMenu">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Hiển thị</h3>
  </div>
  <!-- /.box-header -->               
    <?php echo csrf_field(); ?>


    <div class="box-body">
         <!-- text input -->
        <div class="form-group">
          <label>Text hiển thị <span class="red-star">*</span></label>
          <input type="text" class="form-control" name="title" id="title" value="<?php echo e(old('title')); ?>">
        </div>
         <div class="form-group">
          <label>URL <span class="red-star">*</span></label>
          <input type="text" class="form-control" name="url" readonly="readonly" id="url" value="<?php echo e(old('url')); ?>">
        </div>                
        <input type="hidden" name="type" id="type" value="">
        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo e($parent_id); ?>">
        <input type="hidden" name="object_id" id="object_id" value="">
    </div>
    <!-- /.box-body -->                
    <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
      <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" data-dismiss="modal">Hủy</a>
    </div>
    
</div>
</form>
