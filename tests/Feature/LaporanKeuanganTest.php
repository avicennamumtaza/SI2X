<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LaporanKeuanganTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function laporan_keuangan_method_list(): void
    {
        $response = $this->get(route('laporankeuangan.manage'));

        $response->assertStatus(200);
    }
    public function laporan_keuangan_method_store(): void
    {
        $response = $this->post(route('laporankeuangan.store'));

        $response->assertStatus(200);
    }
    public function laporan_keuangan_method_edit(): void
    {
        $response = $this->get(route('laporankeuangan.edit'));

        $response->assertStatus(200);
    }
    public function laporan_keuangan_method_update(): void
    {
        $response = $this->put(route('laporankeuangan.update'));

        $response->assertStatus(200);
    }
    public function laporan_keuangan_method_destroy(): void
    {
        $response = $this->delete(route('laporankeuangan.destroy'));

        $response->assertStatus(200);
    }
}
