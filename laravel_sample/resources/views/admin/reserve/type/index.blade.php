@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約種類別内容詳細</h1>
        <div class="text-right">
            <a href="{{ route('reserve') }}"><button type="button" class="btn btn-primary">予約種別一覧へ</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="row">
        <table class="table">

            <tr>
                <td style="width: 20%">予約名</td>
                <td>{{ $reserve_type_data->name }}</td>
            </tr>

            <tr>
                <td style="width: 20%">詳細</td>
                <td>{!! nl2br(e($reserve_type_data->detail)) !!}</td>
            </tr>

            <tr>
                <td style="width: 20%">
                    写真<br>
                    <a href="/admin/reserve/type/image/{{ $reserve_type_data->id }}"><button type="button"
                            class="btn-secondary">変更</button></a>
                </td>
                <td>
                    @if (!empty($reserve_type_data->image))
                        <img class="img-thumbnail" src="http://localhost:8888/img/<?php echo $reserve_type_data->image; ?>" width="25%">
                    @else
                        <img class="img-thumbnail" src="http://localhost:8888/img/noimage.png" width="25%">

                    @endif
                </td>
            </tr>

            <tr>
                <td style="width: 20%">登録日時</td>
                <td>{{ $reserve_type_data->created_at }}</td>
            </tr>

            <tr>
                <td style="width: 20%">更新日時</td>
                <td>{{ $reserve_type_data->updated_at }}</td>
            </tr>

            <tr>
                <td></td>
                <td><a href="/admin/reserve/type/edit/{{ $reserve_type_data->id }}"><button
                            class="btn btn-primary">内容を編集する</button></a></td>
            </tr>
            </tbody>
        </table>

    </div>


@endsection
