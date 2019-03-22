<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h2>Configuration</h2>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach(array_keys($configuration) as $item)
                <tr>
                    <td>{{ $item }}</td>
                    <td>{{ config('war.' . $item) }}</td>
                    <td>{{ $configuration[$item] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>