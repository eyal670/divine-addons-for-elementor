jQuery(document).ready(function () {
  if (!jQuery('.elementor-editor-active').length && !inIframe()) {
    console.log('tobi is running');
    console.log('tobi: ' + jQuery.isFunction(Tobi));
    setHover();

    /*init lightbox*/
    var tobi = new Tobi();
    createBtns();

    /*thumbnail moving images on hover*/
    jQuery('.list-item-wrapper .img-wrapper').hover(
      function () {
        jQuery(this).closest('.list-item-wrapper').addClass('active');
        var wrapperHeight = jQuery(this).height();
        var imgHeight = jQuery(this).find('img').height();
        var moveTo = wrapperHeight - imgHeight;
        moveTo += 'px';
        jQuery(this).find('img').stop().animate({
          top: moveTo,
        }, 3000);
      },
      function () {
        jQuery(this).closest('.list-item-wrapper').removeClass('active');
        jQuery(this).find('img').stop().animate({
          top: '0px',
        }, 1500);
      }
    );

  } else {
    console.log("don't load tobi");
  }
});

/**
 * init responsive display and copy link buttons
 */
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
    });
    create_direct_link();
  }, 3000);
}

/**
 * check if current page is running inside an iframe
 */
function inIframe() {
  try {
    return window.self !== window.top;
  } catch (e) {
    return true;
  }
}

function setHover() {
  jQuery('a[data-type="iframe"]').hover(
    function () {
      // jQuery( this ).closest('.list-item-wrapper').addClass('active');
      var wrapperHeight = jQuery(this).height();
      var imgHeight = jQuery(this).find('img').height();
      var moveTo = wrapperHeight - imgHeight;
      moveTo += 'px';
      jQuery(this).find('img').stop().animate({
        top: moveTo,
      }, 3000);
    },
    function () {
      // jQuery( this ).closest('.list-item-wrapper').removeClass('active');
      jQuery(this).find('img').stop().animate({
        top: '0px',
      }, 1500);
    }
  ).prepend('<span class="demoBtn">תצוגה מקדימה</span>');
}

/***/
// check if element is in viewport, https://github.com/customd/jquery-visible/
(function ($) {
  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *       the user visible viewport of a web browser.
   *       can accounts for vertical position, horizontal, or both
   */
  var $w = $(window);
  $.fn.visible = function (partial, hidden, direction, container) {

    if (this.length < 1)
      return;

    // Set direction default to 'both'.
    direction = direction || 'both';

    var $t = this.length > 1 ? this.eq(0) : this,
      isContained = typeof container !== 'undefined' && container !== null,
      $c = isContained ? $(container) : $w,
      wPosition = isContained ? $c.position() : 0,
      t = $t.get(0),
      vpWidth = $c.outerWidth(),
      vpHeight = $c.outerHeight(),
      clientSize = hidden === true ? t.offsetWidth * t.offsetHeight : true;

    if (typeof t.getBoundingClientRect === 'function') {

      // Use this native browser method, if available.
      var rec = t.getBoundingClientRect(),
        tViz = isContained ?
          rec.top - wPosition.top >= 0 && rec.top < vpHeight + wPosition.top :
          rec.top >= 0 && rec.top < vpHeight,
        bViz = isContained ?
          rec.bottom - wPosition.top > 0 && rec.bottom <= vpHeight + wPosition.top :
          rec.bottom > 0 && rec.bottom <= vpHeight,
        lViz = isContained ?
          rec.left - wPosition.left >= 0 && rec.left < vpWidth + wPosition.left :
          rec.left >= 0 && rec.left < vpWidth,
        rViz = isContained ?
          rec.right - wPosition.left > 0 && rec.right < vpWidth + wPosition.left :
          rec.right > 0 && rec.right <= vpWidth,
        vVisible = partial ? tViz || bViz : tViz && bViz,
        hVisible = partial ? lViz || rViz : lViz && rViz,
        vVisible = (rec.top < 0 && rec.bottom > vpHeight) ? true : vVisible,
        hVisible = (rec.left < 0 && rec.right > vpWidth) ? true : hVisible;

      if (direction === 'both')
        return clientSize && vVisible && hVisible;
      else if (direction === 'vertical')
        return clientSize && vVisible;
      else if (direction === 'horizontal')
        return clientSize && hVisible;
    } else {

      var viewTop = isContained ? 0 : wPosition,
        viewBottom = viewTop + vpHeight,
        viewLeft = $c.scrollLeft(),
        viewRight = viewLeft + vpWidth,
        position = $t.position(),
        _top = position.top,
        _bottom = _top + $t.height(),
        _left = position.left,
        _right = _left + $t.width(),
        compareTop = partial === true ? _bottom : _top,
        compareBottom = partial === true ? _top : _bottom,
        compareLeft = partial === true ? _right : _left,
        compareRight = partial === true ? _left : _right;

      if (direction === 'both')
        return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop)) && ((
          compareRight <= viewRight) && (compareLeft >= viewLeft));
      else if (direction === 'vertical')
        return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop));
      else if (direction === 'horizontal')
        return !!clientSize && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
    }
  };

})(jQuery);

/**
 * get the current iframe src
 */
function get_iframe_src() {
  jQuery('.tobi iframe').each(function () {
    if (jQuery(this).visible(false, true)) {
      var src = jQuery(this).attr("src");
      jQuery('#form-field-template_link').val(src);
      console.log(src);
    }
  });
  jQuery('.iframecontact').addClass('active');
}

function inIframe_gw() {
  try {
    return window.self !== window.top;
  } catch (e) {
    return true;
  }
}

/**
 * auto open iframe from by url taken with direct copy linke btn
 */
function pre_filter() {
  //auto filter url template: https://themes.divinesites.co.il/fs/?filter=1&tag=99&cat=97%type=104
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
    }
  };
  var display = getUrlParameter('display');
  if (display) {
    jQuery('a.tobi-zoom[href="' + display + '"] img').click();
  }
}

/**
 * init direct copy link btn
 */
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

/**
 * copy to clipboard
 */
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
