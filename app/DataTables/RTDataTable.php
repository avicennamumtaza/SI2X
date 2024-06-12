<?php

namespace App\DataTables;

use App\Models\Rt;
use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RTDataTable extends DataTable
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
        ->addColumn('nama_rt', function ($row) {
            $nama_rt = Penduduk::where('nik', $row->nik_rt)->value('nama');
            return $nama_rt;
        })
        ->addColumn('action', function($row){
            $nama_rt = Penduduk::where('nik', $row->nik_rt)->value('nama');
            $deleteUrl = route('rt.destroy', $row->no_rt);
            $action = '
            <div class="container-action">';

            $action .= '
                <button type="button"
                data-id="' . $row->no_rt . '"
                data-nik_rt="' . $row->nik_rt . '"
                data-nama="' . $nama_rt . '"
                data-wa_rt="' . $row->wa_rt . '"
                data-jumlah_keluarga="' . $row->keluarga()->count() . '"
                data-bs-toggle="modal" data-bs-target="#showRtModal" class="show-user show btn btn-show btn-sm">Tampil</button>';

            $action .='
            <button type="button"
            data-id="' . $row->no_rt . '"
            data-nik_rt="' . $row->nik_rt . '"
            data-wa_rt="' . $row->wa_rt . '"
            data-bs-toggle="modal" data-bs-target="#editRtModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';
            $action .= ' <button
            type="button" 
            class="delete btn btn-delete btn-sm" 
            data-bs-target="#deleteRtModal" 
            data-bs-toggle="modal"
            data-no_rt="' . $row->no_rt . '"
            data-nik_rt="' . $row->nik_rt . '"
            data-nama_rt="' . $nama_rt . '"
            >Hapus</button>
        </div>';
            return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Rt $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('rt-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->orderBy(0, 'asc') 
        ->parameters([
            'language' => [
                'search' => '', 
                'searchPlaceholder' => 'Cari Data RT', 
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
            Column::make('no_rt')->title('Nomor RT')->width(70),
            Column::make('nama_rt')->title('Nama RT')->width(200),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center')
                  ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RT_' . date('YmdHis');
    }
}