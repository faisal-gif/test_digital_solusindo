<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#">Barang</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top: 7em;">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Barang</li>
            </ol>
        </nav>
        <div class="row" style="padding-bottom: 2em;">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="tambah_barang">Tambah</button>
            </div>
        </div>
        <table class="table table-striped table-barang">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Merek</th>
                    <th>Jenis Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>

    @include('modal-barang')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        const pegawaiIndex = "{{ route('barang.index') }}";
        const pegawaiStore = "{{ route('barang.store') }}";

        $(function () {


            var table = $('.table-barang').DataTable({
                processing: false,
                serverSide: false,
                responsive: true,
                ajax: pegawaiIndex,
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'merek',
                    name: 'merek',
                },
                {
                    data: 'jenis',
                    name: 'jenis',
                },
                {
                    data: 'stok',
                    name: 'stok',
                },
                {
                    data: 'harga',
                    name: 'harga',
                },

                {
                    data: 'keterangan',
                    name: 'keterangan',
                },
                {
                    data: 'action',
                    name: 'action',
                },
                ]
            });

            $('#tambah_barang').click(function () {
                $('#simpan').show();
                $('#update').hide();
                $('#idProduk').val('');
                $('#barangForm').trigger('reset');
                $('#modal-barang').modal('show');
            });

            $('#simpan').click(function (e) {
                e.preventDefault();

                var formData = new FormData($("#barangForm")[0]);

                var url = pegawaiStore;
                var method = "POST";

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: url,
                    type: "POST",
                    success: function (data) {
                        $('#barangForm').trigger("reset");
                        $('#modal-barang').modal('hide');
                        table.ajax.reload();

                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data Berhasil Disimpan.",
                            icon: "success",
                            timer: 3000
                        });
                    },
                    error: function (data) {
                        console.error('Error:', data);
                    }
                });
            });

            $('body').on('click', '.editBarang', function () {
                var barang_id = $(this).data('id');
                var url = '/barang/' + barang_id + '/edit';
                $.get(url, function (data) {
                    $('#simpan').hide();
                    $('#update').show();
                    $('#idProduk').val(data.id);
                    $('#merek').val(data.merek);
                    $('#jenis_produk').val(data.jenis);
                    $('#keterangan').val(data.keterangan);
                    $('#harga').val(data.harga);
                    $('#stok').val(data.stok);
                    $('#modal-barang').modal('show');
                })
            });

            $('#update').click(function (e) {
                e.preventDefault();

                var produk_id = $('#idProduk').val();
                var alamat = '/barang/' + produk_id + '/update';

                var formData = new FormData($("#barangForm")[0]);
         
                formData.append('_method', 'PUT');

                $.ajax({
                    url: alamat,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (response) {
                        table.ajax.reload();
                        $('#barangForm').trigger("reset");
                        $('#modal-barang').modal('hide');
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })


            $('body').on('click', '.deleteBarang', function () {
                var produk_id = $(this).data('id');
                var alamat = '/barang/' + produk_id + '/destroy';

                Swal.fire({
                    title: 'Apakah anda ingin menghapus produk ini ?',
                    text: 'Data yang Dihapus Tidak Dapat Dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: alamat,
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            },
                            error: function (data) {
                                console.log('Error:', data);
                                alert('Produk Gagal Di Hapus!');
                            }
                        });

                    }
                });
            });


        })
    </script>



</body>

</html>