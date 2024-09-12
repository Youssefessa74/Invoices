<?php
namespace App\DataTables;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DeletedInvoicesDataTable extends DataTable
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
                $eye = "<a href='" . route('invoices_details', $query->id) . "' class='btn btn-inverse-warning m-2'><i class='bi bi-eye-fill'></i></a>";
                $edit = "<a href='" . route('invoices.edit', $query->id) . "' class='btn btn-inverse-primary m-2'><i class='bi bi-pen-fill'></i></a>";
                $delete = "<a href='" . route('delete_invoice', $query->id) . "' id='delete'  class='btn btn-inverse-danger  m-2 '><i class='bi bi-trash-fill'></i></a>";
                return $eye.$edit.$delete;
            })
            ->addColumn('invoice_status', function ($query) {
                if($query->invoice_status == 'paid'){
                    return "<span class='badge badge-success'>PAID</span>";
                }
                if($query->invoice_status == 'pending'){
                    return "<span class='badge badge-danger'>PENDING</span>";
                }
                if($query->invoice_status == 'partially_paid'){
                    return "<span class='badge badge-warning'>PARTIALLY PAID</span>";
                }
    })
            ->rawColumns(['invoice_status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return Invoice::onlyTrashed();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('deletedinvoices-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('invoice_Date'),
            Column::make('due_date'),
            Column::make('discount'),
            Column::make('rate_vat'),
            Column::make('value_vat'),
            Column::make('total'),
            Column::make('invoice_status'),
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
        return 'DeletedInvoices_' . date('YmdHis');
    }
}
