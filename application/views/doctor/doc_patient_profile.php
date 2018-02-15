<!DOCTYPE html>
<html>
<head>
<title>Patient Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="Style(css)/doc.css">
<script src="javascript/doc.js"></script>


<!-- <style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style> -->
</head>


<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="docpics/dp2.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2>Pooja</h2>
          </div>
        </div>
        <div class="w3-container" style="padding-top: 15px">
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>1224435534</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>ex@mail.com</p>
          <p><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-text-teal"></i>10-20-1985</p>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Teacher</p>
          
          <p><i class="fa fa-mars-double fa-fw w3-margin-right w3-large w3-text-teal"></i>Married</p>
          <p><i class="fa fa-mars-double fa-fw w3-margin-right w3-large w3-text-teal"></i>Ram(Husband)</p>
          <p><i class="fa fa-plus-circle  fa-fw w3-margin-right w3-large w3-text-red"></i>Ram(Emergency Contact)</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-red"></i>1224435534(Emergency)</p>
          <p><i class="fa fa-mars-double fa-fw w3-margin-right w3-large w3-text-teal"></i>OC</p>
          <p><i class="fa fa-mars-double fa-fw w3-margin-right w3-large w3-text-teal"></i>Hindu</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>1-2B, Vasavi Nagar</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Assam(State)</p>
          <p><i class="fa fa-globe fa-fw w3-margin-right w3-large w3-text-teal"></i>India(country)</p>
          <hr>

          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
          
                   
          </div>
          <br>
        </div>
      </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="#"><img src="docpics/dp2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h2><b>BCP Details</b></h2>
    <div class="w3-section w3-bottombar w3-padding-16">
    <img src="docpics/doc.png" class="w3-left w3-margin-right" style="width:55px">
      <button class="w3-button ">Ashwin</button> 
      <button class="w3-button ">Contact Number :</button>
       <span class="w3-margin-right">9547685478</span> 
      
      <!-- <button class="w3-button w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button> -->
    </div>
    </div>
  </header>
  
  
  <!-- Right Column -->
    <div class="	">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16">
        <i class="fa fa-table fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Chief Complaints</h2>
        <div class="w3-container">
          <table class="table  table-striped table-hover table-bordered">
			<thead>
				<tr >
					<th><h5>
							<b>Chief Complaints</b>
						</h5></th>
					<th><h5>
							<b>Date / Time</b>
						</h5></th>
				</tr>
			</thead>
			<tbody>
				<tr onclick='location.href="patient_visits_screen.html"'>
					<td><h5>Dysuria</h5></td>
					<td><h5>Dec-21st-2016 / 7:00am</h5></td>
				</tr>
				<tr onclick='location.href="patient_visits_screen.html"'>
					<td><h5>
							Wounds
						</h5></td>
					<td><h5>May-21st-2014 / 7:00am</h5></td>
				</tr>
				<tr  onclick='location.href="patient_visits_screen.html"'>
					<td><h5>
							Css Fbp
						</h5></td>
					<td><h5>Jan-01st-2017 / 7:00am</h5></td>
				</tr>
				<tr  onclick='location.href="patient_visits_screen.html"'>
					<td><h5>
							Joint Pain
						</h5></td>
					<td><h5>Apr-31st-2014 / 7:00am</h5></td>
				</tr>
				<tr  onclick='location.href="patient_visits_screen.html"'>
					<td><h5>
							Abrasion
						</h5></td>
					<td><h5>Jun-11st-2013 / 7:00am</h5></td>
				</tr>
			</tbody>
		</table>
        </div>
      </div>

      <div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16">
        <i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
        <div class="w3-container">
          	<div class="row">
        <div class="col-md-12 padbt">

            
            <div class="column-chart">
                <div class="legend legend-left hidden-xs">
                </div>
                <!-- //.legend -->
            
                <div class="legend legend-right hidden-xs">
                    <div class="item">
                        <h4>100</h4>
                    </div>
                    <!-- //.item -->
            
                    <div class="item">
                        <h4>75</h4>
                    </div>
                    <!-- //.item -->
            
                    <div class="item">
                        <h4>50</h4>
                    </div>
                    <!-- //.item -->
            
                    <div class="item">
                        <h4>25</h4>
                    </div>
                    <!-- //.item -->
                    
                    <div class="item">
                        <h4>0</h4>
                    </div>
                    <!-- //.item -->
                </div>
                <!-- //.legend -->
            
                <div class="chart clearfix">
                    <div class="item">
                        <div class="bar">
                            <span class="percent">56</span>
            
                            <div class="item-progress" data-percent="56">
                                <span class="title">Emergency</span>
                            </div>                           
                        </div>                       
                    </div>
                    
            
                    <div class="item">
                        <div class="bar">
                            <span class="percent">7</span>
            
                            <div class="item-progress" data-percent="7">
                                <span class="title">Visits</span>
                            </div>                           
                        </div>                       
                    </div>
                   
            
                    <div class="item">
                        <div class="bar">
                            <span class="percent">82</span>
            
                            <div class="item-progress" data-percent="82">
                                <span class="title">Chief Complaints</span>
                            </div>                          
                        </div>                      
                    </div> 
                </div>
                <!-- //.chart -->
            </div>
            <!-- //.column-chart -->
        </div>
        <!-- //.col-md-6 -->
    </div>
    <!-- //.row --> 
        </div>
      </div>

    <!-- End Right Column -->
    </div>
  
  
  
  
  
  
  <!-- First Photo Grid-->
  <!-- <div class="w3-row-padding">
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/mountains.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/lights.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
    <div class="w3-third w3-container">
      <img src="/w3images/nature.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
  </div>
  
  Second Photo Grid
  <div class="w3-row-padding">
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/p1.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/p2.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
    <div class="w3-third w3-container">
      <img src="/w3images/p3.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>Lorem Ipsum</b></p>
        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>
  </div>

  Pagination
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>

  Images of Me
  <div class="w3-row-padding w3-padding-16" id="about">
    <div class="w3-col m6">
      <img src="/w3images/avatar_g.jpg" alt="Me" style="width:100%">
    </div>
    <div class="w3-col m6">
      <img src="/w3images/me2.jpg" alt="Me" style="width:100%">
    </div>
  </div>

  <div class="w3-container w3-padding-large" style="margin-bottom:32px">
    <h4><b>About Me</b></h4>
    <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    <hr>
    
    <h4>Technical Skills</h4>
    Progress bars / Skills
    <p>Photography</p>
    <div class="w3-grey">
      <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:95%">95%</div>
    </div>
    <p>Web Design</p>
    <div class="w3-grey">
      <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:85%">85%</div>
    </div>
    <p>Photoshop</p>
    <div class="w3-grey">
      <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:80%">80%</div>
    </div>
    <p>
      <button class="w3-button w3-dark-grey w3-padding-large w3-margin-top w3-margin-bottom">
        <i class="fa fa-download w3-margin-right"></i>Download Resume
      </button>
    </p>
    <hr>
    
    <h4>How much I charge</h4>
    Pricing Tables
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third w3-margin-bottom">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-black w3-xlarge w3-padding-32">Basic</li>
          <li class="w3-padding-16">Web Design</li>
          <li class="w3-padding-16">Photography</li>
          <li class="w3-padding-16">1GB Storage</li>
          <li class="w3-padding-16">Mail Support</li>
          <li class="w3-padding-16">
            <h2>$ 10</h2>
            <span class="w3-opacity">per month</span>
          </li>
          <li class="w3-light-grey w3-padding-24">
            <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
          </li>
        </ul>
      </div>
      
      <div class="w3-third w3-margin-bottom">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-teal w3-xlarge w3-padding-32">Pro</li>
          <li class="w3-padding-16">Web Design</li>
          <li class="w3-padding-16">Photography</li>
          <li class="w3-padding-16">50GB Storage</li>
          <li class="w3-padding-16">Endless Support</li>
          <li class="w3-padding-16">
            <h2>$ 25</h2>
            <span class="w3-opacity">per month</span>
          </li>
          <li class="w3-light-grey w3-padding-24">
            <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
          </li>
        </ul>
      </div>
      
      <div class="w3-third">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-black w3-xlarge w3-padding-32">Premium</li>
          <li class="w3-padding-16">Web Design</li>
          <li class="w3-padding-16">Photography</li>
          <li class="w3-padding-16">Unlimited Storage</li>
          <li class="w3-padding-16">Endless Support</li>
          <li class="w3-padding-16">
            <h2>$ 25</h2>
            <span class="w3-opacity">per month</span>
          </li>
          <li class="w3-light-grey w3-padding-24">
            <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
  Contact Section
  <div class="w3-container w3-padding-large w3-grey">
    <h4 id="contact"><b>Contact Me</b></h4>
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p>email@email.com</p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p>Chicago, US</p>
      </div>
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p>512312311</p>
      </div>
    </div>
    <hr class="w3-opacity">
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Send Message</button>
    </form>
  </div> -->

  <!-- Footer -->
<!--   <footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer> -->
  
  <!-- <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div> -->

<!-- End page content -->
</div>

</body>
</html>
