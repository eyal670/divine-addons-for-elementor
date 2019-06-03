jQuery(document).ready(function() {
  if(!jQuery('.elementor-editor-active').length){
    console.log('tobi is running');
    console.log('tobi: '+  jQuery.isFunction(Tobi));
    /*init lightbox*/
    var tobi = new Tobi();
    jQuery('.tobi__close').after(`
      <div class="screensize_btns_wrapper">
      <span class=\"screensize_toggle screensize_toggle_desktop fas fa-desktop\"></span>
      <span class=\"screensize_toggle screensize_toggle_tablet fas fa-tablet-alt\"></span>
      <span class=\"screensize_toggle screensize_toggle_mobile fas fa-mobile-alt\"></span>
      </div>
      `);

      /*add screen size preview btn*/
      jQuery('.screensize_toggle_desktop').click(function(){
        jQuery('.screensize_toggle').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('iframe').animate({
          'width':'85vw'
        });
      });
      jQuery('.screensize_toggle_tablet').click(function(){
        jQuery('.screensize_toggle').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('iframe').animate({
          'width':'750px'
        });
      });
      jQuery('.screensize_toggle_mobile').click(function(){
        jQuery('.screensize_toggle').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('iframe').animate({
          'width':'450px'
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
  }else{
    console.log("don't load tobi");
  }
});
