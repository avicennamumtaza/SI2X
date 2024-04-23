<?php

namespace App\DataTables;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

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
                if ($row->jenis_kelamin === 'L') {
                    return 'Laki-laki';
                } elseif ($row->jenis_kelamin === 'P') {
                    return 'Perempuan';}
            })
            ->editColumn('is_married', function ($row) {
                return $row->is_married ? 'Menikah' : 'Belum Menikah';
            })
            ->editColumn('is_stranger', function ($row) {
                return $row->is_stranger ? 'Non Domisili' : 'Domisili';
            })
            ->addColumn('action', function ($row) {

                $deleteUrl = route('penduduk.destroy', $row->nik);
                $action = '
                <div class="container-action">
                <button type="button"
                data-id="' . $row->nik . '"
                data-nkk="' . $row->nkk . '"
                data-no_rt="' . $row->no_rt . '"
                data-nama="' . $row->nama . '"
                data-tempat_lahir="' . $row->tempat_lahir . '"
                data-tanggal_lahir="' . $row->tanggal_lahir . '"
                data-alamat="' . $row->alamat . '"
                data-jenis_kelamin="' . $row->jenis_kelamin . '"
                data-pekerjaan="' . $row->pekerjaan . '"
                data-gol_darah="' . $row->gol_darah . '"
                data-is_married="' . $row->is_married . '"
                data-is_stranger="' . $row->is_stranger . '"
                data-bs-toggle="modal" data-bs-target="#editPendudukModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';
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
    public function query(Penduduk $model): QueryBuilder
    {
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
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('nik')->type('string'),
            Column::make('nkk'),
            Column::make('no_rt'),
            Column::make('nama'),
            Column::make('tempat_lahir'),
            Column::make('tanggal_lahir'),
            Column::make('alamat'),
            Column::make('jenis_kelamin'),
            Column::make('pekerjaan'),
            Column::make('gol_darah'),
            Column::make('is_married'),
            Column::make('is_stranger'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
