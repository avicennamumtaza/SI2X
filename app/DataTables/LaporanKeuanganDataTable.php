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
            ->editColumn('status_pemasukan', function ($row) {
                return $row->status_pemasukan ? 'Pemasukkan' : 'Pengeluaran';
            })
            ->addColumn('action', function ($row) {
                // $latestTanggal = LaporanKeuangan::orderBy('tanggal', 'desc')->take(1)->get()->value('tanggal');
                $latestUpdate = LaporanKeuangan::latest('updated_at')->value('updated_at');
                if ($row->updated_at == $latestUpdate) {
                    $action = '
                    <div class="container-action">
                    <button type="button"
                    data-id_laporankeuangan="' . $row->id_laporankeuangan . '"
                    data-nominal="' . $row->nominal . '"
                    data-detail="' . $row->detail . '"
                    data-tanggal="' . $row->tanggal . '"
                    data-pihak_terlibat="' . $row->pihak_terlibat . '"
                    data-saldo="' . $row->saldo . '"
                    data-is_income="' . $row->status_pemasukan . '"
                    data-bs-toggle="modal" data-bs-target="#editLaporanKeuanganModal" class="edit btn btn-edit btn-sm">Edit</button>';
                    $action .= '
                    <button
                    type="button" 
                    class="delete btn btn-delete btn-sm" 
                    data-bs-target="#deleteLaporanKeuanganModal" 
                    data-bs-toggle="modal"
                    data-detail="' . $row->detail . '"
                    data-tanggal="' . $row->tanggal . '"
                    data-id="' . $row->id_laporankeuangan . '"
                    >Hapus</button>
                </div>';
                } else {
                    $action = '
                    <div class="container-action">
                    <p>Hanya data terbaru yang dapat diubah atau dihapus</p>
                    </div>
                    ';
                }
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LaporanKeuangan $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('updated_at', 'desc');
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
            // ->orderBy(0, 'asc')
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Laporan Keuangan', 
                    'paginate' => [
                        'previous' => 'Kembali',
                        'next' => 'Lanjut', 
                    ],
                    'info' => 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri', 
                ],
                'dom' => 'Bfrtip', 
                'buttons' => [], 
                'order' => [], 
                'columnDefs' => [
                    
                    ['targets' => -1, 'searchable' => false, 'orderable' => false] 
                ]
            ])
            ->selectStyleSingle();
    }

   
    public function getColumns(): array
    {
        return [
            // ['data' => 'id_laporankeuangan', 'name' => 'id', 'searchable' => false, 'orderable' => false, 'title' => 'ID'],
            ['data' => 'tanggal', 'name' => 'tanggal', 'searchable' => true, 'orderable' => true, 'title' => 'Tanggal'],
            ['data' => 'status_pemasukan', 'name' => 'status_pemasukan', 'searchable' => false, 'orderable' => false, 'title' => 'Jenis'],
            ['data' => 'detail', 'name' => 'detail', 'searchable' => false, 'orderable' => false, 'title' => 'Detail'],
            ['data' => 'nominal', 'name' => 'nominal', 'searchable' => false, 'orderable' => false, 'title' => 'Nominal'],
            ['data' => 'saldo', 'name' => 'saldo', 'searchable' => false, 'orderable' => false, 'title' => 'Saldo'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(190)
                ->addClass('text-center')
                ->title('Aksi')
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