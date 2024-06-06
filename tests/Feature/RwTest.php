<?php

namespace Tests\Feature;

use App\Models\Penduduk;
use App\Models\Rw;
use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RwTest extends TestCase
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
    public function test_rw_factory(): void
    {
        $rw = Rw::factory()->create();
        $this->assertNotNull($rw);
    }

    public function test_store_rw_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $response = $this->post(route('rw.store'), $this->validRwData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_rw_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        Rw::create($this->validRwData());
        $this->assertDatabaseHas('rw', [
            'wa_rw' => '080099887766'
        ]);
    }

    // public function test_edit_rw_status(): void
    // {
    //     $user = $this->createRwUser();
    //     $this->actingAs($user);

    //     $rw = Rw::factory()->create();
    //     $response = $this->get(route('rw.edit', $rw));
    //     $response->assertStatus(500); // Assuming the edit page loads successfully
    // }

    public function test_update_rw_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rw = Rw::findOrFail('6');
        $response = $this->put(route('rw.update', $rw), [
            'wa_rw' => '080099887769',
        ]);
        $response->assertStatus(302); // Assuming the controller redirects after successful update
    }

    public function test_update_rw_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rw = Rw::findOrFail('6');

        $rw->update([
            'wa_rw' => '080099887769',
        ]);

        $this->assertDatabaseHas('rw', [
            'wa_rw' => '080099887769',
        ]);
    }

    public function test_destroy_rw_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rw = Rw::findOrFail('6');
        $response = $this->delete(route('rw.destroy', $rw->no_rw));
        $response->assertStatus(302); // Assuming the controller redirects after successful deletion
    }

    public function test_destroy_rw_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rw = Rw::factory()->create();

        $rwArray = $rw->toArray();
        $rw->delete();

        $this->assertDatabaseMissing('rw', $rwArray);
    }

    private function validRwData()
    {
        $nik = Penduduk::pluck('nik');
        return [
            'no_rw' => '9',
            'nik_rw' => $nik[991],
            'wa_rw' => '080099887766',
        ];
    }
}