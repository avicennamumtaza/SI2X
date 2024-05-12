<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Faker untuk mengisi data
        $faker = Faker::create();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 40) as $index) {
            // Insert data baru ke tabel penduduk
            DB::table('penduduk')->insert([
                'nik' => $faker->unique()->numerify('################'),
                'nkk' => $faker->numerify('################'),
                'no_rt' => $faker->numberBetween(1, 16),
                'nama' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),
                'alamat' => $faker->address(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'pendidikan' => $faker->randomElement([
                    'Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 'Strata II', 'Strata III'
                ]),
                'pekerjaan' => $faker->randomElement([
                'Belum/Tidak Bekerja', 
                'Mengurus Rumah Tangga', 
                'Pelajar/Mahasiswa', 
                'Pensiunan', 
                'Pegawai Negeri Sipil', 
                'TNI/POLRI', 
                'Perdagangan', 
                'Petani/Pekebun', 
                'Peternak', 
                'Nelayan/Perikanan', 
                'Industri', 
                'Konstruksi', 
                'Transportasi', 
                'Karyawan Swasta', 
                'Karyawan BUMN', 
                'Karyawan BUMD', 
                'Karyawan Honorer', 
                'Buruh Harian Lepas', 
                'Buruh Tani/Perkebunan', 
                'Buruh Nelayan/Perikanan', 
                'Buruh Peternakan', 
                'Pembantu Rumah Tangga', 
                'Tukang Cukur', 
                'Tukang Listrik', 
                'Tukang Batu', 
                'Tukang Kayu', 
                'Tukang Sol Sepatu', 
                'Tukang Las/Pandai Besi', 
                'Tukang Jahit', 
                'Penata Rambut', 
                'Penata Rias', 
                'Penata Busana', 
                'Mekanik', 
                'Tukang Gigi', 
                'Seniman', 
                'Tabib', 
                'Paraji', 
                'Perancang Busana', 
                'Penterjemah', 
                'Imam Masjid', 
                'Pendeta', 
                'Pastor', 
                'Wartawan', 
                'Ustadz/Mubaligh', 
                'Juru Masak', 
                'Promotor Acara', 
                'Anggota DPR-RI', 
                'Anggota DPD', 
                'Anggota BPK', 
                'Presiden', 
                'Wakil Presiden', 
                'Anggota Mahkamah Konstitusi', 
                'Anggota Kabinet/Kementerian', 
                'Duta Besar', 
                'Gubernur', 
                'Wakil Gubernur', 
                'Bupati', 
                'Wakil Bupati', 
                'Walikota', 
                'Wakil Walikota', 
                'Anggota DPRD Propinsi', 
                'Anggota DPRD Kabupaten/Kota', 
                'Dosen', 
                'Guru', 
                'Pilot', 
                'Pramugari', 
                'Perawat', 
                'Apoteker', 
                'Psikiater/Psikolog', 
                'Penyiar Televisi', 
                'Penyiar Radio', 
                'Pelaut', 
                'Peneliti', 
                'Sopir', 
                'Pialang', 
                'Paranormal', 
                'Pedagang', 
                'Perangkat Desa', 
                'Kepala Desa', 
                'Biarawati', 
                'Wiraswasta', 
                'Anggota Lembaga Tinggi', 
                'Artis', 
                'Atlit', 
                'Chef', 
                'Manajer', 
                'Tenaga Tata Usaha', 
                'Operator', 
                'Pekerja Pengolahan, Kerajinan', 
                'Teknisi', 
                'Asisten Ahli', 
                'Lainnya'
                ]),
                'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'status_pernikahan' => $faker->randomElement(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']),
                'status_pendatang' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
