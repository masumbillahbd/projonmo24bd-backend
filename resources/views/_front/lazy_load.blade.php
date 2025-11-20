<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
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
    </script>