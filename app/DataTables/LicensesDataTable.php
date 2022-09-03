<?php

namespace App\DataTables;

use App\Models\License;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LicensesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('status',function($license){
                if($license->status == 'active'){
                    $btn = '<span class="btn-success p-3 rounded " style="display: inline-block">Active</span>';
                }
                else{
                    $btn = '<span  class="btn-danger p-3 rounded" style="display: inline-block; padding:0.75rem 2px !important;">In Active</span>';
                }
                return $btn;
            })
            ->filterColumn('product_name', function($query, $keyword) {
                $sql = "name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('actions', 'licenses.actions')
            ->rawColumns(['actions','status'])
        ->addIndexColumn();

    }

    public function html()
    {
        return $this->builder()
            ->setTableId('LicenseDataTable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->pageLength(10)
            ->orderBy(2, 'asc')
            ->buttons(
                Button::make([
                    'text'           => 'Reload',
                    'className'      => 'btn btn-success',
                    'orientation'    => 'landscape',
                    'action'         =>  'function ( e, dt, node, config ) {
                       window.LaravelDataTables["LicenseDataTable-table"].ajax.reload( null, false );
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
    public function query(License $model)
    {
//        return License::with('product');
//        return $model->newQuery();
        return $model->newQuery()->select('licenses.*','products.name as product_name')->
        join('products','licenses.product_id','products.id');
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('social_type')->title('Social Type'),
            Column::make('product_name')->title('Products'),
            Column::make('domain_name')->title('Domain'),
            Column::make('contract_id')->title('Contract ID'),
            Column::make('client_name')->title('Client Name'),
            Column::make('expiry_date',)->title('Expiry Date'),
            Column::make('status')->title('Status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'LicenseTable_' . date('YmdHis');
    }
}
