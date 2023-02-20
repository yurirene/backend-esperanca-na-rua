<?php

namespace App\DataTables;

use App\Helpers\LabelHelper;
use App\Models\User;
use App\Models\Users;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                return view('usuarios.action', [
                    'editar' => $this->is_configuracao,
                    'inativar' => $this->is_configuracao,
                    'id' => $sql->id,
                    'status' => $sql->ativo
                ])->render();
            })
            ->editColumn('ativo', function ($sql) {
                return LabelHelper::LABEL_STATUS[$sql->ativo];
            })
            ->editColumn('perfil_id', function ($sql) {
                $texto = $sql->perfil ? $sql->perfil->nome : 'Não Informado';
                return LabelHelper::badge(
                    $texto,
                    $sql->perfil ? 'info' : 'danger',
                    true
                );
            })
            ->editColumn('created_at', function ($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            })
            ->rawColumns(['ativo', 'action', 'perfil_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()
            ->where('is_super', false)
            ->when(!$this->is_configuracao, function ($sql) {
                return $sql;
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        if ($this->is_configuracao) {
            $botoes[0] = [
                'action' => 'function() {window.location.href ="' . route('usuarios.create') . '"}',
                'text' => '<em class="fas fa-plus"></em> Cadastrar Usuário'
            ];
        }
        return $this->builder()
            ->setTableId('usersdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Ações'),
            Column::make('name')->title('Nome'),
            Column::make('email')->title('E-mail'),
            Column::make('ativo')->title('Status'),
            Column::make('perfil_id')->title('Perfil'),
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
        return 'Users_' . date('YmdHis');
    }
}
