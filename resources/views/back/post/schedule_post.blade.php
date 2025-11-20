@extends('layouts.backend')
@section('title')
    Admin | All Schedule Post
@endsection
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class=" font-weight-light my-2 float-left">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-brand-asana" width="38" height="38"
                                             viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="6" height="6" rx="1"/>
                                            <rect x="4" y="14" width="6" height="6" rx="1"/>
                                            <rect x="14" y="14" width="6" height="6" rx="1"/>
                                            <line x1="14" y1="7" x2="20" y2="7"/>
                                            <line x1="17" y1="4" x2="17" y2="10"/>
                                        </svg>
                                        Schedule Posts
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px">ID</th>
                                        <th>Headline</th>
                                        <th class="text-center">Publish Time</th>
                                        <th class="text-center" style="width: 190px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td class="text-center">{{$post->id}}</td>
                                            <td class="post__name">
                                                <p>{{ Str::limit($post->headline, 65) }}</p>
                                            </td>
                                            <td class="text-center"><p
                                                    id="">{{ view_date_format($post->created_at) }}</p></td>
                                            <td class="text-center">

                                                <a title="view"
                                                   href="{{ route('post.schedule.show', ['id' => $post->id])}}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <a title="edit"
                                                   href="{{ route('post.schedule.edit', ['id' => $post->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                        class="fa fa-edit"></i></a>

                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('post.schedule.destroy', ['id' => $post->id]) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('extra_js')
    <script>
        // Function to calculate the time remaining
        function startCountdown() {
            const targetDate = new Date('2025-03-26T16:11:00'); // Target date (Year-Month-DayTHour:Minute:Second)
            const countdownElement = document.getElementById('timer');
            setInterval(function () {
                const currentDate = new Date(); // Current date and time
                // Calculate the difference in milliseconds
                const timeDiff = targetDate - currentDate;
                // If the countdown is over, show message
                if (timeDiff <= 0) {
                    countdownElement.innerHTML = "The time has arrived!";
                    clearInterval(); // Stop the countdown when the target time is reached
                } else {
                    // Calculate the remaining time
                    const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                    // Display the countdown
                    countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                }
            }, 1000); // Update every second
        }

        // Start the countdown when the page loads
        window.onload = startCountdown;
    </script>
@endsection


