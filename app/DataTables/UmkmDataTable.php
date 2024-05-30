<?php

namespace App\DataTables;

use App\Models\Penduduk;
use App\Models\Umkm;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UmkmDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('status_umkm', function ($row) {
                $status = $row->status_umkm;
                $badgeColor = 'darkgoldenrod'; // Default color for 'Baru'
                if ($status == 'Disetujui') {
                    $badgeColor = 'green';
                } elseif ($status == 'Ditolak') {
                    $badgeColor = 'red';
                }
                return '
                <div style="
                display: flex;
                justify-content: center;
                align-items: center;
                padding-block: 10px;">
                <span style="background-color: ' . $badgeColor . '; display: flex; font-weight: 600; padding-inline: 10px; padding-block: 5px; width: fit-content; text-align: center;" class="badge rounded-pill">' . $status . '</span>
                </div>';
            })
            ->rawColumns(['status_umkm', 'action']) // Make sure to include 'status_umkm' in rawColumns
            ->addColumn('action', function ($row) {
                $pemilik = Penduduk::where('nik', $row->nik_pemilik)->first();
                $action = '
                <div class="container-action">
                <button type="button"
                data-id_umkm="' . $row->id_umkm . '"
                data-nik_pemilik="' . $row->nik_pemilik . '"
                data-nama_pemilik="' . $pemilik->nama . '"
                data-alamat_pemilik="' . $pemilik->alamat . '"
                data-nama_umkm="' . $row->nama_umkm . '"
                data-wa_umkm="' . $row->wa_umkm . '"
                data-foto_umkm="' . $row->foto_umkm . '"
                data-deskripsi_umkm="' . $row->deskripsi_umkm . '"
                data-status_umkm="' . $row->status_umkm . '"
                data-bs-toggle="modal" data-bs-target="#editUmkmModal" class="edit btn btn-edit btn-sm">Edit</button>';
                $action .= '
                <button
                type="button" 
                class="delete btn btn-delete btn-sm" 
                data-bs-target="#deleteUmkmModal" 
                data-bs-toggle="modal"
                data-nama="' . $row->nama_umkm . '"
                data-status="' . $row->status_umkm . '"
                data-id="' . $row->id_umkm . '"
                >Hapus</button>
            </div>';
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Umkm $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {

        return $this->builder()
            ->setTableId('umkm-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc') // Set default order by column 0 (id_pengumuman)
            ->parameters([
                'language' => [
                    'search' => '', // Menghilangkan teks "Search:"
                    'searchPlaceholder' => 'Cari Data UMKM', // Placeholder untuk kolom pencarian
                    'paginate' => [
                        'previous' => 'Kembali', // Mengubah teks "Previous"
                        'next' => 'Lanjut', // Mengubah teks "Next"
                    ],
                    'info' => 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri', // Ubah teks sesuai keinginan Anda
                ],
                'dom' => 'Bfrtip', // Menambahkan tombol
                'buttons' => [], // Menambahkan tombol ekspor dan lainnya ['excel', 'csv', 'pdf', 'print', 'reset', 'reload']
                'order' => [], // Mengaktifkan order by untuk setiap kolom
            ])
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id_umkm')->title('ID')->width(1),
            Column::make('nik_pemilik')->title('Pemilik')->width(50),
            Column::make('nama_umkm')->title('Nama UMKM')->width(100),
            Column::make('deskripsi_umkm')->title('Deskripsi')->width(400),
            Column::make('status_umkm')->title('Status')->width(20),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Umkm_' . date('YmdHis');
    }
}
