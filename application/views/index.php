

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Event Kampus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container">
  <?php $this->load->view('common/navbar'); ?>  <h2>KAMPUS PUNYA CERITA</h2>
    <h4>Daftar Event</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['nama_event'] ?></td>
                    <td><?= $event['tanggal'] ?></td>
                    <td>
                        <form action="<?= base_url('pendaftaran/store') ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $event['id'] ?>">
                            <input type="hidden" name="mahasiswa_id" value="<?= $this->session->userdata('id') ?>">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('event/laporan') ?>" class="btn btn-info mt-3">Lihat Laporan Peserta</a>

    <a class="dropdown-item" href="<?= base_url('mahasiswa/logout') ?>">Logout</a>
</body>
</html>
