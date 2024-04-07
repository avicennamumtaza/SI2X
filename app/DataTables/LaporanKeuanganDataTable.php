<?php

namespace App\DataTables;

use App\Models\LaporanKeuangan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanKeuanganDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'laporankeuangan.action')
            ->setRowId('id')
            ->addColumn('action', function($row){
                // $editUrl = route('laporankeuangan.edit', $row->id_laporankeuangan);
                $deleteUrl = route('laporankeuangan.destroy', $row->id_laporankeuangan);
                $action = '<a href="' . 1 . '" class="edit btn btn-edit btn-sm">Edit</a>';
                $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
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
    public function query(LaporanKeuangan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('laporankeuangan-table')
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
            Column::make('id_laporan')->title('Id'),
            Column::make('is_income')->title('Pemasukan?'),
            Column::make('nominal')->title('Nominal'),
            Column::make('tanggal_laporan')->title('Tanggal'),
            Column::make('pihak_terlibat')->title('Terlibat'),
            Column::make('detail_laporan')->title('Detail Laporan'),
            Column::make('saldo')->title('Saldo'),
            Column::computed('action')
              ->exportable(false)
              ->printable(false)
              ->width(170) 
              ->addClass('text-center'),
        ];
        // return [
        //     Column::make('id_laporankeuangan')->title('Id'),
        //     Column::make('is_income')->title('Pemasukan?'),
        //     Column::make('nominal')->title('Nominal'),
        //     Column::make('tanggal')->title('Tanggal'),
        //     Column::make('pihak_terlibat')->title('Terlibat'),
        //     Column::make('detail')->title('Detail Laporan'),
        //     Column::make('saldo')->title('Saldo'),
        //     Column::computed('action')
        //       ->exportable(false)
        //       ->printable(false)
        //       ->width(170) 
        //       ->addClass('text-center'),
        // ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LaporanKeuangan_' . date('YmdHis');
    }
}
