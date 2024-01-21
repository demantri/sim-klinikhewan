<script>
    function addDetail()
    {
        let params = $("#myForm").serialize();
        $.ajax({
            url: '<?= base_url('pendaftaran/add_detail')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal('', response.msg, 'success');
                location.reload();
            }  
        });
    }

    function prosesSimpan() {
        // let params = $("#formDetail").serialize();
        let params = {
            id_pendaftaran : $("#id_pendaftaran").val(),
            pemilik : $("#pemilik").val(),
        }

        $.ajax({
            url: '<?= base_url('pendaftaran/simpan')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                })
            }  
        });
    }

    function hapusDetail(id) {
        console.log(id);
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang tersimpan tidak bisa dikembalikan",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((value) => {
            if (value) {
                $.ajax({
                    url: '<?= base_url('pendaftaran/hapus')?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id_detail : id
                    },
                    success: function(response) {
                        swal('', response.msg, 'success');
                        location.reload();
                    }  
                });
            }
        });
    }

    $(document).on("click", ".btn-hapus-detail", function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        console.log(id);
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang tersimpan tidak bisa dikembalikan",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((value) => {
            // if (value == 'simpan') {
            //     prosesSimpan();
            // }
            if (value) {
                hapusDetail();
                // Swal.fire({
                // title: "Deleted!",
                // text: "Your file has been deleted.",
                // icon: "success"
                // });
            }
        });
    });

    $(document).ready(function() {
        $("#table").DataTable();
        $("#nama_peliharaan").select2();
        $(".tgl_lahir").datepicker();

        $("#myForm").on("submit", function(e) {
            e.preventDefault();
            addDetail();
        });

        $("#formDetail").on("submit", function(e) {
            e.preventDefault();
            swal({
                title: "Apakah anda yakin?",
                text: "Data yang tersimpan tidak bisa dikembalikan",
                icon: "info",
                buttons: {
                    confirm: {
                        text: 'OK!',
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