@extends('layout')
@section('graph')
<h1 class="text-center">BarChart</h1>

<div>
    <canvas id="myChart"></canvas>
</div>
    <script>
        // Assuming $data is an associative array containing country and population data
        const data = <?php echo json_encode($data); ?>;
        // console.log(data)
        let country = [];
        let color = [];
        let population = [];
        data.forEach(element => {
            country.push(element['country']);
            population.push(element['population']);
            color.push(element['color_code']);
        })
        console.log(country)
        console.log(population)
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: country, // Use country names as labels
                    datasets: [{
                        // label: none,
                        data: population, // Use population values as data
                        borderWidth: 1,
                        backgroundColor:color
                    }]
                },
            options: {
                indexAxis: 'y',
                plugins:{
                    legend:false,
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
