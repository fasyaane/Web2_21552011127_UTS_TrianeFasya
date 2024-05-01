<?php
class Perpustakaan
{
    private $books = [];

    public function tambahBuku(ReferenceBook $book)
    {
        $this->books[] = $book;
    }
    public function cariBukuByISBN($isbn)
    {
        foreach ($this->books as $key => $book) {
            if ($book instanceof ReferenceBook && $book->getISBN() === $isbn) {
                return $this->books[$key];
            }
        }
        return false;
    }
    public function hapusBuku($isbn)
    {
        foreach ($this->books as $key => $book) {
            if ($book instanceof ReferenceBook && $book->getISBN() === $isbn) {
                unset($this->books[$key]);
                return true;
            }
        }
        return false;
    }
    public function getSemuaBuku()
    {
        return $this->books;
    }

    public function cariBuku($keyword)
    {
        $hasil = [];

        foreach ($this->books as $book) {
            if (stripos($book->getJudul(), $keyword) !== false || stripos($book->getPenulis(), $keyword) !== false) {
                $hasil[] = $book;
            }
        }

        return $hasil;
    }

    public function urutkanBuku($kriteria)
    {
        $bukuTerurut = $this->books;

        usort($bukuTerurut, function ($a, $b) use ($kriteria) {
            if ($kriteria === 'penulis') {
                return strcmp($a->getPenulis(), $b->getPenulis());
            } elseif ($kriteria === 'tahun') {
                return $a->getTahunTerbit() - $b->getTahunTerbit();
            }
            return 0;
        });

        return $bukuTerurut;
    }
    public function cekLimitPinjam($peminjam)
    {
        $peminjamCounter = 0;

        foreach ($this->books as $book) {
            if ($book->dipinjam()) {
                $peminjamBuku = $book->getPeminjam();
                if ($peminjamBuku === $peminjam) {
                    $peminjamCounter++;
                }
            }
        }

        if ($peminjamCounter >= 3) {
            echo "<script>alert('Anda telah mencapai batas peminjaman buku');</script>";
            return false;
        }
        return true;
    }

    public function saveKeSession()
    {
        $_SESSION['perpustakaan'] = $this;
    }
}
