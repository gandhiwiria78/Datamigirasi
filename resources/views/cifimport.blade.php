<div class="card bg-light mt-3">

    <div class="card-header">
        Import CIF ke SQL
    </div>
    <div class="card-body">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import CIF </button>

        </form>
        <a href="{{ route('hapusCIF')}}" class="btn btn-danger">Delete</a>
    </div>
</div>