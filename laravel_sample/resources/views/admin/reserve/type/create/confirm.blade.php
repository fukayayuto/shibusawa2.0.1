@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約作成</h1>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <form action="{{ route('type_create_post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="name" id="name" value="{{ $data['name'] }}">
        <input type="hidden" name="detail" id="detail" value="{{ $data['detail'] }}">
        <input type="hidden" name="file_name" id="file_name" value="{{ $data['file_name'] }}">

        <div class="row">
            <table class="table">

                <tr>
                    <td style="width: 20%">予約名</td>
                    <td>{{ $data['name'] }}</td>
                </tr>

                <tr>
                    <td style="width: 20%">詳細</td>
                    <td>{!! nl2br(e($data['detail'])) !!} </td>
                </tr>

                <tr>
                    <td style="width: 20%">写真</td>
                    <td>
                        @if (!empty($data['file_name']))
                            <img class="img-thumbnail" src="http://localhost:8888/img/<?php echo $data['file_name']; ?>" width="25%">
                        @else
                            <img class="img-thumbnail" src="http://localhost:8888/img/noimage.png" width="25%">

                        @endif
                    </td>
                </tr>


                <tr>
                    <td></td>
                    <td><button class="btn btn-primary" type="submit">作成する</button></td>
                </tr>

                </tbody>
            </table>

        </div>
    </form>

@endsection
