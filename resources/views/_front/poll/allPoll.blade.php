@extends('layouts.frontend')
@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>{{ $settings->site_title }}</title>
    <meta name="title" content="{{ $settings->site_title }}"/>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
@endsection

@section('extra_css')
    <style>
        .vote .heading h4 {
            font-size: 30px !important;
            border-bottom: 2px solid #000;
        }

        .vote__rate .progress {
            position: relative;
            height: 22px;
            margin: 10px 0;
        }

        .vote__rate .progress .option-name {
            position: absolute;
            left: 0;
            padding-top: 3px;
            padding-left: 5px;
            font-size: 12px;
            color: var(--bs-white);
        }

        .vote__rate .progress .option-percent {
            position: absolute;
            right: 0;
            padding-top: 3px;
            padding-right: 5px;
            font-size: 12px;
        }

        .vote__rate .total-vote {
            text-align: center;
            font-size: 18px;
        }

        [data-option="হ্যাঁ"] {
            background: #198754;
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
        }

        [data-option="না"] {
            background: #dc3545;
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: 1rem 1rem;
        }
    </style>
@endsection

@section('main_content')
    <section class="vote">
        <div class="container">
            <div class="css__boder__bottom">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="heading">
                            <h4>অনলাইন ভোট</h4>
                        </div>
                    </div>
                    @if(!empty($polls))
                        @foreach($polls as $poll)
                            <div class="col-md-3 mb__mbl">
                                <div class="online__vote">
                                    <div class="body">
                                        <div class="title mt-2 p-2">
                                            <h4>{{ $poll->question }}</h4>
                                        </div>
                                        <div class="vote__rate mt-2 p-2">
                                            <?php
                                            $poll_choices = DB::select("select * from poll_choices where poll_id = :poll_id", array(
                                                'poll_id' => $poll->id,
                                            ));
                                            ?>

                                            <?php $total_vote = \App\Models\PollAnswer::where('poll_id', $poll->id)->count(); ?>
                                            @if($total_vote >= 1)
                                                @foreach($poll_choices as $choice)
                                                    <?php $ans_count = \App\Models\PollAnswer::where('poll_answer_id', $choice->id)->count(); $percent = Percent($total_vote, $ans_count); ?>

                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped"
                                                             data-option="{{$choice->poll_answer}}"
                                                             style="width:{{$percent}}%"></div>
                                                        <small class="option-name">{{$choice->poll_answer}}</small>
                                                        <small
                                                            class="option-percent">{{e_to_b_int(Percent($total_vote, $ans_count))}}
                                                            %</small>
                                                    </div>
                                                @endforeach
                                                <div class="total-vote d-none">মোট ভোটদাতাঃ {{e_to_b_int($total_vote)}}
                                                    জন
                                                </div>
                                            @elseif($total_vote == 0)
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" data-option="হ্যাঁ"
                                                         style="width:0%"></div>
                                                    <small class="option-name">হ্যাঁ</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" data-option="না"
                                                         style="width:0%"></div>
                                                    <small class="option-name">না</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped"
                                                         data-option="মন্তব্য নেই" style="width:0%"></div>
                                                    <small class="option-name">মন্তব্য নেই</small>
                                                    <small class="option-percent">০%</small>
                                                </div>
                                                <div class="total-vote d-none">মোট ভোটদাতাঃ ০ জন</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 mb-3">
                            <div style="background-color: #f5f5f5; padding: 17px 20px; font-size: 18px;">
                                দুঃখিত, জরিপের জন্য অপেক্ষা করুন।
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
