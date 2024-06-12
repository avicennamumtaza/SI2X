<?php

namespace App\DataTables;

use App\Models\Penduduk;
use App\Models\Rt;
use App\Models\Users;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DateTime;
use Carbon\Carbon;

class PendudukDataTable extends DataTable
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
            ->editColumn('jenis_kelamin', function ($row) {
                return $row->jenis_kelamin->getDescription();
            })
            ->editColumn('status_pendatang', function ($row) {
                return $row->status_domisili ? 'Pendatang' : 'Asli';
            })
            ->addColumn('action', function ($row) {

                $deleteUrl = route('penduduk.destroy', $row->nik);
                $action = '
                <div class="container-action">';

                $action .= '
                <button type="button"
                data-id="' . $row->nik . '"
                data-nkk="' . $row->nkk . '"
                data-no_rt="' . $row->no_rt . '"
                data-nama="' . $row->nama . '"
                data-tempat_lahir="' . $row->tempat_lahir . '"
                data-tanggal_lahir="' . $row->tanggal_lahir . '"
                data-umur="' . Carbon::parse($row->tanggal_lahir)->age . '"
                data-alamat="' . $row->alamat . '"
                data-jenis_kelamin="' . $row->jenis_kelamin->getDescription() . '"
                data-pendidikan="' . $row->pendidikan->value . '"
                data-agama="' . $row->agama->value . '"
                data-pekerjaan="' . $row->pekerjaan->value . '"
                data-golongan_darah="' . $row->golongan_darah->value . '"
                data-status_pernikahan="' . $row->status_pernikahan->value . '"
                data-status_pendatang="' . ($row->status_pendatang == 0 ? 'Domisili' : 'Non Domisili') . '"
                data-bs-toggle="modal" data-bs-target="#showPendudukModal" class="show-user show btn btn-show btn-sm me-1">Tampil</button>';

                $action .= '<button type="button"
                data-id="' . $row->nik . '"
                data-nkk="' . $row->nkk . '"
                data-no_rt="' . $row->no_rt . '"
                data-nama="' . $row->nama . '"
                data-tempat_lahir="' . $row->tempat_lahir . '"
                data-tanggal_lahir="' . $row->tanggal_lahir . '"
                data-alamat="' . $row->alamat . '"
                data-jenis_kelamin="' . $row->jenis_kelamin->value . '"
                data-pendidikan="' . $row->pendidikan->value . '"
                data-agama="' . $row->agama->value . '"
                data-pekerjaan="' . $row->pekerjaan->value . '"
                data-golongan_darah="' . $row->golongan_darah->value . '"
                data-status_pernikahan="' . $row->status_pernikahan->value . '"
                data-status_pendatang="' . $row->status_pendatang . '"
                data-bs-toggle="modal" data-bs-target="#editPendudukModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';

                $action .= ' <button
                    type="button"
                    class="delete btn btn-delete btn-sm"
                    data-bs-target="#deletePendudukModal"
                    data-bs-toggle="modal"
                    data-nama="' . $row->nama . '"
                    data-nik="' . $row->nik . '"
                    >Hapus</button>
                </div>';
                return $action;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Penduduk $model): QueryBuilder
    {
        if (auth()->user()->role == 'RT') {
            $user = Users::where('id_user', auth()->user()->id_user)->first();
            $nikRt = $user->nik; 
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
            ->setTableId('penduduk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Data Penduduk',
                    'paginate' => [
                        'previous' => 'Kembali', 
                        'next' => 'Lanjut', 
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
            Column::make('nik')->type('string')->title('NIK'),
            Column::make('nama'),
            Column::make('alamat')->width(350),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Penduduk_' . date('YmdHis');
    }
}