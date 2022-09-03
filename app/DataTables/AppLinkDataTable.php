<?php

namespace App\DataTables;

use App\Models\App_link;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppLinkDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('icon', 'app_links.icon')
            /*->addColumn('short_heading', 'app_links.short_heading')
            ->addColumn('heading', 'app_links.heading')
            ->addColumn('url', 'app_links.url')*/
            ->addColumn('actions', 'app_links.actions')
            ->rawColumns(['actions', 'icon'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('AppLinkDataTable-table')
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
                       window.LaravelDataTables["LicenseDataTable-table"].ajax.reload( null, false );
                }'
                ])
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\App_link $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(App_link $model)
    {
        return $model->newQuery();
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::computed('icon')->title('Icon'),
            Column::make('short_heading')->title('Short Heading'),
            Column::make('heading')->title('Heading'),
            Column::make('url')->title('URL'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'app_links_' . date('YmdHis');
    }
}
