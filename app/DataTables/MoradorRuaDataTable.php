<?php

namespace App\DataTables;

use App\Models\MoradorRua;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MoradorRuaDataTable extends DataTable
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
            ->addColumn('action', function ($sql) {
                return view('morador-rua.action', [
                    'deletar' => auth()->user()->can('menu', 'morador-rua.delete'),
                    'visualizar' => true,
                    'id' => $sql->id
                ])->render();
            })
            ->editColumn('genero', function ($sql) {
                return $sql->genero == 'M' ? 'Masculino' : 'Feminino';
            })
            ->editColumn('created_at', function ($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MoradorRua $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MoradorRua $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('morador-rua-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(5)
                    ->parameters([
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
                        'buttons' => [
                            [
                                'action' => 'excel',
                                'text' => '<em class="fas fa-file-excel"></em> Exportar para Excel'
                            ]
                        ]
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Ações'),
            Column::make('nome')->title('Nome'),
            Column::make('genero')->title('Gênero'),
            Column::make('faixa_etaria')->title('Faixa Etária'),
            Column::make('tempo_rua')->title('Tempo de Rua'),
            Column::make('passagem_policia')->title('Passagem pela Policia'),
            Column::make('created_at')->title('Criado em'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Moradores_rua_' . date('YmdHis');
    }
}
