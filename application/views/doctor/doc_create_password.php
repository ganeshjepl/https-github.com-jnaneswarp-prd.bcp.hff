<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Password</title>
<link rel="shortcut icon" href="http://localhost/hff/images/doctor/smalllogo.png" />
<link rel="stylesheet" href="<?php echo site_url(); ?>css/doctor/cloudflare.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>css/doctor/googleapis.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>css/doctor/font-awesome.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>css/doctor/inputstyle.css">

<script src="<?php echo site_url(); ?>js/doctor/bootstrapjs.js"></script>
<script src="<?php echo site_url(); ?>js/doctor/bootstrapjquery.min.js"></script>
<script src="<?php echo site_url(); ?>js/doctor/validation.js"></script>
</head>

<body>
	<div class="container">	
		<!-- <h1 class="title">Login</h1> -->
		<div class="card">
			<div class="padtop15">
		<img id="profile-img" class="profile-img-card" src="<?php echo site_url(); ?>images/doctor/smalllogo.png" />
				</div>
			<form novalidate action="doc_login.html">
				<div class="input-container">
					<input type="password" id="#{label}" required="required" name="otp"/> <label
						for="#{label}">OTP</label>
					<div id="otpbar" class="bar"></div>
					<span id="error_otp" class="error-msg-box"></span>
				</div>
				<div class="input-container">
					<input type="password" id="#{label}" required="required" name="newpassword"/> <label
						for="#{label}">New Password</label>
					<div id="newpasswordbar" class="bar"></div>
					 <span id="error_newpassword" class="error-msg-box"></span>
				</div>
				<div class="input-container">
					<input type="password" id="#{label}" required="required" name="confirmpassword"/> <label
						for="#{label}">Confirm Password</label>
					<div id="confirmpasswordbar" class="bar"></div>
					<span id="error_confirmpassword" class="error-msg-box"></span>
				</div>
				<div class="button-container">
					<button>
						<span>Submit</span>
					</button>
				</div>
			</form>
		</div>		
	</div>	
</body>
</html>
