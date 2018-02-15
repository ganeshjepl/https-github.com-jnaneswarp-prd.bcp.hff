<html>
    <head>
        <title>Login_Screen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo site_url(); ?>css/bcp/bcp.css" type="text/css">

        <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!--<script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

        <script> var site_url = "<?php echo site_url(); ?>";</script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/login.js"></script>
    </head>
    <body>
    <center>
        <div class="container">
            <div class="card card-container">
                <span class="disperror" id="servererr" style="margin-left: auto;"></span>

                <h3 class="loginusername">
                    <b>User Name</b>
                </h3>
                <?php echo validation_errors(); ?>


                <form class="form-signin" name="login" method='post' id="login">
                    <input type="text" id="username" name="username" class="form-control logininput"
                           placeholder="William David / Mobile Number" >
                    <span class="disperror" id="usernameerr"></span>

                    <h3 class="loginpassword">
                        <b>Password</b>
                    </h3>
                    </p>
                    <input type="password" id="password" name="password"
                           class="form-control logininput" placeholder="Password">
                    <span class="disperror" id="passworderr"></span>
                    <button class="btn btn-lg btn-signin" style="margin-top: 15px;"
                            type="submit"  name="submit">Login</button>
                </form>
                <!-- /form -->
                <a href="bcp_password_screen.html" class="forgot-password"><b>
                        Forgot Password?</b> </a>
            </div>
            <!-- /card-container -->
        </div>
        <!-- /container -->
    </center>

</body>
</html>
