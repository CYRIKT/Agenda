@extends('layouts.app')
@section('content')
<h3>Data Agenda Kegiatan</h3>
<button class="btn btn-primary mb-3" id="btn-tambah">Tambah Agenda Kegiatan</button>
<table class="table table-bordered" id="table-agenda">
    <thead>
        <tr>
            <th>Agenda</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Lokasi</th>
            <th>Penyelenggara</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>  
<!-- Modal Form Tambah Agenda -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content no-dark shadow-lg rounded-3 border-0">
      <div class="modal-header bg-light border-bottom-0">
        <h5 class="modal-title fw-bold" id="ModalAddLabel">Tambah Agenda Kegiatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-3">
        <input type="hidden" id="edit-nim">
        <div class="mb-3">
          <label class="form-label">Agenda</label>
          <input type="text" class="form-control" id="agenda" name="agenda" placeholder="Masukkan Agenda">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Kegiatan</label>
          <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Kegiatan</label>
          <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">
        </div>
        <div class="mb-3">
          <label class="form-label">Penyelenggara</label>
          <textarea class="form-control" rows="3" id="penyelenggara" name="penyelenggara" placeholder="Masukkan Penyelenggara"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <textarea class="form-control" rows="3" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi"></textarea>
        </div>
      </div>
      <div class="modal-footer bg-light border-top-0">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-success" id="btn-simpan">Simpan</button>
        <button type="button" class="btn btn-primary" id="btn-update">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    var table;
    $(document).ready(function() {
        table = $('#table-agenda').DataTable({
            // processing: true,
            // serverSide: true,
            ajax: "/api/agenda",
            columns: [{
                data: 'agenda',
                name: 'agenda'
            },
            {
               data: 'nama_kegiatan',
               name: 'nama_kegiatan'
            },
            {
               data: 'tanggal_kegiatan',
               name: 'tanggal_kegiatan'
            },
            {
               data: 'lokasi',
               name: 'lokasi'
            },
            {
               data: 'penyelenggara',
               name: 'penyelenggara'
            },
            {
               data: 'agenda',
               render: function(agenda){
              return `<button class="btn btn-warning btn-sm btn-edit" data-id="${agenda}">Edit</button>
                     <button class="btn btn-danger btn-sm btn-delete" data-id="${agenda}">Hapus</button>`;
            }
        }
        ]
        });
    });
        
        $("#btn-tambah").click(function(){
            // alert('test');
            $('#ModalAddLabel').text('Tambah Kegiatan');
            $('#ModalAdd').modal('show');
            $('#formAgenda')[0].reset();
            $('#btn-simpan').show();
            $('#btn-update').hide();
            $('#edit-agenda').val('');
            $('#agenda').prop('readonly', false);
        });

        function ambildataForm() {
            return{
                agenda: $('#agenda').val(),
                nama_kegiatan: $('#nama_kegiatan').val(),
                tanggal_kegiatan: $('#tanggal_kegiatan').val(),
                lokasi: $('#lokasi').val(),
                penyelenggara: $('#penyelenggara').val()
            };
        }

        $('#btn-simpan').click(function(){
            var data = ambildataForm();

            $.ajax({
                url: 'api/agenda/',
                type: 'POST',
                data: data,
                success: function(response){
                    $('#ModalAdd').modal('hide');
                    table.ajax.reload();
                    alert('Data Berhasil Disimpan');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#table-agenda').on('click', '.btn-edit', function(){
            var agenda = $(this).data('id');
            $.ajax({
                url: 'api/agenda/' + agenda,
                type: 'GET',
                success: function(data){
                    $('#ModalAddLabel').text('Edit Kegiatan');
                    $('#ModalAdd').modal('show');
                    $('#agenda').val(data.agenda).prop('readonly', true);
                    $('#nama_kegiatan').val(data.nama_kegiatan);
                    $('#tanggal_kegiatan').val(data.tanggal_kegiatan);
                    $('#lokasi').val(data.lokasi);
                    $('#penyelenggara').val(data.penyelenggara);
                    $('#btn-simpan').hide();
                    $('#btn-update').show();
                    $('#edit-nim').val(agenda);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#btn-update').click(function(){
            var agenda = $('#edit-agenda').val();
            var data = ambildataForm();

            $.ajax({
                url: 'api/agenda/' + agenda,
                type: 'PUT',
                data: data,
                success: function(response){
                    $('#ModalAdd').modal('hide');
                    table.ajax.reload();
                    alert('Data berhasil diupdate');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $('#table-agenda').on('click', '.btn-delete', function(){
            var agenda =$(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: 'api/agenda/' + agenda,
                    type: 'DELETE',
                    success: function(response) {
                        table.ajax.reload();
                        alert('Data berhasil dihapus');
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        });

</script>    
@endsection