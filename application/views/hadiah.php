<section class="content-header">
    <h1>
        Hadiah
        <small>Hadiah</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title; ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <button
                        type="button"
                        id="btn-add"
                        class="btn btn-sm btn-flat btn-primary"
                        data-toggle="modal"
                        data-target="#modal-default">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table id="table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Hadiah</th>
                                <th>Deskripsi</th>
                                <th>Point</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tabledata">
                        </tbody>
                    </table>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</section>

<form id="form">
    <div class="modal fade" id="modal-gift">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="close cancel"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="input-nama">
                        <label for="nama-hadiah">Nama Hadiah</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            id="nama"
                            placeholder="Nama Hadiah">
                        <span class="text-danger" id="nama-error"></span>
                    </div>
                    <div class="form-group" id="input-deskripsi">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea
                            class="form-control"
                            name="deskripsi"
                            id="deskripsi"
                            rows="5"></textarea>
                        <span class="text-danger" id="deskripsi-error"></span>
                    </div>
                    <div class="form-group" id="input-point">
                        <label for="point">Nilai Tukar</label>
                        <input
                            type="number"
                            class="form-control"
                            name="point"
                            id="point"
                            placeholder="Nilai Tukar (point)">
                        <span class="text-danger" id="point-error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-default pull-left cancel"
                        data-dismiss="modal">Close
                    </button>
                    <button 
                        type="button"
                        id="btnSubmit"
                        class="btn btn-sm btn-flat btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Delete-->
<div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form>
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <h3 class="delPrompt">Hapus?</h3>
                        <input type="hidden" class="form-control" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm btn-flat cancel" data-dismiss="modal">Cancel</button>
                        <button type="button" id="confDelete" class="btn btn-danger btn-flat btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    reload_data();

    $('#btn-add').click(function() {
        $('#modal-gift').modal('show');
        $('.modal-title').text('Tambah Hadiah');
        $('#form')[0].reset();
        $('#id').val('');
    });

    $('#btnSubmit').click(function() {
        $.ajax({
            url: "http://localhost/majapahit/gifts/store",
            type: "POST",
            dataType: "JSON",
            data: $('#form').serialize(),
            success: function(response) {
                console.log(response)
                $('#form')[0].reset();
                if (response.success == true) {
                    toastr.info(response.msg);
                    $('#modal-gift').modal('hide');
                    reload_data();
                } else {
                    let errors = response.errors;
                    for(let key in errors) {
                    let value = errors[key];
                    $('#input-'+key).append(value).addClass('text-danger')
                    }
                    toastr.warning(response.msg);
                    $('#btnSubmit').text('Menyimpan Data...').attr('disabled', true);
                }
            },
            error: function(jqXHR, textStatus) {
                console.log(textStatus);
                toastr.error('Wadidaw, Error Juragan');
            }
        });
    });

    $('body').on('click', '.btnEdit', function() {
      var id = $(this).data('id');
      $.ajax({
        url: "http://localhost/majapahit/gifts/update",
        type: "POST",
        dataType: "JSON",
        data: { id: id },
        success: function(response) {
          $('#form')[0].reset();
          $('#id').val(response.data.g_id);
          $('#nama').val(response.data.g_name);
          $('#deskripsi').val(response.data.deskripsi);
          $('#point').val(response.data.exchange_value);
        
          $('#modal-gift').modal('show');
          $('#btnSubmit').text('Update');
          $('.modal-title').text('Update Customer');
        }
      });
    });

    $('body').on('click', '.btnDelete', function() {
      $('#modalDel').modal('show');
      var id = $(this).data('id');
      var nama = $(this).data('name');
      $('.delPrompt').text(`Hapus Data "${nama}"?`);
      $('#confDelete').text('Ya, Hapus Gan!');
      
      $('#confDelete').click(function(e) {
        e.preventDefault();
      
        $.ajax({
          url: "http://localhost/majapahit/gifts/delete",
          dataType: "JSON",
          type: "POST",
          data: { id: id},
          success: function(response) {
            $('#confDelete').text('Deleting...').attr('disable', true);
            if(response.success == true) {
              toastr.success(response.msg);
              $('#modalDel').modal('hide');
              reload_data();
            } else {
              toastr.error('Wadidaw, Error Juragan');
            }
          },
          error: function(status) {
            console.log('Error: ', status)
          }
        });
      });
    });

    function reload_data() {
      $.ajax({
        url: "http://localhost/majapahit/gifts/fetch_all",
        dataType: "JSON",
        type: "GET",
        success: function(res, status) {
          var html, idx, no = 1;
          if (res == 0) {
              html = `<tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>`
          } else {
            for(idx = 0; idx < res.data.length; idx++) {
              html += `<tr>
                            <td>${no++}</td>
                            <td>${res.data[idx].g_name}</td>
                            <td>${res.data[idx].deskripsi}</td>
                            <td>${res.data[idx].exchange_value}</td>
                            <td>
                            <button type="button" data-id="${res.data[idx].g_id}" class="btn btn-sm btn-flat btn-info btnEdit">Edit</button>
                            <button type="button" data-id="${res.data[idx].g_id}" data-name="${res.data[idx].g_name}" class="btn btn-sm btn-flat btn-danger btnDelete">Hapus</button>
                            </td>
                        </tr>`
            }
          }
          $('#tabledata').html(html);
          $('#table_info').text('Total data '+ res.data.length + ' entries');
          $('#table_paginate').hide();
        }
      });
    }

    $('.cancel').click(function() {
      $('.form-group').find('p').remove();
      $('.form-group').removeClass('text-danger');
      $('#btnSubmit').attr('disabled', false);
    });
});
</script>