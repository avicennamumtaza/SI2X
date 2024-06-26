<?php

namespace App\DataTables;

use App\Models\Keluarga;
use App\Models\Rt;
use App\Models\Users;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KeluargaDataTable extends DataTable
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
            ->addColumn('action', function ($row) {

                $deleteUrl = route('keluarga.destroy', $row->nkk);
                $action = '
                <div class="container-action">
                <button type="button"
                data-id="' . $row->nkk . '"
                data-no_rt="' . $row->no_rt . '"
                data-nik_kepala="' . $row->nik_kepala_keluarga . '"
                data-bs-toggle="modal" data-bs-target="#showKeluargaModal" class="show-user show btn btn-show btn-sm">Tampil</button>';

                $action .= '
                <div class="container-action">
                <button type="button"
                data-id="' . $row->nkk . '"
                data-nik_kepala="' . $row->nik_kepala_keluarga . '"
                data-no_rt="' . $row->no_rt . '"
                data-bs-toggle="modal" data-bs-target="#editKeluargaModal"
                class="edit btn btn-edit btn-sm">Edit</button>';
                $action .= ' <button
                    type="button" 
                    class="delete btn btn-delete btn-sm" 
                    data-bs-target="#deleteKeluargaModal" 
                    data-bs-toggle="modal"
                    data-nkk="' . $row->nkk . '"
                    >Hapus</button>
                </div>';
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Keluarga $model): QueryBuilder
    {
        if (auth()->user()->role == 'RT') {
            // Dapatkan pengguna yang sedang login
            $user = Users::where('id_user', auth()->user()->id_user)->first();
            $nikRt = $user->nik; // Ambil nilai nik dari pengguna
            $noRt = Rt::where('nik_rt', $nikRt)->pluck('no_rt')->first();

            return $model->newQuery()->where('no_rt', $noRt);
        }
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('keluarga-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Data Keluarga', 
                    'paginate' => [
                        'previous' => 'Kembali', 
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
            Column::make('nkk')->width(300)->title('Nomor KK'),
            Column::make('no_rt')->width(100)->title('Nomor RT'),
            Column::make('nik_kepala_keluarga')->title('Kepala Keluarga')->width(300),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(270)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Keluarga_' . date('YmdHis');
    }
}