<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_open('', '', ['id' => isset($user) ? $user->id : 0]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= form_label($form_fullname['label']['text'], $form_fullname['input']['id'], $form_fullname['label']['attr']); ?>
                            <?= form_input($form_fullname['input']); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= form_label($form_email['label']['text'], $form_email['input']['id'], $form_email['label']['attr']); ?>
                            <?= form_input($form_email['input']); ?>
                        </div>
                    </div>
                    <?php if (isset($user)) : ?>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= form_label('Status', 'is_active', ['class' => 'form-label']); ?>
                                <?= form_dropdown('is_active', [0 => "Tidak Aktif", 1 => "Aktif"], $user->is_active ?? 1, ['class' => 'form-select', 'id' => 'role']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= form_label('Role', 'role', ['class' => 'form-label required']); ?>
                            <?= form_dropdown('role', $select_role, $user->role_id ?? "", ['class' => 'form-select', 'id' => 'role', 'required' => 'required']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control"><?= isset($user) ? $user->alamat : null; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= form_label($form_password['label']['text'], $form_password['input']['id'], $form_password['label']['attr']); ?>
                            <?= form_input($form_password['input']); ?>
                            <span class="text-danger"><?= form_error('password'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= form_label($form_cpassword['label']['text'], $form_cpassword['input']['id'], $form_cpassword['label']['attr']); ?>
                            <?= form_input($form_cpassword['input']); ?>
                            <span class="text-danger"><?= form_error('cpassword'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?= form_submit('', 'Simpan', ['class' => 'btn btn-success form-control']); ?>
                <a href="<?= base_url('user/'); ?>" class="btn btn-info form-control">Batal</a>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>