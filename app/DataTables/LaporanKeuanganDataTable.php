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
            ->setRowId('id')
            ->editColumn('is_income', function ($row) {
                return $row->is_income ? 'Pemasukkan' : 'Pengeluaran';
            })
            ->addColumn('action', function ($row) {
                $deleteUrl = route('laporankeuangan.destroy', $row->id_laporankeuangan);
                $action = '
                <div class="container-action">
                <button type="button"
                data-id_laporankeuangan="' . $row->id_laporankeuangan . '"
                data-nominal="' . $row->nominal . '"
                data-detail="' . $row->detail . '"
                data-tanggal="' . $row->tanggal . '"
                data-pihak_terlibat="' . $row->pihak_terlibat . '"
                data-saldo="' . $row->saldo . '"
                data-is_income="' . $row->is_income . '"
                data-bs-toggle="modal" data-bs-target="#editLaporanKeuanganModal" class="edit btn btn-edit btn-sm">Edit</button>';
                $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="delete btn btn-delete btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Delete</button>
                </form>
                </div>';
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
                    ->orderBy(0, 'asc')
                    ->parameters([
                        'autoWidth' => false, // Menonaktifkan autoWidth
                        'dom' => 'Bfrtip',
                        'buttons' => [],
                        'order' => [],
                    ])
                    ->selectStyleSingle();
    }

    
    public function getColumns(): array
    {
        return [
            Column::make('id_laporankeuangan')->title('Id')->width('5%'),
            Column::make('is_income')->title('Pemasukan?')->width('5%'),
            Column::make('nominal')->title('Nominal')->width('10%'),
            Column::make('tanggal')->title('Tanggal')->width('10%'),
            Column::make('pihak_terlibat')->title('Terlibat')->width('15%'),
            Column::make('detail')->title('Detail')->width('30%'), // Mengatur lebar kolom "Detail"
            Column::make('saldo')->title('Saldo')->width('10%'),
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
        return 'LaporanKeuangan_' . date('YmdHis');
    }
}