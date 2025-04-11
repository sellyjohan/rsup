<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <meta charset="UTF-8">
    
</head>
<body>

    <h2>Daftar Users</h2>

    <div class="controls">
        <input type="text" id="search" placeholder="Cari user..." />
        <button onclick="loadUsers(1)">Cari</button>
        <button onclick="showAddForm()">Tambah User</button>
    </div>

    <div id="user-table"></div>

    <div id="form-container" style="display:none;">
        <h3 id="form-title">Tambah User</h3>
        <input type="hidden" id="user-id">
        <label>Username:</label>
        <input type="text" id="username">
        <label>Password:</label>
        <input type="password" id="password">
        <label>Full Name:</label>
        <input type="text" id="full_name">
        <label>Email:</label>
        <input type="email" id="email">
        <label>Role:</label>
        <select id="role">
            <option value="1">Admin</option>
            <option value="2">Editor</option>
            <option value="3">User</option>
        </select>
        <br>
        <button onclick="saveUser()">Simpan</button>
        <button onclick="hideForm()" style="background-color:#6c757d;">Batal</button>
    </div>

    <script>
      let currentPage = 1;
      let lastPage = 1;
      const token = "<?= $this->session->userdata('jwt_token'); ?>";
      if (!token) {
          alert('Token tidak tersedia. Silakan login ulang.');
      }

      function loadUsers(page = 1) {
        const search = document.getElementById('search').value;
        page = parseInt(page) || 1;
        currentPage = page;
        
        fetch(`<?= base_url('api/users') ?>?search=${search}&page=${page}`, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(res => res.json())
            .then(data => {
                const users = data.data;
                lastPage = data.last_page;

                let html = '<table><tr><th>Username</th><th>Full Name</th><th>Email</th><th>Role</th><th>Aksi</th></tr>';
                users.forEach(user => {
                    html += `<tr>
                        <td>${user.username}</td>
                        <td>${user.full_name}</td>
                        <td>${user.email}</td>
                        <td>${user.role_name}</td>
                        <td class="actions">
                            <button onclick="editUser(${user.id})">Edit</button>
                            <button onclick="deleteUser(${user.id})">Hapus</button>
                        </td>
                    </tr>`;
                });
                html += '</table>';

                html += `
                    <div style="margin-top:10px;">
                        <button onclick="loadUsers(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>Sebelumnya</button>
                        <span>Halaman ${currentPage} dari ${lastPage}</span>
                        <button onclick="loadUsers(${currentPage + 1})" ${currentPage === lastPage ? 'disabled' : ''}>Berikutnya</button>
                    </div>
                `;

                document.getElementById('user-table').innerHTML = html;
            });
      }

      function showAddForm() {
          document.getElementById('form-title').innerText = 'Tambah User';
          document.getElementById('user-id').value = '';
          document.getElementById('username').value = '';
          document.getElementById('password').value = '';
          document.getElementById('full_name').value = '';
          document.getElementById('email').value = '';
          document.getElementById('role').value = 'user';
          document.getElementById('form-container').style.display = 'block';
      }

      function hideForm() {
          document.getElementById('form-container').style.display = 'none';
      }

      function saveUser() {
        const id = document.getElementById('user-id').value;
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        const full_name = document.getElementById('full_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const role_id = document.getElementById('role').value;

        // Validasi sederhana
        if (username === '' || email === '') {
            alert('Username dan Full name wajib diisi.');
            return;
        }

        if (!validateEmail(email)) {
            alert('Format email tidak valid.');
            return;
        }

        const data = { username, password, full_name, email, role_id };
        const method = id ? 'PUT' : 'POST';
        const url = id ? `<?= base_url('api/users/') ?>${id}` : `<?= base_url('api/users') ?>`;

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token },
            body: JSON.stringify(data)
        }).then(res => res.json())
          .then(() => {
              loadUsers();
              hideForm();
          });
      } 

      function validateEmail(email) {
          const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return re.test(email.toLowerCase());
      }


      function editUser(id) {
          fetch(`<?= base_url('api/users/') ?>${id}`, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
              .then(res => res.json())
              .then(data => {
                  const user = data.data;
                  document.getElementById('form-title').innerText = 'Edit User';
                  document.getElementById('user-id').value = user.id;
                  document.getElementById('username').value = user.username;
                  document.getElementById('password').value = '';
                  document.getElementById('full_name').value = user.full_name;
                  document.getElementById('email').value = user.email;
                  document.getElementById('role').value = user.role_id;
                  document.getElementById('form-container').style.display = 'block';
              });
      }

      function deleteUser(id) {
        if (!confirm('Are you sure you want to delete this user?')) return;

        fetch(`<?= base_url('api/users') ?>/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer ' + token
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            alert('User deleted');
            loadUsers(currentPage);
          } else {
            alert('Failed to delete user');
          }
        });
      }
      
      window.onload = loadUsers;
    </script>
</body>
</html>
