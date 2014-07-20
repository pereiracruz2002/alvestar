$(document).ready(function() {

  $(window).bind('scroll', function(e) {
    scrollingfn();
  });

  $('a.header').click(function() {
    $('html, body').animate({ scrollTop:$('#header').offset().top - '60'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });

  $('a.service').click(function() {
    $('html, body').animate({ scrollTop:$('#service').offset().top - '60'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });
  
  $('a.portfolio').click(function() {
    $('html, body').animate({ scrollTop:$('#portfolio').offset().top - '60'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });

  $('a.pricing').click(function() {
    $('html, body').animate({ scrollTop:$('#pricing').offset().top - '60'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });
  
  $('a.aboutus').click(function() {
    $('html, body').animate({ scrollTop:$('#aboutus').offset().top - '60'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });
  
$('a.team').click(function() {
    $('html, body').animate({ scrollTop:$('#team').offset().top - '100'}, 1000,
      function() {
        scrollingfn();
      });
    return false;
  });

 $(window).scroll(function() {
      if ($(this).scrollTop() > 400) {
          $('#scroller2').fadeIn();
      } else {
          $('#scroller2').fadeOut();
      }
  });

});

function scrollingfn() {
  var scrollPosition = $(window).scrollTop();
}

// Script for top Navigation Menu
    jQuery(window).bind('scroll', function () {
      if (jQuery(window).scrollTop() > 100) {
        jQuery('#headnev').addClass('navbar-fixed-top').removeClass('topnavbar');
        jQuery('body').addClass('bodytopmargin').removeClass('bodynomargin');
      } else {
        jQuery('#headnev').removeClass('navbar-fixed-top').addClass('topnavbar');
        jQuery('body').removeClass('bodytopmargin').addClass('bodynomargin');
      }
    });



// Script for Mixitup Plugin
$(function(){
        $('#Grid').mixitup();
      });
