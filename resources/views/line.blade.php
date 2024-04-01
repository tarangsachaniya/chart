@extends('layout')
@section('graph')
<h1 class="text-center">LineChart</h1>
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
            color.push(element['color_code'])
        })
        console.log(country)
        console.log(color)
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'line',

            data: {
                labels: country,
                // labels: country, // Use country names as labels
                datasets: [{
                 label: 'LineChart',
                data: population,
                fill: true,
                // lineColor:color,
                borderColor: color,
                tension: 0.1
  }]
            },
            options:{
                plugins:{
                    legend:{
                        display:false,
                    }
                }
            },
        });
    </script>

@endsection
