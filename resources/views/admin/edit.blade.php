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
        <h5 class="card-title fw-bolder mb-3">Ubah Data Es Krim</h5>
        <form method="post" action="{{ route('admin.update', $data->id_es_krim) }}">
            @csrf
            <div class="mb-3">
                <label for="merk_eskrim" class="form-label">Merk Es Krim</label>
                <input type="text" class="form-control" id="merk_eskrim" name="merk_eskrim"
                    value="{{ $data->merk }}">
            </div>
            <div class="mb-3">
                <label for="rasa" class="form-label">Rasa</label>
                <input type="text" class="form-control" id="rasa" name="rasa" value="{{ $data->rasa }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $data->harga }}">
            </div>
            <div class="mb-3">
                <label for="Supplier" class="form-label">Supplier</label>
                <select class="form-select" aria-label="Default select example" name="id_supplier" id="">
                    @foreach ($datasups as $datasup)
                    <option value="{{$datasup->id_supplier}}">{{$datasup->nama_supplier}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>
@stop
