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
            <div id="highchart"></div>
        </div>
    </div>
</div>

@push('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(function()
    {

        var labelsData = {{ Js::from($labels) }};

        var orderData = {{ Js::from($data) }};

        Highcharts.chart('highchart', {

            title:{
                text:'Cart Order Growth on 2023'
            },
            subtitle: {
            text: 'sukesh Commerse'
            },
            xAxis:{
                title:{
                    text:'Month Base'
                },
                categories:labelsData
            },
            yAxis:{
                title:{
                    text:'No. of new Order'
                }
            },
            legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'Order',
            data: orderData
        }],

        });

    });
</script>

@endpush

@endsection
