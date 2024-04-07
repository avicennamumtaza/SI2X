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
            ->addColumn('action', function($row){
                $editUrl = route('umkm.edit', $row->id_umkm);
                $deleteUrl = route('umkm.destroy', $row->id_umkm);
                $action = '<a href="' . $editUrl . '" class="edit btn btn-edit btn-sm">Edit</a>';
                $action .= '&nbsp;';
                $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="delete btn btn-delete btn-sm">Delete</button>
                </form>';
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
            // Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                //   ->width(60)
                //   ->addClass('text-center'),
                Column::make('id_umkm')->title('ID'),
                Column::make('nik_pemilik')->title('NIK Pemilik'),
                Column::make('nama_umkm')->title('Nama '),
                Column::make('foto_umkm')->title('Foto'),
                Column::make('desc_umkm')->title('Deskripsi'),
                Column::make('status_umkm')->title('Status'),
                Column::computed('action')
              ->exportable(false)
              ->printable(false)
              ->width(300) 
              ->addClass('text-center'),
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