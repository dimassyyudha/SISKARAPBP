<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>SISKARA - Buat Usulan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi untuk sidebar */
        .sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar-closed {
            transform: translateX(-100%);
        }
        /* Memastikan sidebar dan konten utama memenuhi tinggi layar */
        .flex-container {
            min-height: 100vh;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-gradient-to-r from-sky-500 to-blue-600 text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <!-- Tombol menu untuk membuka sidebar -->
            <button onclick="toggleSidebar()" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Logo dan judul aplikasi -->
            <h1 class="text-xl font-bold">SISKARA</h1>
        </div>
        <nav class="space-x-4">
            <a href="{{ url('/') }}" class="hover:underline">Home</a>
            <a href="{{ url('/about') }}" class="hover:underline">About</a>
        </nav>
    </header>

    <div class="flex flex-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-1/5 bg-sky-500 p-4 text-white sidebar fixed lg:static">
            <!-- profil -->
            <div class="p-3 pb-1 bg-gray-300 rounded-3xl text-center mb-6">
                <div class="w-24 h-24 mx-auto bg-gray-400 rounded-full mb-3 bg-center bg-contain bg-no-repeat"
                     style="background-image: url(img/fsm.jpg)">
                </div>
                <h2 class="text-lg text-black font-bold">Ucok, S.Kom</h2>
                <p class="text-xs text-gray-800">NIP 002</p>
                <p class="text-sm bg-sky-700 rounded-full px-3 py-1 mt-2 font-semibold">Bagian Akademik</p>
                <a href="{{ route('login') }}" class="text-sm w-full bg-red-700 py-1 rounded-full mb-4 mt-2 text-center block font-semibold hover:bg-opacity-70">Logout</a>
            </div>
            <nav class="space-y-4">
                <a href="/dashboard-ba" class="block py-2 px-3 bg-gray-300 rounded-xl text-gray-700 hover:bg-gray-700 hover:text-white">Dashboard</a>
                <a href="/editruang" class="block py-2 px-3 bg-gray-300 rounded-xl text-gray-700 hover:bg-gray-700 hover:text-white">Edit Ruang Kuliah</a>
                <a href="/buatusulan" class="block py-2 px-3 bg-sky-800 rounded-xl text-white hover:bg-opacity-70">Buat Usulan</a>
                <a href="/daftarusulan" class="block py-2 px-3 bg-gray-300 rounded-xl text-gray-700 hover:bg-gray-700 hover:text-white">Daftar Usulan</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="w-full lg:w-4/5 lg:ml-auto p-8">
            <!-- Judul Halaman -->
            <h1 class="text-3xl font-bold mb-6">Buat Usulan Pengaturan Ruang Kuliah</h1>

            <!-- Form Usulan -->
            <div class="bg-gray-200 p-6 rounded-lg mb-6">
                <!-- Tahun Ajaran -->
                <div class="mb-4">
                    <label for="tahun-ajaran" class="block text-lg font-semibold text-gray-700 mb-2">Tahun Ajaran</label>
                    <select id="tahun-ajaran" class="w-full p-2 border border-gray-300 rounded-lg">
                        @foreach($tahunAjaranList as $tahunAjaran)
                            <option value="{{ $tahunAjaran->id_tahun }}">{{ $tahunAjaran->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown Program Studi -->
                <div class="mb-4">
                    <label for="program-studi" class="block text-lg font-semibold text-gray-700 mb-2">Program Studi</label>
                    <select id="program-studi" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($programStudiList as $prodi)
                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Ruang Kuliah -->
                <div class="mb-4">
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Ruang Kuliah</label>
                    <div id="daftar-ruang" class="grid grid-cols-2 gap-2">
                        @foreach($ruangList as $ruang)
                            <label class="flex items-center">
                                <input type="checkbox" name="ruang-kuliah" value="{{ $ruang->id_ruang }}" class="mr-2">
                                {{ $ruang->id_ruang }}
                            </label>
                        @endforeach
                    </div>
                </div>

                


                <!-- Tombol Tambah ke Kanan -->
                <div class="flex justify-end">
                    <button onclick="tambahRuang()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Tambah Ruang</button>
                </div>
            </div>

            <!-- Tabel Rekap Ruang per Program Studi -->
            <h2 class="text-2xl font-bold mb-4">Rekap Ruang Kuliah per Program Studi</h2>
            <div class="mb-4">
                <label for="filter-status" class="block text-lg font-semibold text-gray-700 mb-2">Filter Status Ruang</label>
                <select id="filter-status" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">Semua</option>
                    <option value="Sudah Ada">Sudah Ada Ruang</option>
                    <option value="Belum Ada">Belum Ada Ruang</option>
                </select>
            </div>
            <table id="rekap-ruang-table" class="table-auto min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">No</th>
                        <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Program Studi</th>
                        <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Jumlah Ruang</th>
                        <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody id="rekap-ruang">
                    @foreach($programStudiList as $index => $prodi)
                        <tr>
                            <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center">{{ $index + 1 }}</td>
                            <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center">{{ $prodi->nama_prodi }}</td>
                            <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center" id="jumlah-{{ $prodi->id_prodi }}">0</td>
                            <td class="px-2 py-2 border-b border-gray-200 text-center">
                                <button onclick="tampilkanDetail('{{ $prodi->id_prodi }}')" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600">Detail</button>
                            </td>
                            <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center" id="status-{{ $prodi->id_prodi }}">Belum Ada</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


            <!-- Tabel Detail Ruang Kuliah per Program Studi -->
            
            
            <div class="mt-6" id="detail-ruang-container" style="display: none;">
                <h3 class="text-xl font-bold mb-4" id="program-studi-judul"></h3>
                <table id="rekap-ruang-table" class="table-auto min-w-full bg-white border border-gray-200 text-sm">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">No</th>
                            <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Ruang Kuliah</th>
                            <th class="px-2 py-2 border-b border-gray-200 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail-ruang">
                        <!-- Daftar ruang akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>

            <!-- Tombol Simpan di Paling Bawah -->
            <div class="flex justify-end mt-6">
                <button onclick="simpanUsulan()" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Simpan Usulan</button>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-sky-500 to-blue-600 text-white text-center p-4 absolute w-full">
        <hr>
        <p class="text-sm text-center">&copy; Siskara Inc. All rights reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        const programStudiRuang = {};
        let currentStatus = 'belum diajukan';
    
        function tambahRuang() {
            if (currentStatus === 'disetujui') {
                alert('Usulan telah disetujui dan tidak dapat diubah.');
                return;
            }
    
            const programStudiId = $('#program-studi').val();
            const programStudiText = $('#program-studi option:selected').text();
    
            const ruangKuliahCheckboxes = document.querySelectorAll('input[name="ruang-kuliah"]:checked');
            const selectedRuang = Array.from(ruangKuliahCheckboxes).map(checkbox => checkbox.value);
    
            if (!programStudiId) {
                alert('Silakan pilih program studi.');
                return;
            }
    
            if (selectedRuang.length === 0) {
                alert('Silakan pilih minimal satu ruang kuliah.');
                return;
            }
    
            if (!programStudiRuang[programStudiId]) {
                programStudiRuang[programStudiId] = {
                    nama_prodi: programStudiText,
                    ruang: []
                };
            }
    
            selectedRuang.forEach(ruangKuliah => {
                if (!programStudiRuang[programStudiId].ruang.includes(ruangKuliah)) {
                    programStudiRuang[programStudiId].ruang.push(ruangKuliah);
                }
            });
    
            updateJumlahRuang(programStudiId);
            updateDetailTabel(programStudiId);
    
            // Reset checkbox setelah menambahkan
            document.querySelectorAll('input[name="ruang-kuliah"]').forEach(checkbox => checkbox.checked = false);
        }
    
        function updateJumlahRuang(programStudiId) {
            const jumlah = programStudiRuang[programStudiId]?.ruang.length || 0;
            document.getElementById(`jumlah-${programStudiId}`).textContent = jumlah;
            const statusElement = document.getElementById(`status-${programStudiId}`);
            if (statusElement) {
                statusElement.textContent = jumlah > 0 ? 'Sudah Ada' : 'Belum Ada';
            }
        }
    
        function tampilkanDetail(programStudiId) {
            if (!programStudiRuang[programStudiId]) {
                alert('Tidak ada usulan ruang kuliah untuk program studi ini.');
                return;
            }
    
            document.getElementById('detail-ruang-container').style.display = 'block';
            const namaProdi = programStudiRuang[programStudiId].nama_prodi;
            document.getElementById('program-studi-judul').textContent = `Detail Ruang Kuliah untuk Program Studi ${namaProdi}`;
            updateDetailTabel(programStudiId);
        }
    
        function updateDetailTabel(programStudiId) {
            const detailRuangContainer = document.getElementById('detail-ruang');
            detailRuangContainer.innerHTML = '';
    
            programStudiRuang[programStudiId].ruang.forEach((ruang, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center">${index + 1}</td>
                    <td class="px-2 py-2 border-b border-gray-200 text-sm text-gray-800 text-center">${ruang}</td>
                    <td class="px-2 py-2 border-b border-gray-200 text-center">
                        <button onclick="hapusRuang('${programStudiId}', '${ruang}')" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Hapus</button>
                    </td>
                `;
                detailRuangContainer.appendChild(row);
            });
        }
    
        function hapusRuang(programStudiId, ruang) {
            if (currentStatus === 'disetujui') {
                alert('Usulan telah disetujui dan tidak dapat diubah.');
                return;
            }
    
            const index = programStudiRuang[programStudiId].ruang.indexOf(ruang);
            if (index !== -1) {
                programStudiRuang[programStudiId].ruang.splice(index, 1);
                updateJumlahRuang(programStudiId);
                updateDetailTabel(programStudiId);
            }
        }
    
        function simpanUsulan() {
            if (currentStatus === 'disetujui') {
                alert('Usulan telah disetujui dan tidak dapat diubah.');
                return;
            }
    
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenMeta) {
                alert('CSRF token tidak ditemukan.');
                return;
            }
    
            const csrfToken = csrfTokenMeta.getAttribute('content');
            const id_tahun = document.getElementById('tahun-ajaran').value;
    
            if (!id_tahun) {
                alert('Silakan pilih tahun ajaran.');
                return;
            }
    
            fetch('/buatusulan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    data: programStudiRuang,
                    id_tahun: id_tahun
                })
            })
            .then(response => {
                if (response.ok) {
                    alert('Usulan ruang kuliah berhasil disimpan.');
                    // Reset data if needed
                } else {
                    return response.json().then(data => {
                        alert('Gagal menyimpan usulan: ' + (data.message || ''));
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan usulan.');
            });
        }
    
        function loadUsulanData(id_tahun) {
            fetch(`/get-usulan-data/${id_tahun}`)
                .then(response => response.json())
                .then(data => {
                    currentStatus = data.status;
                    const usulanData = data.usulanData;
    
                    // Reset programStudiRuang
                    for (const prodiId in programStudiRuang) {
                        delete programStudiRuang[prodiId];
                        updateJumlahRuang(prodiId);
                    }
    
                    // Load data usulan
                    for (const prodiId in usulanData) {
                        const prodiData = usulanData[prodiId];
                        programStudiRuang[prodiId] = {
                            nama_prodi: prodiData.nama_prodi,
                            ruang: prodiData.ruang,
                        };
                        updateJumlahRuang(prodiId);
                    }
    
                    // Update UI berdasarkan status
                    if (currentStatus === 'disetujui') {
                        document.getElementById('program-studi').disabled = true;
                        document.querySelectorAll('input[name="ruang-kuliah"]').forEach(checkbox => checkbox.disabled = true);
                        document.querySelector('button[onclick="tambahRuang()"]').disabled = true;
                        document.querySelector('button[onclick="simpanUsulan()"]').disabled = true;
                    } else {
                        document.getElementById('program-studi').disabled = false;
                        document.querySelectorAll('input[name="ruang-kuliah"]').forEach(checkbox => checkbox.disabled = false);
                        document.querySelector('button[onclick="tambahRuang()"]').disabled = false;
                        document.querySelector('button[onclick="simpanUsulan()"]').disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error fetching usulan data:', error);
                });
        }
    
        // Event listener untuk perubahan tahun ajaran
        document.getElementById('tahun-ajaran').addEventListener('change', function() {
            const id_tahun = this.value;
            loadUsulanData(id_tahun);
        });
    
        // Load data usulan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const id_tahun = document.getElementById('tahun-ajaran').value;
            loadUsulanData(id_tahun);
        });
    
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('sidebar-closed');
        }
    </script>
    
    <script>
        $(document).ready(function() {
            $('#program-studi').select2({
                placeholder: 'Pilih Program Studi',
                allowClear: true
            });
        });

        $(document).ready(function () {
            const table = $('#rekap-ruang-table').DataTable({
                paging: false,
                info: false,
                searching: true,
                columnDefs: [
                    { orderable: false, targets: [3, 4] },
                ],
            });

            $('#filter-status').on('change', function () {
                const selectedStatus = $(this).val();

                table.rows().every(function () {
                    const jumlahRuang = parseInt($(this.node()).find('td:eq(2)').text().trim(), 10);
                    const shouldShow =
                        selectedStatus === '' ||
                        (selectedStatus === 'Sudah Ada' && jumlahRuang > 0) ||
                        (selectedStatus === 'Belum Ada' && jumlahRuang === 0);

                    $(this.node()).toggle(shouldShow);
                });
            });
        });


    </script>
    
</body>
</html>
