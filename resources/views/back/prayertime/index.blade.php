@extends('layouts.backend')
@section('title')
    Admin | Prayer Time Setup
@endsection
@section('content')
<div class="container-fluid pt-2">
    <div class="row justify-content-center">
        @include('back.parts.message')
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form role="form" method="post" action="{{ route('prayertime.update') }}">
             @csrf
            <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                <div class="card-header">
                  <h4 class="text-center font-weight-light my-2">Prayer Time Setup</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label  for="fajr">ফজর</label>
                        <input type="text" name="fajr" maxlength="30"value="{{ $prayertime->fajr ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('fajr') ? $errors->first('fajr'): '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="zuhr">যোহর</label>
                        <input type="text" name="zuhr" maxlength="30"value="{{ $prayertime->zuhr ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('zuhr') ? $errors->first('zuhr'): '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="asr">আছর</label>
                        <input type="text" name="asr" maxlength="30"value="{{ $prayertime->asr ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('asr') ? $errors->first('asr'): '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="maghrib">মাগরিব</label>
                        <input type="text" name="maghrib" maxlength="30"value="{{ $prayertime->maghrib ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('maghrib') ? $errors->first('maghrib') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="isha">এশা</label>
                        <input type="text" name="isha" maxlength="30"value="{{ $prayertime->isha ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('isha') ? $errors->first('isha') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="sun_rise">সূর্যোদয়</label>
                        <input type="text" name="sun_rise" maxlength="30" value="{{ $prayertime->sun_rise ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('sun_rise') ? $errors->first('sun_rise') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label  for="sun_set">সূর্যাস্ত</label>
                        <input type="text" name="sun_set" maxlength="30" value="{{ $prayertime->sun_set ?? '' }}" class="form-control">
                        <span class="text-danger">{{ $errors->has('sun_set') ? $errors->first('sun_set') : '' }}</span>
                    </div>
                    <div class="update__btn">
                        <button type="submit" name="button" class="btn btn-success my-4">
                            Update
                        </button>
                    </div>
                </div>
            </div> <!--card-->
            </form>
        </div><!--col-6-->
    </div>
</div>
@endsection
