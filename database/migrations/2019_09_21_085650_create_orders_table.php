<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('idu')->nullable();
          $table->string('kode')->nullable();
          //penyewa
          $table->string('nama')->nullable();
          $table->text('alamat')->nullable();
          //paket
          $table->integer('paket')->nullable();
          $table->string('acara')->nullable();
          $table->string('no_hp')->nullable();
          //jaminan
          $table->string('jenis_jaminan')->nullable();
          $table->string('upload_jaminan')->nullable();
          //peminjaman
          $table->integer('harga_unit')->nullable();
          $table->integer('jumlah_unit')->nullable();
          $table->integer('jumlah_hari')->nullable();
          $table->date('tanggal_sewa')->nullable();
          $table->date('tanggal_kembali')->nullable();
          //pembayaran
          $table->integer('total_pembayaran')->nullable();
          $table->integer('dp')->nullable();
          $table->dateTime('tanggal_dp')->nullable();
          $table->integer('pelunasan')->nullable();
          $table->dateTime('tanggal_pelunasan')->nullable();
          $table->string('dp_upload')->nullable();
          $table->integer('status')->nullable();
          $table->text('keterangan')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
