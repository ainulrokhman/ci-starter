<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body table-responsive">
                
                <div class="row">
                    <div class="col-auto">
                        <a href="<?= base_url("user/add"); ?>" class="btn btn-success mb-3">
                            <i class="fas fa-plus me-1"></i>
                            <span>Tambah</span>
                        </a>
                    </div>
                </div>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Email / No HP</th>
                            <th>Role</th>
                            <th class="w-auto"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($users as $r) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $r->full_name; ?></td>
                                <td><?= $r->email; ?></td>
                                <td><?= $r->role_description; ?></td>
                                <td>
                                    <a href="<?= base_url('user/edit/') . $r->id; ?>" class="badge bg-warning" title="edit"><i class="fas fa-edit"></i></a>
                                    <?php if($user_template->role_name !== $r->role_name): ?>
                                        <div class="badge bg-danger hapus-riwayat" data-id="<?= $r->id; ?>"><i class="fas fa-trash"></i></div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" hidden id="delete">
                Anda yakin akan menghapus data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary submit-delete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
    $(document).on('click', '.hapus-riwayat', function() {
        const id = $(this).data('id')
        $('#delete').val(id)
        $('#modal-delete').modal('toggle')
    })
    $(document).on('click', '.submit-delete', function() {
        const id = $('#delete').val()
        window.location.href = "<?= base_url("user/delete/"); ?>" + id
    })
</script>