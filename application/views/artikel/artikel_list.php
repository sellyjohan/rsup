<!-- artikel_list.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2>Daftar Artikel</h2>

<?php if ($this->session->userdata('role') != 'user'): ?>
    <div class="controls">
        <button id="btnTambah">+ Tambah Artikel</button>
    </div>
<?php endif; ?>

<div id="alert-area" class="alert" style="display: none;"></div>

<div id="artikel-table">
    <table id="tabelArtikel">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="pagination" style="margin-top: 20px;">
        <button id="btnPrev">Sebelumnya</button>
        <span>Halaman <span id="currentPage">1</span></span>
        <button id="btnNext">Berikutnya</button>
    </div>
</div>

<script>
$(document).ready(function() {
    let currentPage = 1;
    const limit = 5;

    loadArtikel(currentPage);

    function loadArtikel(page) {
        $.ajax({
            url: `<?= base_url("api/artikel?page="); ?>${page}&limit=${limit}`,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer <?= $this->session->userdata("jwt_token"); ?>'
            },
            success: function(res) {
                if (res.status === 'success' && Array.isArray(res.data)) {
                    let html = '';
                    res.data.forEach(a => {
                        html += `
                            <tr>
                                <td>${a.title}</td>
                                <td>${a.content}</td>
                                <td><a href="${a.file_path}" target="_blank">Lihat File</a></td>
                                <td class="actions">
                                    <?php if ($this->session->userdata("role") != 'user'): ?>
                                    <button onclick="editArtikel(${a.id})">Edit</button>
                                    <?php endif; ?>
                                    <?php if ($this->session->userdata("role") == 'admin'): ?>
                                    <button onclick="deleteArtikel(${a.id})">Hapus</button>
                                    <?php endif; ?>
                                </td>
                            </tr>`;
                    });
                    $('#tabelArtikel tbody').html(html);
                    $('#currentPage').text(currentPage);
                    $('#btnNext').prop('disabled', res.data.length < limit);
                    $('#btnPrev').prop('disabled', currentPage === 1);
                } else {
                    $('#tabelArtikel tbody').html('<tr><td colspan="4">Tidak ada data.</td></tr>');
                }
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert(res?.message || 'Terjadi kesalahan saat mengambil data.');
                $('#tabelArtikel tbody').html('<tr><td colspan="4">Gagal memuat data.</td></tr>');
            }
        });
    }

    $('#btnTambah').click(function() {
        window.location.href = '<?= base_url("artikel/create"); ?>';
    });

    window.editArtikel = function(id) {
        window.location.href = `<?= base_url("artikel/create"); ?>/${id}`;
    };

    window.deleteArtikel = function(id) {
        if (!confirm('Yakin ingin menghapus artikel ini?')) return;
        $.ajax({
            url: `<?= base_url("api/artikel/delete"); ?>/${id}`,
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer <?= $this->session->userdata("jwt_token"); ?>'
            },
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    loadArtikel(currentPage);
                } else {
                    alert(res.message || 'Gagal menghapus artikel.');
                }
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert(res?.message || 'Terjadi kesalahan saat menghapus artikel.');
            }
        });
    };

    $('#btnNext').click(() => {
        currentPage++;
        loadArtikel(currentPage);
    });

    $('#btnPrev').click(() => {
        if (currentPage > 1) {
            currentPage--;
            loadArtikel(currentPage);
        }
    });
});
</script>
