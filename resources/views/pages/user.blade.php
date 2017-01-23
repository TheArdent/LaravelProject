@extends('index')

@section('content')
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Like'],
                    @foreach ( $Statistics as $date => $qty)
                [ '{{ $date}}', {{ $qty}}],
                @endforeach
            ]);

            var options = {
                title: 'Like statistics',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
<div class="row bg-white">
    <img src="{{ $Owner->photo }}" class="img-circle col-sm-2">
    <div class="col-sm-5">
        <h2>{{ $Owner->first_name}} {{ $Owner->last_name}}</h2>
        <p>Всего записей:{{$Owner->qtyWallPosts()}}</p>
        <p>Всего лайков:{{$Owner->qtyLikes()}}</p>
    </div>
        <div id="curve_chart" style="width: 100%; height: 500px" class="col-md-5"></div>
</div><br/>
<div class="row bg-white">
    <h4 class="text-center">Самый популярный пост</h4>
    <img src="{{ $Owner->photo }}" class="img-circle col-sm-1">
    <div>
        <p>{{ $Owner->first_name}} {{ $Owner->last_name}}</p>
        <a href="https://vk.com/wall{{$TopWall['to_id']}}_{{$TopWall['id']}}">
            <small>{{ date('d-m-Y',$TopWall['date']) }}</small>
        </a><br/>
        <div class="container">
            <p>{!!$TopWall['text']!!}</p>
            @if (isset($TopWall['attachment']['photo'] ))
                <img class="center-block" src="{{$TopWall['attachment']['photo']['src_big']}}">
            @endif
        </div>
    </div>
    <p class="text-primary container">Likes : {{$TopWall['likes']['count']}}</p>
</div><br/>

<div class="row bg-white">
    <h4 class="text-center">Первый пост на стене</h4>
    <img src="{{ $Owner->photo }}" class="img-circle col-sm-1">
    <div>
        <p>{{ $Owner->first_name}} {{ $Owner->last_name}}</p>
        <a href="https://vk.com/wall{{$FirstWall['to_id']}}_{{$FirstWall['id']}}">
            <small>{{ date('d-m-Y',$FirstWall['date']) }}</small>
        </a><br/>
        <div class="container">
            <p>{!!$FirstWall['text']!!}</p>
            @if (isset($FirstWall['attachment']['photo'] ))
                <img class="center-block" src="{{$FirstWall['attachment']['photo']['src_big']}}">
            @endif
        </div>
    </div>
    <p class="text-primary container">Likes : {{$FirstWall['likes']['count']}}</p>
</div><br/>



@stop