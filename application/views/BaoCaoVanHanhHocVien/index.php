<!-- bây giờ viết trên local thì 2 file css và js để tạm như link dưới, lúc nào up lên thì chỉnh lại sau -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assets/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/scripts/custom/bootstrap-datepicker.js"></script>



        <div class="page-content-wrapper">
            <div class="page-content" style="background-color: #3D3D3D"> 
			<div >
                <div class="col-lg-12">

                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><strong>Từ ngày : </strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" name="start_date" id='dp1' data-date-format="dd-mm-yyyy" placeholder="">
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><strong>Đến ngày : </strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="end_date" id='dp2' data-date-format="dd-mm-yyyy" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Lọc</button>
                            </div>
                        </div>
                    </form>
                    <div id="header">
                        Giữ nguyên Header khi cuộn trang theo phong cách Facebook bằng jQuery
                        </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead style="background-color: green; color: #FFF;">
                            <th style="width: 550px;">
                                TÍNH TỔNG TẤT CẢ KHÓA HỌC TỪ ĐẦU TỚI THỜI ĐIỂM HIỆN TẠI
                            </th>
                            <th>
                                Excel (ĐV :số đơn)
                            </th>
                            <th>
                                Kế toán (ĐV :số đơn)
                            </th>
                            <th>
                                Tổng
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Tổng số đơn giao hàng
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH kích hoạt ngay sau khi nhận COD
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh đã kích hoạt đến ngày
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học ít nhất 1 video
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học ít nhất 10 video
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số Kh học toàn bộ video
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng nhận hỗ trợ comment (comment + đã trả lời)
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng nhận hỗ trợ comment (comment + chưa trả lời)
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng viết cảm nhận
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 5 sao khóa học
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 4 sao khóa học
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 3 sao khóa học
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 2 sao khóa học
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số khách hàng đánh 1 sao khóa học
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH mua >=2 khóa
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số KH mua 1 khóa
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    4
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                    <table class="table table-striped table-bordered table-hover"> 
                        <thead style="background-color: green; color: #FFF">
                            <th style="width: 550px;">
                                Các tỷ lệ
                            </th>
                            <th>
                                Excel (ĐV :số đơn)
                            </th>
                            <th>
                                Kế toán (ĐV :số đơn)
                            </th>
                            <th>
                                Tổng
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Tỉ lệ kích hoạt/ Số lượng COD phát ra
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên comment được hỗ trợ/ Số học viên học
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên comment chưa được hỗ trợ/ Số học viên học
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên học/ Tổng số học viên
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tỉ lệ học tiếp
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số học viên viết cảm nhận /Tổng số học viên
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số khách đánh giá/ Tổng số học viên
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        </tbody>  
                    </table>
                    
                    
                    
                </div>
            </div>
			</div>
        </div>





