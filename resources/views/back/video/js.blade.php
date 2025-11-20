<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.min.js" type="text/javascript"
        charset="utf-8"></script>
<script>

    $(document).ready(function () {
        $('#lfm').filemanager('image');
 

        /* functions for video gallery*/
        var youtubeVideoID;
        var fbVideoID;

        function parseURL(url) {
            parsed_url = {}

            if (url == null || url.length == 0)
                return parsed_url;

            protocol_i = url.indexOf('://');
            parsed_url.protocol = url.substr(0, protocol_i);

            remaining_url = url.substr(protocol_i + 3, url.length);
            domain_i = remaining_url.indexOf('/');
            domain_i = domain_i == -1 ? remaining_url.length - 1 : domain_i;
            parsed_url.domain = remaining_url.substr(0, domain_i);
            parsed_url.path = domain_i == -1 || domain_i + 1 == remaining_url.length ? null : remaining_url.substr(domain_i + 1, remaining_url.length);

            domain_parts = parsed_url.domain.split('.');
            switch (domain_parts.length) {
                case 2:
                    parsed_url.subdomain = null;
                    parsed_url.host = domain_parts[0];
                    parsed_url.tld = domain_parts[1];
                    break;
                case 3:
                    parsed_url.subdomain = domain_parts[0];
                    parsed_url.host = domain_parts[1];
                    parsed_url.tld = domain_parts[2];
                    break;
                case 4:
                    parsed_url.subdomain = domain_parts[0];
                    parsed_url.host = domain_parts[1];
                    parsed_url.tld = domain_parts[2] + '.' + domain_parts[3];
                    break;
            }

            parsed_url.parent_domain = parsed_url.host + '.' + parsed_url.tld;

            return parsed_url;
        }

        function YouTubeGetID(url) {
            var ID = '';
            url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
            if (url[2] !== undefined) {
                ID = url[2].split(/[^0-9a-z_\-]/i);
                ID = ID[0];
            }
            else {
                ID = url;
            }
            return ID;
        };


        function fbvideoGetID(frame) {

            var myRegexp = /^(?:(?:https?:)?\/\/)?(?:www\.)?facebook\.com\/[a-zA-Z0-9\.]+\/videos\/(?:[a-z0-9\.]+\/)?([0-9]+)\/?(?:\?.*)?$/;
            var match = myRegexp.exec(frame);
            return match[1];
        }

        function YouTubeVideoThumbnail(id) {
            return "https://img.youtube.com/vi/" + id + "/maxresdefault.jpg";
        };

        function fbVideoThumbnail(id) {
            return "https://graph.facebook.com/" + id + "/picture";
        };

        $("#video_url").bind('paste', function (e) {
            var _this = this;
            var video_url;
            var video_thumb;
            var host;

            setTimeout(function () {
                video_url = $(_this).val();
                console.log(video_url);
                host = parseURL(video_url).host;
                console.log(host);
                if (host == "youtube" || host == "youtu") {
                    $("#streaming_site").val('youtube');
                } else if(host == "facebook") {
                    $("#streaming_site").val('facebook');
                } else {
                    alert("Only 'Youtube' or 'Facebook' video supported");
                }


                if (host == "facebook") {

                    fbVideoID = fbvideoGetID(video_url);
                    console.log(fbVideoID);
                    $("#video_id").val(fbVideoID);

                    video_thumb = fbVideoThumbnail(fbVideoID);
                    $("#holder").attr("src", video_thumb);
                    $("#thumbnail").val(video_thumb);


                } else if (host == "youtube" || host == "youtu") {
                    youtubeVideoID = YouTubeGetID(video_url);
                    console.log(youtubeVideoID);
                    $("#video_id").val(youtubeVideoID);

                    video_thumb = YouTubeVideoThumbnail(youtubeVideoID);
                    console.log($(location).attr('host'));
                    $("#holder").attr("src", video_thumb);
                    $("#thumbnail").val(video_thumb);
                }

            }, 1);
        });


        /* create single video */

        /*$("#create_video").submit(function (e) {
            e.preventDefault();
            console.log("submitted");
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            if (request) {
                request.abort();
            }
            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);
            console.log(serializedData);

            var request = $.ajax({
                url: "",
                type: "post",
                data: serializedData
            });

            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                console.log(response);
                console.log(textStatus);
                console.log(jqXHR);
            });

        });*/


    });


</script>