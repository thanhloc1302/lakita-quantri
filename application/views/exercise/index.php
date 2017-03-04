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
                    Bài học <small>Danh sách</small>
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
                        <a href="<?php echo base_url(); ?>learn">
                            Bài tập học viên
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
                            <i class="fa fa-file-text"></i> Danh sách Bài tập học viên (<?php echo number_format($total); ?> bản ghi)
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="btn-group">
                                <strong>Số bản ghi : </strong>
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


                            </div>
                        </div>



                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ngày nộp</th>
                                        <th>Học viên</th>
                                        <th>Tên file</th>
                                        <th>Khóa học</th>
                                        <th>Bài học</th>
                                        <th>Ghi chú</th>
                                        <th>Chữa bài</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($exercise as $key => $value) { ?>
                                        <tr>
                                            <th><?php echo $value['id']; ?></th>
                                            <th><?php echo date('H:i:s d/m/Y', $value['time']); ?></th>
                                            <th><?php
                                                foreach ($student as $khoa3 => $gtri3) {
                                                    if ($value['student_id'] == $gtri3['id']) {
                                                        echo $gtri3['name'];
                                                    }
                                                }
                                                ?></th>
                                            <th><?php echo $value['file_name']; ?></th>
                                            <th><?php
                                                foreach ($khoa as $khoa1 => $gtri1) {
                                                    if ($gtri1['id'] == $value['course_id']) {
                                                        echo $gtri1['name'];
                                                    }
                                                }
                                                ?></th>
                                            <th><?php
                                                foreach ($bai as $khoa2 => $gtri2) {
                                                    if ($value['learn_id'] == $gtri2['id']) {
                                                        echo $gtri2['name'];
                                                    }
                                                }
                                                ?></th>
                                            <th><?php echo $value['note']; ?></th>
                                            <th><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#upload_file<?php echo $value['student_id']; ?>">
                                                    Chữa bài
                                                </button>
                                                <div class="modal fade" id="upload_file<?php echo $value['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Tải bài chữa</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>exercise/action_upload" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                                                                    <div class="gr5-row-2 margintop22" role="tabpanel">
                                                                        <div class="gr5-form">
                                                                            <input type="text" class="hidden" name="student_id" value="<?php echo $value['student_id']; ?>">
                                                                            <input type="text" class="hidden" name="exe_id" value="<?php echo $value['id']; ?>">
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>File chữa bài: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="bai_chua" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>File đáp án: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="dap_an" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>Video đáp án: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="video_dap_an" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>Ghi chú: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group4 text-center marginbottom15">
                                                                                <button id="nap" class="margintop20 type_submit" type="submit" name="ok" value="Upload">  TẢI BÀI CHỮA  <i class="fa fa-sign-out" aria-hidden="true"></i>  </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </div>



                        <div class="table-toolbar">

                            <br>

                            <div class="btn-group">

                              



                                

                            </div>



                            <div class="btn-group pull-right">								   

                                <div class="dataTables_paginate paging_bootstrap pull-right">

<?php echo $paging ?>

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

<!-- END CONTENT -->