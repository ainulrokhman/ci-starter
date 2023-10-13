<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_open('', '', ['id' => isset($user_menu) ? $user_menu->id : 0]); ?>
                <div class="row mb-3">
                    <?= form_label($form_menu['label']['text'], $form_menu['input']['id'], $form_menu['label']['attr']); ?>
                    <?= form_input($form_menu['input']); ?>
                </div>
                <div class="row mb-3">
                    <?= form_label($form_icon['label']['text'], $form_icon['input']['id'], $form_icon['label']['attr']); ?>
                    <?= form_input($form_icon['input']); ?>
                </div>
                <div class="row mb-3">
                    <?= form_label($form_index['label']['text'], $form_index['input']['id'], $form_index['label']['attr']); ?>
                    <?= form_input($form_index['input']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_submit('', 'Simpan', ['class' => 'btn btn-success form-control']); ?>
                <a href="<?= base_url('menu/'); ?>" class="btn btn-info form-control">Batal</a>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>