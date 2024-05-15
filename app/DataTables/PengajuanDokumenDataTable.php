<?php

namespace App\DataTables;

use App\Models\PengajuanDokumen;
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

class PengajuanDokumenDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        if (auth()->user()->role == 'Rw') {
            # code...
            return (new EloquentDataTable($query))
                // ->addColumn('action', 'a.action')
                ->setRowId('id');
        } else {
            return (new EloquentDataTable($query))
                ->setRowId('id')
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('pengajuandokumen.destroy', $row->id_pengajuandokumen);
                    $action = '
                    <div class="container-action">
                    <button type="button"
                    data-id_pengajuandokumen="' . $row->id_pengajuandokumen . '"
                    data-no_rt="' . $row->no_rt . '"
                    data-id_dokumen="' . $row->id_dokumen . '"
                    data-nik_pengaju="' . $row->nik_pengaju . '"
                    data-nama_pengaju="' . $row->nama_pengaju . '"
                    data-status_pengajuan="' . $row->status_pengajuan . '"
                    data-catatan="' . $row->catatan . '"
                    data-bs-toggle="modal" data-bs-target="#editPengajuanDokumenModal" class="edit btn btn-edit btn-sm">Edit</button>';
                    $action .= 
                    '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . 
                    '<button type="submit" class="delete btn btn-delete btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                    </form>
                    </div>';
                    return $action;
                });
        }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PengajuanDokumen $model): QueryBuilder
    {
        if (auth()->user()->role == 'Rt') {
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
                    ->setTableId('pengajuandokumen-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'asc') // Set default order by column 0 (id_pengumuman)
                    ->parameters([
                        'language' => [
                            'search' => '', // Menghilangkan teks "Search:"
                            'searchPlaceholder' => 'Cari Pengumuman', // Placeholder untuk kolom pencarian
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
        if (auth()->user()->role == 'Rw') {
            # code...
            return [
                Column::make('id_pengajuandokumen')->title('Id'),
                Column::make('id_dokumen')->title('Dokumen'),
                Column::make('no_rt')->title('RT'),
                Column::make('nik_pengaju')->title('NIK'),
                Column::make('nama_pengaju')->title('Nama'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('catatan')->title('Catatan'),
                Column::make('created_at')->title('Tanggal'),
                // Column::make('detail_laporan')->title('Detail Laporan'),
                // Column::make('saldo')->title('Saldo'),
                // Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                //   ->width(130) 
                //   ->addClass('text-center'),
            ];
        } else {
            return [
                Column::make('id_pengajuandokumen')->title('Id'),
                Column::make('id_dokumen')->title('Dokumen'),
                Column::make('no_rt')->title('RT'),
                Column::make('nik_pengaju')->title('NIK'),
                Column::make('nama_pengaju')->title('Nama'),
                Column::make('status_pengajuan')->title('Status'),
                Column::make('catatan')->title('Catatan'),
                Column::make('created_at')->title('Tanggal'),
                // Column::make('detail_laporan')->title('Detail Laporan'),
                // Column::make('saldo')->title('Saldo'),
                Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(130) 
                  ->addClass('text-center'),
            ];
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PengajuanDokumen_' . date('YmdHis');
    }
}