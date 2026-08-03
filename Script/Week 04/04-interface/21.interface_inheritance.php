<?php
interface DapatDikirim {
  public function hitungBiayaDolar();
  public function daftarTujuan();
}

interface PanganTersimpan {
  public function cekKedaluwarsa();
}

interface PanganBeku extends PanganTersimpan {
  public function suhuMinimum();
}

class PaketSayuran implements DapatDikirim, PanganBeku {
  public function hitungBiayaDolar(){
    return 8.25;
  }
  public function daftarTujuan(){
    return ["Brunei", "Vietnam", "Filipina"];
  }
  public function suhuMinimum(){
    return -16;
  }
}
