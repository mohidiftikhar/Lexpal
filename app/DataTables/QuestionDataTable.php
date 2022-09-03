<?php

namespace App\DataTables;

use App\Models\Question;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuestionDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            /*->addColumn('question', 'question.question')
            ->addColumn('answer', 'question.answer')*/
            ->addColumn('actions', 'question.actions')
            ->rawColumns(['actions'])
            ->addIndexColumn();
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('QuestionDataTable-table')
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
     * @param \App\Models\Question $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Question $model)
    {
        return $model->newQuery();
    }
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->name('id')->title('Id')->searchable( false),
            Column::make('question')->title('Question'),
            Column::make('answer')->title('Answer'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'QuestionTable' . date('YmdHis');
    }
}
