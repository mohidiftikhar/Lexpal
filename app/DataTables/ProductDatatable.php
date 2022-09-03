<?php

namespace App\DataTables;

use App\Models\product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
/*            ->addColumn('name', 'products.name')*/
            ->addColumn('actions', 'products.actions')
            ->rawColumns(['actions'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('ProductDataTable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->pageLength(10)
            ->orderBy(0,'desc')
            ->buttons(
                Button::make([
                    'text'           => 'Reload',
                    'className'      => 'Reload btn btn-success',
                    'orientation'    => 'landscape',
                    'action'         =>  'function ( e, dt, node, config ) {
                       window.LaravelDataTables["ProductDataTable-table"].ajax.reload( null, false );
                }'
                ])
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('name')->title('Name'),
            Column::make('type')->title('Type'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'product_' . date('YmdHis');
    }
}
