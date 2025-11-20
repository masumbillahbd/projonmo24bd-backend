lazyload();
window.onload = (function (el) {
    lazyload();
});
window.onscroll = function (el) {
    lazyload();
};

function lazyload() {
    var lazyImage = document.getElementsByClassName('lazy');

    for (var i = 0; i < lazyImage.length; i++) {
        if (elementInViewport(lazyImage[i])) {
            lazyImage[i].setAttribute('src', lazyImage[i].getAttribute('data-src'));
        }
    }
}

function elementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

$('.post-wrapper').slick({
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 2,
    autoplay: false,
    autoplaySpeed: 1800,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
    ]
});
