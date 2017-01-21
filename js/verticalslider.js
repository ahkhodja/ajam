/*globals window, $, clearInterval, setInterval */
$(function () {
  "use strict";
  var          hl,
        list = $('.headlines'),
    listItems = $('.headlines li'),
    firstItem = $('.headlines li:nth-child(1)'),
     preview = $('.preview'),
          elCount = $('.headlines').children(':not(.highlight)').index(),
         vPadding = (parseInt(firstItem.css('padding-top').replace('px', ''), 10)) +
                    (parseInt(firstItem.css('padding-bottom').replace('px', ''), 10)),
          vMargin = (parseInt(firstItem.css('margin-top').replace('px', ''), 10)) +
                    (parseInt(firstItem.css('margin-bottom').replace('px', ''), 10)),
         cPadding = (parseInt($('.content').css('padding-top').replace('px', ''), 10)) +
                    (parseInt($('.content').css('padding-bottom').replace('px', ''), 10)),
            speed = 5000, // this is the speed of the switch
         myTimer , /*= null,*/
         siblings = null,
      totalHeight = null,
          indexEl = 1,
                i = null;
  
  list.append('<li class="highlight h-anim"></li>');
  hl = $('.highlight');
  
  listItems.addClass('h-anim');

  function doEqualHeight(c) {

    if (preview.height() < list.height()) {
      preview.height(list.height());
    } else if ((list.height() < preview.height()) && (list.height() > parseInt(preview.css('min-height').replace('px', ''), 10))) {
      preview.height(list.height());
    }

    if ($('.content:nth-child(' + c + ')').height() > preview.height()) {
      preview.height($('.content:nth-child(' + c + ')').height() + cPadding);
    }
  }

  function doTimedSwitch() {

    myTimer = setInterval(function () {
		
      if (($('.selected').prev().index() + 1) === elCount) {
        firstItem.trigger('click');
				
		
      } else {
        $('.selected').next(':not(.highlight)').trigger('click');
		
      }
    }, speed);

  }

  $('.content').on('mouseover', function () {
    clearInterval(myTimer);
  });

  $('.content').on('mouseout', function () {
      doTimedSwitch();
  });

  function doClickItem() {

    listItems.on('click', function () {

      listItems.removeClass('selected');
      $(this).addClass('selected');

      siblings = $(this).prevAll();
      totalHeight = 0;

    
      for (i = 0; i < siblings.length; i += 1) {
          totalHeight += $(siblings[i]).height();
          totalHeight += vPadding;
          totalHeight += vMargin;
      }

     
      hl.css({
        top: totalHeight,
        height: $(this).height() + vPadding
      });

      indexEl = $(this).index() + 1;

      $('.content:nth-child(' + indexEl + ')').siblings().removeClass('top-content');
      $('.content:nth-child(' + indexEl + ')').addClass('top-content');

      clearInterval(myTimer);
     
      doTimedSwitch();
      doEqualHeight(indexEl);
    });

  }

  function doWindowResize() {

    $(window).resize(function () {

      clearInterval(myTimer);
    
      $('.selected').trigger('click');

    });

  }

 
  doClickItem();
  doWindowResize();
  $('.selected').trigger('click');
});