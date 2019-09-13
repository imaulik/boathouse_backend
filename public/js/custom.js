/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $('.mainmenu li:has(ul)').addClass('parent');

    $('a.menulinks').click(function () {
        $(this).next('ul').slideToggle(250);
        $('body').toggleClass('mobile-open');
        $('.mainmenu li.parent ul').slideUp(250);
        $('a.child-triggerm').removeClass('child-open');
        return false;
    });

    $('.mainmenu li.parent > a').after('<a class="child-triggerm"><span></span></a>');

    $('.mainmenu a.child-triggerm').click(function () {
        $(this).parent().siblings('li').find('a.child-triggerm').removeClass('child-open');
        $(this).parent().siblings('li').find('ul').slideUp(250);
        $(this).next('ul').slideToggle(250);
        $(this).toggleClass('child-open');
        return false;
    });    
    
    
    
    
    $("div.main-faq li.faq-question").on("click", function() {
	      $(this).toggleClass("active");
	      $(this).next("div.main-faq li.faq-answer").slideToggle(250);
	      $("div.main-faq li.faq-question").not($(this)).removeClass("active");
	      $("div.main-faq li.faq-answer").not($(this).next()).slideUp(250)
 	 });
         
        
         
         
         
});


    
