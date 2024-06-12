<?php

namespace App\DataTables;

use App\Models\Dokumen;
use App\Models\Penduduk;
use App\Models\PengajuanDokumen;
use App\Models\Rt;
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y');
                })
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
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y');
                })
                ->addColumn('dokumen', function ($row) {
                    $namaDokumen = Dokumen::where('id_dokumen', $row->id_dokumen)->first();
                    return $namaDokumen->jenis_dokumen;
                })
                ->addColumn('status_pengajuan', function ($row) {
                    $status = $row->status_pengajuan;
                    $badgeColor = '#FFC107 '; 
                    if ($status == 'Disetujui') {
                        $badgeColor = 'green';
                    } elseif ($status == 'Ditolak') {
                        $badgeColor = 'red';
                    }
                    return '<span style="background-color: ' . $badgeColor . '; display: inline-block; text-align: center; width: 100%;" class="badge rounded-pill">' . $status . '</span>';            })
                ->rawColumns(['status_pengajuan', 'action'])
                ->addColumn('action', function ($row) {
                    $pengaju = Penduduk::where('nik', $row->nik_pemohon)->first();
                    $dokumen = Dokumen::where('id_dokumen', $row->id_dokumen)->first();
                    $deleteUrl = route('pengajuandokumen.destroy', $row->id_pengajuandokumen);

                    // Menghitung usia
                    $birthDate = new DateTime($pengaju->tanggal_lahir);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthDate)->y;

                    $action = '
                    <div class="container-action">';

                    $action .='
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
                    data-keperluan="' . $row->keperluan . '"
                    data-bs-toggle="modal" data-bs-target="#showPengajuanDokumenModal" class="show-user show btn btn-show btn-sm me-1">Tampil</button>';

                    $action .='
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
                    data-keperluan="' . $row->keperluan . '"
                    data-bs-toggle="modal" data-bs-target="#editPengajuanDokumenModal" class="edit btn btn-edit btn-sm" style="inline" >Edit</button>';

                    $action .=
                        ' <button
                        type="button"
                        class="delete btn btn-delete btn-sm"
                        data-bs-target="#deletePengajuanDokumenModal"
                        data-bs-toggle="modal"
                        data-nama="' . $pengaju->nama . '"
                        data-jenis_dokumen="' . $dokumen->jenis_dokumen . '"
                        data-id_pengajuandokumen="' . $row->id_pengajuandokumen . '"
                        >Hapus</button>
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
        //     $noRt = Rt::where('nik_rt', $nikRt)->pluck('no_rt')->first();
        //     $pendudukRt = Penduduk::where('no_rt', $noRt)->pluck('nik');

        //     return $model->newQuery()->where('nik_pemohon', $pendudukRt);
        // }
        if (auth()->user()->role == 'RT') {
            $nikRt = auth()->user()->nik;
            $noRt = Rt::where('nik_rt', $nikRt)->pluck('no_rt')->first();
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
            ->orderBy(0, 'asc') 
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Pengajuan Dokumen',
                    'paginate' => [
                        'previous' => 'Kembali', 
                        'next' => 'Lanjut', 
                    ],
                    'info' => 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri', 
                ],
                'dom' => 'Bfrtip',
                'buttons' => [], 
                'order' => [], 
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
                Column::make('dokumen')->title('Dokumen'),
                Column::make('no_rt')->title('RT'),
                Column::make('nik_pemohon')->title('NIK'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('keperluan')->title('Keperluan'),
                Column::make('created_at')->title('Tanggal'),
            ];
        } else {
            return [
                Column::make('dokumen')->title('Dokumen'),
                Column::make('nik_pemohon')->title('NIK'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('keperluan')->title('Keperluan'),
                Column::make('created_at')->title('Tanggal'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(250)
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