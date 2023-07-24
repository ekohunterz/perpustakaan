<?php

namespace App\DataTables;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelasDataTable extends DataTable
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
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d M Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update')) {
                    $action = ' <button type="button" data-url="' . route('kelas.edit', $row->id) . '" data-type="edit" class="btn icon btn-primary action"><i class="bi bi-pencil"></i></button>';
                }
                if (Gate::allows('delete')) {
                    $action .= ' <button type="button" data-url="' . route('kelas.destroy', $row->id) . '" data-type="delete" class="btn icon btn-danger action"><i class="bi bi-trash"></i></button>';
                }
                return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Kelas $model): QueryBuilder
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
        $columns = [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('nama_kelas'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];

        // Cek izin pengguna untuk melakukan tindakan
        if (Gate::allows('update', 'delete')) {
            $columns[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center');
        }

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kelas_' . date('YmdHis');
    }
}
