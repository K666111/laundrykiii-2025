# 🧺 Laundry Management System – SYAUQI RIFKI FADILAH

Sistem manajemen laundry berbasis web menggunakan Laravel 12 dan Filament Admin. Meskipun hanya terdiri dari 3 tabel utama (`customers`, `services`, `transactions`), aplikasi ini tetap mengimplementasikan konsep algoritma dan struktur data seperti:

- ✅ Array
- ✅ Stack
- ✅ Queue
- ✅ Tree
- ✅ Graph
- ✅ MVC
- ✅ Search

---

## 📦 Fitur Utama

- **Manajemen Pelanggan**: Tambah, ubah, hapus pelanggan.
- **Manajemen Layanan**: Tambah layanan dengan kategori bertingkat (tree).
- **Manajemen Transaksi**: Multi-layanan per transaksi menggunakan array JSON.
- **Antrian Proses**: Urutan pengerjaan berdasarkan sistem queue.
- **Log Pengerjaan**: Catatan histori pekerjaan per transaksi (stack).
- **Relasi Antar Layanan**: Representasi koneksi antar layanan (graph).
- **Pencarian**: Filter transaksi berdasarkan nama pelanggan dan layanan.

---

## 🧩 Struktur Tabel

### 1. `customers`
| Field      | Tipe     |
|------------|----------|
| id         | bigint   |
| name       | string   |
| phone      | string   |
| address    | text     |

---

### 2. `services`
| Field      | Tipe     | Deskripsi                         |
|------------|----------|----------------------------------|
| id         | bigint   |                                  |
| name       | string   | Nama layanan                     |
| price      | decimal  | Harga                            |
| unit       | enum     | 'kg' / 'pcs'                     |
| parent_id  | bigint   | Kategori induk (untuk tree)      |
| edges      | json     | Relasi antar layanan (graph)     |

---

### 3. `transactions`
| Field           | Tipe     | Deskripsi                         |
|-----------------|----------|----------------------------------|
| id              | bigint   |                                  |
| customer_id     | bigint   | Relasi pelanggan                 |
| services        | json     | Array ID layanan (array)         |
| quantity        | integer  | Total item                       |
| total           | decimal  | Total harga                      |
| logs            | json     | Log pekerjaan (stack)            |
| queue_position  | integer  | Urutan dalam antrian (queue)     |
| status          | enum     | pending / processing / completed |
| transaction_date| timestamp| Tanggal transaksi                |

---

## 🧠 Analisis Struktur Data

| Struktur | Penggunaan                                         |
|----------|----------------------------------------------------|
| Array    | Menyimpan banyak `service_id` dalam `transactions` |
| Stack    | Kolom `logs` untuk log progres pekerjaan           |
| Queue    | Kolom `queue_position` untuk antrian laundry       |
| Tree     | Field `parent_id` dalam `services`                 |
| Graph    | Field `edges` dalam `services`                     |
| MVC      | Laravel default + Filament                        |
| Search   | Searchable field di Filament Table & Form          |

---

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

--

## ⚙️ Contoh Algoritma

### 1. Hitung Total Transaksi
```php
$total = 0;
foreach ($selectedServices as $serviceId) {
    $service = Service::find($serviceId);
    $total += $service->price * $quantity;
}

### 2. Stack Log (Push & Pop)
// Push log
$logs = $transaction->logs ?? [];
$logs[] = "Setrika dimulai";
$transaction->logs = $logs;
$transaction->save();

// Pop log
$logs = $transaction->logs;
array_pop($logs);
$transaction->logs = $logs;
$transaction->save();

3. Queue: Ambil Transaksi Berikutnya
Transaction::where('status', 'pending')
    ->orderBy('queue_position')
    ->first();

4. Tree: Print Kategori Layanan
function printTree($parentId = null, $level = 0) {
    $nodes = Service::where('parent_id', $parentId)->get();
    foreach ($nodes as $node) {
        echo str_repeat('-', $level * 2) . $node->name . "\n";
        printTree($node->id, $level + 1);
    }
}

5. Search Transaksi
Transaction::whereRelation('customer', 'name', 'like', '%cari%')
    ->orWhereJsonContains('services', $serviceId)
    ->get();
