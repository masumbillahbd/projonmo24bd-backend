var wind = $(window);
var sticky = $('.logo-section');
wind.on('scroll', function () {
    var scroll = wind.scrollTop();
    if (scroll < 100) {
        sticky.removeClass('sticky-nav');
    } else {
        sticky.addClass('sticky-nav');
    }
});

$('#btn-nav-previous').click(function () {
    $(".menu-inner-box").animate({scrollLeft: "-=100px"});
});

$('#btn-nav-next').click(function () {
    $(".menu-inner-box").animate({scrollLeft: "+=100px"});
});


$('#searchOpenBtn').on("click", function () {
    $('#mainSrcBox').css('display', 'block');
});
$('#searchCloseBtn').on("click", function () {
    $('#mainSrcBox').css('display', 'none');
});

//mobile
$('#mobilemenuopen').on("click", function () {
    $('#mobilemenu').css('display', 'block');
});
$('#mobilemenuclose').on("click", function () {
    $('#mobilemenu').css('display', 'none');
});
$('#sideNavOpenBtn').on("click", function () {
    $('#sideNavOpen').css('display', 'block');
});
$('#sideNavClose').on("click", function () {
    $('#sideNavOpen').css('display', 'block');
});

$('#sideNavSrcOpenBtn').on("click", function () {
    $('#sideNavSrcBar').css('display', 'block');
});

$('#sideNavSrcColseBtn').on("click", function () {
    $('#sideNavSrcBar').css('display', 'none');
});
