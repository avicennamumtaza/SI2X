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
            ->editColumn('status_pernikahan', function ($row) {
                return $row->status_pernikahan ? 'Menikah' : 'Belum Menikah';
            })
            ->editColumn('status_pendatang', function ($row) {
                return $row->status_domisili ? 'Pendatang' : 'Asli';
            })
            ->editColumn('golongan_darah', function ($row) {
                return $row->golongan_darah;
            })
            // ->addColumn('umur', function ($row) {
            //     // Menghitung umur berdasarkan tanggal lahir
            //     $tanggal_lahir = new DateTime($row->tanggal_lahir);
            //     $waktu_sekarang = new DateTime();
            //     $selisih = $tanggal_lahir->diff($waktu_sekarang);
            //     return $selisih->y;
            // })
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
                data-jenis_kelamin="' . $row->agama . '"
                data-jenis_kelamin="' . $row->pendidikan . '"
                data-pekerjaan="' . $row->pekerjaan . '"
                data-golongan_darah="' . $row->golongan_darah. '"
                data-is_married="' . $row->status_pernikahan . '"
                data-is_stranger="' . $row->status_pendatang . '"
                data-bs-toggle="modal" data-bs-target="#editPendudukModal" class="edit-user edit btn btn-edit btn-sm">Edit</button>';
                $action .= '<form action="' . $deleteUrl . '" method="post" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') .
                '<button type="submit" class="delete btn btn-delete btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
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
            ->setTableId('penduduk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->parameters([
                'language' => [
                    'search' => '', // Menghilangkan teks "Search:"
                    'searchPlaceholder' => 'Cari Data Penduduk', // Placeholder untuk kolom pencarian
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
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            Column::make('nik')->type('string'),
            Column::make('nkk'),
            Column::make('no_rt'),
            Column::make('nama'),
            // Column::make('tempat_lahir'),
            Column::make('tanggal_lahir'),
            // Column::make('umur'),
            Column::make('alamat')->width(170),
            Column::make('jenis_kelamin'),
            Column::make('pekerjaan'),
            // Column::make('golongan_darah'),
            Column::make('status_pernikahan'),
            Column::make('status_pendatang')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
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
