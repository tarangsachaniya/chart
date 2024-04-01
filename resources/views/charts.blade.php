<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Charts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        canvas {
            height: 500px !important;
            padding: 5px;
            /* width: 500px !important; */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Charts</h1>
        <div class="row">
            <div class="col-6"> <select class="form-select w-50" id="chart_data" name="sellist1">
                    <option value="duration" selected>Duration</option>
                    <option value="maxGroupSize">maxGroupSize</option>
                    <option value="ratingsAverage">ratingsAverage</option>
                </select>
            </div>
            <div class="col-6">
                <input type="radio" class="form-check-input" id="radio1" name="optradio" value="bar" checked>
                Bar &nbsp;
                <input type="radio" class="form-check-input" id="radio2" name="optradio" value="line"> Line
                &nbsp;
                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="pie"> Pie &nbsp;
                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="polarArea"> Polar
                &nbsp;
                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="radar"> Radar
                &nbsp;
                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="doughnut"> Doughnut
                &nbsp;

            </div>
        </div>

    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        const data = <?php echo json_encode($data); ?>;
        let myChart;
        let chartType = 'bar';
        let maxGroupSize = [];
        let ratingsAverage = [];
        $(document).ready(function() {
            // let name = [];
            $('#chart_data').change(function() {
                const selectedValue = $(this).val();
                if (myChart) {
                    myChart.destroy();
                }
                createChart(selectedValue, chartType);
            });

            $('.form-check-input').change(function() {
                chartType = $(this).val();
                if (myChart) {
                    myChart.destroy();
                }
                const selectedValue = $('#chart_data').val();
                createChart(selectedValue, chartType);
            });

            // Initialize the chart with default values
            createChart($('#chart_data').val(), chartType);
        });

        function createChart(selectedValue, type) {
            console.log(selectedValue)
            let chartData = [];
            let labels = [];
            data.forEach(element => {
                chartData.push(element[selectedValue]);
                labels.push(element['name']);
            });
            console.log(chartData, name);
            const ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: selectedValue,
                        data: chartData,
                        borderWidth: 1
                    }]
                },
                options: {

                    // animations: {
                    //     tension: {
                    //         duration: 1000,
                    //         easing: 'linear',
                    //         from: 1,
                    //         to: 0,
                    //         loop: true
                    //     }
                    // },

                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>


</body>

</html>
