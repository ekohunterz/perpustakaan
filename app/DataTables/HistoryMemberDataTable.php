<?php

namespace App\DataTables;

use App\Models\History;
use App\Models\HistoryMember;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HistoryMemberDataTable extends DataTable
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
            ->editColumn('tgl_pinjam', function ($row) {
                return date('d M Y', strtotime($row->tgl_pinjam));
            })
            ->editColumn('batas_tgl_kembali', function ($row) {
                return date('d M Y', strtotime($row->batas_tgl_kembali));
            })
            ->editColumn('tgl_kembali', function ($row) {
                $tgl = '';
                if ($row->tgl_kembali) {
                    $tgl = date('d M Y', strtotime($row->tgl_kembali));
                }
                return $tgl;
            })
            ->addColumn('kondisi_buku_saat_dipinjam', function ($row) {
                $kondisi = '';
                if ($row->kondisi_buku_saat_dipinjam == "Rusak") {
                    $kondisi = '<span class="badge bg-warning">' . $row->kondisi_buku_saat_dipinjam . '</span>';
                } else {
                    $kondisi = '<span class="badge bg-success">' . $row->kondisi_buku_saat_dipinjam . '</span>';
                }

                return $kondisi;
            })
            ->addColumn('kondisi_buku_saat_dikembalikan', function ($row) {
                $kondisi = '';
                if ($row->kondisi_buku_saat_dikembalikan == "Rusak") {
                    $kondisi = '<span class="badge bg-warning">' . $row->kondisi_buku_saat_dikembalikan . '</span>';
                } else if ($row->kondisi_buku_saat_dikembalikan == "Hilang") {
                    $kondisi = '<span class="badge bg-danger">' . $row->kondisi_buku_saat_dikembalikan . '</span>';
                } else {
                    $kondisi = '<span class="badge bg-success">' . $row->kondisi_buku_saat_dikembalikan . '</span>';
                }

                return $kondisi;
            })
            ->addColumn('status', function ($row) {
                $status = '';
                if ($row->status == "Pinjam") {
                    $status = '<span class="badge bg-warning align-items-center">' . $row->status . '</span>';
                } else {
                    $status = '<span class="badge bg-success">' . $row->status . '</span>';
                }

                return $status;
            })
            ->editColumn('book_id', function ($row) {
                return $row->buku->nama_buku;
            })
            ->addColumn('foto_buku', function ($row) {
                if ($row->buku->foto_buku) {
                    $foto_buku = '<img src="/storage/books/' . $row->buku->foto_buku . '" height="60" width="60" alt="">';
                } else {
                    $foto_buku = '<img src="/assets/compiled/jpg/img01.jpg" height="60" width="60" alt="">';
                }
                return $foto_buku;
            })
            ->rawColumns(['kondisi_buku_saat_dipinjam', 'kondisi_buku_saat_dikembalikan', 'status', 'foto_buku'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(History $model): QueryBuilder
    {
        return $model->newQuery()->where('member_id', Auth::user()->member->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('historymember-table')
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
            Column::make('book_id')->title('Nama Buku'),
            Column::make('foto_buku')->title('Foto Buku'),
            Column::make('tgl_pinjam')->title('Tanggal Pinjam')->filter(['type' => 'date-range']),
            Column::make('batas_tgl_kembali')->title('Batas Pengembalian'),
            Column::make('tgl_kembali')->title('Tanggal Pengembalian'),
            Column::make('kondisi_buku_saat_dipinjam')->title('Kondisi Saat Dipinjam'),
            Column::make('kondisi_buku_saat_dikembalikan')->title('Kondisi Saat Dikembalikan'),
            Column::make('denda')->title('Denda'),
            Column::make('status')->addClass('text-center')->title('Status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HistoryMember_' . date('YmdHis');
    }
}
