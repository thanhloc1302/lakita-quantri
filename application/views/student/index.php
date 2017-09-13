<?php $this->admin_id = $this->session->userdata('admin_id'); ?>
<script type="text/javascript">
    function delete_items()
    {
        var result = confirm('Bạn chắc chắn muốn xoá các bản ghi đã chọn?');
        if (result == false) {
            return false;
        }
        $('form#form-del').submit();
    }
</script>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Học viên <small>Danh sách</small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url(); ?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>student">
                            Danh sách học viên
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <?php if (!empty($this->session->flashdata('success'))) { ?>
                    <div class="note note-success">
                        <h4 class="block">Thành công! Nội dung thao tác</h4>
                        <p>
                            <?php echo $this->session->flashdata('success'); ?>
                        </p>
                    </div>
                <?php } ?>

                <?php if (!empty($this->session->flashdata('error'))) { ?>
                    <div class="note note-danger">
                        <h4 class="block">Lỗi! Nội dung thao tác</h4>
                        <p>
                            <?php echo $this->session->flashdata('error'); ?>
                        </p>
                    </div>
                <?php } ?>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box light-grey">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i> Danh sách học viên (<?php echo number_format(@$total); ?> bản ghi)
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="btn-group">
                                <a class="btn green" href="<?php echo base_url(); ?>student/update"><i class="fa fa-plus"></i> Thêm mới</a>

                                <button class="btn red" onClick="delete_items();">
                                    <i class="fa fa-minus"></i> Xóa chọn
                                </button>

                                <label for="">
                                    <select size="1" class="per_page form-control input-small">
                                        <?php
                                        $session_per_page = $this->session->userdata('session_per_page');
                                        if (isset($session_per_page) && $session_per_page > 0)
                                            $per_page = $session_per_page;
                                        else
                                            $per_page = 10;
                                        ?>
                                        <option <?php if ($per_page == 10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                        <option <?php if ($per_page == 20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                        <option <?php if ($per_page == 30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                        <option <?php if ($per_page == 50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                    </select>
                                </label>

                            </div>

                            <div class="btn-group pull-right" style="margin-top: 20px; margin-bottom: 20px">
                                <form action="<?php echo base_url(); ?>student/search" method="GET">
                                    <label>Tìm kiếm theo </label>
                                    <input type="text" name="name" placeholder="Họ tên"
                                           value="<?php echo @$_GET['name'];?>"  class="form-control input-medium input-inline" />
                                        <input type="text" name="email" placeholder="Email"
                                              value="<?php echo @$_GET['email'];?>" class="form-control input-medium input-inline" />
                                        <input type="text" name="phone" placeholder="Số điện thoại"
                                             value="<?php echo @$_GET['phone'];?>"  class="form-control input-medium input-inline" />
                                        
                                    <button class="btn purple">
                                        <i class="fa fa-search"></i> Tìm
                                    </button>
                                    <?php if (isset($is_search)) { ?>
                                        <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'student/index'; return false;" class="btn red">Hủy</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="table-checkbox center">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                    </th>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Ảnh
                                    </th>
                                    <th>
                                        Họ tên
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Điện thoại
                                    </th>
                                    <th>
                                        Tham gia
                                    </th>
                                    <th>
                                        Khóa học
                                    </th>
                                    <th>
                                        Hiện
                                    </th>
                                    <th>
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>student/delete" method="POST" id="form-del">
                                <?php foreach ($rows as $key => $value) { ?>
                                    <tr class="odd gradeX">
                                        <td class="center">
                                            <input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id']; ?>"/>
                                        </td>	
                                        <td class="center">
                                            <?php echo $value['id']; ?>
                                        </td>										
                                        <td class="center">
                                            <img style="width:50px!important;" src="<?php
                                            if (!empty($value['thumbnail']))
                                                echo WEBSITE . $value['thumbnail'];
                                            else
                                                echo base_url() . 'styles/assets/img/user-default.png';
                                            ?>" class="img-responsive" alt=""/>
                                        </td>	
                                        <td>
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>">
                                                <?php echo word_limiter($value['name'], 15); ?>
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['email']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $value['phone']; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo date('d/m/Y', $value['createdate']); ?>
                                        </td>
                                        <td class="center">
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>" class="txt-center btn btn-sm green filter-cancel">												
                                                <?php
                                                $count = $this->lib_mod->count('student_courses', array('student_id' => $value['id']));
                                                echo $count . ' khóa học';
                                                ;
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($value['status']) { ?>
                                                <a href="<?php echo base_url() . 'student/status/' . $value['id'] . '/' . $value['status']; ?>" class="txt-center btn btn-sm green filter-cancel curr_segment"><i class="fa fa-check"></i></a>												
                                            <?php } else { ?>
                                                <a href="<?php echo base_url() . 'student/status/' . $value['id'] . '/' . $value['status']; ?>" class="txt-center btn btn-sm yellow filter-cancel curr_segment"><i class="fa fa-times"></i></a>												
                                            <?php } ?>

                                        </td>
                                        <td class="center">
                                            <a href="<?php echo base_url() . 'student/view/' . $value['id']; ?>" class="btn default btn-xs blue">
                                                <i class="fa fa-eye"></i> Xem
                                            </a>
                                            <?php if ($this->admin_id == 35) { ?>
                                                <a href="<?php echo base_url() . 'student/update/' . $value['id']; ?>" class="btn default btn-xs purple curr_segment">
                                                    <i class="fa fa-edit"></i> Sửa
                                                </a>

                                                <a href="<?php echo base_url() . 'student/delete/' . $value['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red curr_segment">
                                                    <i class="fa fa-trash-o"></i> Xóa
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>								
                                </tbody>
                        </table>

                        <div class="table-toolbar">
                            <br>
                            <div class="btn-group">
                                <a class="btn green" href="<?php echo base_url(); ?>student/update"><i class="fa fa-plus"></i> Thêm mới</a>
                                <button class="btn red" onClick="delete_items();">
                                    <i class="fa fa-minus"></i> Xóa chọn
                                </button>

                                <label for="">
                                    <select size="1" class="per_page form-control input-small">
                                        <?php
                                        $session_per_page = $this->session->userdata('session_per_page');
                                        if (isset($session_per_page) && $session_per_page > 0)
                                            $per_page = $session_per_page;
                                        else
                                            $per_page = 10;
                                        ?>
                                        <option <?php if ($per_page == 10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                        <option <?php if ($per_page == 20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                        <option <?php if ($per_page == 30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                        <option <?php if ($per_page == 50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                    </select>						    	
                                </label>
                            </div>

                            <div class="btn-group pull-right">								   
                                <div class="dataTables_paginate paging_bootstrap pull-right">
                                    <?php echo @$paging ?>
                                </div>								
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>
</div>
<input type="hidden" id="page" value="student">

<!-- END CONTENT -->