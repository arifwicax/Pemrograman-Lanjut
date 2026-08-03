<?php
interface DapatDikirim {
  public function hitungBiayaDolar();
  public function daftarTujuan();
}

class PemindaiDokumen implements DapatDikirim {
}

// Fatal error: class belum mengimplementasikan seluruh method pada interface.
