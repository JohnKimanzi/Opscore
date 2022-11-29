@extends('layouts.smart-hr', ['title' => 'Charts'])
@section('content')
    <div class="page-wrapper">
        <div class="card">
            <div class="card-body">
                <h1><strong>{{ \Carbon\Carbon::today()->format('F') }}</strong> Attendance Spread
                    <button onclick="window.location='{{ route('previous_month_chart') }}'" type="button"
                        class="btn btn-primary float-right">View Last Month</button>
                </h1>
                <div class="chart-container ml-2" style="position: relative; height:40vh; width:80vw">
                    <canvas id="myChart"></canvas>
                    <button onclick="downloadPDF()">Export PDF</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.0.279/pdf.min.js"
        integrity = "sha512-QJy1NRNGKQoHmgJ7v+45V2uDbf2me+xFoN9XewaSKkGwlqEHyqLVaLtVm93FzxVCKnYEZLFTI4s6v0oD0FbAlw=="
        crossorigin = "anonymous"
        referrerpolicy = "no-referrer" >
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        var labels = JSON.parse('{!! json_encode($dates) !!}');
        var presentData = JSON.parse('{!! json_encode($presentCount) !!}');
        var absentData = JSON.parse('{!! json_encode($absentCount) !!}');
        var annualLeaveData = JSON.parse('{!! json_encode($annualLeaveCount) !!}');

        //setup
        const bgColor = {
            id: 'bgColor',
            beforeDraw: (myChart, options) =>{
                const{ctx, width, height} = myChart;
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, width, height)
                ctx.restore();
            }

        }
        const data = {
            labels: labels,
            datasets: [{
                    type: 'line',
                    label: 'Present',
                    borderColor: 'rgb(0,255,0)',
                    data: presentData
                },
                {
                    type: 'line',
                    label: 'Absent',
                    borderColor: 'rgb(255, 0, 0)',
                    data: absentData,
                },
                {
                    type: 'line',
                    label: 'Annual Leave',
                    borderColor: 'rgb(0, 0, 255)',
                    data: annualLeaveData,
                }
            ]
        };

        //config
        const config = {
            data: data,
            options: {
                scales: {
                    x: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'This Month Dates',
                        }
                    },
                    y: {
                        title: {
                            color: 'black',
                            display: true,
                            text: '# Employee Count',
                        }
                    }
                }
            },
            plugins: [bgColor]
        };

        //Render the chart
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        function downloadPDF() {
            const canvas = document.getElementById('myChart');
            const canvasImage = canvas.toDataURL('image/jpeg', 1.0);

            let pdf = new jsPDF('landscape');
            pdf.setFontSize(20);
            pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
            pdf.save('attendance.pdf')

        }
    </script>
@endsection
