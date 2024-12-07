<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISKARA - Pengisian IRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi untuk sidebar */
        .sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar-closed {
            transform: translateX(-100%);
        }

        /* Menyesuaikan konten utama saat sidebar dibuka/tutup */
        .main-content {
            transition: margin-left 0.3s ease;
        }

        .main-content-shifted {
            margin-left: 0;
        }

        /* Memastikan sidebar dan konten utama memenuhi tinggi layar */
        .flex-container {
            min-height: 100vh;
        }

        /* Mengatur lebar sidebar saat ditutup */
        .sidebar-closed {
            width: 0;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
        }

        .course-selected {
            background-color: #e2e8f0; /* Warna abu-abu terang */
            border-color: #0090FF;    /* Warna border gelap */
        }
        /* Tambahan styling khusus jika diperlukan */
    </style>
</head>
<body class="bg-gray-100 font-sans">

    @php
        $menus = [
            (object) [
                "title" => "Dasboard",
                "path" => "dashboard-mhs",
            ],
            (object) [
                "title" => "Pengisian IRS",
                "path" => "pengisianirs-mhs",
            ],
            (object) [
                "title" => "IRS",
                "path" => "irs-mhs",
            ]
        ];
    @endphp
    <!-- Header -->
    <header class="bg-gradient-to-r from-sky-500 to-blue-600 text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <!-- Tombol menu untuk membuka sidebar -->
            <button onclick="toggleSidebar()" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Logo dan judul aplikasi -->
            <h1 class="text-xl font-bold">SISKARA</h1>
        </div>
        <!-- Tanggal dan Waktu Server -->
        <div id="serverDateTimeHeader" class="text-right text-sm"></div>
    </header>

    <div class="flex flex-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-1/5 bg-sky-500 h-screen p-4 text-white sidebar-closed fixed lg:static">
            <!-- Profil -->
            <div class="p-3 pb-1 bg-gray-300 rounded-3xl text-center mb-6">
                <div class="w-24 h-24 mx-auto bg-gray-400 rounded-full mb-3 bg-center bg-contain bg-no-repeat"
                    style="background-image: url(img/fsm.jpg)">
                </div>
                <h2 class="text-lg text-black font-bold">{{ $mhs->nama }}</h2>
                <p class="text-xs text-gray-800">NIM {{ $mhs->nim }}</p>
                <p class="text-sm bg-sky-700 rounded-full px-3 py-1 mt-2 font-semibold">Mahasiswa</p>
                <a href="{{ route('login') }}" class="text-sm w-full bg-red-700 py-1 rounded-full mb-4 mt-2 text-center block font-semibold hover:bg-opacity-70">Logout</a>
            </div>
            <nav class="space-y-4">
                {{-- active : bg-sky-800 rounded-xl text-white hover:bg-opacity-70 --}}
                {{-- passive : bg-gray-300 rounded-xl text-gray-700 hover:bg-gray-700 hover:text-white --}}
                @foreach ($menus as $menu)
                <a href="{{ url($menu->path) }}"
                   class="flex items-center space-x-2 p-2 {{ Str::startsWith(request()->path(), $menu->path) ? 'bg-sky-800 rounded-xl text-white hover:bg-opacity-70' : 'bg-gray-300 rounded-xl text-gray-700 hover:bg-gray-700 hover:text-white' }}">
                    <span>{{$menu->title}}</span>
                </a>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="w-full lg:w-8/5 lg:ml-auto p-8" id="mainContent">
            <!-- Header Halaman -->
            <h1 class="text-4xl font-bold mb-6">Pengisian IRS</h1>

            <!-- Tanggal dan Waktu Server di Main Content (Hapus jika tidak diperlukan) -->
            <!-- <div id="serverDateTimeMain" class="text-right mb-4 text-gray-600"></div> -->

            <!-- Konten Pengisian IRS -->
            <div id="irsContent">
                <div class="flex flex-col lg:flex-row">
                    <!-- Sidebar Mata Kuliah -->
                    <div class="w-full lg:w-1/4 mb-6 lg:mb-0 lg:mr-6">
                        <h3 class="text-xl font-semibold mb-4">Informasi Mahasiswa</h3>
                        <!-- Pencarian Mata Kuliah -->
                        <div class="grid grid-cols-1 gap-4 mb-2">
                            <div class="bg-white p-4 rounded-lg shadow-none">
                                <p class="text-sm font-normal">Nama: <span class="font-normal">{{ $mhs->nama ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">NIM: <span class="font-normal">{{ $mhs->nim ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">Tahun Ajaran: <span class="font-normal">{{ $ta_skrg->tahun_ajaran ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">Semester: <span class="font-normal">{{ $mhs->semester ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">Status Semester Lalu: <span class="font-normal">{{ $status_lalu ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">IP Semester Lalu: <span class="font-normal">{{ number_format($ipslalu, 2) ?? 'Unknown' }}</span></p>
                                <p class="text-sm font-normal">Max. SKS: <span class="font-normal">{{ $maxsks ?? 'Unknown' }}</span></p>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Daftar Mata Kuliah</h3>
                        <!-- Pencarian Mata Kuliah -->
                        <div class="mb-4">
                            <input 
                                type="text" 
                                id="searchCourse" 
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" 
                                placeholder="Cari mata kuliah..." 
                                oninput="filterCourses()">
                        </div>
                        <!-- Daftar Mata Kuliah -->
                        <div id="courseList" class="grid gap-4 overflow-y-auto bg-white p-4 rounded-lg" style="max-height: 420px;">
                            <!-- Mata kuliah akan diisi melalui JavaScript -->
                        </div>
                    </div>

                    <!-- Tabel Jadwal -->
                    <div class="w-full lg:w-3/4">
                        <h3 class="text-2xl font-semibold mb-4 flex justify-between items-center">
                            Informasi Jadwal IRS
                            <span id="sksCount" class="text-blue-600 font-bold">0 / {{ $maxsks }} SKS</span>
                        </h3>
                        <table class="w-full bg-gray-50 rounded-lg shadow-md">
                            <!-- Konten tabel akan diisi oleh JavaScript -->
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="py-3 px-4 text-center">Waktu</th>
                                    <th class="py-3 px-4 text-center">Senin</th>
                                    <th class="py-3 px-4 text-center">Selasa</th>
                                    <th class="py-3 px-4 text-center">Rabu</th>
                                    <th class="py-3 px-4 text-center">Kamis</th>
                                    <th class="py-3 px-4 text-center">Jumat</th>
                                    <th class="py-3 px-4 text-center">Sabtu</th>
                                </tr>
                            </thead>
                            <tbody id="timeSlots">
                                <!-- Time slots akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                        <!-- Tombol Simpan -->
                        <div class="mt-6">
                            <button onclick="saveIRS()" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Izin Perbaikan IRS -->
            <div id="requestFixButton" style="display: none;" class="text-center">
                <p class="mb-4">Masa pengisian IRS telah berakhir. Anda dapat meminta izin perbaikan IRS kepada Dosen Wali.</p>
                <button onclick="requestFix()" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Minta Izin Perbaikan IRS</button>
            </div>

            <!-- Tombol Izin Pembatalan IRS -->
            <div id="requestCancellationButton" style="display: none;" class="text-center">
                <p class="mb-4">Masa perbaikan IRS telah berakhir. Anda dapat meminta izin pembatalan IRS kepada Dosen Wali.</p>
                <button onclick="requestCancellation()" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600">Minta Izin Pembatalan IRS</button>
            </div>

            <!-- Pesan Masa Berakhir -->
            <div id="periodOverMessage" style="display: none;" class="text-center">
                <p class="mb-4 text-red-600">Masa pengisian dan perbaikan IRS telah berakhir.</p>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-sky-500 to-blue-600 text-white text-center p-4">
        <hr>
        <p class="text-sm text-center">&copy; Siskara Inc. All rights reserved.</p>
    </footer>

    <!-- Modal Popup -->
    <div id="courseModal" class="modal">
        <div class="modal-content">
            <h2 id="modalCourseName" class="text-xl font-bold mb-4">Nama Mata Kuliah</h2>
            <p id="modalCourseDetails" class="mb-4">Detail mata kuliah akan ditampilkan di sini.</p>
            <div class="flex justify-end space-x-4">
                <button id="modalActionButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Daftar</button>
                <button id="cancelButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 hidden">Keluar</button>
                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Simulasi Tanggal Server (untuk keperluan demo)
        let serverDate = new Date(); // Gunakan tanggal saat ini
        // Untuk pengujian, Anda bisa mengatur tanggal server secara manual
        // Contoh: let serverDate = new Date('2023-11-10');

        // Tanggal Mulai dan Berakhir Pengisian IRS
        let fillingStartDate = new Date('2024-11-01');
        let fillingEndDate = new Date('2024-12-31');

        // Tanggal untuk periode perbaikan dan pembatalan
        let twoWeeksAfterEnd = new Date(fillingEndDate.getTime() + (14 * 24 * 60 * 60 * 1000));
        let fourWeeksAfterEnd = new Date(fillingEndDate.getTime() + (28 * 24 * 60 * 60 * 1000));

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('sidebar-closed');
            // Jika Anda ingin menyesuaikan margin, tambahkan logika di sini
        }

        // Fungsi untuk menampilkan Tanggal dan Waktu Server
        function displayServerDateTime() {
            const dateTimeElement = document.getElementById('serverDateTimeHeader');
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = serverDate.toLocaleDateString('id-ID', options);
            const timeStr = serverDate.toLocaleTimeString('id-ID');
            dateTimeElement.innerText = `Tanggal Server: ${dateStr}, ${timeStr}`;
        }

        // Fungsi untuk mengecek periode pengisian IRS
        function checkIRSPeriod() {
            if (serverDate <= fillingEndDate) {
                // Masa pengisian IRS masih berlangsung
                document.getElementById('irsContent').style.display = 'block';
                document.getElementById('requestFixButton').style.display = 'none';
                document.getElementById('requestCancellationButton').style.display = 'none';
                document.getElementById('periodOverMessage').style.display = 'none';
            } else if (serverDate <= twoWeeksAfterEnd) {
                // Dalam 2 minggu setelah masa pengisian berakhir
                document.getElementById('irsContent').style.display = 'none';
                document.getElementById('requestFixButton').style.display = 'block';
                document.getElementById('requestCancellationButton').style.display = 'none';
                document.getElementById('periodOverMessage').style.display = 'none';
            } else if (serverDate <= fourWeeksAfterEnd) {
                // Antara 2 hingga 4 minggu setelah masa pengisian berakhir
                document.getElementById('irsContent').style.display = 'none';
                document.getElementById('requestFixButton').style.display = 'none';
                document.getElementById('requestCancellationButton').style.display = 'block';
                document.getElementById('periodOverMessage').style.display = 'none';
            } else {
                // Lebih dari 4 minggu setelah masa pengisian berakhir
                document.getElementById('irsContent').style.display = 'none';
                document.getElementById('requestFixButton').style.display = 'none';
                document.getElementById('requestCancellationButton').style.display = 'none';
                document.getElementById('periodOverMessage').style.display = 'block';
            }
        }

        // Fungsi untuk meminta izin perbaikan IRS
        function requestFix() {
            alert('Permintaan perbaikan IRS telah dikirim ke Dosen Wali.');
            // Di sini Anda bisa menambahkan logika untuk mengirim permintaan ke server
        }

        // Fungsi untuk meminta izin pembatalan IRS
        function requestCancellation() {
            alert('Permintaan pembatalan IRS telah dikirim ke Dosen Wali.');
            // Di sini Anda bisa menambahkan logika untuk mengirim permintaan ke server
        }

        // Fungsi untuk menampilkan tanggal dan waktu secara real-time
        function startDateTimeUpdater() {
            setInterval(() => {
                serverDate = new Date(); // Update tanggal server setiap detik
                displayServerDateTime();
                checkIRSPeriod();
            }, 1000);
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            displayServerDateTime();
            checkIRSPeriod();
            initializeScheduleTable();
            populateCourseList();
            startDateTimeUpdater();
        });

        // Inisialisasi SKS dan Mata Kuliah
        const maxSKS = {{ $maxsks }};
        const idTahun = {{ $ta_skrg->id_tahun }}
        const mahasiswa = @json($mhs);
        const listMatkul = @json($listmk);
        const jadwalMatkul = @json($jadwalmk);
        let currentSKS = 0;
        const selectedCourses = {};
        let matakuliah_terdaftar = [];
        // Variabel untuk menyimpan mata kuliah yang dipilih
        let selectedCourseItem = null;
        let selectedMatkul = null;

        // const courseSchedules = {};

        let schedulesByKodeMK = {};

        Object.values(jadwalMatkul).forEach(jadwal => {
            if (!schedulesByKodeMK[jadwal.kode_mk]) {
                schedulesByKodeMK[jadwal.kode_mk] = [];
            }
            schedulesByKodeMK[jadwal.kode_mk].push(jadwal);
        });
        
        function initializeScheduleTable() {
            const timeSlots = ["06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00"];
            const days = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            const timeSlotsContainer = document.getElementById('timeSlots');

            timeSlots.forEach((time) => {
                const row = document.createElement('tr');
                
                // Kolom pertama adalah waktu
                row.innerHTML = `<td class="border px-4 py-2 font-semibold">${time}</td>`;

                // Kolom berikutnya adalah jadwal per hari
                days.forEach(day => {
                    const cell = document.createElement('td');
                    cell.className = 'border px-4 py-2 align-top';
                    cell.id = `${day}-${time}`; // Gunakan format 'senin-0600' agar cocok dengan waktu_mulai
                    row.appendChild(cell);
                });

                timeSlotsContainer.appendChild(row);
            });
        }

        // Fungsi untuk mengisi daftar mata kuliah
        function populateCourseList() {
            const courseList = document.getElementById('courseList');
            courseList.innerHTML = ''; // Kosongkan daftar sebelum diisi ulang

            // Iterasi mata kuliah dari data PHP (listMatkul)
            Object.keys(listMatkul).forEach((kode_mk) => {
                const matkul = listMatkul[kode_mk];
                const courseItem = document.createElement('div');
                courseItem.className = 'p-2 border rounded-lg bg-white shadow-none hover:bg-gray-100 cursor-pointer';
                courseItem.dataset.kode_mk = kode_mk;
                courseItem.dataset.nama = matkul.nama_mk;

                // Konten mata kuliah
                courseItem.innerHTML = `
                    <p class="font-bold">${matkul.nama_mk} (${matkul.sks} SKS)</p>
                    <p class="text-sm text-gray-500">Kode MK: ${kode_mk}</p>
                `;

                // Event saat diklik
                courseItem.onclick = () => toggleCourseSelection(courseItem, matkul);
                // courseItem.onclick = () => {
                //     alert(`Anda memilih mata kuliah: ${matkul.nama}`);
                //     // Tambahkan logika untuk pendaftaran atau detail
                // };

                courseList.appendChild(courseItem);
            });
        }

        function toggleCourseSelection(courseItem, matkul) {
            const kodeMK = courseItem.dataset.kode_mk;

            if (selectedCourses[kodeMK]) {
                // Jika sudah dipilih, hapus dari tabel dan batalkan pemilihan
                delete selectedCourses[kodeMK];
                courseItem.classList.remove('course-selected');
                removeCourseFromSchedule(matkul);
            } else {
                // Jika belum dipilih, tambahkan ke tabel dan tandai sebagai dipilih
                selectedCourses[kodeMK] = matkul;
                courseItem.classList.add('course-selected');
                addCourseToSchedule(matkul);
            }
        }

        function addCourseToSchedule(matkul) {
            const schedules = schedulesByKodeMK[matkul.kode_mk];
            if (!schedules || schedules.length === 0) {
                alert(`Tidak ada jadwal untuk mata kuliah ${matkul.nama_mk}`);
                return;
            }

            schedules.forEach(schedule => {
                // const { hari, waktu_mulai, waktu_selesai } = schedule; 
                const cell = document.getElementById(`${schedule.hari.toLowerCase()}-${schedule.waktu_mulai.substring(0, 5)}`);
                if (cell) {
                    const courseInfo = `
                        <div class="bg-gray-200 text-sm rounded p-1 my-1 course-item" data-id-jadwal="${schedule.id_jadwal}" data-kode-mk="${matkul.kode_mk}" data-nama="${matkul.nama_mk}" data-sks="${matkul.sks}" data-kelas="${schedule.kelas}" data-hari="${schedule.hari}" data-waktu="${schedule.waktu_mulai} - ${schedule.waktu_selesai}" data-ruang="${schedule.id_ruang}" data-kuota="${schedule.kuota}">
                            ${matkul.nama_mk} (${schedule.kelas})<br>
                            ${schedule.waktu_mulai} - ${schedule.waktu_selesai}<br>
                            Ruang: ${schedule.id_ruang}
                        </div>
                    `;
                    cell.innerHTML += courseInfo;

                    // Tambahkan event listener untuk membuka modal saat klik pada course item
                    const courseItems = cell.querySelectorAll('.course-item');
                    courseItems.forEach(courseItem => {
                        courseItem.onclick = () => openModal(courseItem);
                    });
                }
            });
        }

        function removeCourseFromSchedule(matkul) {
            const schedules = schedulesByKodeMK[matkul.kode_mk];
            if (!schedules || schedules.length === 0) return;

            schedules.forEach(schedule => {
                // const { hari, waktu_mulai } = schedule;
                const cell = document.getElementById(`${schedule.hari.toLowerCase()}-${schedule.waktu_mulai.substring(0, 5)}`);
                if (cell) {
                    // Hapus elemen terkait jadwal
                    const matkulElements = cell.querySelectorAll('div');
                    matkulElements.forEach(el => {
                        if (el.textContent.includes(matkul.nama_mk)) {
                            el.remove();
                        }
                    });
                }
            });
        }

        // Fungsi untuk memfilter daftar mata kuliah
        function filterCourses() {
            const query = document.getElementById('searchCourse').value.toLowerCase();
            const courses = document.querySelectorAll('#courseList > div');

            courses.forEach(course => {
                const name = course.dataset.nama.toLowerCase();
                const kode = course.dataset.kode_mk.toLowerCase();
                if (name.includes(query) || kode.includes(query)) {
                    course.style.display = 'block';
                } else {
                    course.style.display = 'none';
                }
            });
        }

        function openModal(courseItem) {
            // Ambil data dari elemen yang diklik
            const idJadwal = courseItem.dataset.idJadwal;
            const kodeMK = courseItem.dataset.kodeMk;
            const namaMK = courseItem.dataset.nama;
            const sks = courseItem.dataset.sks;
            const kelas = courseItem.dataset.kelas;
            const hari = courseItem.dataset.hari;
            const waktu = courseItem.dataset.waktu;
            const ruang = courseItem.dataset.ruang;
            const kuota = courseItem.dataset.kuota;


            // Set data ke modal
            document.getElementById('modalCourseName').innerText = `${namaMK} (${kelas})`;
            document.getElementById('modalCourseDetails').innerHTML = `
                <strong>Kode MK:</strong> ${kodeMK}<br>
                <strong>SKS:</strong> ${sks}<br>
                <strong>Hari:</strong> ${hari}<br>
                <strong>Waktu:</strong> ${waktu}<br>
                <strong>Ruang:</strong> ${ruang}<br>
                <strong>Jumlah Mahasiswa:</strong> ${kuota}
            `;

            // Set elemen yang diklik untuk menyimpan mata kuliah yang dipilih
            selectedCourseItem = courseItem;
            selectedMatkul = { id_jadwal: idJadwal, kode_mk: kodeMK, nama: namaMK, sks, kelas, hari, waktu, ruang, kuota };

            // Tampilkan modal
            document.getElementById('courseModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('courseModal').style.display = 'none';
        }

        // Fungsi untuk menambahkan mata kuliah ke dalam daftar ketika tombol "Daftar" diklik
        document.getElementById('modalActionButton').addEventListener('click', function () {
            // Cek apakah mata kuliah sudah terdaftar atau belum
            if (matakuliah_terdaftar.find(item => item.id_jadwal === selectedMatkul.id_jadwal)) {
                alert('Mata kuliah sudah terdaftar.');
            } else {
                // Tambahkan mata kuliah ke array matakuliah_terdaftar
                matakuliah_terdaftar.push({
                    status: 'BARU',
                    nim: mahasiswa.nim, // Ganti dengan NIM yang sesuai
                    id_jadwal: selectedMatkul.id_jadwal
                });

                console.log(selectedMatkul.sks);
                currentSKS = currentSKS + selectedMatkul.sks;
                updateSKS();
                // Ubah warna latar belakang course item menjadi biru
                selectedCourseItem.classList.remove('bg-gray-200');
                selectedCourseItem.classList.add('bg-blue-200');

                document.getElementById('cancelButton').style.display = 'block';
                document.getElementById('modalActionButton').style.display = 'none';

                alert(`Mata kuliah ${selectedMatkul.nama} berhasil didaftarkan.`);
            }

            // Tutup modal
            closeModal();
        });

        // Fungsi untuk menghapus mata kuliah dari daftar ketika tombol "Keluar" diklik
        document.getElementById('cancelButton').addEventListener('click', function () {
            // Cek apakah mata kuliah sudah terdaftar atau belum
            const index = matakuliah_terdaftar.findIndex(item => item.id_jadwal === selectedMatkul.id_jadwal);

            if (index !== -1) {
                // Jika mata kuliah sudah terdaftar, batalkan pendaftaran
                matakuliah_terdaftar.splice(index, 1); // Hapus mata kuliah dari array

                currentSKS = currentSKS - selectedMatkul.sks;

                updateSKS();

                // Reset background warna course item
                selectedCourseItem.classList.remove('bg-blue-200');
                selectedCourseItem.classList.add('bg-gray-200');

                // Sembunyikan tombol "Keluar" dan tampilkan kembali tombol "Daftar"
                document.getElementById('cancelButton').style.display = 'none';
                document.getElementById('modalActionButton').style.display = 'block';

                alert(`Pendaftaran mata kuliah ${selectedMatkul.nama} dibatalkan.`);
            } 

            // Tutup modal
            closeModal();
        });

        function updateSKS() {
            document.getElementById('sksCount').innerText = `${currentSKS} / ${maxSKS} SKS`;
        }

        function saveIRS() {
            if (matakuliah_terdaftar.length === 0) {
                alert("Tidak ada mata kuliah yang terdaftar.");
                return;
            }

            // Pastikan CSRF token ada di halaman
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            if (!csrfToken) {
                alert('CSRF token tidak ditemukan!');
                return;
            }
            
            fetch('/tambah-irs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'), // Ambil token dari meta tag
                },
                body: JSON.stringify({ matakuliah_terdaftar: matakuliah_terdaftar }),
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.message || 'Internal Server Error') });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Terjadi kesalahan saat menyimpan IRS.');
                }
            })
                        .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan IRS: ' + (error.message || 'Internal Server Error'));
            });
        }
    </script>

</body>
</html>
