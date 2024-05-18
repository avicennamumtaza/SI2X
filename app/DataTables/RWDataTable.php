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
            // $editUrl = route('rw.edit', $row->no_rw);
            $deleteUrl = route('rw.destroy', $row->no_rw);
            $action = '
            <div class="container-action">
            <button type="button"
            data-id="' . $row->no_rw . '"
            data-nik_rw="' . $row->nik_rw . '"
            data-wa_rw="' . $row->wa_rw . '"
            data-bs-toggle="modal" data-bs-target="#editRwModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';
            $action .= '
            <form action="' . $deleteUrl . '" method="post" style="display:inline;">
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
                    ->orderBy(0, 'asc') // Set default order by column 0 (id_pengumuman)
                    ->parameters([
                        'language' => [
                            'search' => '', // Menghilangkan teks "Search:"
                            'searchPlaceholder' => 'Cari Data RW', // Placeholder untuk kolom pencarian
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
        return [
            Column::make('no_rw')->width(100),
            Column::make('nik_rw')->width(200),
            Column::make('wa_rw')->width(200),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
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