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
            ->addColumn('action', function($row){
                $editUrl = route('pengumuman.edit', $row->id_pengumuman);
                $deleteUrl = route('pengumuman.destroy', $row->id_pengumuman);
                $action = '
                <div class="container-action">
                <a href="' . $editUrl . '" class="edit btn btn-edit btn-sm">Edit</a>';
                $action .= '
                <form action="' . $deleteUrl . '" method="post" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="delete btn btn-delete btn-sm">Delete</button>
                </form>
                </div>';
                return $action;
            });
            // Menambahkan kolom "foto" ke tabel
            // ->addColumn('foto', function($row) {
            //     // Pastikan $row adalah objek yang memiliki properti "foto"
            //     $imageUrl = isset($row->foto) ? $row->foto : '';
            //     $foto = '<img src="' . $imageUrl . '" width="100" height="100">';
            //     return $foto;
            // });
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
            Column::make('id_pengumuman')->title('Id'),
            Column::make('judul')->title('Judul'),
            Column::make('tanggal')->title('Tanggal'),
            Column::make('deskripsi')->title('Deskripsi'),
            Column::make('foto')->title('Foto'),
            // Column::computed('foto')
            //     ->title('Foto')
            //     ->render(function ($pengumuman) {
            //         // Pastikan $pengumuman adalah objek yang memiliki properti "foto"
            //         $imageUrl = isset($pengumuman->foto) ? $pengumuman->foto : '';
            //         return '<img src="' . $imageUrl . '" width="100" height="100">';
            //     })
            //     ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(130)
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