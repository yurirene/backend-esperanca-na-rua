<?php

namespace App\DataTables;

use App\Helpers\LabelHelper;
use App\Models\MoradorRua;
use Yajra\DataTables\Html\Button;
use App\Models\Parceiro;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ParceirosDataTable extends DataTable
{
    private $is_configuracao;
    public function __construct($configuracao = false)
    {
        $this->is_configuracao = $configuracao;
    }
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
                return view('parceiros.action', [
                    'editar' => $this->is_configuracao,
                    'inativar' => $this->is_configuracao,
                    'id' => $sql->id,
                    'status' => $sql->ativo
                ])->render();
            })
            ->editColumn('telefone', function ($sql) {
                return $sql->telefone_principal
                . ($sql->telefone_secundario ? ' / ' . $sql->telefone_secundario : '');
            })
            ->editColumn('ativo', function ($sql) {
                return LabelHelper::LABEL_STATUS[$sql->ativo];
            })
            ->editColumn('disponivel', function ($sql) {
                return LabelHelper::LABEL_DISPONIBILIDADE[$sql->disponivel];
            })
            ->editColumn('created_at', function ($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            })
            ->rawColumns(['ativo',  'disponivel', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MoradorRua $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parceiro $model)
    {
        return $model->newQuery()->when(!$this->is_configuracao, function ($sql) {
            return $sql->where('ativo', true)
                ->where('disponivel', true);
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $botoes = [
            0 => [],
            1 => [
                'action' => 'excel',
                'text' => '<em class="fas fa-file-excel"></em> Exportar para Excel'
            ]
        ];
        if ($this->is_configuracao) {
            $botoes[0] = [
                'action' => 'function() {window.location.href ="' . route('parceiros.create') . '"}',
                'text' => '<em class="fas fa-plus"></em> Cadastrar Parceiro'
            ];
        }
        return $this->builder()
                    ->setTableId('parceiros-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(5)
                    ->parameters([
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
                        'buttons' => $botoes
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $colunas = [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Ações'),
            Column::make('nome')->title('Nome'),
            Column::make('cpf_cnpj')->title('CPF / CNPJ'),
            Column::make('endereco')->title('Endereço'),
            Column::make('telefone')->title('Telefone'),
            Column::make('quantidade_vagas')->title('Qtd Vagas'),
        ];
        if ($this->is_configuracao) {
            $colunas[] = Column::make('disponivel')->title('Disponível');
            $colunas[] = Column::make('ativo')->title('Status');
            $colunas[] = Column::make('created_at')->title('Criado em');
        }
        return $colunas;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Parceiros_' . date('YmdHis');
    }
}
