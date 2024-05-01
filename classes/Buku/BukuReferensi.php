<?php
require_once "Buku.php";

class ReferenceBook extends Buku
{
    private $isbn;
    private $penerbit;

    public function __construct($judul, $penulis, $tahun_terbit, $isbn, $penerbit)
    {
        parent::__construct($judul, $penulis, $tahun_terbit);
        $this->isbn = $isbn;
        $this->penerbit = $penerbit;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function getPenerbit()
    {
        return $this->penerbit;
    }
}
