@extends('admin.layout')

@section('content')

<h4 class="mt-4">Data Es Krim</h4>

<a href="{{ route('admin.create') }}" type="button" class="btn btn-primary rounded-3 mb-2">Tambah Data Es Krim</a>
<a href="#" type="button" class="btn btn-success rounded-3 mb-2 ml-3" aria-pressed="true">Daftar Es Krim</a>
<a href="{{ route('admin.showSup') }}" type="button" class="btn btn-outline-success rounded-3 mb-2 ml-3">Daftar Supplier</a>

@if($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{ $message }}
</div>
@endif

<form action="{{route('admin.showIce')}}" method="GET" class="mb-3 mt-1">
    <input type="text" name="search" class="form-control rounded-1" placeholder="Cari Es Krim" value="{{$searchTerm}}">
</form>

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>Merk</th>
            <th>Rasa</th>
            <th>Harga</th>
            <th>ID Supplier</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_es_krim }}</td>
            <td>{{ $data->merk }}</td>
            <td>{{ $data->rasa }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->id_supplier }}</td>
            <td>
                <a href="{{ route('admin.edit', $data->id_es_krim) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->id_es_krim }}">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->id_es_krim }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.delete', $data->id_es_krim) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
