<body class="stylefontinnerpages" >
    <nav class="navbar navbar-fixed-top hffgreen">
        <div class="container-fluid">
            <div id="mySidenav" class="sidenav" style="overflow: hidden;">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
                <div align="center"> 
                    <img src="<?php echo site_url(); ?>pics/profile.jpg" alt="Lights" class="proflienavimg img-circle">
                </div>
                <hr>
                <div>
                    <a class="pdbt <?php ////if(isset($page_current) && $page_current =="home"){ echo "active";}?>" href="<?php echo site_url(); ?>user/dashboard"><img src="<?php echo site_url(); ?>pics/home.png" alt="Lights" class="navimg">&nbsp; Home</a><hr>
                    <a class="pdbt" href="<?php echo site_url(); ?>patient/registration"><img src="<?php echo site_url(); ?>pics/form_white.png" alt="Lights" class="navimg">&nbsp;New Patient Registration</a><hr>
                    <a class="pdbt" href="<?php echo site_url(); ?>medicalRecord"><img src="<?php echo site_url(); ?>pics/book_white.png" alt="Nature" class="navimg">&nbsp;Medical Record</a><hr>
                    <a class="pdbt" href="#"><img src="<?php echo site_url(); ?>pics/stethoscope_white.png" alt="Fjords" class="navimg">&nbsp;Health Incident</a><hr>
                    <a class="pdbt" href="#"><img src="<?php echo site_url(); ?>pics/doctor_white.png" alt="Nature" class="navimg">&nbsp;FollowUp Incidents</a><hr>
                    <a class="pdbt" href="#"><img src="<?php echo site_url(); ?>pics/plus_white.png" alt="Fjords" class="navimg">&nbsp;Emergency</a><hr>
                    <a class="pdbt" href="#"><img src="<?php echo site_url(); ?>pics/settings_white.png" alt="Fjords" class="navimg">&nbsp;Settings</a><hr>
                    <a class="pdbt" href="<?php echo site_url();?>UserLogin/logout"><img src="<?php echo site_url(); ?>pics/logout.png" alt="Fjords" class="navimg">&nbsp;Logout</a><hr>
                </div>
            </div>
            <span class="fltleft 3nav"  style=" width:5%; height:auto; font-size:35px;" onclick="openNav()">&#9776;</span>
            <div align="center" class="paddtop">
                <p class=" hffgreen">
                    <img src="<?php echo site_url(); ?>pics/book_white.png" alt="Nature" class="widt2 ">
                    &nbsp; <?php echo $page_title; ?></p>
            </div>
        </div>
    </nav>
