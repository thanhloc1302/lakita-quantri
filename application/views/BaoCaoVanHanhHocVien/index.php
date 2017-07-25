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
                        email
                    </th>
                    <th>
                        sdt
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
