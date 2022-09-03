<?php

namespace App\DataTables;

use App\Models\DictionaryUpload;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', 'csv.actions')
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DictionaryUpload $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DictionaryUpload $model)
    {
        return $model->from('dictionary_uploads as du')->join('languages as l','l.id','=','du.language_id')
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('csvdatatable1-table')
            ->columns($this->getColumns())
           // ->minifiedAjax()
            ->postAjax([
                'type'=>'POST'
            ])
            ->dom('Bfrtip')
            ->pageLength(10)
            ->orderBy(1)
            ->buttons(
                Button::make([
                    'text'           => 'Reload',
                    'className'      => 'Reload',
                    'orientation'    => 'landscape',
                    'action'         =>  'function ( e, dt, node, config ) {
                       window.LaravelDataTables["csvdatatable1-table"].ajax.reload( null, false );
                }'
                ])
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->name('du.id')->title('Id'),
            Column::make('from')->name('l.from')->title('Language From'),
            Column::make('to')->name('l.to')->title('Language To'),
            Column::make('status')->name('du.status')->title('status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Csv_' . date('YmdHis');
    }
}
