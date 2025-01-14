<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    public function run()
    {
        DB::table('matakuliah')->insert([

            ['kode_mk' => 'PAIK6101', 'nama_mk' => 'Matematika I', 'plot_semester' => 1, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6102', 'nama_mk' => 'Dasar Pemrograman', 'plot_semester' => 1, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6103', 'nama_mk' => 'Dasar Sistem', 'plot_semester' => 1, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6104', 'nama_mk' => 'Logika Informatika', 'plot_semester' => 1, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6105', 'nama_mk' => 'Struktur Diskrit', 'plot_semester' => 1, 'sks' => 4, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6201', 'nama_mk' => 'Matematika II', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6202', 'nama_mk' => 'Algoritma dan Pemrograman', 'plot_semester' => 2, 'sks' => 4, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6203', 'nama_mk' => 'Organisasi dan Arsitektur Komputer', 'plot_semester' => 2, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6204', 'nama_mk' => 'Aljabar Linier', 'plot_semester' => 2, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6301', 'nama_mk' => 'Struktur Data', 'plot_semester' => 3, 'sks' => 4, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6302', 'nama_mk' => 'Sistem Operasi', 'plot_semester' => 3, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6303', 'nama_mk' => 'Basis Data', 'plot_semester' => 3, 'sks' => 4, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6304', 'nama_mk' => 'Metode Numerik', 'plot_semester' => 3, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6305', 'nama_mk' => 'Interaksi Manusia dan Komputer', 'plot_semester' => 3, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6306', 'nama_mk' => 'Statistika', 'plot_semester' => 3, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6401', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6402', 'nama_mk' => 'Jaringan Komputer', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6403', 'nama_mk' => 'Manajemen Basis Data', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6404', 'nama_mk' => 'Grafika dan Komputasi Visual', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6405', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6406', 'nama_mk' => 'Sistem Cerdas', 'plot_semester' => 4, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6501', 'nama_mk' => 'Pengembangan Berbasis Platform', 'plot_semester' => 5, 'sks' => 4, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6502', 'nama_mk' => 'Komputasi Tersebar dan Pararel', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6503', 'nama_mk' => 'Sistem Informasi', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6504', 'nama_mk' => 'Proyek Perangkat Lunak', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6505', 'nama_mk' => 'Pembelajaran Mesin', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6506', 'nama_mk' => 'Keamanan dan Jaminan Informasi', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6601', 'nama_mk' => 'Analisis dan Strategi Algoritma', 'plot_semester' => 6, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6602', 'nama_mk' => 'Uji Perangkat Lunak', 'plot_semester' => 6, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6603', 'nama_mk' => 'Masyarakat dan Etika Profesi', 'plot_semester' => 6, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6604', 'nama_mk' => 'Praktik Kerja Lapangan', 'plot_semester' => 0, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6605', 'nama_mk' => 'Manajemen Proyek', 'plot_semester' => 6, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6701', 'nama_mk' => 'Metodologi Penelitian dan Penulisan Ilmiah', 'plot_semester' => 0, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6702', 'nama_mk' => 'Teori Bahasa dan Otomata', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAIK6703', 'nama_mk' => 'Metode Perangkat Lunak', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6704', 'nama_mk' => 'Kualitas Perangkat Lunak', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6705', 'nama_mk' => 'Pemodelan dan Simulasi', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6706', 'nama_mk' => 'Visi Komputer', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6707', 'nama_mk' => 'Audit Sistem Informasi', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6708', 'nama_mk' => 'Penambangan Data', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6709', 'nama_mk' => 'Sistem Tertanam', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6710', 'nama_mk' => 'Algoritma Evolusioner', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6711', 'nama_mk' => 'Komputasi Lunak', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6712', 'nama_mk' => 'Temu Balik Informasi', 'plot_semester' => 7, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6801', 'nama_mk' => 'Topik Khusus RPL & STI', 'plot_semester' => 0, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6802', 'nama_mk' => 'Topik Khusus SC & KG', 'plot_semester' => 0, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6803', 'nama_mk' => 'Evolusi Perangkat Lunak', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6804', 'nama_mk' => 'Rekayasa Sistem', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6805', 'nama_mk' => 'Komputasi Awan', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6806', 'nama_mk' => 'Arsitektur Perangkat Lunak', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6807', 'nama_mk' => 'Pemrograman Lanjut', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6808', 'nama_mk' => 'Pengenalan Pola', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6809', 'nama_mk' => 'Kriptografi', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6810', 'nama_mk' => 'Bioinformatika', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6811', 'nama_mk' => 'Keamanan Siber', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6812', 'nama_mk' => 'Pemrosesan Citra Medis', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6813', 'nama_mk' => 'Data Besar', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6814', 'nama_mk' => 'Intelijen Bisnis', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6815', 'nama_mk' => 'Pemodelan Informasi', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6816', 'nama_mk' => 'Sistem Enterprise', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6817', 'nama_mk' => 'Robotika', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6818', 'nama_mk' => 'Pengolahan Bahasa Alami', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6819', 'nama_mk' => 'Analisis Jaringan Sosial', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6820', 'nama_mk' => 'Sains Data', 'plot_semester' => 8, 'sks' => 3, 'jenis' => 'P'],
            ['kode_mk' => 'PAIK6821', 'nama_mk' => 'Tugas Akhir', 'plot_semester' => 0, 'sks' => 6, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00003', 'nama_mk' => 'Pancasila dan Kewarganegaraan', 'plot_semester' => 1, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00004', 'nama_mk' => 'Bahasa Indonesia', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00005', 'nama_mk' => 'Olahraga', 'plot_semester' => 1, 'sks' => 1, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00006', 'nama_mk' => 'Internet of Things (IoT)', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00007', 'nama_mk' => 'Bahasa Inggris', 'plot_semester' => 1, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00008', 'nama_mk' => 'Kewirausahaan', 'plot_semester' => 5, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00009', 'nama_mk' => 'Kuliah Kerja Nyata (KKN)', 'plot_semester' => 0, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00011', 'nama_mk' => 'Pendidikan Agama Islam', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00021', 'nama_mk' => 'Pendidikan Agama Kristen', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00031', 'nama_mk' => 'Pendidikan Agama Khatolik', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00041', 'nama_mk' => 'Pendidikan Agama Hindu', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00051', 'nama_mk' => 'Pendidikan Agama Buddha', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00061', 'nama_mk' => 'Pendidikan Agama Kong Hu Chu', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],
            ['kode_mk' => 'UUW00071', 'nama_mk' => 'Aliran Kepercayaan terhadap Tuhan Yang Maha Esa', 'plot_semester' => 2, 'sks' => 2, 'jenis' => 'W'],

            //statisika
            ['kode_mk' => 'PAST6501', 'nama_mk' => 'Proses Stokhastik', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAST6502', 'nama_mk' => 'Aljabar Linear Elementer', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],
            ['kode_mk' => 'PAST6503', 'nama_mk' => 'Statistika Multivariat', 'plot_semester' => 5, 'sks' => 3, 'jenis' => 'W'],


        ]);
    }
}
