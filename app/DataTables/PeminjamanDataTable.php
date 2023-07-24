<?php

namespace App\DataTables;

use App\Models\Pinjam;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PeminjamanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('member_id', function ($row) {
                return $row->member->user->name;
            })
            ->editColumn('book_id', function ($row) {
                return $row->buku->nama_buku;
            })
            ->addColumn('kondisi_buku', function ($row) {
                $kondisi = '';
                if ($row->kondisi_buku == "Rusak") {
                    $kondisi = '<span class="badge bg-danger">' . $row->kondisi_buku . '</span>';
                } else {
                    $kondisi = '<span class="badge bg-success">' . $row->kondisi_buku . '</span>';
                }

                return $kondisi;
            })
            ->rawColumns(['kondisi_buku'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pinjam $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
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
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('member_id')->title('Nama Member')->width('200'),
            Column::make('book_id')->title('Nama Buku')->width('200'),
            Column::make('tgl_pinjam')->title('Tanggal Pinjam'),
            Column::make('tgl_kembali')->title('Batas Pengembalian')->width('100'),
            Column::make('kondisi_buku')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Peminjaman_' . date('YmdHis');
    }
}
