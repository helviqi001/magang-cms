@extends('layouts.app')

@section('title','Wisata List')
@section('content_header_title','Wisata List')

@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Wisata</h3>
            <div class="box-tools">
                test
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped wisata-list">
                <thead>
                <tr>
                    <th>Gambar Wisata</th>
                    <th>Name Wisata</th>
                    <th>Deskripsi</th>
                    <th>Harga Dewasa</th>
                    <th>Harga Anak</th>
                    <th>Fasilitas</th>
                    <th>Operasional</th>
                    <th>Lokasi</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <a class="btn btn-primary" href="wisata/create/">Create</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Area</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger btn-sm active">Delete</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        let dataTable = $('.wisata-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: window.location.href + "/fn_get_data",
            },
            columns: [
                {data: 'gambarwisata', name: 'gambarwisata', width: '10%', searchable: false, orderable: false},
                {data: 'name_wisata', name: 'name_wisata'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'harga_dewasa', name: 'harga_dewasa'},
                {data: 'harga_anak', name: 'harga_anak'},
                {data: 'fasilitas', name: 'fasilitas'},
                {data: 'operasional', name: 'operasional'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'latitude', name: 'latitude'},
                {data: 'longitude', name: 'longitude'},
                {data: 'action', searchable: false, orderable: false, width: '25%'},
            ],
        })

        function fnDelete(component, id) {
            let modalDelete = $('#modal-delete')
            let name = component.parentElement.parentElement.childNodes[1].textContent
            modalDelete.find('div.modal-body>p')[0].textContent = "Are you sure want to delete " + name + "?"
            modalDelete.find('div.modal-footer>a')[0].href = 'wisata/delete/' + id
            modalDelete.modal()
        }
    </script>
@endsection
