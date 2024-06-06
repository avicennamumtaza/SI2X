<?php

namespace Tests\Feature;

use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KeluargaTest extends TestCase
{
    use DatabaseTransactions;

        /**
     * A basic feature test example.
     */
    public function test_keluarga_factory(): void
    {
        // Create dummy data using factory
        $keluarga = Keluarga::factory()->create();

        // Assert that the data is created successfully
        $this->assertNotNull($keluarga);
    }

    /**
     * Test store method in KeluargaController.
     */
    public function test_store_keluarga_status(): void
    {
        $response = $this->post(route('keluarga.store'), $this->validKeluargaData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_keluarga_data(): void
    {
        Keluarga::create($this->validKeluargaData());

        $this->assertDatabaseHas('keluarga', [
            'nik' => '12345678901234567',
        ]);
    }

    /**
     * Test edit method in KeluargaController.
     */
    public function test_edit_keluarga_status(): void
    {
        // Create a dummy keluarga
        $keluarga = Keluarga::factory()->create();

        // Visit the edit page for the keluarga
        $response = $this->get(route('keluarga.edit', $keluarga));

        // Assert that the edit page is accessible
        $response->assertStatus(302);
    }

    /**
     * Test update method in KeluargaController.
     */
    public function test_update_keluarga_status(): void
    {
        // Create a dummy keluarga
        $keluarga = Keluarga::factory()->create();

        // Update the keluarga data
        $response = $this->put(route('keluarga.update', $keluarga), $this->validKeluargaData());

        $response->assertStatus(302);
    }

    public function test_update_keluarga_data(): void
    {
        // Create a dummy keluarga
        $keluarga = Keluarga::factory()->create()->first();

        // Updating nkk data only or all data (optional)
        $keluarga->update([
            // 'nik' => '12345678901234567',
            'nkk' => '12345678901234567',
            // 'no_rt' => '01',
            // 'nama' => 'John Doe',
            // 'tempat_lahir' => 'Jakarta',
            // 'tanggal_lahir' => '1990-01-01',
            // 'alamat' => 'Jl. Contoh No. 123',
            // 'jenis_kelamin' => 'L',
            // 'agama' => 'Islam',
            // 'pendidikan' => 'Tidak/Belum Sekolah',
            // 'pekerjaan' => 'Karyawan Swasta',
            // 'golongan_darah' => 'A',
            // 'status_pernikahan' => 'Kawin',
            // 'status_pendatang' => true,
        ]);

        $this->assertDatabaseHas('keluarga', [
            // 'nik' => '12345678901234567',
            'nkk' => '12345678901234567',
        ]);
    }

    /**
     * Test destroy method in KeluargaController.
     */
    public function test_destroy_keluarga_status(): void
    {
        // Create a dummy keluarga
        $keluarga = Keluarga::factory()->create();

        // Delete the keluarga
        $response = $this->delete(route('keluarga.destroy', $keluarga));

        // Assert that the keluarga is deleted successfully
        $response->assertStatus(302);
    }

    public function test_destroy_keluarga_data(): void
    {
        // Create a dummy keluarga
        $keluarga = Keluarga::factory()->create();

        // Delete the keluarga
        $keluarga->delete();

        // Convert the Keluarga model to array for the assertDatabaseMissing check
        $keluargaArray = $keluarga->toArray();

        // Assert that the keluarga is removed from the database
        $this->assertDatabaseMissing('keluarga', $keluargaArray);
    }

    /**
     * Valid keluarga data for testing.
     */
    private function validKeluargaData(): array
    {
        $nik = Penduduk::pluck('nik');
        return [
            'nkk' => '12345678901234567',
            'nik_kepala_keluarga' => $nik[988],
            'no_rt' => '11',
        ];
    }
}
