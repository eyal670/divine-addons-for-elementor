jQuery(document).ready(function () {
      console.log('tobi is running from sinlge script');
    console.log('tobi: ' + jQuery.isFunction(Tobi));
    /* fix missing classes and attr for CPT elemnets grid */
    setTimeout(function () {
      console.log('1');
      /*init lightbox*/
      var tobi = new Tobi();
      createBtns();
      setHover();
    }, 1500);
  });

function createBtns() {
  if (jQuery('.screensize_btns_wrapper').length) {
    jQuery('.screensize_btns_wrapper').remove();
  }
  jQuery('.tobi__close').after(`
      <div class="screensize_btns_wrapper">
          <span class=\"screensize_toggle screensize_toggle_desktop fas fa-desktop\"></span>
          <span class=\"screensize_toggle screensize_toggle_tablet fas fa-tablet-alt\"></span>
          <span class=\"screensize_toggle screensize_toggle_mobile fas fa-mobile-alt\"></span>
          <span class=\"copy-link fas fa-paste\"><span class="copy-tooltip">הקישור הועתק ללוח</span></span>
          <a class="more-info-a" href="#" target="_blank"><span class=\"more-info-btn fas fa-info-circle\"><span class="more-info-tooltip">לחץ למידע נוסף</span></span></a>
      </div>
  `);

  /*add screen size preview btn*/
  jQuery('.screensize_toggle_desktop').click(function () {
    jQuery('.screensize_toggle').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('iframe').animate({
      'width': '85vw'
    });
  });
  jQuery('.screensize_toggle_tablet').click(function () {
    jQuery('.screensize_toggle').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('iframe').animate({
      'width': '750px'
    });
  });
  jQuery('.screensize_toggle_mobile').click(function () {
    jQuery('.screensize_toggle').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('iframe').animate({
      'width': '450px'
    });
  });
  /* add copy to clipboard btn */
  setTimeout(function () {
    pre_filter();
    jQuery('.tobi__next, .tobi__prev, .lightbox.tobi-zoom').click(function () {
      // reset copy to clipboard icon
      jQuery('.copy-link').attr('class', 'copy-link fas fa-paste');
      console.log('reset copy icon');
      jQuery('.iframecontact').removeClass('active');
      setTimeout(get_iframe_src, 2000);
      set_more_info_link();
    });
    create_direct_link();
  }, 3000);
}

function create_direct_link() {
  jQuery('.copy-link').click(function () {
    console.log('copy link');
    copyToClipboard();
    jQuery(this).attr('class', 'copy-link fas fa-clipboard-check show-tip');
    setTimeout(function () {
      jQuery('.copy-link').removeClass('show-tip');
    }, 3500);
  });
}

function get_more_info_link() {
    console.log('more info link');
    // jQuery('.info-link').attr('href',);
    var link = '';
    var iframe_src = jQuery('.tobi iframe').each(function () {
        if (jQuery(this).visible(false, true)) {
           iframe = jQuery(this).attr("src");
            var id = jQuery('a[href="'+iframe+'"]').attr('data-id');
            if(!id){
                link = jQuery('a[href="'+iframe+'"]').closest('.elementor-widget-wrap').find('a.premium-button').attr('href');
            }else{
                link = jQuery('.ifram-list-item-'+id+' > a').attr('href');
            }
            console.log('info link: '+link);
        }
    });
    return link;
}

function set_more_info_link(){
    setTimeout(function(){
        jQuery('a.more-info-a').attr('href',get_more_info_link());
    },1500);
}

function copyToClipboard() {
  var uri = window.location.href;
  var url = uri.split('?');
  var iframe;
  var iframe_src = jQuery('.tobi iframe').each(function () {
    if (jQuery(this).visible(false, true)) {
      iframe = jQuery(this).attr("src");
    }
  });
  console.log(iframe);
  var $temp = jQuery("<input></input>");
  jQuery("body").append($temp);
  $temp.val(url[0] + '?display=' + iframe).select();
  document.execCommand("copy");
  $temp.remove();
}   
