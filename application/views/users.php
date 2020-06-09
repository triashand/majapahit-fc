<section class="content-header">
    <h1>
        Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title; ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form id="form">
                        <div class="form-group" id="input-nama">
                            <label for="nama-hadiah">Nama</label>
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input
                                type="text"
                                class="form-control"
                                name="nama"
                                id="nama"
                                placeholder="Nama User">
                            <span class="text-danger" id="nama-error"></span>
                        </div>
                        <div class="form-group" id="input-email">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                placeholder="Email">
                            <span class="text-danger" id="email-error"></span>
                        </div>
                        <div class="form-group" id="input-username">
                            <label for="username">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                name="username"
                                id="username"
                                placeholder="Username">
                            <span class="text-danger" id="username-error"></span>
                        </div>
                        <div class="form-group" id="input-password">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                                placeholder="Password">
                            <span class="text-danger" id="password-error"></span>
                        </div>
                        <div class="form-group" id="input-passconf">
                            <label for="passconf">Password Confirmation</label>
                            <input
                                type="password"
                                class="form-control"
                                name="passconf"
                                id="passconf"
                                placeholder="Password Confirmation">
                            <span class="text-danger" id="passconf-error"></span>
                        </div>
                        <button 
                            type="button"
                            id="btnSubmit"
                            class="btn btn-sm btn-flat btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pengguna</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table id="table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
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
        $('.modal-title').text('Tambah Customer');
        $('#form')[0].reset();
        $('#id').val('');
    });

    $('#btnSubmit').click(function() {
        $.ajax({
            url: "http://localhost/majapahit/users/store",
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
        url: "http://localhost/majapahit/users/update",
        type: "POST",
        dataType: "JSON",
        data: { id: id },
        success: function(response) {
          $('#form')[0].reset();
          $('#id').val(response.data.u_id);
          $('#nama').val(response.data.name);
          $('#email').val(response.data.email);
          $('#username').val(response.data.username);
        
          $('#btnSubmit').text('Update');
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
          url: "http://localhost/majapahit/users/delete",
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
        url: "http://localhost/majapahit/users/fetch_all",
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
                            <td>${res.data[idx].name}</td>
                            <td>${res.data[idx].email}</td>
                            <td>${res.data[idx].username}</td>
                            <td>
                            <button type="button" data-id="${res.data[idx].u_id}" class="btn btn-sm btn-flat btn-info btnEdit">Edit</button>
                            <button type="button" data-id="${res.data[idx].u_id}" data-name="${res.data[idx].name}" class="btn btn-sm btn-flat btn-danger btnDelete">Hapus</button>
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
});
</script>