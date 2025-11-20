@extends('layouts.backend')
@section('title')
    Admin | Ramadan Setup
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @include('back.parts.message')
        <div class="col-lg-4">
            <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                <div class="card-header"><h4 class="text-center font-weight-light my-1">Add Ramadan</h4>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('ramadan.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="division">Division <span class="text-danger">*</span></label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="">-Select Division-</option>
                                <option value="ঢাকা">ঢাকা</option>
                                <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                <option value="রাজশাহী">রাজশাহী</option>
                                <option value="খুলনা">খুলনা</option>
                                <option value="সিলেট">সিলেট</option>
                                <option value="বরিশাল">বরিশাল</option>
                                <option value="রংপুর">রংপুর</option>
                                <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                            </select>
                            <span class="text-danger">{{ $errors->has('division') ? $errors->first('division'):''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="ramadan_no">Ramadan No <span class="text-danger">*</span></label>
                            <input class="form-control" name="ramadan_no" placeholder="Ramadan No" type="number" required>
                            <span class="text-danger">{{ $errors->has('ramadan_no') ? $errors->first('ramadan_no'):''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="date" placeholder="Date" type="date" required>
                            <span class="text-danger">{{ $errors->has('date') ? $errors->first('date'):''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="sehri">Sehri <span class="text-danger">*</span></label>
                            <input class="form-control" name="sehri" placeholder="Sehri" type="time" required>
                            <span class="text-danger">{{ $errors->has('sehri') ? $errors->first('sehri'):''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="iftar">Iftar <span class="text-danger">*</span></label>
                            <input class="form-control" name="iftar" placeholder="Iftar" type="time" required>
                            <span class="text-danger">{{ $errors->has('iftar') ? $errors->first('iftar'):''}}</span>
                        </div>
                        <button type="submit" class="float-right btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div> <!--col-6-->

        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                <div class="card-header">
                    <h4 class="text-center font-weight-light my-1">Ramadan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">Ramadan No</th>
                                <th class="text-center">Division</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Day</th>
                                <th class="text-center">Sehri</th>
                                <th class="text-center">Iftar</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($ramadans as $row)
                                <tr>
                                    <td class="text-center">{{$row->ramadan_no}}</td>
                                    <td class="text-center">{{$row->division}}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->date)
                            ->format('d M')}}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->date)
                            ->format('l')}}</td>
                                    <td class="text-center">{{date('h:i', strtotime($row->sehri))}}</td>
                                    <td class="text-center">{{date('h:i', strtotime($row->iftar))}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('ramadan.edit', ['id' => $row->id])}}"
                                           class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                    class="fa fa-edit"></i></a>
                                        <a href="{{ route('ramadan.destroy', ['id' => $row->id])}}"
                                           onclick="return confirm('Are you sure to delete this!')"
                                           class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i
                                                    class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!--col-6-->

    </div>
</div>
@endsection
