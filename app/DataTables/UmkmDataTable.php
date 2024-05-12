<?php

namespace App\DataTables;

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
            ->addColumn('action', function ($row) {
                $deleteUrl = route('umkm.destroy', $row->id_umkm);
                $action = '
                <div class="container-action">
                <button type="button"
                data-id_umkm="' . $row->id_umkm . '"
                data-nik_pemilik="' . $row->nik_pemilik . '"
                data-nama_umkm="' . $row->nama_umkm . '"
                data-wa_umkm="' . $row->wa_umkm . '"
                data-foto_umkm="' . $row->foto_umkm . '"
                data-desc_umkm="' . $row->deskripsi_umkm . '"
                data-status_umkm="' . $row->status_umkm . '"
                data-bs-toggle="modal" data-bs-target="#editUmkmModal" class="edit btn btn-edit btn-sm">Edit</button>';
                $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') .
                    '<button type="submit" class="delete btn btn-delete btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                </form>
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
                'dom' => 'Bfrtip', // Menambahkan tombol
                'buttons' => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'], // Menambahkan tombol ekspor dan lainnya
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
            Column::make('id_umkm')->title('Nomor')->width(1),
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
