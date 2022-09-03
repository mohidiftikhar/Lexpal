<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Query\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', 'sliders.image')
            /*->addColumn('heading', 'sliders.heading')
            ->addColumn('description', 'sliders.description')*/
            ->addColumn('app_id', 'sliders.app_links')
            ->addColumn('actions', 'sliders.actions')
            ->rawColumns(['actions', 'image'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('SliderDataTable-table')
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
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {

        return Slider::with('appLinks','appLinks.appHeading')->newQuery();
        //return $model->with('app_link')->newQuery();
    }
 /*   public function query()
    {
        return Slider::select('sliders.*', 'app_links.heading as app_links')
            ->leftJoin('slider_links', 'slider_links.slider_id', 'sliders.id')
            ->leftJoin('app_links', 'app_links.id', 'slider_links.app_link_id')
            ->newQuery();
            }*/
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::computed('image')->title('Image'),
            Column::make('heading')->title('Heading'),
            Column::make('description')->title('Description'),
            Column::computed('app_id')->title('App Links'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'sliders_' . date('YmdHis');
    }
}
