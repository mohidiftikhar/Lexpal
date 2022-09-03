<?php

namespace App\DataTables;

use App\Models\Language;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LanguagesDataTable extends DataTable
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
            ->addColumn('from_file', 'languages.from_file')
            ->addColumn('to_file', 'languages.to_file')
            ->addColumn('actions', 'languages.actions')
            ->addColumn('lang', 'languages.lang')
            ->addColumn('from', 'languages.from')
            ->addColumn('to', 'languages.to')
            ->rawColumns(['actions','version','from_file','to_file','lang']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Language $model)
    {
        return $model->from('languages as l')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('csvdatatable-table')
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
                       window.LaravelDataTables["csvdatatable-table"].ajax.reload( null, false );
                }'
                ])
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->name('l.id')->title('Id'),
            Column::computed('from')->title('Language From'),
            Column::computed('from_file')
                ->exportable(false)
                ->printable(false)->title('Language From Flag')
                ->addClass('text-center'),
            Column::computed('to')->title('Language To'),
            Column::computed('to_file')
                ->exportable(false)
                ->title('Language To Flag')
                ->printable(false)
                ->addClass('text-center'),
            Column::computed('lang')
                ->exportable(false)
                ->title('Key')
                ->printable(false)
                ->addClass('text-center'),

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
        return 'Languages_' . date('YmdHis');
    }
}
