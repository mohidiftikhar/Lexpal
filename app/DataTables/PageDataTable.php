<?php

namespace App\DataTables;

use App\Models\Page;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PageDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('header',function($page){
                if($page->header == 'active'){
                    $btn = '<span class="btn-success p-3 rounded " style="display: inline-block">Active</span>';
                }
                else{
                    $btn = '<span  class="btn-danger p-3 rounded" style="display: inline-block; padding:0.75rem 2px !important;">In Active</span>';
                }
                return $btn;
            })
            ->editColumn('footer',function($page){
                if($page->footer == 'active'){
                    $btn = '<span class="btn-success p-3 rounded " style="display: inline-block">Active</span>';
                }
                else{
                    $btn = '<span  class="btn-danger p-3 rounded" style="display: inline-block; padding:0.75rem 2px !important;">In Active</span>';
                }
                return $btn;
            })
            ->editColumn('bg',function($page){
                if($page->bg == 'active'){
                    $btn = '<span class="btn-success p-3 rounded " style="display: inline-block">Active</span>';
                }
                else{
                    $btn = '<span  class="btn-danger p-3 rounded" style="display: inline-block; padding:0.75rem 2px !important;">In Active</span>';
                }
                return $btn;
            })
            ->addColumn('actions', 'pages.actions')
            ->rawColumns(['actions','header','footer','bg'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('PageDataTable-table')
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
                       window.LaravelDataTables["PageDataTable-table"].ajax.reload( null, false );
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
    public function query(Page $model)
    {
        return $model->newQuery();
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('name')->title('Name'),
            Column::make('heading')->title('Heading'),
            Column::make('content')->title('Content'),
            Column::make('header')->title('Header'),
            Column::make('footer')->title('Footer'),
            Column::make('bg')->title('Background'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'PageTable_' . date('YmdHis');
    }
}
