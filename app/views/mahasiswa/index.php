<section class="row mt-3">
    <div class="col-12">
        <h4>Data Mahasiswa</h4>
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
        <a href="<?= BASE_URL . 'mahasiswa/create' ?>" class="btn btn-custom-primary mr-3"><i class="fa fa-plus"></i> Tambah</a>
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

<script>
    function renderTable(page = 1) {
        const search = $('#search').val()
        $.ajax({
            url: '<?= BASE_URL ?>' + 'mahasiswa/show',
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
    })
</script>