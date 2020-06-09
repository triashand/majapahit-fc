<section class="content-header">
    <h1>
        Transactions
        <small>Transaksi</small>
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
                                <th>Invoice</th>
                                <th>Nama Customer</th>
                                <th>Produk</th>
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
                    <div class="form-group" id="input-invoice">
                        <label for="nama-hadiah">Invoice</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input
                            type="text"
                            class="form-control"
                            name="invoice"
                            id="invoice"
                            value="<?= $invoice; ?>"
                            readonly>
                        <span class="text-danger" id="nama-error"></span>
                    </div>
                    <div class="form-group" id="input-cust_id">
                        <label for="nama-hadiah">Customer</label>
                        <select class="form-control" name="cust_id" id="cust_id">
                            <option value="">Pilih Customer</option>
                            <?php foreach($customers as $customer) : ?>
                                <option value="<?= $customer->c_id ?>"><?= $customer->c_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger" id="cust_id-error"></span>
                    </div>
                    <div class="form-group" id="input-cust_id">
                        <label for="nama-hadiah">Produk</label>
                        <select class="form-control" name="prod_id" id="prod_id">
                            <option value="">Pilih Produk</option>
                            <?php foreach($products as $product) : ?>
                                <option value="<?= $product->p_id ?>"><?= $product->p_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger" id="prod_id-error"></span>
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
        $('.modal-title').text('Tambah Customer');
        $('#form')[0].reset();
        $('#id').val('');
    });

    $('#btnSubmit').click(function() {
        $.ajax({
            url: "http://localhost/majapahit/transactions/store",
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

    $('body').on('click', '.btnDelete', function() {
      $('#modalDel').modal('show');
      var id = $(this).data('id');
      var invoice = $(this).data('invoice');
      $('.delPrompt').text(`Hapus Transaksi Nomor "${invoice}"?`);
      $('#confDelete').text('Ya, Hapus Gan!');
      
      $('#confDelete').click(function(e) {
        e.preventDefault();
      
        $.ajax({
          url: "http://localhost/majapahit/transactions/delete",
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
        url: "http://localhost/majapahit/transactions/fetch_all",
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
                            <td>${res.data[idx].invoice}</td>
                            <td>${res.data[idx].c_name}</td>
                            <td>${res.data[idx].p_name}</td>
                            <td>
                                <button type="button" data-invoice="${res.data[idx].invoice}" data-id="${res.data[idx].t_id}" class="btn btn-sm btn-flat btn-danger btnDelete">Hapus</button>
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
      $('#btnSubmit').text('Simpan');
    });
});
</script>