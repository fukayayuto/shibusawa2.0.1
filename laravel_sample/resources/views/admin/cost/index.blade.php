@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2">Dashboard</h1> -->
    <h1 class="h3">請求一覧</h1>
</div>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="row">
    <div class="text-center h4">
        <a href="/admin/cost/{{$pre_month}}"><</a>  {{$month}}  <a href="/admin/cost/{{$next_month}}">></a>
    </div>
</div>


<div class="row">
    <table class="table">

        <thead>
            <tr class="thead-lignt">
                <th>ツアー日時</th>
                <th>ツアー名</th>
                <th>予約者名</th>
                <th>人数</th>
                <th>支払い方法</th>
                <th>請求金額</th>
                <th>入金金額</th>
                <th>差額</th>
                <th>入金日時</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
            @foreach ($data as $val)
            <tr class="<?php echo $val['color']; ?>">
                <td>{{ $val['start_date'] }}</td>
                <td><a href="/admin/entry/detail/{{ $val['id'] }}">{{ $val['reserve_name'] }}</a></td>
                <td>{{ $val['name'] }}</td>
                <td>{{ $val['count'] }}人</td>
                <td>
                    @if ($val['pay_method'] == 1)
                    銀行振り込み
                    @elseif ($val['pay_method'] == 2)
                    クレジット
                    @else
                    paypay
                    @endif
                </td>
                <td>{{ number_format($val['price']) }}円</td>
                <td>{{ number_format($val['payment']) }}円</td>
                <td>{{ number_format($val['difference']) }}円</td>
                <td>{{ $val['payment_date'] }}</td>
                <td><a href="/admin/entry/payment/{{$val['id']}}"><button class="btn-secondary">入金</button></a></td>
            </tr>
            @endforeach
            @endif
        </tbody>

        <tbody>
            @if (!empty($shibusawa_data))
            @foreach ($shibusawa_data as $value)
            <tr class="<?php echo $value['color']; ?>">
                <td>{{ $value['start_date'] }}</td>
                <td><a href="/admin/entry/shibusawa/{{ $value['id'] }}">{{ $value['reserve_name'] }}</a></td>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['count'] }}人</td>
                <td>
                    @if ($value['pay_method'] == 1)
                    銀行振り込み
                    @elseif ($value['pay_method'] == 2)
                    クレジット
                    @else
                    paypay
                    @endif
                </td>
                <td>{{ number_format($value['price']) }}円</td>
                <td>{{ number_format($value['payment']) }}円</td>
                <td>{{ number_format($value['difference']) }}円</td>
                <td>{{ $value['payment_date'] }}</td>
                <td><a href="/admin/entry/shibusawa/payment/{{$value['id']}}"><button
                            class="btn-secondary">入金</button></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        </form>
    </table>


</div>

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