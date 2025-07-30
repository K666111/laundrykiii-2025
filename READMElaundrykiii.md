# 🧺 Laundry Management System – Laravel 12 + Filament

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

