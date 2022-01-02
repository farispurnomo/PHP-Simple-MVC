<div class="table-responsive">
    <table class="table table-custom table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">ID</th>
                <th scope="col" class="text-center align-middle">NAMA</th>
                <th scope="col" class="text-center align-middle">FOTO</th>
                <th scope="col" class="text-center align-middle" width="250"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data->datas)) : ?>
                <?php foreach ($data->datas as $user) : ?>
                    <tr>
                        <td class="text-center align-middle" scope="row"><?= htmlspecialchars($user['user_id'], ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><?= htmlspecialchars($user['user_name'], ENT_QUOTES) ?></td>
                        <td class="text-center align-middle"><img src="<?= BASE_URL . $user['user_avatar'] ?>" alt="" style="max-width: 75px; max-height: 75px;" /></td>
                        <td class="text-center align-middle">
                            <div class="dropdown position-static">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= BASE_URL . 'user/edit/' . $user['user_id'] ?>"><i class="fa fa-edit text-success"></i> Sunting</a></li>
                                    <li><a class="dropdown-item delete-item" href="#" data-href="<?= BASE_URL . 'user/destroy/' . $user['user_id'] ?>"><i class="fa fa-times-circle text-danger"></i> Hapus</a></li>
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