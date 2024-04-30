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
                $deleteUrl = route('users.destroy', $row->id_user);
                $action = '
                <div class="container-action">
                <button type="button"
                data-id_user="' . $row->id_user . '"
                data-nik="' . $row->nik . '"
                data-username="' . $row->username . '"
                data-role="' . $row->role . '"
                data-email="' . $row->email . '"
                data-bs-toggle="modal" 
                data-bs-target="#editUsersModal" class="edit btn btn-edit btn-sm">Edit</button>';
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
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id_user')->title('ID'),
            Column::make('nik')->title('NIK'),
            Column::make('username')->title('Username'),
            Column::make('role')->title('Role'),
            Column::make('email')->title('Email'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
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