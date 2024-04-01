<div>
    {{-- {{$authors}} --}}
    <div class="row m-5">
        <div class="col-3">
            <label for="type">Type of Graph</label>
            <select name="graph" id="type" class="form-control">
                <option value="bar" selected>Bar</option>
                <option value="pie">Pie</option>
                <option value="doughnut">Doughnut</option>
                <option value="line">Line</option>
                <option value="polarArea">Polar</option>
                <option value="radar">Radar</option>
            </select>
        </div>
        {{--  --}}
        <div class="col-2">
            <label for="start">Start date:</label>
            <input type="date" id="start" name="start" class="form-control" />
        </div>
        <div class="col-2">
            <label for="end">End date:</label>
            <input type="date" id="end" name="end" class="form-control"/>
        </div>
        {{-- <div class="col-2 mt-4">
            <input type="button" value="Reset" class="btn btn-warning" id="reset">
        </div> --}}
    </div>
</div>
