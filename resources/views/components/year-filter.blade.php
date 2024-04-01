<div>
    <div class="row m-5">
        <div class="col-3 m-4">
            <select name="graph" id="month" class="form-control">
                <option value="" selected>Select Month</option>
                {{-- <option value="">All</option> --}}
                <option value="1">Jan</option>
                <option value="2">Feb</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">Aug</option>
                <option value="9">Sept</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
               {{-- @foreach ($months as $item=>$val)
                        <option value="{{$val}}">{{$val}}</option>
                @endforeach --}}
                        {{-- {{$years}} --}}
            </select>
        </div>
        <div class="col-3 m-4">
            <select name="type" id="type" class="form-control">
                    <option value="bar" selected>Bar</option>
                    <option value="pie">Pie</option>
                    <option value="doughnut">Doughnut</option>
                    <option value="line">Line</option>
                    <option value="polarArea">Polar</option>
                    <option value="radar">Radar</option>
            </select>
        </div>
    </div>
</div>
