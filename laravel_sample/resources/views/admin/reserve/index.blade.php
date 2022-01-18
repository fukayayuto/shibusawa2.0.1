@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">予約状況管理</h1>
        <a href="{{ route('type_create') }}"><button type="button" class="btn btn-primary">新規講座を作成する</button></a>
    </div>


    <div class="row">


        @foreach ($reserve_type_data as $data)
            <div class="col-4">

                <div class="card h-100">
                    <div class="text-center">
                        @if (!empty($data->image))
                            <img class="img-thumbnail" src="http://mystery-travelagency.com/img/<?php echo $data->image; ?>" width="50%">
                        @else
                            <img class="img-thumbnail" src="http://mystery-travelagency.com/img/noimage.png" width="50%">

                        @endif
                    </div>

                    <div class="card-body h-20">
                        <h4 class="card-title h-10"><a class="text-dark"
                                href="/reserve/{{ $data->id }}">{{ $data->name }}</a></h4>
                        <div class="text-center">
                            <a href="/admin/reserve/type/{{ $data->id }}" class="btn btn-secondary">内容詳細を見る</a>
                            <a href="/admin/reserve/{{ $data->id }}" class="btn btn-primary">予約状況を見る</a>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection
