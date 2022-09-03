<?php

namespace App\DataTables;

use App\Models\CsvSpilt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CSVSplitDataTable extends DataTable
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
    public function query(CsvSpilt $model)
    {
        return $model->from('csv_parts as c')
            ->where('c.upload_id',$this->csv_id)
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
            ->minifiedAjax()
            ->postAjax([
                'type'=>'POST',
                'url'   =>  route('csv.allUploadCsv',$this->csv_id)
            ])
            ->dom('Bfrtip')
            ->pageLength(10)
            ->orderBy(1)
            ->buttons(
                Button::make([
                    'text'           => 'Reload',
                    'className'      => 'Reload d btn btn-success',
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
            Column::make('id')->name('c.id')->title('Id'),
            Column::make('upload_id')->name('c.upload_id')->title('Upload Id'),
            Column::make('page')->name('c.page')->title('Page'),
            Column::make('import_records')->name('c.import_records')->title('Import Records'),
            Column::make('total_records')->name('c.total_records')->title('Total Records'),
            Column::make('is_done')->name('c.is_done')->title('Is Completed'),
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
