<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Users;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                $action = '
                <div class="container-action">';

                $action .='
                <button type="button"
                data-id_user="' . $row->id_user . '"
                data-nik="' . $row->nik . '"
                data-username="' . $row->username . '"
                data-role="' . $row->role . '"
                data-bs-toggle="modal"
                data-bs-target="#showUsersModal" class="show-user show btn btn-show btn-sm">Tampil</button>';

                $action .='
                <button type="button"
                data-id_user="' . $row->id_user . '"
                data-nik="' . $row->nik . '"
                data-username="' . $row->username . '"
                data-role="' . $row->role . '"
                data-bs-toggle="modal"
                data-bs-target="#editUsersModal" class="edit btn btn-edit btn-sm">Edit</button>';

                $action .= ' <button
                type="button"
                class="delete btn btn-delete btn-sm"
                data-bs-target="#deleteUserModal"
                data-bs-toggle="modal"
                data-nik="' . $row->nik . '"
                data-username="' . $row->username . '"
                data-id_user="' . $row->id_user . '"
                >Hapus</button>
            </div>';
                return $action;
            });

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Users $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc') 
            ->parameters([
                'language' => [
                    'search' => '', 
                    'searchPlaceholder' => 'Cari Data User', 
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
            Column::make('id_user')->title('ID'),
            Column::make('nik')->title('NIK'),
            Column::make('username')->title('Nama Pengguna'),
            Column::make('role')->title('Peran'),
            //Column::make('email')->title('Email'),
            //Column::make('foto_profil')->title('Foto Profil'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(250)
                  ->addClass('text-center')
                  ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}