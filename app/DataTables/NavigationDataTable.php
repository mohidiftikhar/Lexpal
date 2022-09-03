<?php

namespace App\DataTables;

use App\Models\NavigationBar;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NavigationDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('status', 'navigation.status')
            ->addColumn('actions', 'navigation.actions')
            ->rawColumns(['actions','status'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('NavigationDataTable-table')
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
                       window.LaravelDataTables["NavigationDataTable-table"].ajax.reload( null, false );
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
    public function query(NavigationBar $model)
    {
        return $model->newQuery();
    }

    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('name')->title('Name'),
            Column::make('url')->title('URL'),
            Column::make('status')->title('Status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Navigation_' . date('YmdHis');
    }
}
