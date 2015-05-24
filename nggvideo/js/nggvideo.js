var owner = null;

jQuery(function($){
  var loadVideo = function() {
    // workaround - can't stopp ngg from loading image or run script immediately afterwards
    waitForImg = function() {
      if($('img[src$="' + owner.data("src")+ '"]').length == 1) {
        var createdObj = $('img[src$="' + owner.data("src")+ '"]');
        var video = owner.data("video");
        var videoWidth = parseInt(video.match("width[:=].? *([0-9]+)[^0-9]")[1]);
        var videoHeight = parseInt(video.match("height[:=].? *([0-9]+)[^0-9]")[1]);
        createdObj.replaceWith("<div class=\"nggvideo\" style=\"width: " + videoWidth + "px; height: " + videoHeight + "px; margin: auto;\">" + video + "<div>");
        /*createdObjCont.width(videoWidth);
        createdObjCont.height(videoHeight);*/
      } else {
        window.setTimeout(waitForImg, 10);
      }
    }
    waitForImg();
  }
  
  $(window).load(function() {
    // handler on open gallery
    $('.nggvideo-thumbnail a').click(function() {
      owner = $(this);
      if(owner.data("video") != "") {
        loadVideo();
      }
    });
    
    // workaround - can't trigger on next or prev by using different libraries - so just add triggers for all gallery libraries
    // handler for different galleries
    $('#fancybox-right').click(function() {
      if(owner != null) {
        owner = $(owner.closest(".ngg-gallery-thumbnail-box").next().find(".nggvideo-thumbnail a")[0]);
        if(owner.data("video") != "") {
          loadVideo();
        }
      }
    });
    $('#fancybox-left').click(function() {
      if(owner != null) {
        owner = $(owner.closest(".ngg-gallery-thumbnail-box").prev().find(".nggvideo-thumbnail a")[0]);
        if(owner.data("video") != "") {
          loadVideo();
        }
      }
    });
  });
});