@extends('layouts.app')

@section('title','Edit Kuliner')
@section('content_header_title',' Edit Kuliners')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kuliner</h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="employeeFirstName">Nama Kuliner<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name_kuliner" value="{{ $kuliner->name_kuliner }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Deskripsi<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="deskripsi" value="{{ $kuliner->deskripsi }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Operasional<span class="text-red">*</span></label>
                    <select class="form-control" name="operasional" id="cars" value="{{ $kuliner->operasional }}"  required>
                        <option value="Senin-Jumat">Senin - Jumat</option>
                        <option value="Setiap Hari">Sabtu - Minggu</option> 
                        <option value="Setiap Hari">Setiap Hari</option>  
                    </select>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Reguler<span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="harga_reguler" value="{{ $kuliner->harga_reguler }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Harga Jumbo<span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="harga_jumbo" value="{{ $kuliner->harga_jumbo }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Lokasi<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="lokasi" value="{{ $kuliner->lokasi }}" required>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Latitude<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="latitude" value="{{ $kuliner->latitude }}" required>
                    <h5><span class="text-red">*Silahkan diisi sesuai format ini "-6.265834950350268"</h5>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Longitude<span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="longitude" value="{{ $kuliner->longitude }}" required>
                    <h5><span class="text-red">*Silahkan diisi sesuai format ini "106.73329584425376"</h5>
                </div>
                <div class="form-group">
                    <label for="employeeFirstName">Gambar Kuliner</label>
                    <br>
                    <img src="{{ $kuliner->gambar_kuliner }}" alt="" width="150px">
                    <input type="file" class="form-control" name="gambar_kuliner"  accept="image/*" >
                <h5><span class="text-red">*Silahkan diisi jika anda ingin mengganti image</h5>
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