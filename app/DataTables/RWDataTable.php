<?php

namespace App\DataTables;

use App\Models\RW;
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
        ->addColumn('action', function($row){
            $editUrl = route('rw.edit', $row->no_rw);
            $deleteUrl = route('rw.destroy', $row->no_rw);
            $action = '<div class="container-action">
            <a href="' . $editUrl . '" class="edit btn btn-edit btn-sm">Edit</a>';
            $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline-block;">
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
    public function query(RW $model): QueryBuilder
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
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('no_rw'),
            Column::make('nik_rw')->width(200),
            Column::make('jumlah_rt')->width(150),
            Column::make('jumlah_keluarga_rw')->width(150),
            Column::make('jumlah_penduduk_rw')->width(150),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
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
