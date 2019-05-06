jQuery(document).ready(function() {
  //console.log('runtime.js is running');
  /*init lightbox*/
  var tobi = new Tobi();
  jQuery('.tobi__close').after('<span class=\"screensize_toggle fas fa-desktop\"></span>');

  /*add screen size preview btn*/
  jQuery('.screensize_toggle').toggle(function(){
    jQuery(this).removeClass('fa-desktop');
    jQuery(this).addClass('fa-tablet-alt');
    jQuery('iframe').animate({
      'max-width':'750px'
    });
  },function(){
    jQuery(this).removeClass('fa fa-tablet-alt');
    jQuery(this).addClass('fas fa-mobile-alt');
    jQuery('iframe').animate({
      'max-width':'450px'
    });
  },function(){
    jQuery(this).removeClass('fa fa-mobile-alt');
    jQuery(this).addClass('fas fa-desktop');
    jQuery('iframe').animate({
      'max-width':'1400px'
    });
  });

  /*thumbnail moving images on hover*/
  jQuery( '.list-item-wrapper .img-wrapper' ).hover(
    function() {
      jQuery( this ).closest('.list-item-wrapper').addClass('active');
      var wrapperHeight = jQuery(this).height();
      var imgHeight = jQuery(this).find('img').height();
      var moveTo = wrapperHeight-imgHeight;
      //console.log(wrapperHeight+' - '+imgHeight+' = '+moveTo);
      moveTo += 'px';
      //console.log('move: '+moveTo);
      //console.log('hovered '+moveTo);
      jQuery( this ).find('img').stop().animate({
        top: moveTo,
      }, 3000 );
    }, function() {
      jQuery( this ).closest('.list-item-wrapper').removeClass('active');
      //console.log('not hovered');
      jQuery( this ).find('img').stop().animate({
        top: '0px',
      }, 1500 );
    }
  );
});
