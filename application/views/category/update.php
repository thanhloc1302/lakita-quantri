<style>.has-switch{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Danh mục <small><?php if(isset($category[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url();?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>category">
                            Danh sách danh mục
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php if(isset($category[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> danh mục
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        
        <div class="row ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php if(!empty($this->session->flashdata('error'))){ ?>
            <div class="note note-danger">
                <h4 class="block">Lỗi! Nội dung thao tác</h4>
                <p>
                    <?php echo $this->session->flashdata('error'); ?>
                </p>
            </div>
            <?php } ?>

            <form role="form" action="<?php echo base_url().'category/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">  
                                <div class="form-group">
                                    <label class="control-label"><i>Loại danh mục</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-exchange"></i>
                                        <select class="form-control" name="type_id">
                                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sản phẩm</option>
                                            <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tin tức</option>
                                            <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Video</option>
                                        </select>
                                    </div>
                                </div>     

                                <div class="form-group">
                                    <label class="control-label"><i>Danh mục cha</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-folder-open"></i>
                                        <select class="form-control" name="parent">
                                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ++++++++ Chọn là danh mục cha ++++++++</option>
                                            <?php if(isset($category[0])) foreach ($category as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="control-label"><i>Tên danh mục</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-align-justify"></i>
                                        <input class="form-control" type="text" id="name" required="true" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Slug - Đường dẫn web</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-globe"></i>
                                        <input class="form-control" type="text" id="slug" required="true" value="<?php if(isset($row[0])) echo $row[0]['slug'];?>" name="slug" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Thứ tự hiển thị</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-sort-numeric-desc"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['sort'];?>" name="sort" />
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label"><i>Từ khóa</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <textarea  rows="4" class="form-control tags" id="tags_1" name="keyword"><?php if(isset($row[0])) echo $row[0]['keyword'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Mô tả</i></label>
                                    <div class="input-icon">
                                        <textarea  rows="4" class="form-control" name="description"><?php if(isset($row[0])) echo $row[0]['description'];?></textarea>
                                    </div>
                                </div>
                            </div>                           
                        </div> 
                    </div>                           
                </div>
                
                <div class="col-md-3">
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thao tác</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">

                             
                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Trạng thái</i></label>
                                    <input type="checkbox" value="1" name="status" <?php if(isset($row[0]) && $row[0]['status']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Hoạt động&nbsp;" data-off-label="Lưu nháp">
                                </div>  
                             
                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Nổi bật</i></label>
                                    <input type="checkbox" value="1" name="hot" <?php if(isset($row[0]) && $row[0]['hot']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Có chọn&nbsp;" data-off-label="Bỏ chọn">
                                </div>                              

                                <div class="form-group">
                                    <label class="control-label"><i>Ảnh đại diện</i></label>
                                    <div class="fileinput fileinput-new w100" data-provides="fileinput">
                                        <div class="fileinput-new image">
                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['thumbnail'])) echo WEBSITE.$row[0]['thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists image w100">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file w100">
                                                <span class="fileinput-new">
                                                    Chọn ảnh
                                                </span>
                                                <span class="fileinput-exists yellow">
                                                    Sửa ảnh
                                                </span>
                                                <input type="file" name="thumbnail">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists w100" data-dismiss="fileinput">
                                                Xóa ảnh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        
                                <br><div class="form-group">
                                    <button type="submit" name="edit" value="edit" class="w100 btn blue"><i class="fa fa-checked"></i> Cập nhật & Thoát</button>
                                    <button type="submit" name="save_edit" value="save_edit" class="w100 btn green"><i class="fa fa-checked"></i> Cập nhật & Thêm mới</button>
                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'category/index'; return false;" class="w100 btn yellow">Thoát</button>
                                </div>

                             </div>
                         </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->