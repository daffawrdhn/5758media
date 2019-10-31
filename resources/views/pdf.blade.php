
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{$orders->nama}} - {{$orders->kode}}</title>
    <link href="{{ public_path("/css/bootstrap.css")}}" rel="stylesheet">
  </head>
  <body>
    <div class="card">
      <div class="card-body shadow">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAAC7CAMAAAB/72G+AAAACXBIWXMAAAsSAAALEgHS3X78AAAA0lBMVEX///+mpqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqampqZBj5hOlp9anqZnpa10rbOAtLqNvMGaw8impqamy8+z0tbA2t3M4eTZ6erm8PHugT7viUvwkljxmmXy+Pjzo3H0q371s4v2vJj3xKX4zbL51b/63cz85tj97uX+9/L///+oUkVAAAAAJnRSTlMAECAwQFBgcICIkZ+ipq2us7vAxdHV2d3g5Obq7O729/j6+/z9/oGClqAAAAShSURBVHja7dttW5tIFAZgEidYu13r1jZ21+5GV5dEYA7hJSoxxETy/P+/tB9iLAQm4aUDXjrnU8oVvWWYeYaBqWbUKa1uKV3pSle60pWu9NeoT+rUq9RDpIo3q6NNfQgEPFFmo7opPt03r3PAblU336vuAcZ71QMELeqA16q+rtBz+U3TupkKed9qVh9t8n3shQAwbm1+t1wATnt3FzaE2dPEvc1Y2Pb5OnJqWVm/Afz2dAOi6BPqUapiIGpST/37Dljd1ml5r44+F516rj60Mr3OqaHfroC74jpP31bZAEY19Ah4LD7ihgACvvFGTum0iaJUQ8fAfYnxbgYAELicc8ernbQz0XAT9jo7SAzVoN4s8wRMy2bdDXd9AKHnWPVm2CkQt7eKXAKz1vQ7YNXeCvpRmDQN6OKQbULfkTTy9R0h24A+AxbtPbeJdySNdH1XyMrXdyaNbH1nyErXFzuTRrK+J2kk6497T12ivi9pJpPJpPZT5qohK1cvcuqTmqvAuqtIpStd6UpXutJfry5jfl6lnzRGzepoU78F4uSjzqlYr3dfKFoHRAWv+5vTo30LMNn69L3qy61n3O9Jj/ctvKXq+554yNbXtVouovum9Wkq5J8emtXvNvn+uFwBO1bCclo+UQ8LAPMKuuV4HuB53KqhTyYzCLNHrPPETq2Q19Anj8K2F+lDH0Dg2KZpOwEAf1hdvweeyukeEL40uBWK3yYWGdYQRZ9At4EwsWHiJhRtXZKiu1uaDbh1Wn5ZSg+B4db7xbCwfvuQ6XXzUnrmnbXoJXbum8z0bdUM4re4+XqQPfegqH4LII423t28fNrUuu7TGADiRRRF82WVpDWBIHHyw1C0bSS/183ixCwTl59lxoD/4pm+eNeIqJ9HiycAq+X8ocIMOxwD8Lllmhb3AYxrZF2V+d1KvMUOzDo5X0FPvUKHbzepD10Arm0ahmGYtofS172W7gJ+IufF3U6GbqUH3HrIWU3pbmZKE8WNDD3MpLpompGh58wpgmlGhh5kdgeNBNOMDH2c2QPOBZ1ehm4CuNk+YDY23h0A/GXMDblwr5ScpHUAwOWWadrchXijlqScN71kzntms7OMYYz4eL2ScvjIMJrWf80q8i3r6v+YKV3pSle60pWu9Nelq1KlSpUqVapUqVKlSpWqlqvDDnI+dj88F0sd0Fkn/0c1TdMYK68zutj8xqP/zn4efa6P6QPXdNxJ/OhZ4hfpRHoFnY6fT48ooV/2+/1+v6+nD1wQ/XOQr38n+l5Fp3WTfUnpZ9tfWx/QB3TeyfsSuyK6YlX0r5sP+3XtgK71vC+d0skpnZbX/15fsHP6s4iunaz/2K0vdS+vGLu67JbWz45o0NEO6aKXve6/Z/XDl09J/ZjONe3HpguV0TsDOuoM6JBRps+fFdQ7dK1rmn5NndK6phP9QedaSv+LMcbYQcGWPyL6/OnTZ6Kj8rr2lYhYWi/X6wabfBhU0A+IvmiF9PwRp19TjzHGej//tBK69rHf3dKf0+a3Qmnz0t1O6EcFPfvxub4VSdoebYZa91/q/cJZRk8d6OXPMt1E72RdTZWqVP0PrNjB9e/ojNsAAAAASUVORK5CYII=" class="img-fluid">
              </th>
              <th class="text-right align-middle" scope="col" style="margin: 0px auto;">
                <address class="font-weight-normal">
                  <strong>Invoice #: 000{{$orders->id}}</strong><br>
                  Created: {{$orders->created_at->toFormattedDateString()}}<br>
                  Due: {{$orders->tanggal_kembali->toFormattedDateString()}}<br>
                  Code: <strong class="text-monospace">{{$orders->kode}}</strong>
                </address>
              </th>
            </tr>
          </thead>
        </table>
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">
                <address class="font-weight-normal">
                  5758 Media<br>
                  Perum. Semeru Blok H no.6<br>
                  Sumbersari, Jember, 68121<br>
                  <abbr title="Phone">P:</abbr> (62) 89516156911
                </address>
              </th>
              <th class="text-right align-middle" scope="col" style="margin: 0px auto;">
                <address class="font-weight-normal">
                  {{$orders->nama}}<br>
                  {{$orders->acara}}, {{$orders->alamat}}<br>
                  <abbr title="Phone">P:</abbr> (62) {{$orders->no_hp}}
                </address>
              </th>
            </tr>
          </thead>
        </table>

        <table class="table table-sm">
          <thead class="thead-light">
            <tr>
              <th scope="col">
                <strong>Order Detail</strong><br>
              </th>
              <th class="text-right align-middle" scope="col">
              <strong>Check#</strong><br></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><span class="font-weight-normal text-muted">Package</span>
                @if ($orders->paket == 1)
                    <span class="font-weight-bold">Normal</span>
                @elseif ($orders->paket == 2)
                    <span class="font-weight-bold">Media Partner</span>
                @else
                    <span class="text-muted">ERROR</span>
                @endif
              </th>
              <td class="text-right align-middle">
                    <p class="font-weight-bold">Rp. {{$orders->harga_unit}}/Unit/24Jam</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><span class="font-weight-bold">Duration, <span class="font-weight-normal">for</span> {{$orders->tanggal_sewa->toDateString()}} <span class="font-weight-normal">until</span> {{$orders->tanggal_kembali->toDateString()}} </span>
              </th>
              <td class="text-right align-middle">
                    <p class="font-weight-bold">{{$orders->jumlah_hari}} Days</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><span class="font-weight-bold">Unit</span>
              </th>
              <td class="text-right align-middle">
                    <p class="font-weight-bold">{{$orders->jumlah_unit}} Units</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><span class="font-weight-bold">Total order</span>
              </th>
              <td class="text-right align-middle">
                @if (isset($orders->total_pembayaran))
                    <p class="font-weight-bold">Rp. {{$orders->total_pembayaran}}</p>
                @elseif (is_null($orders->total_pembayaran))
                    on process
                @else
                    <p class="font-weight-bold">ERROR</p>
                @endif
              </td>
            </tr>

          </tbody>
        </table>
        <table class="table table-sm">
          <thead class="thead-light">
            <tr>
              <th scope="col">
                <strong>Payment Method</strong><br>
              </th>
              <th class="text-right align-middle" scope="col">
              <strong>Check#</strong><br></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Down payment
                @if (isset($orders->tanggal_dp))
                    <span class="font-weight-normal text-muted">,{{$orders->tanggal_dp->toFormattedDateString()}}</span>
                @elseif (is_null($orders->tanggal_dp))
                    on process
                @else
                    <span class="text-muted">ERROR</span>
                @endif
              </th>
              <td class="text-right align-middle">
                @if (isset($orders->dp))
                    <p class="font-weight-bold">Rp. {{$orders->dp}}</p>
                @elseif (is_null($orders->pelunasan))
                    0
                @else
                    <p class="font-weight-bold">ERROR</p>
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">Full payment
                @if (isset($orders->tanggal_pelunasan))
                    <span class="font-weight-normal text-muted">,{{$orders->tanggal_pelunasan->toFormattedDateString()}}</span>
                @elseif (is_null($orders->tanggal_pelunasan))
                    on process
                @else
                    <span class="text-muted">ERROR</span>
                @endif
              </th>
              <td class="text-right align-middle">
                @if (isset($orders->pelunasan))
                    <p class="font-weight-bold">Rp. {{$orders->pelunasan}}</p>
                @elseif (is_null($orders->pelunasan))
                    0
                @else
                    <p class="font-weight-bold">ERROR</p>
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row"><span class="font-weight-bold">Total payment</span>
              </th>
              <td class="text-right align-middle">
                @if (isset($orders->total_pembayaran))
                    <p class="font-weight-bold">Rp. {{($orders->dp + $orders->pelunasan)}}</p>
                @elseif (is_null($orders->total_pembayaran))
                    0
                @else
                    <p class="font-weight-bold">ERROR</p>
                @endif
              </td>
            </tr>
          </tbody>
        </table>

        <br> <br> <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th scope="col">
                <strong>STATUS:</strong><br>
              </th>
              <th class="text-right" scope="col">
              <strong>CODE:</strong><br></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                @if($orders->status =='0')
                        <h3>Menunggu di proses</h3>
                  @elseif($orders->status =='1')
                        <h3>Proses pembayaran</h3>
                  @elseif($orders->status =='2')
                        <h3>Pembayaran di konfirmasi penyewa</h3>
                  @elseif($orders->status =='3')
                        <h3>Proses jaminan</h3>
                  @elseif($orders->status =='4')
                        <h3>Jaminan di konfirmasi penyewa</h3>
                  @elseif($orders->status =='5')
                        <h3>Sewa berjalan</h3>
                  @elseif($orders->status =='6')
                        <h3>Sewa selesai</h3>
                  @elseif($orders->status =='98')
                        <h3>Proses pembatalan order</h3>
                  @elseif($orders->status =='99')
                        <h3>Pesanan dibatalkan</h3>
                  @else
                        <h3>ERROR</h3>
                @endif
              </th>
              <td class="text-right align-middle">
                <h3 class="text-monospace">{{$orders->kode}}</h3>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th scope="col">
                <strong>JAMINAN:</strong><br>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">
                @if (isset($orders->jenis_jaminan))
                    <p class="font-weight-bold">{{$orders->jenis_jaminan}}</p>
                @elseif (is_null($orders->jenis_jaminan))
                    On process
                @else
                    <p class="font-weight-bold">ERROR</p>
                @endif
              </th>
            </tr>
          </tbody>
        </table>

        <br> <br> <p class="text-muted">*Lampiran ini dikeluarkan dan bersifat resmi oleh pihak 5758Media sebagai tanda bukti pembayaran dan pengganti nota pembayaran yang telah ada sebelumnya.</p>

      </div>
    </div>
  </body>
</html>
