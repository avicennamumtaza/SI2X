<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->string('nik', 17)->primary();
            $table->string('nkk', 17);
            $table->string('no_rt', 2);
            $table->string('nama', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            // $table->string('jenis_kelamin', 1);
            ;$table->enum('jenis_kelamin', ['L', 'P']);
            ;$table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            ;$table->enum('pendidikan', ['Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 'Strata II', 'Strata III']);
            // $table->string('pekerjaan', 50);
            ;$table->enum('pekerjaan', [
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
            ]);
            // $table->string('gol_darah', 2);
            ;$table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            // $table->boolean('is_married');
            ;$table->enum('status_pernikahan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            // $table->boolean('is_stranger');
            ;$table->boolean('status_pendatang');
            $table->timestamps();

            // $table->foreign('nkk')->references('nkk')->on('keluarga')->onDelete('cascade');
            // $table->foreign('noRT')->references('noRT')->on('rt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
}
