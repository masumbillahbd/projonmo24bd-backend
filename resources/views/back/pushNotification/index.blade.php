@extends('layouts.backend')
@section('title')
    Admin | Notification
@endsection

@section('extra_css')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #msg {
            color: #5cb85c;
            text-align: center;
            font-size: 20px;
        }

    </style>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class="text-center font-weight-light my-3">Push Notification</h4>
                                </div>
                                <div class="col-md-4 col-10">
                                    <div class="search-box">
                                        <div class="input-group float-left">
                                            <form action="{{ route('notification.post.search') }}" role="search"
                                                  class="d-flex" method="GET">
                                                <input type="text" class="form-control"
                                                       placeholder="Post ID, Headline or Text" name="value">
                                                <button class="btn btn-success px-4 ms-3" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-2">
                                    <a href="{{ route('pushNotification.index') }}" class="mt-3 d-block"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="39" height="39" stroke-width="1.5">
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($posts ?? false)
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Headline</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center" style="width: 120px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <div class="pagination-info">
                                            <p>Showing {{$posts->firstItem()}} to {{$posts->lastItem()}}
                                                of {{$posts->total()}}</p>
                                        </div>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td class="text-center">{{$post->id}}</td>
                                                <td class="post__name">
                                                    <p>{{ Str::limit($post->headline, 80) }}</p>
                                                </td>
                                                <td class="text-center">{{ view_date_format($post->created_at) }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm p-1 px-2" data-title="{{ $post->headline ?? 'N/A' }}"
                                                            data-intro="{{ $post->intro ?? 'N/A' }}"
                                                            data-url="{{ news_url($post->id) ?? 'N/A' }}">Push
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination-list ">
                                        {!! $posts->links() !!}
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required="required">
                            </div>
                            <div class="form-group">
                                <label for="body">Intro</label>
                                <input type="text" class="form-control" id="body" name="body" required="required">
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" id="url" name="url" required="required">
                            </div>
                            <div class="form-group mt-2">
                                <input type="button" class="btn btn-primary" value="{{ 'Add Notification' }}" onclick="sendNotification()">
                            </div> --}}
                        </div>
                    </div>
                </div> <!--col-6-->
            </div>
            {{--
                        @php $posts = notify_post_query(); @endphp
                        @if(!empty($posts->count()))


                        @endif --}}

        </div>
    </main>
@endsection


@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        navigator.serviceWorker.register("{{ URL::asset('service-worker.js') }}")

        if ("Notification" in window) {
            if (Notification.permission === 'granted') {
                notify();
            } else {
                Notification.requestPermission().then((res) => {
                    if (res === 'granted') {
                        notify();
                        console.log("Notification access granted")
                        //old code
                        navigator.serviceWorker.ready.then((sw) => {
                            sw.pushManager.subscribe({
                                userVisibleOnly: true,
                                applicationServerKey: "BCwHrNwPwzQyAndhhpCMUEgaNnh0-vSto_p3e-LCb5NYovX4rpnzAszruBL8dIkkswEaYG3SAdeWg_no1_yB4hE"
                            }).then((subscription) => {
                                // 		console.log(subscription);
                                // 		console.log(JSON.stringify(subscription));
                                saveSub(JSON.stringify(subscription));
                            })
                        })
                        //old code end
                    } else if (res === 'denied') {
                        console.log("Notification access denied")
                    } else if (res === 'default') {
                        console.log("Notification permission not given")
                    }
                });
            }
        } else {
            console.log("Notification not supported")
        }

        function notify() {
            new Notification("Thank you for allowing the notification")
        }

        // old function, onclick function, not use now
        function askForPermission() {
            Notification.requestPermission().then((permission) => {
                if (permission === 'granted') {
                    navigator.serviceWorker.ready.then((sw) => {
                        sw.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: "BCwHrNwPwzQyAndhhpCMUEgaNnh0-vSto_p3e-LCb5NYovX4rpnzAszruBL8dIkkswEaYG3SAdeWg_no1_yB4hE"
                        }).then((subscription) => {
                            // 		console.log(subscription);
                            // 		console.log(JSON.stringify(subscription));
                            saveSub(JSON.stringify(subscription));
                        })
                    })
                }
            })
        }

        function saveSub(sub) {
            console.log(sub);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route("saveSubcription") }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'sub': sub
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Status: " + textStatus);
                }
            });
        }

        function sendNotification() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route("sendNotification") }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'title': $("#title").val(),
                    'body': $("#body").val(),
                    'url': $("#url").val(),
                },
                success: function (data) {
                    $('#msg').show();
                    $('#msg').html("Notification sent successfully").fadeIn('slow') //also show a success message
                    $('#msg').delay(5000).fadeOut('slow');
                    $("#title").val('');
                    $("#body").val('');
                    $("#url").val('');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Status: " + textStatus);
                }
            });
        }

    </script>
@endsection
