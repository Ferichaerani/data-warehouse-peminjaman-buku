-- =====================================================
-- STAR SCHEMA
-- SISTEM PERPUSTAKAAN SEKOLAH
-- =====================================================

PRAGMA foreign_keys = OFF;

-- =====================================================
-- 1. HAPUS SEMUA TABEL SEBELUMNYA
-- =====================================================

DROP TABLE IF EXISTS fact_pengembalian;
DROP TABLE IF EXISTS fact_peminjaman;

DROP TABLE IF EXISTS dim_pengembalian;
DROP TABLE IF EXISTS dim_status;
DROP TABLE IF EXISTS dim_waktu;
DROP TABLE IF EXISTS dim_siswa;
DROP TABLE IF EXISTS dim_buku;

-- KHUSUS MENGHAPUS TABEL DARI SNOWFLAKE
DROP TABLE IF EXISTS dim_kategori;

PRAGMA foreign_keys = ON;


-- =====================================================
-- 2. DIMENSI BUKU
-- Kategori langsung berada di dalam dim_buku
-- =====================================================

CREATE TABLE dim_buku (
    id_buku INTEGER PRIMARY KEY,
    judul TEXT NOT NULL,
    penulis TEXT,
    penerbit TEXT,
    nama_kategori TEXT,
    stok INTEGER,
    status_buku TEXT
);

INSERT INTO dim_buku
(id_buku, judul, penulis, penerbit, nama_kategori, stok, status_buku)
VALUES
(1, 'dikta dan hukum', 'Farah', 'Gramedia', 'Novel', 0, 'Dipinjam'),
(2, 'kimia itu mudah', 'Ridho', 'Gramedia', 'Sains', 2, 'Tersedia'),
(3, 'fisika itu mudah', 'Sindi', 'Gramedia', 'Sains', 20, 'Tersedia'),
(4, 'senja', 'Fericha', 'Gramedia', 'Novel', 10, 'Tersedia'),
(5, 'sky', 'Aulia', 'Gramedia', 'Novel', 7, 'Tersedia');


-- =====================================================
-- 3. DIMENSI SISWA
-- =====================================================

CREATE TABLE dim_siswa (
    id_siswa INTEGER PRIMARY KEY,
    nis TEXT,
    nama_siswa TEXT NOT NULL,
    email TEXT,
    no_telp TEXT
);

INSERT INTO dim_siswa
(id_siswa, nis, nama_siswa, email, no_telp)
VALUES
(1, '2301022015', 'Rudi Syahputra', 'rudi@gmail.com', '0813176692'),
(2, '222000', 'Shofi', 'shofi@gmail.com', '077777'),
(3, '2222', 'Muslimah', 'muslimah@gmail.com', '0777666'),
(4, '23010220016', 'Paula', 'paula@gmail.com', '0813175244252'),
(5, '23010220019', 'Sindi', 'sindi@gmail.com', '0812219888'),
(6, '00029282', 'Lily', 'lily@gmail.com', '098765422');


-- =====================================================
-- 4. DIMENSI WAKTU
-- =====================================================

CREATE TABLE dim_waktu (
    id_waktu INTEGER PRIMARY KEY,
    tanggal TEXT NOT NULL,
    hari TEXT,
    bulan TEXT,
    tahun INTEGER
);

INSERT INTO dim_waktu
(id_waktu, tanggal, hari, bulan, tahun)
VALUES
(1, '2025-05-07', 'Rabu', 'Mei', 2025),
(2, '2025-05-28', 'Rabu', 'Mei', 2025),
(3, '2026-02-03', 'Selasa', 'Februari', 2026),
(4, '2026-02-04', 'Rabu', 'Februari', 2026),
(5, '2026-02-11', 'Rabu', 'Februari', 2026);


-- =====================================================
-- 5. DIMENSI STATUS
-- =====================================================

CREATE TABLE dim_status (
    id_status INTEGER PRIMARY KEY,
    status TEXT NOT NULL
);

INSERT INTO dim_status
(id_status, status)
VALUES
(1, 'Dipinjam'),
(2, 'Dikembalikan');


-- =====================================================
-- 6. DIMENSI PENGEMBALIAN
-- =====================================================

CREATE TABLE dim_pengembalian (
    id_pengembalian INTEGER PRIMARY KEY,
    jenis_pengembalian TEXT NOT NULL,
    keterangan TEXT
);

INSERT INTO dim_pengembalian
(id_pengembalian, jenis_pengembalian, keterangan)
VALUES
(1, 'Tepat Waktu', 'Buku dikembalikan sesuai batas waktu'),
(2, 'Terlambat', 'Buku dikembalikan melewati batas waktu');


-- =====================================================
-- 7. FACT PEMINJAMAN
-- =====================================================

CREATE TABLE fact_peminjaman (
    id_fact_peminjaman INTEGER PRIMARY KEY AUTOINCREMENT,

    id_buku INTEGER NOT NULL,
    id_siswa INTEGER NOT NULL,
    id_waktu INTEGER NOT NULL,
    id_status INTEGER NOT NULL,

    jumlah_peminjaman INTEGER,
    lama_peminjaman INTEGER,

    FOREIGN KEY (id_buku)
        REFERENCES dim_buku(id_buku),

    FOREIGN KEY (id_siswa)
        REFERENCES dim_siswa(id_siswa),

    FOREIGN KEY (id_waktu)
        REFERENCES dim_waktu(id_waktu),

    FOREIGN KEY (id_status)
        REFERENCES dim_status(id_status)
);

