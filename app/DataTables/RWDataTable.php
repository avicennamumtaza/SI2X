<?php

namespace App\DataTables;

use App\Models\Penduduk;
use App\Models\Rw;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RWDataTable extends DataTable
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
            ->addColumn('nama_rw', function ($row) {
                $nama_rw = Penduduk::where('nik', $row->nik_rw)->value('nama');
                return $nama_rw;
            })
            ->addColumn('action', function ($row) {
                $deleteUrl = route('rw.destroy', $row->no_rw);

                $nama_rw = Penduduk::where('nik', $row->nik_rw)->value('nama');

                $action = '
            <div class="container-action">';

                $action .= '
            <div class="container-action">
            <button type="button"
            data-id="' . $row->no_rw . '"
            data-nik_rw="' . $row->nik_rw . '"
            data-wa_rw="' . $row->wa_rw . '"
            data-nama_rw="' . $nama_rw . '"
            data-jumlah_penduduk="' . $row->penduduk->count() . '"
            data-bs-toggle="modal" data-bs-target="#showRwModal" class="show-user show btn btn-show btn-sm">Tampil</button>';

                $action .= '
            <button type="button"
            data-id="' . $row->no_rw . '"
            data-nik_rw="' . $row->nik_rw . '"
            data-wa_rw="' . $row->wa_rw . '"
            data-bs-toggle="modal" data-bs-target="#editRwModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>
            </div>';
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Rw $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rw-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc') 
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Data RW', 
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
            Column::make('no_rw')->width(100)->title('Nomor RW'),
            Column::make('nama_rw')->width(200)->title('Nama RW'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RW_' . date('YmdHis');
    }
}