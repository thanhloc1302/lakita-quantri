﻿<script type="text/javascript">

    function delete_items()

    {

        var result = confirm('Bạn chắc chắn muốn xoá các bản ghi đã chọn?');

        if (result == false ) {

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

                Khóa học <small>Danh sách</small>

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

                        <a href="<?php echo base_url();?>courses">

                            Danh sách khóa học

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



				<?php if(!empty($this->session->flashdata('success'))){ ?>

                <div class="note note-success">

                    <h4 class="block">Thành công! Nội dung thao tác</h4>

                    <p>

                        <?php echo $this->session->flashdata('success'); ?>

                    </p>

                </div>

                <?php } ?>



                <?php if(!empty($this->session->flashdata('error'))){ ?>

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

							<i class="fa fa-sitemap"></i> Danh sách khóa học (<?php echo number_format($total); ?> bản ghi)

						</div>

					</div>



					<div class="portlet-body">

						<div class="table-toolbar">

							<div class="btn-group">

								<a class="btn green" href="<?php echo base_url();?>courses/update"><i class="fa fa-plus"></i> Thêm mới</a>



								<button class="btn red" onClick="delete_items();">

									<i class="fa fa-minus"></i> Xóa chọn

								</button>



								<label for="">

									<select size="1" class="per_page form-control input-small">

				                        <?php $session_per_page = $this->session->userdata('session_per_page');

				                        if(isset($session_per_page) && $session_per_page>0)

				                            $per_page = $session_per_page;

				                        else $per_page = 10; ?>

				                        <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>

				                        <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>

				                        <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>

				                        <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>

				                    </select>

								</label>



							</div>



							<div class="btn-group pull-right">

								<form action="<?php echo base_url();?>courses/search" method="post">

									<?php if('comenu'=='comenu'){ ?> 

									<label for="">

					                    <select size="1" class="form-control input-medium" name="group_courses_id">

					                        <option <?php if(isset($group_courses) && $group_courses==0) echo 'selected="selected"'; ?> value="0">Tất cả</option>

                                            <?php foreach ($group_courses as $key => $cour) { ?>

                                            <option <?php if(isset($group_courses_id) && $group_courses_id==$cour['id']) echo 'selected="selected"'; ?> value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>

                                            <?php } ?>

                                        </select>					    	

									</label>	

									 <?php }else{ ?>                                    

                                    <input type="hidden" name="group_courses" value="">

                                    <?php } ?>   





									<label for="">

										<select size="1" name="status" class="form-control input-small">

					                        <option <?php if(isset($status) && $status==2) echo 'selected="selected"'; ?> value="2">Toàn bộ</option>

					                        <option <?php if(isset($status) && $status==1) echo 'selected="selected"'; ?> value="1">Hoạt động</option>

					                        <option <?php if(isset($status) && $status==0) echo 'selected="selected"'; ?> value="0">Tạm ngừng</option>

					                    </select>						    	

									</label>



									<label><input type="text" name="key_word" <?php if(isset($key_word) && $key_word !='empty') { ?> value="<?php echo $key_word; ?>" <?php }else{ ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>

									<button class="btn purple">

										<i class="fa fa-search"></i> Tìm

									</button>

									<?php if(isset($is_search)){ ?>

		                            <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'courses/index'; return false;" class="btn red">Hủy</button>

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

										Ảnh

									</th>

									<th>

										Id

									</th>

									<th>

										Tên khóa học

									</th>

									<th>

										Nhóm khóa học

									</th>

									<th>

										Loại

									</th>

									
									<th>Tổng tài khoản</th>
									<th>Tổng tài khoản đã kích hoạt</th>
									<th>Tổng tài khoản đang học</th>
									
								</tr>

							</thead>

							<tbody>

                				<form class="form-horizontal" role="form" action="<?php echo base_url();?>courses/delete" method="POST" id="form-del">

									<?php foreach ($rows as $key => $value) { ?>

									<tr class="odd gradeX">

										<td class="center">

											<input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id'];?>"/>

										</td>	

										<td class="center">

                                            <img style="width:50px!important;" src="<?php if(!empty($value['image'])) echo WEBSITE.$value['image']; else echo base_url(). 'styles/assets/img/no-image2.png';?>" class="img-responsive" alt=""/>

										</td>	

										<td class="center">

											<?php echo $value['id'];?>

										</td>										

										<td>

											<a href="<?php echo base_url().'courses/update/'.$value['id']; ?>">

												<?php echo word_limiter($value['name'], 25); ?>

											</a>

										</td>

										<td class="center">

											<?php $group_courses = $this->lib_mod->detail('group_courses', array('id'=>$value['group_courses_id']));

											if(isset($group_courses[0])) echo $group_courses[0]['name']; else echo '...'; ?>

										</td>

										<td class="center">

											<?php if($value['free']==1) echo 'Mất phí'; else echo 'Miễn phí';?>

										</td>

										<td class="center">
																				
											<?php $count = $this->lib_mod->count('student_courses', array('courses_id'=>$value['id']));
												echo $count ;
											;?>
											
										</td>
										<td class="center">
										<?php $count_active = $this->lib_mod->count('student_courses', array('courses_id'=>$value['id'],'status'=>1));
												echo $count_active ;
											;?>
										</td>
										<td class="center">
										<?php //$count = $this->lib_mod->count('student_courses', array('student_id'=>$value['id']));
												//echo $count ;
											;?>
										</td>

									
										

									</tr>

									<?php } ?>								

							</tbody>

						</table>



						<div class="table-toolbar">

							<br>

							<div class="btn-group">

								<a class="btn green" href="<?php echo base_url();?>courses/update"><i class="fa fa-plus"></i> Thêm mới</a>

								<button class="btn red" onClick="delete_items();">

									<i class="fa fa-minus"></i> Xóa chọn

								</button>



								<label for="">

									<select size="1" class="per_page form-control input-small">

				                        <?php $session_per_page = $this->session->userdata('session_per_page');

				                        if(isset($session_per_page) && $session_per_page>0)

				                            $per_page = $session_per_page;

				                        else $per_page = 10; ?>

				                        <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>

				                        <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>

				                        <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>

				                        <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>

				                    </select>						    	

								</label>

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