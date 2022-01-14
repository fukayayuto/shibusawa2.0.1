@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <h1 class="h2">メールテンプレート一覧</h1>
        <div class="text-right">
            <a href="{{ route('mail_template_create') }}"><button type="button" class="btn btn-success">新規作成</button></a>
            <a href="{{ route('mail') }}"><button type="button" class="btn btn-primary">戻る</button></a>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">



        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>使用方法</th>
                    <th>件名</th>
                    <th>本文</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if (!empty($template_data))
                    @foreach ($template_data as $val)
                        <tr>
                            <td>{{ $val->method }}</td>
                            <td>{{ $val->title }}</td>
                            <td>{!! nl2br(e($val->content)) !!}</td>
                            <td><a href="/admin/mail/template/{{ $val->id }}"><button type="button"
                                        class="btn btn-primary">編集</button></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
