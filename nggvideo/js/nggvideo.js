jQuery(function($){
  /*$(window).load(function() {
    $('.nggvideo-thumbnail a').each(function() {
      if($(this).data("video") != "") {
        $(this).click(function() {
          var owner = this;
          // workaround - can't stopp ngg from loading image or run script immediately afterwards
          window.setTimeout(function() {
            var createdObj = $('img[src$="' + $(owner).data("src")+ '"]');
            var video = $(owner).data("video");
            createdObj.replaceWith("<div class=\"nggvideo\" style=\"display: inline-block; margin: auto;\">" + video + "<div>");
            /*var videoWidth = parseInt(video.match("width[:=].? *([0-9]+)[^0-9]")[1]);
            var videoHeight = parseInt(video.match("height[:=].? *([0-9]+)[^0-9]")[1]);
            createdObjCont.width(videoWidth);
            createdObjCont.height(videoHeight);*/
    /*      }, 100);
        });
      }
    });
  });*/
});