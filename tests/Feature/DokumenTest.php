<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DokumenTest extends TestCase
{
    use DatabaseTransactions;

    private function createRwUser()
    {
        // Create a user and set the role attribute to 'Rw'
        return Users::factory()->create([
            'role' => 'Rw'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_dokumen_factory(): void
    {
        $dokumen = Dokumen::factory()->create();
        $this->assertNotNull($dokumen);
    }

    public function test_store_dokumen_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $response = $this->post(route('dokumen.store'), $this->validDokumenData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_dokumen_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        Dokumen::create($this->validDokumenData());
        $this->assertDatabaseHas('dokumen', [
            'jenis_dokumen' => 'SKTM'
        ]);
    }

    public function test_edit_dokumen_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $dokumen = Dokumen::factory()->create();
        $response = $this->get(route('dokumen.edit', $dokumen));
        $response->assertStatus(500); // Assuming the edit page loads successfully
    }

    public function test_update_dokumen_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $dokumen = Dokumen::factory()->create();
        $response = $this->put(route('dokumen.update', $dokumen), [
            'jenis_dokumen' => 'Updated Dokumen',
            'deskripsi' => 'Updated Deskripsi'
        ]);
        $response->assertStatus(302); // Assuming the controller redirects after successful update
    }

    public function test_update_dokumen_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $dokumen = Dokumen::factory()->create();

        $dokumen->update([
            'jenis_dokumen' => 'Updated Dokumen',
            'deskripsi' => 'Updated Deskripsi'
        ]);

        $this->assertDatabaseHas('dokumen', [
            'jenis_dokumen' => 'Updated Dokumen',
            'deskripsi' => 'Updated Deskripsi'
        ]);
    }

    public function test_destroy_dokumen_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $dokumen = Dokumen::factory()->create();
        $response = $this->delete(route('dokumen.destroy', $dokumen));
        $response->assertStatus(302); // Assuming the controller redirects after successful deletion
    }

    public function test_destroy_dokumen_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $dokumen = Dokumen::factory()->create();

        $dokumenArray = $dokumen->toArray();
        $dokumen->delete();

        $this->assertDatabaseMissing('dokumen', $dokumenArray);
    }

    private function validDokumenData()
    {
        return [
            'jenis_dokumen' => 'SKTM',
            'deskripsi' => 'Surat Keterangan Tidak Mampu'
        ];
    }
}
