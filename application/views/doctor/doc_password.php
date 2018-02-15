
	<div class="container_login">	
		<div class="card"  id="forgotdiv"  >
		<div class="padtop15">
		<img id="profile-img" class="profile-img-card" src="<?php echo $doc_images; ?>smalllogo.png" />
				</div>
			
                    <form   id="forgotsubmit" method="post" novalidate >
                        <center>
                             <span id="forgot_error" class="error-msg-box"> </span>
                         </center>
				<div class="input-container mob-field">
					<input type="#{type}" id="mobile" required="required" name="mobile"/> <label
						for="#{label}">Mobile Number</label>
					<div id="mobilebar" class="bar"></div>
					 <span id="error_mobile" class="error-msg-box"></span>
				</div>
				<div class="button-container">
                                    <button id="forgotsubmitbutton" type="submit">
						<span>Next</span>
					</button>
				</div>
			</form>
		</div>
            <input type="hidden" name="username" id="username" value="sridevigara">
            <div class="card"   id="otpdiv" style="display:none" >
		<div class="padtop15">
		<img id="profile-img" class="profile-img-card" src="<?php echo $site_url; ?>images/doctor/smalllogo.png" />
			</div>	
			
			<form novalidate  id="formotp" method="post">
                             <center>
                             <span id="otp_sucess" class="success-msg-box"> </span>
                             <span id="otp_error" class="error-msg-box"> </span>
                     </center>
				<div class="input-container">
					<input type="#{type}"  required="required" name="otp" id="otp" /> <label
						for="#{label}">OTP</label>
					<div id="otpbar" class="bar"></div>
					<span id="error_otp" class="error-msg-box"></span>
				</div>
				<div class="input-container">
					<input type="password"   required="required" name="newpassword" id="newpassword"/> <label
						for="#{label}">New Password</label>
					<div id="newpasswordbar" class="bar"></div>
					 <span id="error_newpassword" class="error-msg-box"></span>
				</div>
				<div class="input-container">
					<input type="password"   required="required" name="confirmpassword" id="confirmpassword"/> <label
						for="#{label}">Confirm Password</label>
					<div id="confirmpasswordbar" class="bar"></div>
					<span id="error_confirmpassword" class="error-msg-box"></span>
				</div>
				<div class="button-container">
					<button id="otpsubmitbutton" type="submit">
						<span>Submit</span>
					</button>
				</div>
			</form>
		</div>
	</div>
      