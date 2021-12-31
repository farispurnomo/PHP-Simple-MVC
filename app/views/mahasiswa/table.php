<div class="table-responsive">
    <table class="table table-custom table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">NIM</th>
                <th scope="col" class="text-center align-middle">NAMA</th>
                <th scope="col" class="text-center align-middle">FOTO</th>
                <th scope="col" class="text-center align-middle" width="250"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data->datas)) : ?>
                <?php foreach ($data->datas as $mahasiswa) : ?>
                    <tr>
                        <td class="text-center align-middle" scope="row"><?= htmlspecialchars($mahasiswa['nim'], ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlspecialchars($mahasiswa['nama'], ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><img src="<?= BASE_URL . $mahasiswa['foto'] ?>" alt="" style="max-width: 75px; max-height: 75px;"/></td>
                        <td class="text-center align-middle">
                            <div class="dropdown position-static">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= BASE_URL . 'mahasiswa/edit/' . $mahasiswa['nim'] ?>"><i class="fa fa-edit text-success"></i> Sunting</a></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL . 'mahasiswa/destroy/' . $mahasiswa['nim'] ?>" onclick="return confirm('Konfirmasi untuk menghapus data ini?')"><i class="fa fa-times-circle text-danger"></i> Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">Data Tidak Ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<p class="text-center">
    Ditemukan Total: <?= $data->total_data ?: '0' ?> Data
</p>
<?= $data->paging_html ?>