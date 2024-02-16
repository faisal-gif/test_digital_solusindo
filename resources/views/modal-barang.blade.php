<!-- Modal -->
<div class="modal fade" id="modal-barang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="barangForm" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" id="idProduk" required>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="merek" class="form-label">Merek</label>
                            <input type="text" class="form-control" id="merek" name="merek" aria-describedby="merek" required>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_produk" class="form-label">Jenis Produk</label>
                            <select id="jenis_produk" class="form-select" id="jenis_produk" name="jenis_produk" aria-describedby="jenis_produk" required>
                                <option value="kebutuhan Sehari-hari">Kebutuhan Sehari-hari</option>
                                <option value="belanjaan">Belanjaan</option>
                                <option value="khusus">Khusus</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" aria-describedby="harga" required>
                        </div>
                        <div class="col-6">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" aria-describedby="stok" required>
                        </div>
                        
                        <div class="col-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10"></textarea>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                    <button type="submit" class="btn btn-warning" id="update">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>