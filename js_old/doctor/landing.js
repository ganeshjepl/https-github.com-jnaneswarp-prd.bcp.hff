$(document).ready(function fun(){
	
	$(".medrec").hover(function () {
	    $(".caption1").css("transform","translate(0,40%) scale(1)");
	    $(".medrec").css("transform","scale(2, 2)");
	     
	},
	      function () {
	        $(".caption1").css("transform","none");
	        $(".medrec").css("transform","none");
	      });
	
	$(".sendpresp").hover(function () {
	    $(".caption2").css("transform","translate(0,40%) scale(1)");
	    $(".sendpresp").css("transform","scale(1.6, 1.6)");
	     
	},
	      function () {
	        $(".caption2").css("transform","none");
	        $(".sendpresp").css("transform","none");
	      });
	
	$(".docprof").hover(function () {
	    $(".caption3").css("transform","translate(0,90%) scale(1)");
	    $(".docprof").css("transform","scale(2, 2)");
	     
	},
	      function () {
	        $(".caption3").css("transform","none");
	        $(".docprof").css("transform","none");
	      });
	
	$(".lgot").hover(function () {
	    $(".caption4").css("transform","translate(0,40%) scale(1)");
	    $(".lgot").css("transform","scale(2, 2)");
	     
	},
	      function () {
	        $(".caption4").css("transform","none");
	        $(".lgot").css("transform","none");
	      });
})
