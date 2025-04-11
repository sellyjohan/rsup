<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const BASE_URL = "<?= base_url(); ?>";
    const JWT_TOKEN = "<?= $this->session->userdata('jwt_token'); ?>";

    const pathParts = window.location.pathname.split('/');
    const lastSegment = pathParts[pathParts.length - 1];
    const artikelId = /^\d+$/.test(lastSegment) ? lastSegment : null;
    
</script>

<div class="container">
    <h2 id="formTitle">Tambah Artikel</h2>
    <form id="formArtikel" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">

        <input type="hidden" name="file_url" id="file_url">

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="content" class="form-control" id="content" required></textarea>
        </div>

        <div class="form-group">
            <label>File (PDF / Gambar)</label>
            <input type="file" name="file" class="form-control" id="file">
            <div id="filePreview" style="margin-top: 5px;"></div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('artikel'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
$(document).ready(function () {

    if (artikelId) {
        $('#formTitle').text('Edit Artikel');
        $('#id').val(artikelId);

        $.ajax({
            url: `${BASE_URL}api/artikel/${artikelId}`,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + JWT_TOKEN
            },
            success: function (res) {
                const data = res.data;
                $('#title').val(data.title);
                $('#content').val(data.content);
                $('#file_url').val(data.file_path);

                if (data.file_path) {
                    $('#filePreview').html(
                        `<p>File saat ini: ${data.file_path}</p>`
                    );
                }
            },
            error: function () {
                alert('Gagal memuat data artikel.');
            }
        });
    }
});

$('#formArtikel').submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const isEdit = $('#id').val();
    const fileInput = $('#file')[0];
    const file = fileInput.files[0];
    const apiUrl = isEdit
        ? `${BASE_URL}api/artikel/update/${isEdit}`
        : `${BASE_URL}api/artikel/create`;

    if (file) {
        const validTypes = ['application/pdf', 'image/png', 'image/jpeg'];
        if (!validTypes.includes(file.type)) {
            alert('File harus berupa PDF atau gambar!');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB');
            return;
        }
    }

    $.ajax({
        url: apiUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'Authorization': 'Bearer ' + JWT_TOKEN
        },
        success: function (res) {
            alert(res.message);
            window.location.href = BASE_URL + 'artikel';
        },
        error: function (xhr) {
            const res = xhr.responseJSON;
            alert(res?.message ?? 'Terjadi kesalahan saat menyimpan artikel.');
        }
    });
});
</script>
