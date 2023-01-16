@extends('layouts.app')

@section('title','Create Kuliner')
@section('content_header_title','Create Kuliner')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kuliner </h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="employeeFirstName">Nama Kuliner<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name_kuliner" value="{{ old('name_kuliner') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Deskripsi<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="deskripsi" value="{{ old('deskripsi') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Operasional<span class="text-red">*</span></label>
                    <select class="form-control" name="operasional" id="cars" value="{{ old('operasional') }}"  required>
                        <option value="Senin-Jumat">Senin - Jumat</option>
                        <option value="Setiap Hari">Sabtu - Minggu</option> 
                        <option value="Setiap Hari">Setiap Hari</option>  
                    </select>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Reguler<span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="harga_reguler" value="{{ old('harga_reguler') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Jumbo<span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="harga_jumbo" value="{{ old('harga_jumbo') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Lokasi<span class="text-red">*</label>
                    <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi') }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Latitude<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" required>
                    <h5><span class="text-red">*Silahkan diisi sesuai format ini "-6.265834950350268"</h5>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Longitude<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" required>
                    <h5><span class="text-red">*Silahkan diisi sesuai format ini "106.73329584425376"</h5>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Gambar Kuliner<span class="text-red">*</span></label>
                    <input type="file" class="form-control" name="gambar_kuliner" accept="image/*" value="{{ old('gambar_kuliner') }}" required>
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