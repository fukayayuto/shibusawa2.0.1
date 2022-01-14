@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">予約作成</h1>
        <div class="text-right">
            <a href="{{ route('reserve') }}"><button type="button" class="btn btn-primary">予約種別一覧へ</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <form action="{{ route('type_create_confirm') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <table class="table">

                <tr>
                    <td style="width: 20%">予約名</td>
                    <td><input type="text" name="name" id="name" class="form-control" value="{{ $data['name'] }}"
                            required>
                    </td>
                </tr>

                <tr>
                    <td style="width: 20%">詳細</td>
                    <td>
                        <textarea name="detail" id="detail" class="form-control" cols="30"
                            rows="10">{!! nl2br(e($data['detail'])) !!}</textarea>
                    </td>
                </tr>

                <tr>
                    <td style="width: 20%">写真</td>
                    <td>
                        <input type="file" name="image" id="image" class="form-control">
                    </td>
                </tr>


                <tr>
                    <td></td>
                    <td><button class="btn btn-primary" type="submit">確認画面へ</button></td>
                </tr>
                </tbody>
            </table>

        </div>
    </form>

@endsection
