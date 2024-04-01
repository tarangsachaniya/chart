@extends('layout')
@section('graph')
<h1 class="text-center">PolarChart</h1>
<div>
    <canvas id="myChart"></canvas>
</div>
    <script>
        // Assuming $data is an associative array containing country and population data
        const data = <?php echo json_encode($data); ?>;
        // console.log(data)
        let duration = [];
        let maxGroupSize = [];
        let ratingsAverage = [];
        let name=[]
        data.forEach(element => {
            duration.push(element['duration']);
            maxGroupSize.push(element['maxGroupSize']);
            ratingsAverage.push(element['ratingsAverage']);
            name.push(element['name']);
        })
        console.log(name)
        console.log(maxGroupSize)
        console.log(ratingsAverage)
        console.log(duration)
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
    data: {
        datasets: [{
            type: 'bar',
            label: 'Barchart',
            data: duration
        }, {
            type: 'line',
            label: 'Line Dataset',
            data: maxGroupSize,
        },
        {
            type:'line',
            fill:true,
            label: 'Area Dataset',
            data: ratingsAverage,
        }
    ],
        labels: name
    },
});
    </script>

@endsection
