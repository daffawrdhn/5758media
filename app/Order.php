<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
  protected $fillable = [
      'idu',
      'nama',
      'alamat',
      'acara',
      'paket',
      'no_hp',
      'jenis_jaminan',
      'upload_jaminan',
      'harga_unit',
      'jumlah_unit',
      'jumlah_hari',
      'tanggal_sewa',
      'total_pembayaran',
      'dp',
      'dp_upload',
      'pelunasan',
      'tanggal_dp',
      'tanggal_kembali',
      'status',
      'keterangan',
      'kode',
  ];
  protected $dates = ['deleted_at','tanggal_sewa','tanggal_kembali','tanggal_dp','tanggal_pelunasan'];
}
