<script>
    // function showContentObat() {
    //     $("#content_obat").removeClass('d-none');
    // }

    function prosesSimpan() {
        let params = $("#myform").serialize();

        $.ajax({
            url: '<?= base_url('rekam-medis/simpan')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    // location.reload();
                    window.location.href = '<?= base_url('rekam-medis/view') ?>';
                })
            }  
        });
    }

    function inputHargaObat(key1, key2) {
        let value = $("#" + key1).val();
        $.ajax({
            url: '<?= base_url('rekam-medis/getObat')?>',
            type: 'post',
            data: {
                id_obat : value
            },
            success: function(response) {
                // console.log(value);
                // stok
                $("#btn-submit").prop("disabled", false);
                
                // let resep = response.resep;

                if (value == '') {
                    $("#" + key2).val('');
                } else {
                    if (response.resep <= 0) {
                        swal('Gagal', 'Stok '+ response.nama_obat +' tidak boleh kurang dari sama dengan 0!', 'warning');
                        $("#btn-submit").prop("disabled", true);
                        $("#" + key2).val('');
                    } else {
                        let harga = response.harga;
                        $("#" + key2).val(harga);
                        $("#btn-submit").prop("disabled", false);   
                    }
                }
            }
        });
    }

    function prosesSimpanPrint() {
        let params = {
            id_rekam_medis : $("#id_rekam_medis").val(),
            tanggal : $("#tanggal").val(),
            pemilik : $("#pemilik").val(),
            peliharaan : $("#peliharaan").val(),
            dokter : $("#dokter").val(),
            jasa_dokter : $("#jasa_dokter").val(),
            total_transaksi : $("#total_transaksi").val(),
            grandtotal : $("#grandtotal").val(),
            temperatur_rektal : $("#temperatur_rektal").val(),
            frekuensi_pulsus : $("#frekuensi_pulsus").val(),
            frekuensi_nafas : $("#frekuensi_nafas").val(),
            berat_badan : $("#berat_badan").val(),
            kondisi_umum : $("#kondisi_umum").val(),
            kulit_bulu : $("#kulit_bulu").val(),
            membran_mukosa : $("#membran_mukosa").val(),
            kelenjar_limfa : $("#kelenjar_limfa").val(),
            muskuloskeletal : $("#muskuloskeletal").val(),
            sistem_sirkulasi : $("#sistem_sirkulasi").val(),
            sistem_respirasi : $("#sistem_respirasi").val(),
            sistem_digesti : $("#sistem_digesti").val(),
            sistem_urogenital : $("#sistem_urogenital").val(),
            sistem_saraf : $("#sistem_saraf").val(),
            mata_telinga : $("#mata_telinga").val(),
        }

        $.ajax({
            url: '<?= base_url('rekam-medis/simpan')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    cetak();
                })
            }  
        });
    }

    function cetak() {
        let id_rekam_medis = $("#id_rekam_medis").val();

        $.ajax({
            url: '<?= base_url('rekam-medis/cetak')?>',
            method: 'post',
            // dataType: 'text',
            xhr: function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 2) {
                        if (xhr.status == 200) {
                            xhr.responseType = "blob";
                        } else {
                            xhr.responseType = "text";
                        }
                    }
                };
                return xhr;
            },
            data: {
                id_rekam_medis: id_rekam_medis
            },
            success: function(data, status, xhr) {
                // swal.close();
                var fileName = xhr.getResponseHeader('content-disposition').split('filename=')[
                    1].split(';')[0];
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = fileName.replace(/\"/g, '');
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);

                // prosesSimpan();
                location.reload();
            },
        });
    }

    $(document).ready(function() {
        $("#table").DataTable();

        $("#pemilik").on("change", function() {
            // let value = $("#pemilik").val();
            // console.log(value); // untuk debuging, kalau di php nama print_r($variabel);exit;
            $.ajax({
                url: '<?= base_url('rekam-medis/get-peliharaan')?>',
                type: 'post', // untuk ngirim data
                data: {
                    id_pemilik : $("#pemilik").val(),
                },
                success: function(response) { // callback
                    // console.log(response);
                    let data = response;
                    let option = '';
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            option += `<option value="${data[i].id_hewan}">${data[i].nama_peliharaan}</option>`;
                        }
                        $("#peliharaan").html(option);
                    } else {
                        $("#peliharaan").html(option);
                    }
                }
            });
        });

        $("#myform").on("submit", function(e) {
            e.preventDefault();
            swal({
                text: "Apakah anda yakin?",
                icon: "info",
                buttons: {
                    confirm: {
                        text: 'Simpan Data',
                        value: 'selesai',
                    },
                    // print: {
                    //     text: 'Bayar & print',
                    //     value: 'selesai_print',
                    // }
                },
            }).then((value) => {
                if (value == 'selesai') {
                    prosesSimpan();
                } 
                // else if (value == 'selesai_print') {
                //     prosesSimpanPrint();
                // }
            });
        });
        
        let kode_booking = $("#kode_booking").val();
        if (kode_booking !== '') {
            $.ajax({
                url: '<?= base_url('find-booking')?>',
                type: 'post',
                data: {
                    kode_booking : kode_booking
                },
                success: function(response) {
                    $("#nama_pemilik").val(response.nama_lengkap);
                    $("#pemilik").val(response.id_customer).trigger('change');
                }
            })
        }

        let max = 5;
        let button = $("#button_tambah_obat");
        let x = 1;
        let wrapper = $(".wrapper_obat");

        $(button).on("click", function(e) {
            e.preventDefault();
            if (x < max) {
                x++;
                let html = `
                <div class="wrapper_obat mt-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <select name="obat[]" id="select_obat_${x}" class="form-control obat" onchange="inputHargaObat('select_obat_${x}', 'obat_${x}')" required>
                                <option value="" selected disabled>Pilih</option>
                                <?php foreach ($obat as $item) { ?>
                                <option value="<?= $item->id_obat ?>"><?= $item->nama_obat ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" class="harga_obat" name="harga_obat[]" id="obat_${x}">
                        </div>
                        <div class="col-lg-3">
                            <input type="number" name="qty[]" class="form-control qty" min="1" value="1" placeholder="Masukan QTY">
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-danger remove_field" type="button">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
                $(wrapper).append(html);
            }
        });

        $(wrapper).on("click",".remove_field", function(e) {
            e.preventDefault();
            $(this).parent('div')
                .parent('div')
                .parent('div')
                .remove();
            x--;
        });
    });
</script>