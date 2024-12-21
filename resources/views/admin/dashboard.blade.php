<x-layout>
        <h1>Dashboard Admin</h1>
    <p>Selamat datang di halaman admin!</p>

    <h2>Daftar Pengguna</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button onclick="editUser({{ $user->id }})">Edit</button>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 id="edit-section" style="display:none;">Edit Pengguna</h2>
    <form id="edit-form" action="" method="POST" style="display:none;">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" id="user_id">
        <div>
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit">Simpan</button>
        <button type="button" onclick="cancelEdit()">Batal</button>
    </form>
    <script>
        function editUser(userId) {
            // Tampilkan form edit
            const editSection = document.getElementById('edit-section');
            const editForm = document.getElementById('edit-form');
            editSection.style.display = 'block';
            editForm.style.display = 'block';

            // Ambil data user untuk diisi ke form
            fetch(`/admin/users/${userId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user_id').value = data.id;
                    document.getElementById('name').value = data.name;
                    document.getElementById('email').value = data.email;
                    editForm.action = `/admin/users/${data.id}`;
                })
                .catch(error => console.error('Error:', error));
        }

        function cancelEdit() {
            // Sembunyikan form edit
            const editSection = document.getElementById('edit-section');
            const editForm = document.getElementById('edit-form');
            editSection.style.display = 'none';
            editForm.style.display = 'none';
        }
    </script>
</x-layout>