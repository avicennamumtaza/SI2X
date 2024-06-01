<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

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
        $faker = Faker::create('id_ID');

        $umurMin = 1;
        $umurMax = 30;

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 500) as $index) {
            // Tentukan jenis keluarga
            $familyType = $faker->randomElement(['complete', 'single_parent', 'single']);

            $nik = $faker->unique()->numerify('################');
            $nkk = $faker->numerify('################');
            $no_rt = $faker->numberBetween(1, 16);
            $alamat = $faker->address();

            // Data untuk kepala keluarga
            $penduduk = [
                'nik' => $nik,
                'nkk' => $nkk,
                'no_rt' => $no_rt,
                'nama' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat' => $alamat,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pendidikan' => $faker->randomElement([
                    'Tidak/Belum Sekolah', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 
                    'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 
                    'Strata II', 'Strata III'
                ]),
                'pekerjaan' => $faker->randomElement([
                    'Belum/Tidak Bekerja',
                    'Ibu Rumah Tangga',
                    'Pelajar/Mahasiswa',
                    'Pensiunan',
                    'Pegawai Negeri Sipil',
                    'TNI/POLRI',
                    'Pedagang',
                    'Petani/Pekebun',
                    'Peternak',
                    'Nelayan/Perikanan',
                    'Pegawai Konstruksi',
                    'Karyawan Swasta',
                    'Karyawan BUMN',
                    'Karyawan BUMD',
                    'Karyawan Honorer',
                    'Buruh Harian Lepas',
                    'Buruh Tani/Perkebunan',
                    'Buruh Nelayan/Perikanan',
                    'Buruh Peternakan',
                    'Asisten Rumah Tangga',
                    'Tukang Listrik',
                    'Tukang Batu',
                    'Tukang Kayu',
                    'Tukang Sol Sepatu',
                    'Tukang Las/Pandai Besi',
                    'Tukang Jahit',
                    'Penata Rias',
                    'Penata Busana',
                    'Mekanik',
                    'Seniman',
                    'Dokter',
                    'Perancang Busana',
                    'Penterjemah',
                    'Wartawan',
                    'Pemuka Agama',
                    'Juru Masak',
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
                    'Anggota DPRD Provinsi',
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
                    'Perangkat Desa',
                    'Kepala Desa',
                    'Wiraswasta',
                    'Anggota Lembaga Tinggi',
                    'Artis',
                    'Atlit',
                    'Manajer',
                    'Tenaga Tata Usaha',
                    'Operator',
                    'Pekerja Pengolahan, Kerajinan',
                    'Teknisi',
                    'Asisten Ahli',
                    'Lainnya'
                ]),
                'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'status_pernikahan' => '',
                'status_pendatang' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tentukan status pernikahan berdasarkan familyType
            if ($familyType == 'complete') {
                $penduduk['status_pernikahan'] = 'Kawin';
            } elseif ($familyType == 'single_parent') {
                // Set status pernikahan sebagai 'Cerai Hidup' atau 'Cerai Mati'
                $penduduk['status_pernikahan'] = $faker->randomElement(['Cerai Hidup', 'Cerai Mati']);
            } elseif ($familyType == 'single') {
                $penduduk['status_pernikahan'] = 'Belum Kawin';
            }

            DB::table('penduduk')->insert($penduduk);

            // Tambahkan anggota keluarga berdasarkan jenis keluarga
            if ($familyType == 'complete') {
                // Pasangan
                DB::table('penduduk')->insert([
                    'nik' => $faker->unique()->numerify('################'),
                    'nkk' => $nkk,
                    'no_rt' => $no_rt,
                    'nama' => $faker->name(),
                    'tempat_lahir' => $faker->city(),
                    'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                    'alamat' => $alamat,
                    'jenis_kelamin' => $penduduk['jenis_kelamin'] == 'L' ? 'P' : 'L',
                    'agama' => $penduduk['agama'],
                    'pendidikan' => $faker->randomElement([
                        'Tidak/Belum Sekolah', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 
                        'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 
                        'Strata II', 'Strata III'
                    ]),
                    'pekerjaan' => $faker->randomElement([
                        'Belum/Tidak Bekerja',
                        'Ibu Rumah Tangga',
                        'Pelajar/Mahasiswa',
                        'Pensiunan',
                        'Pegawai Negeri Sipil',
                        'TNI/POLRI',
                        'Pedagang',
                        'Petani/Pekebun',
                        'Peternak',
                        'Nelayan/Perikanan',
                        'Pegawai Konstruksi',
                        'Karyawan Swasta',
                        'Karyawan BUMN',
                        'Karyawan BUMD',
                        'Karyawan Honorer',
                        'Buruh Harian Lepas',
                        'Buruh Tani/Perkebunan',
                        'Buruh Nelayan/Perikanan',
                        'Buruh Peternakan',
                        'Asisten Rumah Tangga',
                        'Tukang Listrik',
                        'Tukang Batu',
                        'Tukang Kayu',
                        'Tukang Sol Sepatu',
                        'Tukang Las/Pandai Besi',
                        'Tukang Jahit',
                        'Penata Rias',
                        'Penata Busana',
                        'Mekanik',
                        'Seniman',
                        'Dokter',
                        'Perancang Busana',
                        'Penterjemah',
                        'Wartawan',
                        'Pemuka Agama',
                        'Juru Masak',
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
                        'Anggota DPRD Provinsi',
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
                        'Perangkat Desa',
                        'Kepala Desa',
                        'Wiraswasta',
                        'Anggota Lembaga Tinggi',
                        'Artis',
                        'Atlit',
                        'Manajer',
                        'Tenaga Tata Usaha',
                        'Operator',
                        'Pekerja Pengolahan, Kerajinan',
                        'Teknisi',
                        'Asisten Ahli',
                        'Lainnya'
                    ]),
                    'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                    'status_pernikahan' => 'Kawin',
                    'status_pendatang' => $faker->boolean(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // anak
                foreach (range(1, 3) as $index) {
                    $tanggal_lahir = $faker->dateTimeBetween("-30 years", "-1 years")->format('Y-m-d');
                    $umur_anak = Carbon::parse($tanggal_lahir)->age;
                
                    $pekerjaan = ($umur_anak >= 16) ? $faker->randomElement([
                        'Ibu Rumah Tangga',
                        'Pelajar/Mahasiswa',
                        'Pensiunan',
                        'Pegawai Negeri Sipil',
                        'TNI/POLRI',
                        'Pedagang',
                        'Petani/Pekebun',
                        'Peternak',
                        'Nelayan/Perikanan',
                        'Pegawai Konstruksi',
                        'Karyawan Swasta',
                        'Karyawan BUMN',
                        'Karyawan BUMD',
                        'Karyawan Honorer',
                        'Buruh Harian Lepas',
                        'Buruh Tani/Perkebunan',
                        'Buruh Nelayan/Perikanan',
                        'Buruh Peternakan',
                        'Asisten Rumah Tangga',
                        'Tukang Listrik',
                        'Tukang Batu',
                        'Tukang Kayu',
                        'Tukang Sol Sepatu',
                        'Tukang Las/Pandai Besi',
                        'Tukang Jahit',
                        'Penata Rias',
                        'Penata Busana',
                        'Mekanik',
                        'Seniman',
                        'Dokter',
                        'Perancang Busana',
                        'Penterjemah',
                        'Wartawan',
                        'Pemuka Agama',
                        'Juru Masak',
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
                        'Anggota DPRD Provinsi',
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
                        'Perangkat Desa',
                        'Kepala Desa',
                        'Wiraswasta',
                        'Anggota Lembaga Tinggi',
                        'Artis',
                        'Atlit',
                        'Manajer',
                        'Tenaga Tata Usaha',
                        'Operator',
                        'Pekerja Pengolahan, Kerajinan',
                        'Teknisi',
                        'Asisten Ahli',
                        'Lainnya'
                    ]) : 'Belum/Tidak Bekerja';
                
                    DB::table('penduduk')->insert([
                        'nik' => $faker->unique()->numerify('################'),
                        'nkk' => $nkk,
                        'no_rt' => $no_rt,
                        'nama' => $faker->name(),
                        'tempat_lahir' => $faker->city(),
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                        'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                        'pendidikan' => $faker->randomElement([
                            'Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 
                            'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 
                            'Strata II', 'Strata III'
                        ]),
                        'pekerjaan' => $pekerjaan,
                        'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                        'status_pernikahan' => 'Belum Kawin',
                        'status_pendatang' => $faker->boolean(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                                

                }
            } elseif ($familyType == 'single_parent') {
                // Hanya 1 anak
                    $tanggal_lahir = $faker->dateTimeBetween("-30 years", "-1 years")->format('Y-m-d');
                    $umur_anak = Carbon::parse($tanggal_lahir)->age;
                
                    $pekerjaan = ($umur_anak >= 16) ? $faker->randomElement([
                        'Ibu Rumah Tangga',
                        'Pelajar/Mahasiswa',
                        'Pensiunan',
                        'Pegawai Negeri Sipil',
                        'TNI/POLRI',
                        'Pedagang',
                        'Petani/Pekebun',
                        'Peternak',
                        'Nelayan/Perikanan',
                        'Pegawai Konstruksi',
                        'Karyawan Swasta',
                        'Karyawan BUMN',
                        'Karyawan BUMD',
                        'Karyawan Honorer',
                        'Buruh Harian Lepas',
                        'Buruh Tani/Perkebunan',
                        'Buruh Nelayan/Perikanan',
                        'Buruh Peternakan',
                        'Asisten Rumah Tangga',
                        'Tukang Listrik',
                        'Tukang Batu',
                        'Tukang Kayu',
                        'Tukang Sol Sepatu',
                        'Tukang Las/Pandai Besi',
                        'Tukang Jahit',
                        'Penata Rias',
                        'Penata Busana',
                        'Mekanik',
                        'Seniman',
                        'Dokter',
                        'Perancang Busana',
                        'Penterjemah',
                        'Wartawan',
                        'Pemuka Agama',
                        'Juru Masak',
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
                        'Anggota DPRD Provinsi',
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
                        'Perangkat Desa',
                        'Kepala Desa',
                        'Wiraswasta',
                        'Anggota Lembaga Tinggi',
                        'Artis',
                        'Atlit',
                        'Manajer',
                        'Tenaga Tata Usaha',
                        'Operator',
                        'Pekerja Pengolahan, Kerajinan',
                        'Teknisi',
                        'Asisten Ahli',
                        'Lainnya'
                    ]) : 'Belum/Tidak Bekerja';
                
                    DB::table('penduduk')->insert([
                        'nik' => $faker->unique()->numerify('################'),
                        'nkk' => $nkk,
                        'no_rt' => $no_rt,
                        'nama' => $faker->name(),
                        'tempat_lahir' => $faker->city(),
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                        'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                        'pendidikan' => $faker->randomElement([
                            'Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 
                            'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 
                            'Strata II', 'Strata III'
                        ]),
                        'pekerjaan' => $pekerjaan,
                        'golongan_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                        'status_pernikahan' => 'Belum Kawin',
                        'status_pendatang' => $faker->boolean(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                              

            }
        }
    }
}
