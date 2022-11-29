<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart Sample</title>
    @section('styles')
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto);

            body {
                font-family: Roboto, sans-serif;
            }

            #chart {
                max-width: 650px;
                margin: 35px auto;
            }
        </style>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>

    {{-- {!! $chart->container() !!}

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }} --}}
    <div id="chart">
    </div>
</body>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                width: "50%"
            },
            title: {
                text: 'Graph Example'
            },
            noData: {
                text: 'Loading...'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 45, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

</html>