INSERT INTO fact_peminjaman
(
    id_buku,
    id_siswa,
    id_waktu,
    id_status,
    jumlah_peminjaman,
    lama_peminjaman
)
VALUES
(1, 1, 1, 2, 1, 24),
(3, 3, 2, 2, 1, 1),
(4, 4, 3, 2, 1, 8),
(5, 6, 4, 1, 1, 1);


-- =====================================================
-- 8. FACT PENGEMBALIAN
-- =====================================================

CREATE TABLE fact_pengembalian (
    id_fact_pengembalian INTEGER PRIMARY KEY AUTOINCREMENT,

    id_buku INTEGER NOT NULL,
    id_siswa INTEGER NOT NULL,
    id_waktu INTEGER NOT NULL,
    id_status INTEGER NOT NULL,
    id_pengembalian INTEGER NOT NULL,

    jumlah_pengembalian INTEGER,
    denda REAL,

    FOREIGN KEY (id_buku)
        REFERENCES dim_buku(id_buku),

    FOREIGN KEY (id_siswa)
        REFERENCES dim_siswa(id_siswa),

    FOREIGN KEY (id_waktu)
        REFERENCES dim_waktu(id_waktu),

    FOREIGN KEY (id_status)
        REFERENCES dim_status(id_status),

    FOREIGN KEY (id_pengembalian)
        REFERENCES dim_pengembalian(id_pengembalian)
);

INSERT INTO fact_pengembalian
(
    id_buku,
    id_siswa,
    id_waktu,
    id_status,
    id_pengembalian,
    jumlah_pengembalian,
    denda
)
VALUES
(1, 1, 2, 2, 1, 1, 0),
(3, 3, 3, 2, 1, 1, 0),
(4, 4, 5, 2, 2, 1, 10000);


-- =====================================================
-- 9. CEK TABEL YANG TERBENTUK
-- =====================================================

SELECT name AS nama_tabel
FROM sqlite_master
WHERE type = 'table'
AND name NOT LIKE 'sqlite_%'
ORDER BY name;


-- =====================================================
-- 10. QUERY DATA PEMINJAMAN
-- =====================================================

SELECT
    f.id_fact_peminjaman,
    s.nama_siswa,
    b.judul,
    b.nama_kategori,
    w.tanggal,
    st.status,
    f.jumlah_peminjaman,
    f.lama_peminjaman
FROM fact_peminjaman f
JOIN dim_siswa s
    ON f.id_siswa = s.id_siswa
JOIN dim_buku b
    ON f.id_buku = b.id_buku
JOIN dim_waktu w
    ON f.id_waktu = w.id_waktu
JOIN dim_status st
    ON f.id_status = st.id_status;


-- =====================================================
-- 11. QUERY DATA PENGEMBALIAN
-- =====================================================

SELECT
    f.id_fact_pengembalian,
    s.nama_siswa,
    b.judul,
    w.tanggal AS tanggal_pengembalian,
    p.jenis_pengembalian,
    f.denda,
    st.status
FROM fact_pengembalian f
JOIN dim_siswa s
    ON f.id_siswa = s.id_siswa
JOIN dim_buku b
    ON f.id_buku = b.id_buku
JOIN dim_waktu w
    ON f.id_waktu = w.id_waktu
JOIN dim_pengembalian p
    ON f.id_pengembalian = p.id_pengembalian
JOIN dim_status st
    ON f.id_status = st.id_status;


-- =====================================================
-- 12. ANALISIS JUMLAH PEMINJAMAN BERDASARKAN KATEGORI
-- =====================================================

SELECT
    b.nama_kategori,
    SUM(f.jumlah_peminjaman) AS total_peminjaman
FROM fact_peminjaman f
JOIN dim_buku b
    ON f.id_buku = b.id_buku
GROUP BY b.nama_kategori
ORDER BY total_peminjaman DESC;


-- =====================================================
-- 13. ANALISIS BUKU PALING BANYAK DIPINJAM
-- =====================================================

SELECT
    b.judul,
    SUM(f.jumlah_peminjaman) AS total_peminjaman
FROM fact_peminjaman f
JOIN dim_buku b
    ON f.id_buku = b.id_buku
GROUP BY b.judul
ORDER BY total_peminjaman DESC;


-- =====================================================
-- 14. ANALISIS SISWA PALING BANYAK MEMINJAM
-- =====================================================

SELECT
    s.nama_siswa,
    SUM(f.jumlah_peminjaman) AS total_peminjaman
FROM fact_peminjaman f
JOIN dim_siswa s
    ON f.id_siswa = s.id_siswa
GROUP BY s.nama_siswa
ORDER BY total_peminjaman DESC;


-- =====================================================
-- 15. TOTAL DENDA
-- =====================================================

SELECT
    SUM(denda) AS total_denda
FROM fact_pengembalian;


-- =====================================================
-- 16. ANALISIS PENGEMBALIAN
-- =====================================================

SELECT
    p.jenis_pengembalian,
    COUNT(*) AS jumlah_pengembalian,
    SUM(f.denda) AS total_denda
FROM fact_pengembalian f
JOIN dim_pengembalian p
    ON f.id_pengembalian = p.id_pengembalian
GROUP BY p.jenis_pengembalian;
