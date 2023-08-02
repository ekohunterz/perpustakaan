<?php

namespace App\DataTables;

use App\Models\Member;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MemberDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $action = '<button type="button" data-url="' . route('member.show', $row->id) . '" data-type="detail" class="btn icon btn-success action"><i class="bi bi-eye"></i></button>';
                if (Gate::allows('manage')) {
                    $action .= ' <button type="button" data-url="' . route('member.edit', $row->id) . '" data-type="edit" class="btn icon btn-primary action"><i class="bi bi-pencil"></i></button>';
                    $action .= ' <button type="button" data-url="' . route('member.destroy', $row->id) . '" data-type="delete" class="btn icon btn-danger action"><i class="bi bi-trash"></i></button>';
                }
                return $action;
            })
            ->editColumn('user_id', function ($row) {
                return $row->user->name;
            })
            ->editColumn('kelas_id', function ($row) {
                return $row->kelas->nama_kelas;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Member $model): QueryBuilder
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
            ->orderBy(6, 'desc') // Mengurutkan berdasarkan kolom 'updated_at' secara descending (terbaru ke terlama)
            ->columnDefs([
                ['targets' => 6, 'visible' => false, 'searchable' => false] // Kolom 'updated_at' menjadi tersembunyi
            ])
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
            Column::make('user_id')->title('Nama Siswa'),
            Column::make('nis')->title('NIS'),
            Column::make('jk')->title('Jenis Kelamin'),
            Column::make('kelas_id')->title('Kelas'),
            Column::make('hp')->title('No.HP'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Member_' . date('YmdHis');
    }
}
