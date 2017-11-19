
$(document).ready(function(){
    setTimeout(function() {
         $("#lft").animate({left: '-500px' },5000);
		 $("#rgt").animate({right: '-500px'},5000); 
		 $("#lft1").animate({left: '-300px' },3000);
		 $("#rgt1").animate({right: '-300px'},3000); 
		 $("#top1").animate({left: '-100px' },7000);
		 $("#top3").animate({right: '-100px'},7000);       
    }, 2000);
});
$(document).ready(function(){
    setTimeout(function() {
        $('#st').show();      
    }, 5000);
});
$(document).ready(function(){
    setTimeout(function() {
        $('.main').show();      
    }, 8000);
});
$(document).ready(function(){
    setTimeout(function() {
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $("#bstage").css({
    width: (100+ scroll/5)  + "%",
    height: (101 + scroll/5) + "%"},'slow');
  $("#st").css({
    width: (40+ scroll/100)  + "%", 
	height: (93 +scroll/5.5) + "%"},'slow');
  $("#lft").css({ 
  height: (83 +scroll/5.5) + "%",
  width: (50- scroll/5)  + "%"},'slow');
  $("#rgt").css({
  height: (83 +scroll/5.5) + "%",
  width: (50- scroll/5)  + "%"});
  $("#lft1").css({ 
  height: (81 +scroll/5.5) + "%",
   width: (40- scroll/10)  + "%"});
  $("#rgt1").css({
  height: (81 +scroll/5.5) + "%",
  width: (40- scroll/10)  + "%"});
});
    }, 9000);
});
$(window).scroll(function(e) {   
    if($(window).scrollTop() >=150) {
      $(window).scrollTop(150)
    }
});