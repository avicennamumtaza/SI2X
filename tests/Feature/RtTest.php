<?php

namespace Tests\Feature;

use App\Models\Penduduk;
use App\Models\Rt;
use App\Models\Users;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RtTest extends TestCase
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
    public function test_rt_factory(): void
    {
        $rt = Rt::factory()->create();
        $this->assertNotNull($rt);
    }

    public function test_store_rt_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $response = $this->post(route('rt.store'), $this->validRtData());
        $response->assertStatus(302); // Assuming the controller redirects after successful creation
    }

    public function test_store_rt_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        Rt::create($this->validRtData());
        $this->assertDatabaseHas('rt', [
            'wa_rt' => '080099887766'
        ]);
    }

    // public function test_edit_rt_status(): void
    // {
    //     $user = $this->createRwUser();
    //     $this->actingAs($user);

    //     $nik = Penduduk::pluck('nik');
    //     $rt = Rt::create([
    //         'no_rt' => '17',
    //         'nik_rt' => $nik[990],
    //         'wa_rt' => '088976543290',
    //     ]);
    //     dd($rt);
    //     $response = $this->get(route('rt.edit', $rt));
    //     $response->assertStatus(500); // Assuming the edit page loads successfully
    // }

    public function test_update_rt_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rt = Rt::findOrFail('4');
        $response = $this->put(route('rt.update', [
            'wa_rt' => '080099887760',
            'rt' => $rt,
        ]));
        $response->assertStatus(302); // Assuming the controller redirects after successful update
    }

    public function test_update_rt_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rt = Rt::findOrFail('4');

        $rt->update([
            'wa_rt' => '080099887760',
        ]);

        $this->assertDatabaseHas('rt', [
            'wa_rt' => '080099887760',
        ]);
    }

    public function test_destroy_rt_status(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rt = Rt::findOrFail('4');
        $response = $this->delete(route('rt.destroy', $rt->no_rt));
        $response->assertStatus(302); // Assuming the controller redirects after successful deletion
    }

    public function test_destroy_rt_data(): void
    {
        $user = $this->createRwUser();
        $this->actingAs($user);

        $rt = Rt::factory()->create();

        $rtArray = $rt->toArray();
        $rt->delete();

        $this->assertDatabaseMissing('rt', $rtArray);
    }

    private function validRtData()
    {
        $nik = Penduduk::pluck('nik');
        return [
            'no_rt' => '17',
            'nik_rt' => $nik[991],
            'wa_rt' => '080099887766',
        ];
    }
}
