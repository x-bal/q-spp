<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function __construct($sekolah_id, $kelas_id, $tahun)
    {
        $this->sekolah_id = $sekolah_id;
        $this->kelas_id = $kelas_id;
        $this->tahun = $tahun;
    }

    public function collection(Collection $rows)
    {
        $tahunAjaran = Spp::where('tahun_ajaran_id', $this->tahun)->get()->pluck('id')->toArray();

        foreach ($rows as $row) {
            $user = User::create([
                'name' => $row['nama'],
                'username' => $row['nisn'],
                'email' => strtolower(trim($row['nisn'], " ")) . '@spp.com',
                'password' => bcrypt(Carbon::parse($row['tanggal'])->format('dmY'))
            ]);

            $miliseconds = ($row['tanggal'] - 25569) * 86400 * 1000;
            $tgl = $miliseconds / 1000;

            $siswa = $user->siswa()->create([
                'sekolah_id' => $this->sekolah_id,
                'kelas_id' => $this->kelas_id,
                'nisn' => $row['nisn'],
                'nama' => $row['nama'],
                'jk' => $row['jk'],
                'tempat_lahir' => $row['tempat'],
                'tanggal_lahir' => date('Y-m-d', $tgl),
            ]);

            $siswa->spp()->sync($tahunAjaran);
        }
    }
}
