<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href='{{ asset('/fullcalendar-5.10.1/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('/fullcalendar-5.10.1/lib/main.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                    left: "dayGridMonth",
                    center: "title",
                    right: "today prev,next"
                },
                buttonText: {
                    today: '今月',
                    month: '月',
                    // list: 'リスト'
                },
                noEventsContent: 'スケジュールはありません',
                events: '/admin/shibusawa/set_data',

            });
            calendar.render();
        });
    </script>


</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                 
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">
                                <span data-feather="home"></span>
                                <!-- Dashboard <span class="sr-only">(current)</span> -->
                                ホーム <span class="sr-only">(現在位置)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reserve') }}">
                                <span data-feather="file"></span>
                                <!-- Orders -->
                                予約講座
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accounts') }}">
                                <span data-feather="users"></span>
                                <!-- Products -->
                                顧客
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mail') }}">
                                <span data-feather="mail"></span>
                                <!-- Customers -->
                                メール配信
                            </a>
                        </li>
                    </ul>


            </nav>


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <!-- <h1 class="h2">Dashboard</h1> -->
                    <h1 class="h3">渋沢ツアー申し込み一覧</h1>
                    <div class="text-right">
                        <a href="{{ route('reserve') }}"><button type="button"
                                class="btn btn-primary">予約種別一覧へ</button></a>
                        <a href="/admin/reserve/2631"><button type="button" class="btn btn-primary">申し込み一覧</button></a>
                    </div>
                </div>

                <table class="table">
                    @if (!empty($data))
                        <thead class="thead-light">
                            <tr class="success">
                                <th>申し込み日時</th>
                                <th>参加人数(大人、子供、幼児)</th>
                                <th>予約日</th>
                                <th>予約時間</th>
                                <th>乗車駅</th>
                                <th>降車駅</th>
                                <th>ステータス</th>
                                <th></th>
                            </tr>
                        </thead>
                    @else
                        <thead>
                            <tr>
                                <th>新規予約はありません</th>
                            </tr>
                        </thead>
                    @endif

                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $val)
                                <tr>
                                    <td>{{ $val['created_at'] }}</td>
                                    <td>{{ $val['count'] }}人 ({{ $val['count_1'] }}人 ,{{ $val['count_2'] }}人
                                        ,{{ $val['count_3'] }}人)
                                    </td>
                                    <td>{{ $val['start_date'] }}</td>
                                    <td>{{ $val['start_time'] }}</td>
                                    <td>{{ $val['start_station'] }}</td>
                                    <td>{{ $val['finish_station'] }}</td>
                                    @if ($val['status'] == 0)
                                        <td><button type="button" class="btn btn-warning">未確定</button></td>
                                    @elseif($val['status'] == 1)
                                        <td><button type="button" class="btn btn-success">確定</button></td>
                                    @elseif($val['status'] == 2)
                                        <td><button type="button" class="btn btn-danger">キャンセル</button></td>
                                    @endif

                                    <td><a href="/admin/entry/shibusawa/{{ $val['id'] }}"><button type="button"
                                                class="btn btn-primary">詳細</button></a></td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>



                <div id='calendar'></div>


            </main>

            <footer class="footer mt-auto py-3">
                <div class="container">
                    <span class="text-muted"><br></span>
                </div>
            </footer>
        </div>
    </div>




</body>

</html>
