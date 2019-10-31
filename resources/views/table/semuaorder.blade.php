@extends('dashboard_baru')

@section('content')
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Kode</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Paket</th>

        <th scope="col">Acara</th>
        <th scope="col">Nomor hp</th>
        <th scope="col">Jaminan</th>
        <th scope="col">Upload jaminan</th>

        <th scope="col">Harga unit</th>
        <th scope="col">Jumlah unit</th>
        <th scope="col">Jumlah hari</th>
        <th scope="col">Tanggal sewa</th>
        <th scope="col">Tanggal kembali</th>

        <th scope="col">Total pembayaran</th>
        <th scope="col">DP</th>
        <th scope="col">Tanggal dp</th>
        <th scope="col">Pelunasan</th>
        <th scope="col">Tanggal pelunasan</th>

        <th scope="col">Status</th>
        <th scope="col">Keterangan</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($semuaorder_data as $o)
      <tr>
        <td>{{ $o -> id }}</td>
        <td>{{ $o -> kode }}</td>

        <td>{{ $o -> nama }}</td>
        <td>{{ $o -> alamat }}</td>

        <td>{{ $o -> paket }}</td>

        <td>{{ $o -> acara }}</td>
        <td>{{ $o -> no_hp }}</td>
        <td>{{ $o -> jenis_jaminan }}</td>
        <td>{{ $o -> upload_jaminan }}</td>

        <td>{{ $o -> harga_unit }}</td>
        <td>{{ $o -> jumlah_unit }}</td>
        <td>{{ $o -> jumlah_hari }}</td>
        <td>{{ $o -> tanggal_sewa }}</td>
        <td>{{ $o -> tanggal_kembali }}</td>

        <td>{{ $o -> total_pembayaran }}</td>
        <td>{{ $o -> dp }}</td>
        <td>{{ $o -> tanggal_dp }}</td>
        <td>{{ $o -> pelunasan }}</td>
        <td>{{ $o -> tanggal_pelunasan }}</td>

        <td>{{ $o -> status }}</td>

        <td>{{ $o -> keterangan }}</td>
        <td>eyasy
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
