<?php

namespace App\DataTables;

use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DokumenDataTable extends DataTable
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
                $deleteUrl = route('dokumen.destroy', $row->id_dokumen);
                $action ='
                <div class="container-action">';

                $action .='
                <button type="button"
                data-id="' . $row->id_dokumen . '"
                data-jenis_dokumen="' . $row->jenis_dokumen . '"
                data-deskripsi="' . $row->deskripsi . '"
                data-bs-toggle="modal" data-bs-target="#showDokumenModal"
                class="show-user show btn btn-show btn-sm me-1">Tampil</button>';

                $action .='
                <button type="button"
                data-id="' . $row->id_dokumen . '"
                data-jenis_dokumen="' . $row->jenis_dokumen . '"
                data-deskripsi="' . $row->deskripsi . '"
                data-bs-toggle="modal" data-bs-target="#editDokumenModal"
                class="edit btn btn-edit btn-sm">Edit</button>';

                $action .= ' <button
                type="button"
                    class="delete btn btn-delete btn-sm"
                    data-bs-target="#deleteDokumenModal"
                    data-bs-toggle="modal"
                    data-jenis_dokumen="' . $row->jenis_dokumen . '"
                    data-id="' . $row->id_dokumen . '"
                    >Hapus</button>
                </div>';
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Dokumen $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dokumen-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->parameters([
                'language' => [
                    'search' => '', // Menghilangkan teks "Search:"
                    'searchPlaceholder' => 'Cari Dokumen', // Placeholder untuk kolom pencarian
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
            Column::make('id_dokumen')->title('ID'),
            Column::make('jenis_dokumen')->title('Jenis'),
            Column::make('deskripsi')->title('Deskripsi'),
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
        return 'Dokumen_' . date('YmdHis');
    }
}
