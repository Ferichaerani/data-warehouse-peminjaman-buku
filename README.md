# Sistem Peminjaman Buku - Data Warehouse

## Deskripsi

Repository ini merupakan dokumentasi dan implementasi proyek Sistem Peminjaman Buku yang menerapkan konsep Data Warehouse. Sistem dibuat untuk membantu pengelolaan data buku, kategori, siswa, peminjaman, dan pengembalian buku.

Data transaksi yang dihasilkan dari sistem digunakan sebagai sumber Data Warehouse untuk mendukung proses pengolahan, analisis, dan penyajian informasi dalam bentuk dashboard visualisasi.

## Tujuan

Proyek ini bertujuan untuk menerapkan konsep Data Warehouse pada Sistem Peminjaman Buku, meliputi:

- Perancangan Star Schema.
- Perancangan Snowflake Schema.
- Pengelolaan data transaksi peminjaman dan pengembalian.
- Penerapan query OLAP untuk analisis data.
- Penyajian hasil analisis dalam bentuk dashboard visualisasi.

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- SQLite
- Looker Studio
- GitHub

## Fitur Sistem

Sistem Peminjaman Buku memiliki beberapa fitur utama, yaitu:

- Pengelolaan data buku.
- Pengelolaan data kategori buku.
- Pengelolaan data siswa.
- Pengelolaan data peminjaman.
- Pengelolaan data pengembalian.
- Pengelolaan denda.
- Dashboard informasi.
- Analisis Data Warehouse.

## Struktur Repository

```text
data-warehouse-peminjaman-buku/
│
├── project/
│   └── Sistem Peminjaman Buku (Laravel)
│
├── data-warehouse/
│   ├── star-schema/
│   │   └── star_schema.sql
│   │
│   └── snowflake-schema/
│       └── snowflake_schema.sql
│
└── README.md
```

## Data Warehouse

Data Warehouse pada proyek ini menggunakan dua model dimensional, yaitu:

### 1. Star Schema

Star Schema digunakan untuk menyusun tabel fakta dan tabel dimensi dalam struktur yang sederhana sehingga memudahkan proses analisis data.

### 2. Snowflake Schema

Snowflake Schema merupakan pengembangan dari Star Schema dengan melakukan normalisasi pada beberapa tabel dimensi.

Pada rancangan ini, data kategori buku dipisahkan menjadi tabel dimensi tersendiri sehingga struktur data menjadi lebih terorganisir.

## OLAP

Query OLAP digunakan untuk melakukan analisis terhadap data yang tersimpan pada Data Warehouse.

Analisis yang dihasilkan meliputi:

- Total Peminjaman
- Total Pengembalian
- Total Denda
- Peminjaman Berdasarkan Kategori
- Buku Terpopuler
- Aktivitas Bulanan

## Dashboard Visualisasi

Hasil query OLAP kemudian divisualisasikan menggunakan Looker Studio. Dashboard menampilkan informasi peminjaman dan pengembalian buku dalam bentuk grafik dan ringkasan data.

Dashboard terdiri dari:

- Total Peminjaman
- Total Pengembalian
- Total Denda
- Peminjaman Berdasarkan Kategori
- Buku Terpopuler
- Aktivitas Bulanan

### Link Dashboard

https://datastudio.google.com/reporting/1fd1b275-ff94-4fcc-b2bc-a8c9b2bdee34

## Dokumentasi

Dokumentasi berupa diagram Star Schema dan Snowflake Schema serta hasil dashboard visualisasi telah dicantumkan pada laporan proyek.

## Kesimpulan

Proyek ini menerapkan konsep Data Warehouse pada Sistem Peminjaman Buku dengan menggunakan Star Schema dan Snowflake Schema. Data yang dihasilkan dari sistem dapat dianalisis menggunakan query OLAP dan disajikan melalui dashboard visualisasi untuk membantu memperoleh informasi mengenai aktivitas peminjaman dan pengembalian buku.
