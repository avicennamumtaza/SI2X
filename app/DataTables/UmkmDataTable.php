<?php

namespace App\DataTables;

use App\Models\Umkm;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UmkmDataTable extends DataTable
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
                $editUrl = route('umkm.update', $row->id_umkm);
                $editModal = '
                <div class="modal fade" id="validasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pengajuan UMKM</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="' . $editUrl . '" method="POST">
                            <div class="modal-body justify-content-start text-start">
                                ' .
                                //  . (@csrf) . (@method('PUT')) . 
                                '
                                    <div class="form-group mb-3">
                                        <label for="status_umkm" class="form-label text-start">Status UMKM</label>
                                        <select class="form-control" id="status_umkm" name="status_umkm" required>
                                            <option value="Baru" ' .  ($row->status_umkm == 'Baru' ? 'selected' : '') . '>Baru</option>
                                            <option value="Diterima" ' . ($row->status_umkm == 'Diterima' ? 'selected' : '') . '>Diterima
                                            </option>
                                            <option value="Ditolak" ' . ($row->status_umkm == 'Ditolak' ? 'selected' : '') . '>Ditolak
                                            </option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>';
                $deleteUrl = route('umkm.destroy', $row->id_umkm);
                $action = '
                <div class="container-action">
                <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#validasi">Edit</button>
                ';
                $action .= '
                <form data-confirm-delete="true" action="' . $deleteUrl . '" method="post" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                </form>
                </div>';
                return $action;
            });
    }    

    /**
     * Get the query source of dataTable.
     */
    public function query(Umkm $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {

        return $this->builder()
            ->setTableId('umkm-table')
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
            // Column::computed('action')
            //   ->exportable(false)
            //   ->printable(false)
            //   ->width(60)
            //   ->addClass('text-center'),
            Column::make('id_umkm')->title('ID'),
            Column::make('nik_pemilik')->title('NIK Pemilik'),
            Column::make('nama_umkm')->title('Nama'),
            Column::make('foto_umkm')->title('Foto'),
            // Column::computed('foto_umkm')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(130)
            //     // ->addClass('text-center')
            //     ->title('Foto'),
            // // ->width(10),
            Column::make('desc_umkm')->title('Deskripsi'),
            Column::make('status_umkm')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(130)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Umkm_' . date('YmdHis');
    }
}