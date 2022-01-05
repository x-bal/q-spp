<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function __construct($sekolah_id, $kelas_id)
    {
        $this->sekolah_id = $sekolah_id;
        $this->kelas_id = $kelas_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'name' => $row['nama'],
                'username' => $row['nisn'],
                'email' => strtolower(trim($row['nama'], " ")) . '@spp.com',
                'password' => bcrypt(Carbon::parse($row['tanggal'])->format('dmY'))
            ]);

            $user->siswa()->create([
                'sekolah_id' => $this->sekolah_id,
                'kelas_id' => $this->kelas_id,
                'nisn' => $row['nisn'],
                'nama' => $row['nama'],
                'jk' => $row['jk'],
                'tempat_lahir' => $row['tempat'],
                'tanggal_lahir' => Carbon::parse($row['tanggal'])->format('Y-m-d'),
            ]);
        }
    }
}
