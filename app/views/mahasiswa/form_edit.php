<section class="row">
    <div class="col-12">
        <h4>Form Sunting Data Mahasiswa</h4>
    </div>
</section>

<section class="row mt-3">
    <div class="col-12">
        <div class="my-3">
            <?= FlashData::getMessage('msg') ?>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-md-6">
        <form action="<?= BASE_URL . 'mahasiswa/update/' . @$data['nim'] ?>" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="edtNim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" id="edtNim" class="form-control" value="<?= @$data['nim'] ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="edtNama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" id="edtNama" class="form-control" name="nama" value="<?= @$data['nama'] ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-2 col-sm-10">
                    <img id="prevImage" src="<?= BASE_URL . (@$data['foto'] ?: '/img/avatar-placeholder.png') ?>" alt="" style="max-width: 300px; max-height: 300px;">
                </div>
            </div>
            <div class="row mb-3">
                <label for="edtFoto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" id="edtFoto" class="form-control" name="foto" accept=".svg, .png, .jpeg, .jpg" onchange="document.getElementById('prevImage').src = window.URL.createObjectURL(this.files[0])">
                </div>
            </div>
            <div class="me-1 mt-5 text-end">
                <a href="<?= BASE_URL . 'mahasiswa' ?>" class="btn btn-custom-secondary">Batal</a>
                <button type="submit" class="btn btn-custom-primary">Simpan</button>
            </div>
        </form>
    </div>
</section>