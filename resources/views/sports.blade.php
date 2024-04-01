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
    <div class="container">
        <h1 class="text-center">Sports</h1>
        <hr>

        <x-filters />
        <hr>
        <div class="d-flex justify-content-center">
            <canvas id="myChart"></canvas>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#secondGraphModal" id="secondGraphBtn" style="display:none;">
            Launch Second Graph Modal
          </button>

          <!-- Modal -->
          <div class="modal fade" id="secondGraphModal" tabindex="-1" aria-labelledby="secondGraphModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="secondGraphModalLabel">Authorwise Post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <canvas id="secondChart"></canvas>
                </div>
              </div>
            </div>
          </div>
    </div>
    <script>
        let chart;
        let secondChart;
        $(document).ready(function(){
        let chartType='bar';
        let startDate;
        let endDate = '2023-12-31';
        let author;
        document.getElementById('end').valueAsDate = new Date();
            $('#type').change(function(){
               chartType=$(this).val();
                getData(chartType,startDate,endDate,author);
            });
            $('#start').change(function(){
                startDate=$(this).val();
                getData(chartType,startDate,endDate,author);
            });
            $('#end').change(function(){
                endDate=$(this).val();
                getData(chartType,startDate,endDate,author);
            })
            getData(chartType,startDate,endDate);
        })
        function getData(chartType,startDate=null,endDate,author = null) {
            $.ajax({
                url: '/store',
                method: 'GET',
                dataType: 'json',
                data: {
                    'start': startDate,
                    'end': endDate,
                },
                success: function(data) {
                    if(chart){
                        chart.destroy();
                    }
                    const ctx = document.getElementById('myChart');
                    chart = new Chart(ctx, {
                        type: chartType,
                        data: {
                            labels: data.sports, // Use country names as labels
                            datasets: [{
                                label: 'sports wise blog',
                                data: data.dataCount, // Use population values as data
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            plugins: {
                                legend: false,
                            },
                            scales: {
                                x:{
                                    grid:{
                                        display:false,
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid:{
                                        display:false,
                                    }
                                }
                            },
                            onClick:function(events,elements){
                                if(elements.length > 0){
                                    var elementIndex = elements[0].index;
                                    // console.log(elementIndex);
                                    var label = this.data.labels[elementIndex];
                                    // console.log(label);
                                    var value = this.data.datasets[0].data[elementIndex];
                                    // console.log(startDate)
                                    console.log("Clicked on: " + label + ", Value: " + value);
                                    getSecondGraphData(startDate,endDate,label);
                                }
                            }
                        }
                    });
                }
            })
        }
        function getSecondGraphData(startDate = null,endDate,label){
            console.log(startDate,endDate,label)
            $.ajax({
                url:'/author',
                method:'get',
                dataType:'json',
                data:{
                    'start':startDate,
                    'end':endDate,
                    'sport':label
                },
                success:function(data){
                    console.log(data);
                    updateSecondGraph(data);
                    $('#secondGraphBtn').trigger('click'); // Open modal after updating the second graph
                }
            })
        }
        function updateSecondGraph(data){
            if(secondChart){
                secondChart.destroy();
            }
            const ctx=document.getElementById('secondChart').getContext('2d');
            secondChart = new Chart(ctx, {
                        type: 'pie', // Assuming you want a pie chart
                        data: {
                            labels: data.authors,
                            datasets: [{
                                label: 'Blogs published',
                                data: data.dataCount,
                                borderWidth: 1,
                            }]
                        },
                        options:{
                            plugins:{
                                legend:true,
                            }
                        }
                    });
        }
    </script>


</body>

</html>
