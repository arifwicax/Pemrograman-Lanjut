<?php
interface DapatDikirim {
  public function hitungBiayaDolar();
  public function daftarTujuan();
  public const TARIF_LAYANAN = 0.65;
}

echo DapatDikirim::TARIF_LAYANAN;   // 0.65
