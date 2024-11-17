$(document).ready(function(){
var div = $(".context" );
div.contextmenu(function() {
this.setAttribute("id", "target");
 $("#target div .nav-item #navbardrop").dropdown("toggle");
 this.setAttribute("id", "");
 return false;
});
});


