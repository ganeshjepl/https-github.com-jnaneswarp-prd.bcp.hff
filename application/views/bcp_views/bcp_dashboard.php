    <!--------Header--------->
    <?php $this->load->view('bcp_views/bcp_header'); ?>
    <!----------------------->
<script src="<?php echo site_url(); ?>js/multiselect.js"></script>
    <body class="stylefont" >

        <div class="container paddd" >
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="<?php echo site_url(); ?>patient/registration">
                            <img src="<?php echo site_url(); ?>pics/form.png" alt="Lights" class="landingimg">
                            <div class="caption">
                                <p align="center" class="iconinfo"><b>Patient Registration</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="<?php echo site_url(); ?>medicalRecord">
                            <img src="<?php echo site_url(); ?>pics/book.png" alt="Nature" class="landingimg">
                            <div class="caption">
                                <p  align="center" class="iconinfo"><b>Medical Record</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="bcp_health_incident.html">
                            <img src="<?php echo site_url(); ?>pics/stethoscope.png" alt="Fjords" class="landingimg">
                            <div class="caption">
                                <p  align="center" class="iconinfo"><b>Health Incident</b></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="bcp_followup_incident.html">
                            <img src="<?php echo site_url(); ?>pics/doctor.png" alt="Nature" class="landingimg">
                            <div class="caption">
                                <p  align="center"  class="iconinfo"><b>Follow-Up Incident</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="bcp_emergency_screen.html">
                            <img src="<?php echo site_url(); ?>pics/plus(1).png" alt="Fjords" class="landingimg">
                            <div class="caption">
                                <p align="center"  class="iconinfo redtext"><b>Emergency</b></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="thumbnail ownthumbnail">
                        <a href="login_screen.html">
                            <img src="<?php echo site_url(); ?>pics/settings.png" alt="Fjords" class="landingimg">
                            <div class="caption">
                                <p align="center"  class="iconinfo"><b>Settings</b></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    <!--------Footer--------->
    <?php $this->load->view('bcp_views/bcp_footer'); ?>
    <!----------------------->