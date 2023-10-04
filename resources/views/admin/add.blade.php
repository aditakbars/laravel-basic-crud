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
        <h5 class="card-title fw-bolder mb-3">Tambah Es Krim</h5>
        <form method="post" action="{{route('admin.store')}}">
            @csrf
            <div class="mb-3">
                <label for="merk_eskrim" class="form-label">Merk Es krim</label>
                <input type="text" class="form-control" id="merk_eskrim" name="merk_eskrim">
            </div>
            <div class="mb-3">
                <label for="rasa" class="form-label">Rasa</label>
                <input type="text" class="form-control" id="rasa" name="rasa">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <!-- <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div> -->
            <div class="mb-3">
                <label for="Supplier" class="form-label">Supplier</label>
                <select class="form-select" aria-label="Default select example" name="id_supplier" id="">
                    @foreach ($datas as $data)
                    <option value="{{$data->id_supplier}}">{{$data->nama_supplier}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop
