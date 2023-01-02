@extends('layouts.app')

@section('title','Wisatas')
@section('content_header_title','Wisatas')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Wisata</h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="employeeFirstName">Nama Wisata<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('nama_wisata') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Deskripsi<span class="text-red">*</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Dewasa<span class="text-red">*</label>
                    <input type="text" class="form-control" name="Harga Dewasa" value="{{ old('harga_dewasa') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Anak<span class="text-red">*</label>
                    <input type="text" class="form-control" name="Harga Anak" value="{{ old('harga_anak') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Fasilitas<span class="text-red">*</label>
                    <input type="text" class="form-control" name="Fasilitas" value="{{ old('fasilitas') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Operasional<span class="text-red">*</label>
                    <input type="text" class="form-control" name="Operasional" value="{{ old('operasional') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Lokasi<span class="text-red">*</label>
                    <input type="text" class="form-control" name="Lokasi" value="{{ old('lokasi') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Gambar Wisata</label>
                    <input type="file" class="form-control" name="Gambar Wisata" accept="image/*" value="{{ old('gambar_wisata') }}" required>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button class="btn btn-default" onclick="history.back()">Back</button>
                <button class="btn btn-primary" form="form">Save</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection