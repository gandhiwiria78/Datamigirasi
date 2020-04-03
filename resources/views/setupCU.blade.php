@extends('master')

@section('sidebar')
  
@endsection

@section('content')
<h1>Informasi CU</h1>
<form action="/proses1" method="post">
    {{ csrf_field() }}
     <div class="form-group">
             <label for="nama">Nama CU</label>
             <input class="form-control" type="text" name="namaCU" value="{{ old('namaCU') }}">
     </div>
    <div class="form-group">
            <label for="pekerjaan">Berapa TP</label>
            <input class="form-control" type="text" name="jumlahTP" value="{{ old('jumlahTP') }}">
    </div>
    <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Simpan & Lanjutkan">
    </div>
</form>

@endsection