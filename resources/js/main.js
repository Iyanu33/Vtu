

  function playButton(b,v){
	  var b = document.getElementById(b);
	  var v = document.getElementById(v);
	  b.style.display="none";
	  v.style.display="block";
	
	  v.play();
	  
  }
  
  
function getreqfullscreen(v){
	 
	 var elem = document.getElementById(v);
	 
	 if(
    document.fullscreenElement ||
    document.webkitFullscreenElement ||
    document.mozFullScreenElement ||
    document.msFullscreenElement
  ){
	   if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
  }else{
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}
}

  
  
  function pausePlay(v){
	  var v = document.getElementById(v);
	  if(v.paused){
	  v.play();
	  }else{
	   v.pause();
	  }
	  
  }

	var  type = navigator.connection.type;
	
  function spacePaused(event) {
    var x = event.which || event.keyCode;
   if(x==32){
	   var v = document.getElementById('<?php echo "v$mainId"; ?>');
	   var b = document.getElementById('<?php echo "b$mainId"; ?>');
	   if(v.style.display==="none"){
		   v.style.display= "block";
		   b.style.display= "none";
	   }
	   pausePlay('<?php echo "v$mainId"; ?>');
   }
}
window.onscroll = function() {
	if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
    console.log("scrolling");
	}
};
  
 ////////////////////////////


  
  
  