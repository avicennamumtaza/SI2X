<?php

namespace App\DataTables;

use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AlternatifDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'alternatif.action')
            ->setRowId('nkk')
            ->addColumn('action', function ($row) {

                $deleteUrl = route('bansos.destroy', $row->nkk);
                $action = '
                <div class="container-action">';
                
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
    public function query(Alternatif $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('alternatif')
        ->columns($this->getColumns())
        ->minifiedAjax()
        //->dom('Bfrtip')
        ->orderBy(0, 'asc')
        ->parameters([
            'language' => [
                'search' => '', // Menghilangkan teks "Search:"
                'searchPlaceholder' => 'Cari Data', // Placeholder untuk kolom pencarian
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
            Column::make('nkk')->title('Keluarga Calon Penerima'),
            Column::make('penghasilan'),
            Column::make('tanggungan'),
            Column::make('pajak_bumibangunan')->title('Pajak Bumi Bangunan'),
            Column::make('pajak_kendaraan')->title('Pajak Kendaraan'),
            Column::make('daya_listrik')->title('Daya Listrik'),
            // Column::make('updated_at')->title('tan'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Alternatif_' . date('YmdHis');
    }
}
