@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h3">写真変更画面</h1>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('reserve_type_image_change') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $reserve_type_data->id }}">

        <div class="row">
            <table class="table">

                <tr>
                    <td style="width: 20%">写真</td>
                    <td>
                        @if (!empty($reserve_type_data->image))
                            <img class="img-thumbnail" src="http://localhost:8888/img/<?php echo $reserve_type_data->image; ?>" width="25%">
                        @else
                            <img class="img-thumbnail" src="http://localhost:8888/img/noimage.png" width="25%">

                        @endif
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>変更後</td>
                    <td><input type="file" name="image" id="image" class="form-control" required></td>
                </tr>



                <tr>
                    <td></td>
                    <td><button class="btn btn-primary">変更する</button></td>
                </tr>



                </tbody>
            </table>

        </div>

    </form>

    <script>
        $(function() {
            $("#form").submit(function() {
                if (window.confirm('この内容で変更しますか?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


@endsection
