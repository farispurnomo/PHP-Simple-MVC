<section class="row">
    <div class="col-12">
        <h4>Data Pengguna</h4>
    </div>
</section>

<section class="row">
    <div class="col-12">
        <div class="my-3">
            <?= FlashData::getMessage('msg') ?>
        </div>
    </div>
</section>

<section class="row mt-3">
    <div class="col-lg-9">
        <a href="<?= BASE_URL . 'user/create' ?>" class="btn btn-custom-primary mr-3"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="col-lg-3">
        <div class="input-group mt-3 mt-lg-0 input-group-custom mb-3">
            <input type="text" class="form-control" aria-label="Pencarian" placeholder="Pencarian ...." id="search" oninput="renderTable()">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
    </div>
</section>

<section class="row mt-3">
    <div class="col-12">
        <div id="result"></div>
    </div>
</section>

<div class="modal fade modal-custom" id="modal-delete" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title font-italic">Hapus Data?</div>
            </div>
            <div class="modal-body py-4">
                <div class="text-center">Konfirmasi untuk menghapus <br /> data ini ?</div>
                <div class="text-center pt-4">
                    <a href="#" type="button" id="modal-ok" class="btn btn-custom-primary">OK</a>
                    <button type="button" class="btn btn-custom-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function renderTable(page = 1) {
        const search = $('#search').val()
        $.ajax({
            url: '<?= BASE_URL ?>' + 'user/show',
            method: 'post',
            data: {
                search: search,
                page: page
            },
            beforeSend: function() {
                $('#result').html('<div class="text-center"><span class="px-2 py-2 border"><i class="fa fa-spinner fa-spin"></i> Loading</span></div>')
            },
            success: function(response) {
                $('#result').html(response)
            },
            error: function(err) {

            }
        })
    }

    $(document).ready(function() {
        renderTable()

        $(document).on('click', '.delete-item', function() {
            $('#modal-delete').modal('show')
            const href = $(this).data('href')
            $('#modal-ok').attr('href', href)
        })
    })
</script>