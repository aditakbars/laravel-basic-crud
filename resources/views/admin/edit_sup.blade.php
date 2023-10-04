@extends('admin.layout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Ubah Data Supplier</h5>
        <form method="post" action="{{ route('admin.updateSup', $data->id_supplier) }}">
            @csrf
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ $data->nama_supplier }}">
            </div>
            <div class="mb-3">
                <label for="alamat_supplier" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="{{ $data->alamat_supplier }}">
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $data->no_telepon }}">
            </div>
            <div class="mb-3">
                <label for="established" class="form-label">established</label>
                <input type="text" class="form-control" id="established" name="established" value="{{ $data->established }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>
@stop
