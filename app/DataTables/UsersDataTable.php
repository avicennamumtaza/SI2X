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
                data-foto_profil="' . $row->foto_profil . '"
                data-email="' . $row->email . '"
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
            ->orderBy(0, 'asc') // Set default order by column 0 (id_pengumuman)
            ->parameters([
                'language' => [
                    'search' => '', // Menghilangkan teks "Search:"
                    'searchPlaceholder' => 'Cari Data User', // Placeholder untuk kolom pencarian
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
            Column::make('id_user')->title('ID'),
            Column::make('nik')->title('NIK'),
            Column::make('username')->title('Nama Pengguna'),
            Column::make('role')->title('Peran'),
            //Column::make('email')->title('Email'),
            //Column::make('foto_profil')->title('Foto Profil'),
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
        return 'Users_' . date('YmdHis');
    }
}