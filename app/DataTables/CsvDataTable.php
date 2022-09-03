<?php

namespace App\DataTables;

use App\Models\DictionaryUpload;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CsvDataTable extends DataTable
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
            ->addColumn('version', 'csv.versions')
            ->addColumn('csv_download', 'csv.csv_download')
            ->rawColumns(['actions','csv_download','version']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DictionaryUpload $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DictionaryUpload $model)
    {
         $newModel = $model->from('dictionary_uploads as du')
            ->join('languages as l','l.id','=','du.language_id')
            ->select('du.*','l.from','l.to');
         if (!empty($this->languageId)){
             $newModel  =   $newModel->where('du.language_id',$this->languageId);
         }
        $newModel  =   $newModel->newQuery();
         return  $newModel;
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
    protected function getColumns(): array
    {
        return [
            Column::make('id')->name('du.id')->title('Id'),
            Column::make('language_id')->name('du.language_id')->title('Language Id'),
            Column::make('from')->name('l.from')->title('Language From'),
            Column::make('to')->name('l.to')->title('Language To'),
            Column::make('status')->name('du.status')->title('status'),
            Column::make('created_at')->name('du.created_at')->title('Uploaded At'),
            Column::computed('csv_download')->name('csv_download')->title('CSV Download'),
            Column::make('version')->name('version')->title('Version'),
          /*  Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),*/
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
