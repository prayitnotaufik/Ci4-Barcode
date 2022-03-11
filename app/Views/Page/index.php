<?= $this->extend('layout.php'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>List Produk</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-3 mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Produk
    </button>
    <button type="button" class="btn btn-primary mt-3 mb-5" data-bs-toggle="modal" data-bs-target="#importmodal">
        Import File Produk
    </button>
    <a href="page/exportData" class="btn btn-primary mt-3 mb-5">Export Data Produk (.pdf)</a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/page/tambah" method="POST">
                    <?= @csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Produk</label>
                            <input type="text" class="form-control" id="kode" name="kode">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="importmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import FIle Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="page/import" method="POST" enctype="multipart/form-data">
                    <?= @csrf_field(); ?>
                    <div class="modal-body">
                        <small class="text-muted">
                            Ketentuan Upload File <br>
                            1. Harus berupa file excel <br>
                            2. Data excel dengan header Kode, Nama dan Harga
                        </small>
                        <p>Contoh file : </p>
                        <img src="aicafile.jpg" alt="" srcset="">
                        <div class="mb-3 mt-2">
                            <label for="formFile" class="form-label">Import File Produk .xls/.xlsx</label>
                            <input class="form-control" type="file" id="formFile" name="file" required accept=".xls, .xlsx">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Barcode</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            use Picqer\Barcode\BarcodeGeneratorHTML;

            $i = 1 ?>
            <?php foreach ($produk as $p) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $p['kode']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td>Rp.<?= $p['harga']; ?>,-</td>
                    <td>
                        <?php
                        $barcode = new BarcodeGeneratorHTML();
                        echo $barcode->getBarcode($p['kode'], $barcode::TYPE_CODE_128);
                        ?>
                    </td>
                    <td><a href="page/delete/<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda Yakin?')">Delete</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>