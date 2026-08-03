<?php
class Barang{
  private $_formItem = [];
  private $_db = null;

  public function __construct(){
    $this->_db = DB::getInstance();
  }

  public function validasi($formMethod){
    $validate = new Validate($formMethod);

    $this->_formItem['nama_inventaris'] = $validate->setRules('nama_inventaris',
    'Nama inventaris', [
      'required' => true,
      'sanitize' => 'string'
    ]);

    $this->_formItem['jumlah_inventaris'] = $validate->setRules('jumlah_inventaris',
    'Jumlah inventaris', [
      'numeric' => true,
      'min_value' => 0
    ]);

    $this->_formItem['biaya_inventaris'] = $validate->setRules('biaya_inventaris',
    'Harga inventaris', [
      'numeric' => true,
      'min_value' => 0
    ]);

    if(!$validate->passed()) {
      return $validate->getError();
    }
  }

  public function getItem($elemen){
    return isset($this->_formItem[$elemen]) ? $this->_formItem[$elemen] : '';
  }

  public function insert(){
    $newBarang = [
      'nama_inventaris' => $this->getItem('nama_inventaris'),
      'jumlah_inventaris' => $this->getItem('jumlah_inventaris'),
      'biaya_inventaris' => $this->getItem('biaya_inventaris'),
      'waktu_pembaruan' => date("Y-m-d H:i:s") // Tanggal saat ini
    ];
    return $this->_db->insert('inventaris',$newBarang);
  }

  public function generate($id_inventaris){
    $hasil = $this->_db->getWhereOnce('inventaris',['id_inventaris','=',$id_inventaris]); //SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris
    foreach ($hasil as $key => $val) {
      $this->_formItem[$key] = $val;
    }
  }
// $this->_formItem[id_inventaris] = 1
// $this->_formItem[nama_inventaris] = 'TV NusaTech 43NU7090 4K'
// $this->_formItem[jumlah_inventaris] = 5399000
// $this->_formItem[waktu_pembaruan] = 2019-04-10 18:29:30

  public function update($id_inventaris){
    $newBarang = [
      'nama_inventaris' => $this->getItem('nama_inventaris'),
      'jumlah_inventaris' => $this->getItem('jumlah_inventaris'),
      'biaya_inventaris' => $this->getItem('biaya_inventaris')
    ];
    $this->_db->update('inventaris',$newBarang,['id_inventaris','=',$id_inventaris]);
  }

  public function delete($id_inventaris){
    $this->_db->delete('inventaris',['id_inventaris','=',$id_inventaris]);
  }
}
