** A. ANALISIS STUDI KASUS LAUNDRY

1. Judul
 "Sistem Informasi Manajemen Laundry Berbasis Web Menggunakan Laravel 12 dan Filament dengan Pendekatan Struktur Data Komputasional"

2. Latar Belakang
 Bisnis laundry memerlukan sistem yang efisien untuk mengelola data pelanggan, layanan, dan transaksi secara akurat. Banyak sistem konvensional tidak menerapkan logika komputasi secara optimal, seperti penggunaan antrian (queue), log pekerjaan (stack), maupun relasi kompleks (tree & graph). Oleh karena itu, dibutuhkan sistem modern berbasis Laravel dan Filament yang tidak hanya mudah digunakan, tetapi juga efisien secara logika dan struktur data.

3. Tujuan 
Membangun sistem laundry berbasis web menggunakan Laravel 12 dan Filament Admin.
Mengimplementasikan struktur data: array, stack, queue, tree, graph. 
Menyediakan fitur pencarian data yang cepat (search). 
Menjaga arsitektur kode bersih menggunakan pola MVC.**

4. Fitur Sistem
| Fitur               | Deskripsi                                           |
| ------------------- | --------------------------------------------------- |
| Manajemen Pelanggan | Tambah, edit, dan hapus data pelanggan              |
| Manajemen Layanan   | Tambah layanan, termasuk kategori dan relasi (tree) |
| Manajemen Transaksi | Tambah transaksi, dengan multi-layanan (array)      |
| Log Pengerjaan      | Catatan progres (stack)                             |
| Antrian Transaksi   | Sistem antrian pengerjaan (queue)                   |
| Navigasi Layanan    | Hubungan antar layanan (graph)                      |
| Pencarian Data      | Cari transaksi berdasarkan nama pelanggan/layanan   |

5. Struktur Data yang Digunakan
| Struktur | Penggunaan                                                                     |
| -------- | ------------------------------------------------------------------------------ |
| Array    | Menyimpan banyak `service_id` dalam 1 transaksi                                |
| Stack    | Menyimpan log pengerjaan layanan (push/pop)                                    |
| Queue    | Menentukan urutan proses transaksi laundry                                     |
| Tree     | Kategori layanan menggunakan `parent_id`                                       |
| Graph    | Representasi relasi antar layanan (misal: rute layanan)                        |
| Search   | Pencarian via SQL + Laravel searchable                                         |
| MVC      | Laravel default: Model-View-Controller (Filament Resource = Controller + View) |

B. KESIMPULAN
Sistem ini sederhana dalam jumlah tabel namun kuat dalam logika struktur data. Dengan hanya customers, services, dan transactions, kamu tetap bisa membangun sistem laundry dengan fitur:

Multilayanan (array)
Pencatatan pekerjaan (stack)
Antrian pelanggan (queue)
Hirarki layanan (tree)
Relasi antar proses atau cabang (graph)
Disiplin pola arsitektur (MVC)
Dukungan pencarian cepat (search)