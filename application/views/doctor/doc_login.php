
	<div class="container_login">
		<div class="card card-login-box">
			<div class="padtop15">
		<img id="profile-img" class="profile-img-card" src="<?php  echo $doc_images  ?>smalllogo.png" />
			
			<form  id="loginsubmit" method="post" novalidate>
                             <center>
                            <span id="login_sucess" class="success-msg-box"> </span>
                            <span id="login_error" class="error-msg-box"> </span>
                            </center>
				<div class="input-container">
					<input type="#{type}" id="" required="required" name="username"/> <label
						for="#{label}">Username</label>
					<div id="usernamebar" class="bar"></div>
					<span id="error_username" class="error-msg-box"></span>
				</div>
				<div class="input-container">
					<input type="password" id="#{label}" required="required" name="password"/> <label
						for="#{label}">Password</label>
					<div id="passwordbar" class="bar"></div>
					<span id="error_password" class="error-msg-box"></span>
				</div>
				<div class="button-container">
					<button id="loginsubmitbutton">
						<span>Login</span>
					</button>
				</div>
				<div class="footer">
					<a id="loginforgotpwd" href="<?php  echo $site_url.'doctorForgotpassword';?>">Forgot your password?</a>
				</div>
			</form>
		</div>
	</div>
	</div>
