@extends('layout')
@section('graph')
    <h1 class="text-center">BarChart</h1>
    <x-year-filter />
    <div>
        <canvas id="myChart"></canvas>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#secondGraphModal" id="secondGraphBtn" style="display:none;">
          Launch Second Graph Modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="secondGraphModal" tabindex="-1" aria-labelledby="secondGraphModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="secondGraphModalLabel">Sports Graph</h5>
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
        $(document).ready(function() {
            let labels = [];
            let count = [];
            let month = null;
            let year = null;
            let type = $('#type').val();
            $('#month').change(function() {
                labels = []; // Clearing labels array
                count = []; // Clearing count array
                month = $(this).val();
                getChart(type, month);
            });
            $('#type').change(function() {
                labels = [];
                count = [];
                type = $(this).val();
                getChart(type, month);
            });
            // getChart(year,month);
        });

        function getChart(type, month) {

            $.ajax({
                url: '/post/year',
                method: 'GET',
                dataType: 'json',
                data: {
                    // 'year': year,
                    'month': month,
                },
                success: function(data) {
                    console.log(data);
                    // data.forEach(element => {
                    // //    console.log(element)
                    // });

                    if (chart) {
                        chart.destroy();
                    }

                    const ctx = document.getElementById('myChart').getContext('2d');
                    chart = new Chart(ctx, {
                        type: type, // Assuming you want a bar chart
                        data: {
                            labels: data.year.map((year, index) => data.month[index] + '-' + year),
                            datasets: [{
                                label: 'Blogs published',
                                data: data.count,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            onClick: function(event, elements) {
                                if (elements.length > 0) {
                                    // Get the first element (point) that is clicked
                                    var elementIndex = elements[0].index;
                                    // console.log(elementIndex);
                                    // Get the label and value of the clicked point
                                    var label = this.data.labels[elementIndex];
                                    var value = this.data.datasets[0].data[elementIndex];
                                    // Perform actions with the clicked data
                                    console.log("Clicked on: " + label + ", Value: " + value);

                                    // Fetch data for the second graph based on the clicked point
                                    var monthYear = label.split('-');
                                    var month = monthYear[0];
                                    var year = monthYear[1];
                                    // console.log(month,year);
                                    getSecondGraphData(month, year);
                                }
                            }
                        }
                    });
                    // chart.resize(500,500);
                }
            });

        }

        function getSecondGraphData(month,year){
            console.log(month,year)
            $.ajax({
                url:'/second',
                method:'get',
                dataType:'json',
                data:{
                    'year':year,
                    'month':month
                },
                success:function(data){
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
                            labels: data.sports,
                            datasets: [{
                                label: 'Blogs published',
                                data: data.dataCount,
                                borderWidth: 1,
                            }]
                        },
                    });
        }

        // Event listener for modal close event
        // $('#secondGraphModal').on('hidden.bs.modal', function (e) {
        //     // Revert back to the original graph when modal is closed
        //     getChart($('#type').val(), $('#month').val(), $('#year').val());
        // });
    </script>
@endsection
