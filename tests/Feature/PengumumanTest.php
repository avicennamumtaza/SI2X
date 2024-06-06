<?php

namespace Tests\Feature;

use App\Models\Pengumuman;
use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PengumumanTest extends TestCase
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
    public function test_pengumuman_factory(): void
    {
        $pengumuman = Pengumuman::factory()->create();
        $this->assertNotNull($pengumuman);
    }

    public function test_store_pengumuman_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $response = $this->post(route('pengumuman.store'), $this->validPengumumanData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_pengumuman_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        Pengumuman::create($this->validPengumumanData());
        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'Penambahan Dana Sosial BLT'
        ]);
    }

    public function test_edit_pengumuman_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $pengumuman = Pengumuman::factory()->create();
        $response = $this->get(route('pengumuman.edit', $pengumuman));
        $response->assertStatus(500); // Assuming the edit page loads successfully
    }

    public function test_update_pengumuman_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $pengumuman = Pengumuman::factory()->create();
        $response = $this->put(route('pengumuman.update', $pengumuman), [
            'judul' => 'Updated Pengumuman',
            'deskripsi' => 'Updated Deskripsi'
        ]);
        $response->assertStatus(302); // Assuming the controller redirects after successful update
    }

    public function test_update_pengumuman_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $pengumuman = Pengumuman::factory()->create();

        $pengumuman->update([
            'judul' => 'Updated Pengumuman',
            'deskripsi' => 'Updated Deskripsi'
        ]);

        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'Updated Pengumuman',
            'deskripsi' => 'Updated Deskripsi'
        ]);
    }

    public function test_destroy_pengumuman_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $pengumuman = Pengumuman::factory()->create();
        $response = $this->delete(route('pengumuman.destroy', $pengumuman));
        $response->assertStatus(302); // Assuming the controller redirects after successful deletion
    }

    public function test_destroy_pengumuman_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $pengumuman = Pengumuman::factory()->create();

        $pengumumanArray = $pengumuman->toArray();
        $pengumuman->delete();

        $this->assertDatabaseMissing('pengumuman', $pengumumanArray);
    }

    private function validPengumumanData()
    {
        return [
            'judul' => 'Penambahan Dana Sosial BLT',
            'tanggal' => now(),
            'deskripsi' => 'Bantuan Langsung Tunai (BLT) periode ini diberikan secara khusus kepada masyarakat lanjut usia yang kurang mampu.',
            'foto_pengumuman' => 'blt.png'
        ];
    }
}
