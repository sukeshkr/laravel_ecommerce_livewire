@extends('layouts.admin')

@section('title','Chart')

@section('content')

<div class="row">

    <div class="col-md-12 grid-margin">

        <div class="me-md-3 me-xl-5">
            <h3>Chart</h3>
            <p class="mb-md-0">Your Chart</p>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-9">
            <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};

    const data = {
        labels: labels,
        datasets: [{
            label: 'My Order 2023',
            backgroundColor: 'rgb(30,144,255)',
            borderColor: 'rgb(30,144,255)',
            data: users,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endpush

@endsection
