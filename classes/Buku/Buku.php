<?php

class Buku
{
    private $judul;
    private $penulis;
    private $tahun_terbit;
    private $dipinjam;
    private $peminjam;
    private $tanggal_kembali;
    private $denda;

    public function __construct($judul, $penulis, $tahun_terbit)
    {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun_terbit = $tahun_terbit;
        $this->dipinjam = false;
    }

    public function getJudul()
    {
        return $this->judul;
    }

    public function getPenulis()
    {
        return $this->penulis;
    }

    public function getTahunTerbit()
    {
        return $this->tahun_terbit;
    }

    public function getPeminjam()
    {
        return $this->peminjam;
    }
    public function getTanggalKembali()
    {
        return $this->tanggal_kembali;
    }
    public function dipinjam()
    {
        return $this->dipinjam;
    }
    public function pinjamBuku($borrower, $returnDate)
    {
        if (!$this->dipinjam) {
            $this->dipinjam = true;
            $this->peminjam = $borrower;
            $this->tanggal_kembali = $returnDate;
        }
    }
    public function kembalikanBuku()
    {
        if ($this->dipinjam) {
            $hari_ini = new DateTime();
            $tanggal_kembali = new DateTime($this->tanggal_kembali);
            if ($tanggal_kembali < $hari_ini) {
                $denda = 5000;
                $this->denda = $denda;
                echo "<script>alert('Buku berhasil dikembalikan. Anda terkena denda sebanyak $denda');</script>";
            } else {
                echo "<script>alert('Buku berhasil dikembalikan. Tidak ada denda yang dikenakan');</script>";
            }

            $this->dipinjam = false;
            $this->peminjam = "";
            $this->tanggal_kembali = "";
        }
    }
}
