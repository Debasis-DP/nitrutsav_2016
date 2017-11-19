// JavaScript Document
$(document).ready(function(){
    setTimeout(function() {
         $("#lft").animate({left: '-500px' },6000);
		 $("#rgt").animate({right: '-500px'},6000); 
		 $("#lft1").animate({left: '-300px' },5000);
		 $("#rgt1").animate({right: '-300px'},5000);      
    }, 2000);
});
$(document).ready(function(){
    setTimeout(function() {
        $('#st').show();      
    }, 10000);
});
