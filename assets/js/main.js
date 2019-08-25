$(document).ready(function() {
    let unsave = false;
    let total = 0;
    let check = true;

    $('.data-table').DataTable();
    $('.select2').select2();

    $('.custom-file-input').change(function() {
        let filename = $(this)[0].files[0].name;
        $(this).next().text(filename);
    });

    $('.btn-edit-product').click(function() {
        let dataJSON = atob($(this).attr('data-product'));
        let dataProduct = $.parseJSON(dataJSON);
        $('#edit-id-produk').val(dataProduct.id_produk);
        $('#edit-nama-produk').val(dataProduct.nama);
        $('#edit-harga-produk').val(dataProduct.harga);
        $('#edit-satuan-produk').val(dataProduct.satuan);
    });
    
    $('.btn-edit-diskon').click(function() {
        let dataJSON = atob($(this).attr('data-diskon'));
        let dataDiskon = $.parseJSON(dataJSON);
        $('#edit-pemesanan-diskon').val(dataDiskon.pemesanan);
        $('#edit-potongan-diskon').val(dataDiskon.potongan);
    });

    $('.select2').addClass('d-none');
    $('.is-member').change(function() {
        let val = $(this).val();
        if (val == 'true') {
            $('#nama-pemesan').addClass('d-none').removeAttr('required');
            $('.select2').removeClass('d-none');
            $('#telp-pemesan').attr('readonly', 'readonly');
            $('#alamat-pemesan').attr('readonly', 'readonly');
        } else {
            $('#nama-pemesan').removeClass('d-none').attr('required', 'required');
            $('.select2').addClass('d-none');
            $('#telp-pemesan').removeAttr('readonly');
            $('#telp-pemesan').val('');
            $('#alamat-pemesan').removeAttr('readonly');
            $('#alamat-pemesan').val('');
        }
    });

    $('#select-nama-pemesan').change(function() {
        let childData = $(this).find('option:selected').attr('data-member');
        let dataJson = atob(childData);
        let dataMember = $.parseJSON(dataJson);
        $('#id-member-pemesan').val(dataMember.id_member);
        $('#telp-pemesan').val(dataMember.telp);
        $('#alamat-pemesan').val(dataMember.alamat);
    });

    $('.card-select-product .card-body:last-child').scrollbar();

    $('.btn-select-product').click(function() {
        let dataJSON = atob($(this).attr('data-product'));
        let dataProduct = $.parseJSON(dataJSON);
        let target = $('#list-pesanan');

        if (target.find('#product-'+dataProduct.id_produk).length == 0) {
            let templateList = `<tr id="product-${dataProduct.id_produk}">
                                        <td class="p-1">
                                            <span class="font-weight-bold">${dataProduct.nama}</span> <br>
                                            <span>@ ${textToRupiah(dataProduct.harga)}</span>

                                            <input type="hidden" name="produk[]" value="${dataProduct.id_produk}">
                                            <input type="hidden" name="nama_produk[]" value="${dataProduct.nama}">
                                            <input type="hidden" name="harga[]" value="${dataProduct.harga}" class="harga-produk">
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend"><button type="button" class="btn btn-outline-danger btn-xs btn-pesanan-update-qty btn-pesanan-min"><i class="fa fa-minus"></i></button></div>
                                                <input type="text" name="qty[]" value="1" class="form-control qty-pesanan" pattern="[0-9]{0,3}" title="Kuantiti hanya berisi angka">
                                                <div class="input-group-append"><button type="button" class="btn btn-outline-primary btn-xs btn-pesanan-update-qty btn-pesanan-plus"><i class="fa fa-plus"></i></button></div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <b>Rp. ${textToRupiah(dataProduct.harga)},-</b>
                                            <input type="hidden" name="subtotal[]" value="${parseFloat(dataProduct.harga)}" class="subtotal">
                                        </td>
                                        <td class="p-1 text-right">
                                            <a href="javascript:void(0)" class="text-danger remove-pesanan text-right"><i class="fa fa-trash"></i></a>
                                        </td>
                                </tr>`;
                target.append(templateList);
                
                let total = $('.total-pemesanan');
                let btnAntar = $('#btn-antar-pesanan');
                if (total.hasClass('d-none')) {
                    total.removeClass('d-none');
                }
                if (btnAntar.hasClass('d-none')) {
                    btnAntar.removeClass('d-none');
                }
                updateTotal();
        } else {
            let targetQty = $('#product-'+dataProduct.id_produk).find('.qty-pesanan');
            let targetSubtotal = $('#product-'+dataProduct.id_produk).find('.subtotal');
            operateQtyPesanan(targetQty, 'plus', targetSubtotal);
        }
    });

    $('body').on('click',  '.btn-pesanan-update-qty', function() {
        let targetQty = $(this).closest('td').find('.qty-pesanan');
        let targetSubtotal = $(this).closest('tr').find('.subtotal');

        if ($(this).hasClass('btn-pesanan-plus')) {
            operateQtyPesanan(targetQty, 'plus', targetSubtotal);
        } else if ($(this).hasClass('btn-pesanan-min')) {
            operateQtyPesanan(targetQty, 'min', targetSubtotal);
        }
    });

    $('body').on('input', '.qty-pesanan', function() {
        let targetSubtotal = $(this).closest('tr').find('.subtotal');
        operateQtyPesanan($(this), '', targetSubtotal, $(this).val());
    })

    let operateQtyPesanan = function(targetQty, operator = '', targetSubtotal, operate = 1) {
        let currentQty = parseFloat(targetQty.val());
        let priceOne = targetSubtotal.closest('tr').find('.harga-produk').val();

        let newQty = 0;
        if (operator !== '') {
            if (operator == 'plus') {
                newQty = currentQty + operate;
            } else if (operator == 'min') {
                if (currentQty > 1) {
                    newQty = currentQty - operate;
                } else {
                    newQty = currentQty;
                }
            }
        } else if (operator == '' && (operate > 1 || operate == 1)) {
            newQty = operate;
        }

        let newPrice = priceOne * newQty;

        targetQty.val(newQty);
        targetSubtotal.val(newPrice);
        targetSubtotal.prev().text('Rp. ' + textToRupiah(newPrice) + ',-');
        updateTotal();
    }

    $('body').on('click', '.remove-pesanan', function() {
        $(this).closest('tr').remove();
        if ($('#list-pesanan tr').length == 0) {
            $('.total-pemesanan').addClass('d-none');
            $('#btn-antar-pesanan').addClass('d-none');
        }
        updateTotal();
    });

    $('#antar').click(function() {
        updateTotal();
    })
    
    let updateTotal = function() {
        total = 0;
        $('.subtotal').each(function() {
           total = total + parseFloat($(this).val());
        });

        if ($('#antar').is(':checked')) {
            total = total + 9000;
        }

        $('#total-input').val(total);
        $('.total-all>h3').text('Rp. ' + textToRupiah(total) + ',-');

        if (total > 0) {
            unsave = true;
            check = true;
        } else {
            unsave = false;
            check = false;
        }
    }

    let textToRupiah = function(nominal) {
        nominal = nominal.toString().replace('.00', '');
        let rupiah = '';
        var angkarev = nominal.split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) {
            if(i%3 == 0) {
                rupiah += angkarev.substr(i,3)+'.';
            }
        }

        rupiah = rupiah.split('', rupiah.length-1).reverse().join('');
        return (rupiah.length < 1 ? '0' : rupiah);
    }

    window.onbeforeunload = function() {
        if (unsave) {
            return "Pesanan terisi, yakin merefresh halaman dan mengosongkan form?";
        }
    }

    $('#form-pesanan').submit(function() {
        if ($('.is-member').val() == 'true') {
            if ($('select-nama-pemesan').val() == '') {
                alert('Pemesan belum dipilih');
                check = false;
            }
        }

        if (total == 0 || unsave == false) {
            alert('Pesanan belum ditambahkan!');
            check = false;
        }

        if ($('#tunai').val() < total) {
            alert('Pastikan nominal pembayaran! \r\nPastikan sama dengan atau lebih dari jumlah total');
            check = false;
        } else {
            check = true;
        }

        if (check) {
            let formData = $(this).serializeArray();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(res) {
                    $('.struk-content').html(res);
                    $('#struk-modal').modal({show: true});
                }
            })
        }
        return false;
    });

    $('#btn-print-struk').click(function() {
        let url = $(this).attr('href');
        let kode = $('#kode-transaksi').text();
        unsave = false;
        
        window.open(url + kode, '_blank');
        setTimeout(() => {
            window.open('index.php?page=pesanan', '_self');
        }, 10);
    });

    $('.btn-detail-transaksi').click(function() {
        let kdt = $(this).attr('data-kt');
        $.ajax({
            url: 'detail_transaksi.php?k=' + kdt,
            method: 'GET',
            error: function(err) {
                console.log(err)
            },
            success: function(res) {
                $('.detail-content').html(res);
            }
        })
    });

    $('.btn-delete').click(function() {
        let destionation = $(this).attr('href');
        console.log(destionation);
        
        swal({
            title: 'Yakin Hapus?',
			text: "Data yang dihapus akan hilang permanen!",
            icon: 'warning',
            buttons:{
                confirm: {
                    text : 'Ya Hapus!',
                    className : 'btn btn-danger'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-primary'
                }
            }
        }).then((isDelete) => {
            if (isDelete) {
                window.location.href = destionation;
            } else {
                swal.close();
            }
        });
        return false;
    });

    $('.btn-edit-klasifikasi').click(function() {
        let dataKlasifikasi = $.parseJSON(atob($(this).attr('data-klasifikasi')));
        $('#id_klasifikasi').val(dataKlasifikasi.id_klasifikasi);
        $('#edit_nama').val(dataKlasifikasi.nama_klasifikasi);
    });

    $('.btn-edit-coa').click(function() {
        let dataCOA = $.parseJSON(atob($(this).attr('data-coa')));
        $('#edit-no-coa').val(dataCOA.no_coa);
        $('#edit-nama').val(dataCOA.nama_coa);
        if (dataCOA.gol === 'D') {
            $('#edit-debet').attr('checked', 'checked');
        } else {
            $('#edit-kredit').attr('checked', 'checked');
        }
        $('#edit-klasifikasi').val(dataCOA.klasifikasi);
    });

    $('#select-coa').change(function() {
        let dataSaldo = $(this).find('option:selected').attr('data-saldo');
        $('#saldo').val(dataSaldo);
    });
});