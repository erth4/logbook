<html>

<head>
    <style>
        body {
            font-size: 11px;
            font-family: 'Calibri', sans-serif;
        }
    	h5 {
    		margin: 0;
    	}
    	table {
    		width: 100%;
    		border-collapse: collapse;
    	}

    	.table th {
    		font-weight: bold;
    		border: 1px solid;
    		padding: 8px;
    		font-size: 11px;
    		background: #ddd;
    		text-align: center;
    	}

    	.table td {
    		border: 1px solid;
    		padding: 5px;
    		font-size: 11px;
            vertical-align: top;
    	}

        .table2 td {
            padding: 2px;
            padding-left: 0;
            vertical-align: middle !important;
        }

    	.text-center {
    		text-align: center;
    	}
    </style>
</head>

<body>
	<div class="text-center" style="margin-bottom: 15px;">
		<h5 style="font-size:12px">LOG BOOK KERJA PRAKTIK MAHASISWA</h5>
		<h5 style="font-size:12px">PROGRAM STUDI TEKNIK INFORMATIKA  T.A ...... / ......</h5>
        <i>(WAJIB DIISI DAN MASUK DALAM PENILAIAN)</i>
	</div>


    <div style="margin-bottom: 15px;">
        <table class="table2">
            <tr>
                <td style="width: 20%;">NIM</td>
                <td style="width: 1%;">:</td>
                <td>{{ auth()->user()->identity_number }}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Nama Mahasiswa</td>
                <td style="width: 1%;">:</td>
                <td>{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Judul Kerja Praktik</td>
                <td style="width: 1%;">:</td>
                <td>{{ auth()->user()->title_project }}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Dosen Pembimbing</td>
                <td style="width: 1%;">:</td>
                <td>{{ auth()->user()->dosen_pembimbing }}</td>
            </tr>
            <tr>
                <td style="width: 20%;">Pembimbing Lapangan</td>
                <td style="width: 1%;">:</td>
                <td>{{ auth()->user()->dosen_lap }}</td>
            </tr>
        </table>
    </div>

    <div>
        <u>Petunjuk Pengisian Log Book</u>
       
        <ol style="padding: 0;padding-left: 17px;">
            <li>Log book di isi per minggu</li>
            <li>Log book ditulis tangan</li>
            <li>Setiap kegiatan di paraf oleh pembimbing lapangan/ dosen pembimbing KP</li>
            <li>Log book per minggu di paraf oleh dosen pengampu kelas KP</li>
            <li>Jumlah bimbingan minimal 7 minggu</li>
        </ol>
    </div>

    <div style="margin-bottom: 10px;">
        <strong>{{ $status }}</strong>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 4%;">No</th>
                <th rowspan="2">Kegiatan dan Lokasi KP</th>
                <th colspan="2">Waktu Pelaksanaan</th>
                <th rowspan="2" style="width: 20%;">Hasil</th>
                <th rowspan="2" style="width: 20%;">Kendala, Rencana Perubahan (Jika ada)</th>
                <th rowspan="2" style="width: 10%;">Paraf Pembimbing Lapangan</th>
                <th rowspan="2" style="width: 10%;">Paraf Dosen Pembimbing KP</th>
            </tr>
            <tr>
                <th style="width: 8%;">Hari/TGL</th>
                <th style="width: 8%;">Jam</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($logbook as $key => $value)
        	<tr>
        		<td class="text-center">{{ $key+1 }}</td>
        		<td>{!! nl2br($value['description']) !!}</td>
        		<td class="text-center">{!! \Carbon\Carbon::parse($value['execution_date'])->isoFormat('dddd, D MMM Y') !!}</td>
        		<td class="text-center">{!! \Carbon\Carbon::parse($value['start_time'])->format('H:i') !!} - {!! \Carbon\Carbon::parse($value['end_time'])->format('H:i') !!}</td>
        		<td>{!! nl2br($value['results']) !!}</td>
        		<td>{!! nl2br($value['constraint']) !!}</td>
        		<td></td>
        		<td></td>
        	</tr>
        	@endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;page-break-inside: avoid;">
        <span>Catatan Pembimbing Lapangan/Dosen Pembimbing KP/ Dosen Pengampu Kelas KP:</span>
        <div style="width: 90%">{{ str_repeat('.', 1794) }}</div>
    </div>

    <div style="margin-top: 35px;page-break-inside:avoid;">
        <table style="margin-bottom: 10px;">
            <tr>
                <td></td>
                <td style="width: 40%;height: 10px !important;"></td>
                <td style="text-align: center;width: 30%;">
                    <span>Yogyakarta, {!! \Carbon\Carbon::now()->isoFormat('D MMMM Y') !!}</span>
                </td>
            </tr>
        </table>
        <table>

            <tr>
                <td style="width: 30%; text-align: center;height: 0;">
                    <span>Dosen Pengampu Kelas KP</span>
                </td>
                <td style="width: 40%;"></td>
                <td style="width: 30%; text-align: center;height: 0;">
                    <span>Mahasiswa</span>
                </td>
            </tr>

            <tr>
                <td style="width: 30%; text-align: center;height: 0;line-height: 5px;">
                    {!! str_repeat('<br>', 20) !!}
                    <div>{{ auth()->user()->dosen_kp }}</div>
                    ({{ str_repeat('.', 55) }})
                </td>
                <td style="width: 40%;"></td>
                <td style="width: 30%; text-align: center;height: 0;line-height: 5px;">
                    {!! str_repeat('<br>', 20) !!}
                    <div>{{ auth()->user()->name }}</div>
                    ({{ str_repeat('.', 55) }})
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
