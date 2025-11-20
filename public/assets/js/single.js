$(document).ready(function () {
            $(".content img").each(function () {
                var imageCaption = $(this).attr("alt");
                if (imageCaption != '') {
                    var imgWidth = $(this).width();
                    var imgHeight = $(this).height();
                    var position = $(this).position();
                    var positionTop = (position.top + imgHeight - 26)
                    $("<p class='img-caption'><em>" + imageCaption +
                        "</em></p>").css({
                        "top": positionTop + "px",
                        "left": "0",
                    }).insertAfter(this);
                }
            });
        });