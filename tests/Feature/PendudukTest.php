<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Penduduk;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PendudukTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_penduduk_factory(): void
    {
        // Create dummy data using factory
        $penduduk = Penduduk::factory()->create();

        // Assert that the data is created successfully
        $this->assertNotNull($penduduk);
    }

    /**
     * Test store method in PendudukController.
     */
    public function test_store_penduduk_status(): void
    {
        $response = $this->post(route('penduduk.store'), $this->validPendudukData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_penduduk_data(): void
    {
        Penduduk::create($this->validPendudukData());

        $this->assertDatabaseHas('penduduk', [
            'nik' => '12345678901234567',
        ]);
    }

    /**
     * Test edit method in PendudukController.
     */
    public function test_edit_penduduk_status(): void
    {
        // Create a dummy penduduk
        $penduduk = Penduduk::factory()->create();

        // Visit the edit page for the penduduk
        $response = $this->get(route('penduduk.edit', $penduduk));

        // Assert that the edit page is accessible
        $response->assertStatus(302);
    }

    /**
     * Test update method in PendudukController.
     */
    public function test_update_penduduk_status(): void
    {
        // Create a dummy penduduk
        $penduduk = Penduduk::factory()->create();

        // Update the penduduk data
        $response = $this->put(route('penduduk.update', $penduduk), $this->validPendudukData());

        $response->assertStatus(302);
    }

    public function test_update_penduduk_data(): void
    {
        // Create a dummy penduduk
        $penduduk = Penduduk::factory()->create()->first();

        // Updating nkk data only or all data (optional)
        $penduduk->update([
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

        $this->assertDatabaseHas('penduduk', [
            // 'nik' => '12345678901234567',
            'nkk' => '12345678901234567',
        ]);
    }

    /**
     * Test destroy method in PendudukController.
     */
    public function test_destroy_penduduk_status(): void
    {
        // Create a dummy penduduk
        $penduduk = Penduduk::factory()->create();

        // Delete the penduduk
        $response = $this->delete(route('penduduk.destroy', $penduduk));

        // Assert that the penduduk is deleted successfully
        $response->assertStatus(302);
    }

    public function test_destroy_penduduk_data(): void
    {
        // Create a dummy penduduk
        $penduduk = Penduduk::factory()->create();

        // Delete the penduduk
        $penduduk->delete();

        // Convert the Penduduk model to array for the assertDatabaseMissing check
        $pendudukArray = $penduduk->toArray();

        // Assert that the penduduk is removed from the database
        $this->assertDatabaseMissing('penduduk', $pendudukArray);
    }

    /**
     * Valid penduduk data for testing.
     */
    private function validPendudukData(): array
    {
        return [
            'nik' => '12345678901234567',
            'nkk' => '12345678901234567',
            'no_rt' => '01',
            'nama' => 'John Doe',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Contoh No. 123',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'pendidikan' => 'Tidak/Belum Sekolah',
            'pekerjaan' => 'Karyawan Swasta',
            'golongan_darah' => 'A',
            'status_pernikahan' => 'Kawin',
            'status_pendatang' => true,
        ];
    }
}
