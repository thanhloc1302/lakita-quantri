
                



                <table class="table table-striped table-bordered table-hover"  >
                    <thead>
                        
                    <th>
                        tên học viên
                    </th>
                    <th>
                        email
                    </th>
                    <th>
                        sdt
                    </th>
                    <th>
                        Ngày đăng ký mua
                    </th>
                    <th>
                        Kích hoạt
                    </th>
                    <th>
                        Ngày kích hoạt
                    </th>
                    <th>
                        Khóa học
                    </th>
                    <th>
                        đã học
                    </th>
                    <th>
                        lần cuối đăng nhập
                    </th>
            
                    </thead>
                    <tbody>
                            <?php
                            foreach ($ketqua as $k_ketqua => $v_ketqua) {
                                ?>
                        <tr>
                            <td>
                                <?php echo $v_ketqua['name'] ?>
                            </td>
                            <td>
                                <?php echo $v_ketqua['email'] ?>
                            </td>
                            <td>
                                <?php echo $v_ketqua['phone'] ?>
                            </td>
                            <td>
                                <?php echo date('H:i:s d/m/Y', $v_ketqua['date_reg']); ?>
                            </td>
                            <td>
                                <?php echo $v_ketqua['active'] ?>
                            </td>
                            <td>
                                <?php echo date('H:i:s d/m/Y', $v_ketqua['create_date']); ?>
                            </td>
                            <td>
                                <?php echo $v_ketqua['course'] ?>
                            </td>
                            <td>
                                <?php echo $v_ketqua['learn'] ?>
                            </td>
                            <td>
                                <?php echo date('H:i:s d/m/Y', $v_ketqua['last_log_in']); ?>
                            </td>
                            
                        </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>



               


