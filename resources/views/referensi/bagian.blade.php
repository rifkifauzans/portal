@extends('layouts.app')

@section('content')
<style>
    /* Gaya CSS sesuai kebutuhan */
    body {
        /* background-color: #add8e645; */
    }
    .content-body .container {
        margin: 0px;
        max-width: 100%!important;
        height:99%;
    }
    .content-body {
        padding: 3px!important;
    }
    .dt-length label{
        display:none;
    }
    .modalpopup {
        width: 80%;
        margin-top: 3%;
        margin-left: 10%;
        height: auto;
    }
    .form-group {
        margin-bottom: 0.5rem!important;
    }
    .form-control {
        font-size: 1em!important;
    }
</style>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Bagian</h1>
<p class="mb-4">Daftar Bagian PT Perkebunan Nusantara I</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-rounded add_bagian" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-fw fa-plus"></i> Tambah Data
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nomenklatur</th>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Tanggal Aktif</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody style='font-size: 0.85em; text-align: center;'>
                    @foreach($dataallbagian as $bagian)
                    <tr>
                        <td>{{ $bagian->Nomenklatur }}</td>
                        <td>{{ $bagian->Nama }}</td>
                        <td style="text-align:center">{{ $bagian->TanggalAktif }}</td>
                        <td style="text-align:center">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{ $bagian->BagianId }}" data-nomenklatur="{{ $bagian->Nomenklatur }}" data-nama="{{ $bagian->Nama }}" data-tanggal_aktif="{{ $bagian->TanggalAktif }}">
                                <i class="fas fa-fw fa-edit"></i> Edit
                            </button>
                            <a href="{{ route('bagian.destroy', $bagian->BagianId) }}" class="btn btn-danger btn-sm deletedata">
                                <i class="fas fa-fw fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="nomenklatur">Nomenklatur</label>
                        <input type="text" class="form-control" id="nomenklatur" name="nomenklatur">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_aktif">Tanggal Aktif</label>
                        <input type="date" class="form-control" id="tanggal_aktif" name="tanggal_aktif">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveAddData">Save Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_bagian_id" name="BagianId">
                    <div class="form-group">
                        <label for="edit_nomenklatur">Nomenklatur</label>
                        <input type="text" class="form-control" id="edit_nomenklatur" name="nomenklatur">
                    </div>
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_aktif">Tanggal Aktif</label>
                        <input type="date" class="form-control" id="edit_tanggal_aktif" name="tanggal_aktif">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditData">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle modal display and AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handle add data
        $('#saveAddData').on('click', function() {
            $.ajax({
                url: '{{ route('bagian.store') }}',
                type: 'POST',
                data: $('#addForm').serialize(),
                success: function(response) {
                    Swal.fire('Success!', 'Data berhasil ditambahkan.', 'success');
                    $('#addModal').modal('hide');
                    location.reload(); // Reload halaman setelah data ditambahkan
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal menambahkan data: ' + xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle edit data
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nomenklatur = button.data('nomenklatur');
            var nama = button.data('nama');
            var tanggal_aktif = button.data('tanggal_aktif');

            var modal = $(this);
            modal.find('#edit_bagian_id').val(id);
            modal.find('#edit_nomenklatur').val(nomenklatur);
            modal.find('#edit_nama').val(nama);
            modal.find('#edit_tanggal_aktif').val(tanggal_aktif);
        });

        $('#saveEditData').on('click', function() {
            $.ajax({
                url: '{{ route('bagian.update') }}',
                type: 'POST',
                data: $('#editForm').serialize(),
                success: function(response) {
                    Swal.fire('Success!', 'Data berhasil diubah.', 'success');
                    $('#editModal').modal('hide');
                    location.reload(); // Reload halaman setelah data diubah
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal mengubah data: ' + xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle delete data
        $('.deletedata').click(function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>

@endsection
