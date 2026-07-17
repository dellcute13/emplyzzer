<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Perankingan Pegawai - {{ $period->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #334155;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 3px 0 0 0;
            font-size: 10px;
            color: #64748b;
        }
        .title {
            text-align: center;
            margin-bottom: 15px;
        }
        .title h2 {
            font-size: 13px;
            color: #0f172a;
            margin: 0;
            text-transform: uppercase;
        }
        .title p {
            margin: 3px 0 0 0;
            font-size: 10px;
            color: #475569;
        }
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 2px 0;
            font-size: 10px;
        }
        .info-table td.label {
            color: #64748b;
            width: 110px;
        }
        .info-table td.value {
            font-weight: bold;
            color: #0f172a;
        }
        .rank-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 20px;
        }
        .rank-table th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            padding: 8px 6px;
            font-size: 10px;
            text-transform: uppercase;
        }
        .rank-table td {
            padding: 8px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 10px;
        }
        .rank-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .rank-table td.center {
            text-align: center;
        }
        .rank-table td.font-bold {
            font-weight: bold;
        }
        .rank-badge {
            display: inline-block;
            width: 18px;
            height: 18px;
            line-height: 18px;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 9px;
        }
        .rank-1 {
            background-color: #fef08a;
            color: #854d0e;
        }
        .rank-2 {
            background-color: #e2e8f0;
            color: #334155;
        }
        .rank-3 {
            background-color: #ffedd5;
            color: #9a3412;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-sangat-baik {
            background-color: #dcfce7;
            color: #15803d;
        }
        .badge-baik {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        .badge-cukup {
            background-color: #fef9c3;
            color: #a16207;
        }
        .badge-kurang {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .footer-sig {
            margin-top: 30px;
            width: 100%;
            page-break-inside: avoid;
        }
        .footer-sig td {
            text-align: center;
            width: 50%;
        }
        .footer-sig .signature-space {
            height: 50px;
        }
        .footer-sig .name {
            font-weight: bold;
            text-decoration: underline;
        }
        .footer-sig .role {
            font-size: 9px;
            color: #64748b;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>EMPLYZER REPORT SYSTEM</h1>
        <p>Sistem Pendukung Keputusan Penilaian Kinerja Karyawan Metode SAW</p>
    </div>

    <div class="title">
        <h2>Laporan Hasil Perankingan Pegawai</h2>
        <p>Berdasarkan Penilaian Kinerja Multi-Kriteria (Simple Additive Weighting)</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Periode Evaluasi</td>
            <td class="value">: {{ $period->name }}</td>
            <td class="label" style="text-align: right; width: 250px;">Tanggal Cetak: {{ date('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Tahun / Semester</td>
            <td class="value">: {{ $period->year }} / Semester {{ $period->semester }}</td>
            <td class="label" style="text-align: right;">Dicetak Oleh: {{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <td class="label">Rentang Tanggal</td>
            <td class="value">: {{ \Carbon\Carbon::parse($period->start_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($period->end_date)->format('d M Y') }}</td>
            <td></td>
        </tr>
    </table>

    <table class="rank-table">
        <thead>
            <tr>
                <th style="width: 40px; text-align: center;">Rank</th>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th style="width: 70px; text-align: center;">Skor (V)</th>
                <th style="width: 90px;">Kategori Kinerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($preferences as $index => $pref)
                <tr>
                    <td class="center font-bold">
                        @if($index == 0)
                            <span class="rank-badge rank-1">1</span>
                        @elseif($index == 1)
                            <span class="rank-badge rank-2">2</span>
                        @elseif($index == 2)
                            <span class="rank-badge rank-3">3</span>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>
                    <td class="font-bold">{{ $pref['name'] }}</td>
                    <td>{{ $pref['nip'] }}</td>
                    <td>{{ $pref['position'] }}</td>
                    <td>{{ $pref['department'] }}</td>
                    <td class="center font-bold" style="color: #1e3a8a; font-family: monospace;">
                        {{ number_format($pref['total'], 4) }}
                    </td>
                    <td>
                        @if ($pref['total'] >= 0.85)
                            <span class="badge badge-sangat-baik">Sangat Baik</span>
                        @elseif ($pref['total'] >= 0.70)
                            <span class="badge badge-baik">Baik</span>
                        @elseif ($pref['total'] >= 0.55)
                            <span class="badge badge-cukup">Cukup</span>
                        @else
                            <span class="badge badge-kurang">Kurang</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="center" style="padding: 20px; color: #64748b; font-style: italic;">
                        Belum ada data hasil penilaian untuk periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="footer-sig">
        <tr>
            <td>
                <p class="role">Mengetahui,</p>
                <p class="role" style="font-weight: bold;">Direktur Utama / Supervisor</p>
                <div class="signature-space"></div>
                <p class="name">..................................................</p>
                <p class="role">NIP. ....................................</p>
            </td>
            <td>
                <p class="role">Dibuat Oleh,</p>
                <p class="role" style="font-weight: bold;">HRD Administrator</p>
                <div class="signature-space"></div>
                <p class="name">{{ Auth::user()->name }}</p>
                <p class="role">Role: {{ Auth::user()->role }}</p>
            </td>
        </tr>
    </table>

</body>
</html>
