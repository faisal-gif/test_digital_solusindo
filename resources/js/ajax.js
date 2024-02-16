$(function () {
    var table = $('.table-pegawai').DataTable({
        processing: true,
        serverSide: true,
        ajax: pegawaiIndex,
        columns: [
        {
            data: 'nomor_pegawai',
            name: 'nomor_pegawai',
        },
        {
            data: 'nama',
            name: 'nama',
        },
        {
            data: 'jenis_kelamin',
            name: 'jenis_kelamin',
        },
        {
            data: 'departemen',
            name: 'departemen',
        },
        {
            data: 'posisi',
            name: 'posisi',
        },
        {
            data: 'action',
            name: 'action',
        },
    ]
    });

    
})