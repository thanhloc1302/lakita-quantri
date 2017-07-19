<!-- bây giờ viết trên local thì 2 file css và js để tạm như link dưới, lúc nào up lên thì chỉnh lại sau -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/css/bootstrap.min.css"  />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/css/datepicker.css" />

<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/jquery-1.10.2.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assets/plugins/bootstrap/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>styles/assest/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->


<style>
    .sticky1 {
        position: fixed;
        top: 27px;
    }
    .header1 {
        width: 100%;
        padding: 15px 0;
    }
</style>


<div class="page-content-wrapper">
    <div class="page-content" style="height: 1100px"> 
        <div >
            <div class="col-lg-12">

                

                



                <table class="table table-striped table-bordered table-hover"  >
                    <thead>
                    <th>
                        ten hoc vien
                    </th>
                    <th>
                        sdt
                    </th>
                    <th>
                        email
                    </th>
                    <th>
                        đã kích hoạt
                    </th>
                    <th>
                        đã xem video
                    </th>
                    <th>
                        đã comment
                    </th>
                    <th>
                        đã nộp bài
                    </th>
                    </thead>
                    <tbody>
                            <?php
                            foreach ($locnt as $k_locnt => $v_locnt) {
                                ?>
                        <tr>
                            <td>
                                <?php echo $v_locnt['name'] ?>
                            </td>
                            <td>
                                <?php echo $v_locnt['sdt'] ?>
                            </td>
                            <td>
                                <?php echo $v_locnt['email'] ?>
                            </td>
                            <td>
                            <?php
                                foreach ($student as $k_student => $v_student){
                                    if($v_locnt['email'] == $v_student['email']){
                                        foreach ($student_courses as $k_student_courses => $v_student_courses){
                                            if($v_student_courses['student_id'] == $v_student['id']){
                                                echo 'x';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                            <?php
                                foreach ($student as $k_student => $v_student){
                                    if($v_locnt['email'] == $v_student['email']){
                                        foreach ($student_learn as $k_student_learn => $v_student_learn){
                                            if($v_student_learn['student_id'] == $v_student['id']){
                                                echo 'x';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                            <?php
                                foreach ($student as $k_student => $v_student){
                                    if($v_locnt['email'] == $v_student['email']){
                                        foreach ($comment as $k_comment => $v_comment){
                                            if($v_comment['student_id'] == $v_student['id']){
                                                echo 'x';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                            <?php
                                foreach ($student as $k_student => $v_student){
                                    if($v_locnt['email'] == $v_student['email']){
                                        foreach ($exercise as $k_exercise => $v_exercise){
                                            if($v_exercise['student_id'] == $v_student['id']){
                                                echo 'x';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>



               


            </div>
        </div>
    </div>
</div>

<script>

    var header = document.querySelector('.header1');
    var origOffsetY = header.offsetTop;

    function onScroll(e) {
        window.scrollY >= origOffsetY ? header.classList.add('sticky1') :
                header.classList.remove('sticky1');
    }

    document.addEventListener('scroll', onScroll);

</script>

<script type="text/javascript">
    $(function () {
        $('#dp1').datepicker();
    });
    $(function () {
        $('#dp2').datepicker();
    });
    $(function () {
        $('#datepicker2').datepicker();
    });
</script>
