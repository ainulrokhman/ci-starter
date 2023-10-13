<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_open('', '', ['id' => isset($user_menu) ? $user_menu->id : 0]); ?>
                <div class="row mb-3">
                    <?= form_label('Menu', 'menu', ['class' => 'form-label']); ?>
                    <?= form_dropdown('menu', $select_menu, isset($user_menu) ? $user_menu->menu_id : "", ['class' => 'form-select']); ?>
                </div>
                <div class="row mb-3">
                    <?= form_label($form_title['label']['text'], $form_title['input']['id'], $form_title['label']['attr']); ?>
                    <?= form_input($form_title['input']); ?>
                </div>
                <div class="row mb-3">
                    <?= form_label($form_url['label']['text'], $form_url['input']['id'], $form_url['label']['attr']); ?>
                    <?= form_input($form_url['input']); ?>
                </div>
                <div class="row mb-3">
                    <div class="form-check">
                        <?= form_checkbox($s['form_attr']); ?>
                        <?= form_label("Is Active?", $s['form_attr']['id'], $s['label_attr']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_submit('', 'Simpan', ['class' => 'btn btn-success form-control']); ?>
                <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-info form-control">Batal</a>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>