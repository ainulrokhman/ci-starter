<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_open('', '', ['id' => isset($role) ? $role->id : 0]); ?>
                <div class="row mb-3">
                    <?= form_label($form_name['label']['text'], $form_name['input']['id'], $form_name['label']['attr']); ?>
                    <?= form_input($form_name['input']); ?>
                </div>
                <div class="row mb-3">
                    <?= form_label($form_description['label']['text'], $form_description['input']['id'], $form_description['label']['attr']); ?>
                    <?= form_input($form_description['input']); ?>
                </div>
                <?php if (isset($access_menu)) : ?>
                    <div class="mb-3">
                        <div class="form-label">
                            Akses Menu
                        </div>
                        <div>
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" id="select-all">
                                <span class="form-check-label">Pilih Semua</span>
                            </label>
                            <?php foreach ($access_menu as $ua) : ?>
                                <?php
                                $access = explode(',', $ua->roles);
                                $roles = array_filter($access, function ($value) {
                                    return $value !== '';
                                });
                                ?>
                                <label class="form-check">
                                    <input name="menu[]" value="<?= $ua->menu_id; ?>" class="form-check-input" type="checkbox" <?= in_array($role->name, $roles) ? "checked" : ""; ?>>
                                    <span class="form-check-label"><?= "$ua->menu"; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_submit('', 'Simpan', ['class' => 'btn btn-success form-control']); ?>
                <a href="<?= base_url('role/'); ?>" class="btn btn-info form-control">Batal</a>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        $('#select-all').on('click', function() {
            const checked = $(this).prop('checked')
            $('input[name="menu[]"]').prop('checked', checked);
        });
    });
</script>