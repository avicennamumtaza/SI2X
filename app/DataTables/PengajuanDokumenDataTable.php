<?php

namespace App\DataTables;

use App\Models\PengajuanDokuman;
use App\Models\PengajuanDokumen;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengajuanDokumenDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        // ->addColumn('action', 'pengajuandokumen.action')
        ->setRowId('id')
        ->addColumn('action', function($row){
            // $editUrl = route('pengajuandokumen.edit', $row->id_pengajuandokumen);
            $deleteUrl = route('pengajuandokumen.destroy', $row->id_pengajuandokumen);
            $action = '
            <div class="container-action">
            <a href="' . 1 . '" class="edit btn btn-edit btn-sm">Edit</a>';
            $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="delete btn btn-delete btn-sm">Delete</button>
            </form>
            </div>';
            return $action;
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PengajuanDokumen $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengajuandokumen-table')
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
            Column::make('id_pengajuandokumen')->title('Id'),
            Column::make('id_dokumen')->title('Dokumen'),
            Column::make('no_rt')->title('RT'),
            Column::make('nik_pengaju')->title('NIK'),
            Column::make('nama_pengaju')->title('Nama'),
            Column::make('status_pengajuan')->title('Status'),
            Column::make('catatan')->title('Catatan'),
            Column::make('created_at')->title('Tanggal'),
            // Column::make('detail_laporan')->title('Detail Laporan'),
            // Column::make('saldo')->title('Saldo'),
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
        return 'PengajuanDokumen_' . date('YmdHis');
    }
}
