<script>
    function getDetail() {
        let id_pendaftaran = $("#id_pendaftaran").val();
        $.ajax({
            url: "<?= base_url('pendaftaran/getDetail')?>",
            type: "post",
            dataType: "json",
            data: {
                id_pendaftaran : id_pendaftaran
            },
            success: function(response) {
                let data = response;
                let jumlah = data.length;
                let x = 1;

                let inputField = '';
                for (let i in data) {
                    if (i == 0) {
                        inputField += `<div class="wrapper_peliharaan mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="nama_peliharaan[]" class="form-control nama_peliharaan" value="${data[i].nama_peliharaan}" placeholder="Masukan nama peliharaan" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="jenis_peliharaan[]" class="form-control jenis_peliharaan" id="jenis_peliharaan_${i}" required>
                                            <option value="" disabled selected>- Pilih jenis peliharaan -</option>
                                            <?php foreach ($hewan as $item) { ?>
                                            <option value="<?= $item->id_hewan ?>"><?= $item->spesies .' - '. $item->ras ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="warna[]" class="form-control" placeholder="Masukan warna" required value="${data[i].warna}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="postur[]" class="form-control" placeholder="Masukan postur" required value="${data[i].postur}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="tgl_lahir[]" class="form-control tgl_lahir" placeholder="Masukan tgl lahir" required value="${data[i].tanggal_lahir}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <button class="btn btn-outline-success" id="button_tambah_peliharaan" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    } else {
                        inputField += `<div class="wrapper_peliharaan">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="nama_peliharaan[]" class="form-control nama_peliharaan" value="${data[i].nama_peliharaan}" placeholder="Masukan nama peliharaan">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="jenis_peliharaan[]" id="jenis_peliharaan_${i}" class="form-control jenis_peliharaan">
                                            <option value="" disabled selected>- Pilih jenis peliharaan -</option>
                                            <?php foreach ($hewan as $item) { ?>
                                            <option value="<?= $item->id_hewan ?>"><?= $item->spesies .' - '. $item->ras ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="warna[]" class="form-control" placeholder="Masukan warna" value="${data[i].warna}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="postur[]" class="form-control" placeholder="Masukan postur" value="${data[i].postur}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="text" name="tgl_lahir[]" class="form-control tgl_lahir" placeholder="Masukan tgl lahir" value="${data[i].tanggal_lahir}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <button class="btn btn-outline-danger remove_field" type="button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                }
                $("#inputField").html(inputField);

                $(".wrapper_peliharaan").on("click",".remove_field", function(e) {
                    e.preventDefault();
                    $(this).parent('div')
                        .parent('div')
                        .parent('div')
                        .remove();
                    x--;
                });

                selectedValue(data);
                addRowField(jumlah);
            }
        });
    }

    function selectedValue(data) {
        let jumlah = data.length;
        let jenis_peliharaan = $("#jenis_peliharaan_");
        for (let i = 0; i < jumlah; i++) {
            $("#jenis_peliharaan_" + i).val(data[i].id_hewan).trigger('change');    
        }
    }

    function addRowField(jumlah) {
        let max = 5;
        let button = $("#button_tambah_peliharaan");
        let x = jumlah;
        let wrapper = $("#inputField");

        $(button).on("click", function(e) {
            e.preventDefault();
            if (x < max) {
                x++;
                let html = `<div class="wrapper_peliharaan">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="nama_peliharaan[]" class="form-control nama_peliharaan" placeholder="Masukan nama peliharaan">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="jenis_peliharaan[]" id="jenis_peliharaan_${x}" class="form-control jenis_peliharaan">
                                    <option value="" disabled selected>- Pilih jenis peliharaan -</option>
                                    <?php foreach ($hewan as $item) { ?>
                                    <option value="<?= $item->id_hewan ?>"><?= $item->spesies .' - '. $item->ras ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <input type="text" name="warna[]" class="form-control" placeholder="Masukan warna">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <input type="text" name="postur[]" class="form-control" placeholder="Masukan postur">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <input type="text" name="tgl_lahir[]" class="form-control tgl_lahir" placeholder="Masukan tgl lahir">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <button class="btn btn-outline-danger remove_field" type="button">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
                $(wrapper).append(html);
                $(".tgl_lahir").datepicker({
                    dateFormat: "yy-mm-dd"
                });
            }

            $(".wrapper_peliharaan").on("click",".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div')
                    .parent('div')
                    .parent('div')
                    .remove();
                x--;
            });
        });
    }

    function prosesSimpan() {
        let params = $("#myForm").serialize();
        $.ajax({
            url: '<?= base_url('pendaftaran/update')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    window.location.href = '<?= base_url('pendaftaran') ?>';
                })
            }  
        });
    }
    $(document).ready(function() {
        getDetail();
        
        $(".tgl_lahir").datepicker({
            dateFormat: "yy-mm-dd"
        });

        $("#myForm").on("submit", function(e) {
            e.preventDefault();
            swal({
                title: "Peringatan",
                text: "Data yang diubah tidak dapat dikembalikan, anda yakin?",
                icon: "info",
                buttons: {
                    confirm: {
                        text: 'Simpan Perubahan',
                        value: 'simpan',
                    },
                },
            }).then((value) => {
                if (value == 'simpan') {
                    prosesSimpan();
                }
            });
        });
    });
</script>