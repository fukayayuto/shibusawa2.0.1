@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2">Dashboard</h1> -->
    <h1 class="h2">メール履歴一覧</h1>
    <a href="{{ route('mail_template') }}"><button type="button" class="btn btn-primary">メールテンプレート編集</button></a>
</div>

<div class="container">

    <form action="{{ route('mail_search') }}" method="post">
        @csrf
        <input type="text" name="email" id="email" placeholder="メールアドレス" value="{{ @$email }}">
        <button type="submit" class="btn btn-secondary">検索</button>
    </form>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th style="width: 15%">送信日時</th>
                <th>宛先</th>
                <th>件名</th>
                <th>本文</th>
                <th style="width: 5%"></th>
            </tr>
        </thead>

        <tbody>
            @if (!empty($mail_data))
            @foreach ($mail_data as $val)
            <tr>
                <td>{{ $val['created_at'] }}</td>
                <td>{{ $val['email'] }}<br><a href="/admin/account/detail/{{ $val['account_id'] }}">( {{$val['account_name']}} )</a></td>
                <td>{{ $val['title'] }}</td>
                <td style="white-space: pre-wrap;">{!! nl2br(e(mb_substr($val['content'],0,50))) !!}</td>
                <td width="5%"><a href="/admin/mail/detail/{{ $val['id'] }}"><button type="button"
                            class="btn btn-primary">表示</button></a></td>
            </tr>
            @endforeach
            @if(empty($search_flg))
            <tr>
                <td></td>
                <td></td>
                <td>{{ $mail_data->links() }}</td>
                <td></td>
                <td></td>
            </tr>
            @endif
            
            @endif
        </tbody>
       
    </table>
</div>

@endsection