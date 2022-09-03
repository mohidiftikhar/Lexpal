<?php

namespace App\DataTables;

use App\Models\Plan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PlanDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', 'plans.actions')
            ->editColumn('status',function($plan){
                if($plan->status == 'active'){
                    $btn = '<span class="btn-success p-3 rounded " style="display: inline-block">Active</span>';
                }
                else{
                    $btn = '<span  class="btn-danger p-3 rounded" style="display: inline-block; padding:0.75rem 2px !important;">In Active</span>';
                }
                return $btn;
            })            ->rawColumns(['actions','status'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('PlanDataTable-table')
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
                       window.LaravelDataTables["PlanDataTable-table"].ajax.reload( null, false );
                }'
                ])
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Plan $model)
    {
        return $model->newQuery();
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('name')->title('Name'),
            Column::make('price')->title('  Price'),
            Column::make('currency')->title('Currency'),
            Column::make('plan_duration')->title('Duration'),
            Column::make('duration_period')->title('Duration Period'),
            Column::make('content')->title('Offers'),
            Column::make('status')->title('Status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'PlanTable_' . date('YmdHis');
    }
}
