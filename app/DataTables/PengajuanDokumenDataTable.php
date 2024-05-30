<?php

namespace App\DataTables;

use App\Models\Dokumen;
use App\Models\Penduduk;
use App\Models\PengajuanDokumen;
use App\Models\RT;
use App\Models\Users;
use DateTime;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengajuanDokumenDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        if (auth()->user()->role == 'RW') {
            # code...
            return (new EloquentDataTable($query))
                // ->addColumn('action', 'a.action')
                ->setRowId('id')
                ->addColumn('dokumen', function ($row) {
                    // $namaDokumen = Dokumen::where('id_dokumen', $row->id_dokumen)->first();
                    // return $namaDokumen->jenis_dokumen;
                    return $row->dokumen->jenis_dokumen;
                })
                ->addColumn('no_rt', function ($row) {
                    // $penduduks = Penduduk::where('nik', $row->nik_pemohon)->first();
                    // return $penduduks->no_rt;
                    return $row->penduduk->no_rt;
                })
                ->addColumn('status_pengajuan', function ($row) {
                    $status = $row->status_pengajuan;
                    $badgeColor = '#FFC107 '; // Default color for 'Baru'
                    if ($status == 'Disetujui') {
                        $badgeColor = 'green';
                    } elseif ($status == 'Ditolak') {
                        $badgeColor = 'red';
                    }
                    return '<span style="background-color: ' . $badgeColor . '; display: inline-block; text-align: center; width: 100%;" class="badge rounded-pill">' . $status . '</span>';            })
                ->rawColumns(['status_pengajuan', 'action']); // Make sure to include 'status_pengajuan'
        } else {
            return (new EloquentDataTable($query))
                ->setRowId('id')
                ->addColumn('dokumen', function ($row) {
                    $namaDokumen = Dokumen::where('id_dokumen', $row->id_dokumen)->first();
                    return $namaDokumen->jenis_dokumen;
                })
                ->addColumn('status_pengajuan', function ($row) {
                    $status = $row->status_pengajuan;
                    $badgeColor = '#FFC107 '; // Default color for 'Baru'
                    if ($status == 'Disetujui') {
                        $badgeColor = 'green';
                    } elseif ($status == 'Ditolak') {
                        $badgeColor = 'red';
                    }
                    return '<span style="background-color: ' . $badgeColor . '; display: inline-block; text-align: center; width: 100%;" class="badge rounded-pill">' . $status . '</span>';            })
                ->rawColumns(['status_pengajuan', 'action']) // Make sure to include 'status_pengajuan' in rawColumns
                ->addColumn('action', function ($row) {
                    $pengaju = Penduduk::where('nik', $row->nik_pemohon)->first();
                    $dokumen = Dokumen::where('id_dokumen', $row->id_dokumen)->first();
                    $deleteUrl = route('pengajuandokumen.destroy', $row->id_pengajuandokumen);

                    // Menghitung usia
                    $birthDate = new DateTime($pengaju->tanggal_lahir);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthDate)->y;

                    $action = '
                    <div class="container-action">
                    <button type="button"
                    data-id_pengajuandokumen="' . $row->id_pengajuandokumen . '"
                    data-no_rt="' . $pengaju->no_rt . '"
                    data-nik_pemohon="' . $row->nik_pemohon . '"
                    data-nama_asli_pengaju="' . $pengaju->nama . '"
                    data-usia_pengaju="' . $age . '"
                    data-pekerjaan_pengaju="' . $pengaju->pekerjaan->value . '"
                    data-id_dokumen="' . $row->id_dokumen . '"
                    data-jenis_dokumen="' . $dokumen->jenis_dokumen . '"
                    data-status_pengajuan="' . $row->status_pengajuan . '"
                    data-catatan="' . $row->catatan . '"
                    data-bs-toggle="modal" data-bs-target="#editPengajuanDokumenModal" class="edit btn btn-edit btn-sm">Edit</button>';
                    $action .=
                        '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') .
                        '<button type="submit" class="delete btn btn-delete btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                    </form>
                    </div>';
                    return $action;
                });
        }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PengajuanDokumen $model): QueryBuilder
    {
        // if (auth()->user()->role == 'RT') {
        //     // Dapatkan pengguna yang sedang login
        //     $user = Users::where('id_user', auth()->user()->id_user)->first();
        //     $nikRt = $user->nik; // Ambil nilai nik dari pengguna
        //     $noRt = RT::where('nik_rt', $nikRt)->pluck('no_rt')->first();
        //     $pendudukRt = Penduduk::where('no_rt', $noRt)->pluck('nik');

        //     return $model->newQuery()->where('nik_pemohon', $pendudukRt);
        // }
        if (auth()->user()->role == 'RT') {
            $nikRt = auth()->user()->nik;
            $noRt = RT::where('nik_rt', $nikRt)->pluck('no_rt')->first();
            $pendudukRt = Penduduk::where('no_rt', $noRt)->pluck('nik');

            return $model->newQuery()->whereIn('nik_pemohon', $pendudukRt);
        }
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengajuandokumen-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc') // Set default order by column 0 (id_pengumuman)
            ->parameters([
                'language' => [
                    'search' => '', // Menghilangkan teks "Search:"
                    'searchPlaceholder' => 'Cari Pengajuan Dokumen', // Placeholder untuk kolom pencarian
                    'paginate' => [
                        'previous' => 'Kembali', // Mengubah teks "Previous"
                        'next' => 'Lanjut', // Mengubah teks "Next"
                    ],
                    'info' => 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri', // Ubah teks sesuai keinginan Anda
                ],
                'dom' => 'Bfrtip', // Menambahkan tombol
                'buttons' => [], // Menambahkan tombol ekspor dan lainnya
                'order' => [], // Mengaktifkan order by untuk setiap kolom
            ])
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        if (auth()->user()->role == 'RW') {
            # code...
            return [
                Column::make('id_pengajuandokumen')->title('ID'),
                Column::make('dokumen')->title('Dokumen'),
                Column::make('no_rt')->title('RT'),
                Column::make('nik_pemohon')->title('NIK'),
                // Column::make('nama_pemohon')->title('Nama'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('catatan')->title('Catatan'),
                Column::make('created_at')->title('Tanggal'),
                // Column::make('detail_laporan')->title('Detail Laporan'),
                // Column::make('saldo')->title('Saldo'),
                // Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                //   ->width(130) 
                //   ->addClass('text-center'),
            ];
        } else {
            return [
                Column::make('id_pengajuandokumen')->title('ID'),
                Column::make('dokumen')->title('Dokumen'),
                // Column::make('no_rt')->title('Nomor RT'),
                Column::make('nik_pemohon')->title('NIK'),
                // Column::make('nama_pemohon')->title('Nama'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('catatan')->title('Catatan'),
                Column::make('created_at')->title('Tanggal'),
                // Column::make('detail_laporan')->title('Detail Laporan'),
                // Column::make('saldo')->title('Saldo'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(130)
                    ->addClass('text-center')
                    ->title('Aksi'),
            ];
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PengajuanDokumen_' . date('YmdHis');
    }
}