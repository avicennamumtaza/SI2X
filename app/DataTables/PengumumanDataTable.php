<?php

namespace App\DataTables;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengumumanDataTable extends DataTable
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
                // $deleteUrl = route('pengumuman.destroy', $row->id_pengumuman);

                // $editUrl = route('pengumuman.edit', $row->id_pengumuman);
                $action = '
                <div class="container-action">';

                $action .='
                <button type="button"
                data-id="' . $row->id_pengumuman . '"
                data-judul="' . $row->judul . '"
                data-tanggal_pengumuman="' . $row->tanggal . '"
                data-deskripsi="' . $row->deskripsi . '"
                data-foto_pengumuman="' . $row->foto_pengumuman . '"
                data-bs-toggle="modal" data-bs-target="#showPengumumanModal" class="show-user show btn btn-show btn-sm">Tampil</button>';

                $action .='
                <button type="button"a
                data-id="' . $row->id_pengumuman . '"
                data-judul="' . $row->judul . '"
                data-tanggal_pengumuman="' . $row->tanggal . '"
                data-deskripsi="' . $row->deskripsi . '"
                data-foto_pengumuman="' . $row->foto_pengumuman . '"
                data-bs-toggle="modal" data-bs-target="#editPengumumanModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';

                $action .= '
                    <button
                    type="button"
                    class="delete btn btn-delete btn-sm"
                    data-bs-target="#deletePengumumanModal"
                    data-bs-toggle="modal"
                    data-judul="' . $row->judul . '"
                    data-tanggal="' . $row->tanggal . '"
                    data-id="' . $row->id_pengumuman . '"
                    >Hapus</button>
                </div>';
                return $action;
            });
            }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengumuman $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengumuman-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc') 
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Pengumuman', 
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
        return [
            // Column::make('id_pengumuman')->title('ID')->width(1),
            Column::make('judul')->title('Judul')->width(200),
            Column::make('tanggal')->title('Tanggal')->width(10),
            // Column::make('deskripsi')->title('Deskripsi')->width(400),
            Column::computed('action')->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(141)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengumuman_' . date('YmdHis');
    }
}