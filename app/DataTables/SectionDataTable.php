<?php

namespace App\DataTables;

use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SectionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $edit = "<a href='" . route('sections.edit', $query->id) . "' class='btn btn-inverse-primary m-2'><i class='bi bi-pen-fill'></i></a>";
            $delete = "<a href='" . route('sections.destroy', $query->id) . "' id='delete'  class='btn btn-inverse-danger  m-2 '><i class='bi bi-trash-fill'></i></a>";
            return $edit . $delete;
        })
        ->addColumn('status', function ($query) {
            return $query->status == 1 ? "<span class='badge badge-success'>Active</span>" : '<span class="badge badge-danger">Inactive</span>';
        })
        ->addColumn('created_by',function($query){

            return isset($query->user->name) ? $query->user->name : '' ;
        })
        ->rawColumns(['action','status','created_by'])
        ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Section $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('section-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('id'),
            Column::make('name'),
            Column::make('description'),
            Column::make('status'),
            Column::make('created_by'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Section_' . date('YmdHis');
    }
}
