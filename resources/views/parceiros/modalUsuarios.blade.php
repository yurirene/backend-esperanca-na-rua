<div class="modal fade" id="usuarioModal"
    tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usuarioModalLabel">Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="datatable-usuarios-parceiros" class="table w-100">
                                <thead>
                                    <tr>
                                        <th>Ação</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Perfil</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUsuarioModal"
    tabindex="-1" role="dialog" aria-labelledby="addUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUsuarioModalLabel">Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'parceiros.add-usuarios']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        {!! Form::label('usuarios', 'Usuários') !!}
                        {!! Form::select('usuarios[]', [], null, [
                            'id' => 'usuarios[]',
                            'class' => 'form-control usuarios-select',
                            'required' => 'required',
                            'multiple',
                            'style' => 'width: 100%'
                        ]) !!}
                        <input type="hidden" name="parceiro_id" id="parceiro_id" value="0" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success" >Adicionar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('js')
<script>

    $(document).ready(function() {

        $('#parceiro_id').on('change', function() {
            $('.usuarios-select').trigger('change');
        });
    })

    $('#usuarioModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var route = "{{ route('parceiros.usuarios.datatables', ':id') }}".replace(":id", id);
        $('#parceiro_id').val(id).trigger('change');
        carregarDataTableUsuarios(route);
    });

    $('.usuarios-select').select2({
        ajax: {
            url: function() {
                return getUrlSelect2()
            },
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
        }
    });

    function getUrlSelect2()
    {
        return '{{ route("parceiros.get-usuarios", ":id") }}'.replace(':id', $('#parceiro_id').val())
    }

    function carregarDataTableUsuarios(route) {

        $('#datatable-usuarios-parceiros').DataTable().destroy();
        $('#datatable-usuarios-parceiros').DataTable({
            dom: 'frtip',
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    text: '<i class="fas fa-plus"></i> Adicionar Usuário',
                    action: function () {
                        $('#addUsuarioModal').modal().show();
                    }
                }
            ],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: route,
            columns: [
                {
                    render: function (data, type, result) {
                        return `<button
                            type="button"
                            class="btn btn-sm btn-danger delete-usuario"
                            data-id="${result.id}">
                                <i class="fas fa-trash"></i>
                            </button>`;
                    }
                },
                {data: 'nome'},
                {data: 'email'},
                {data: 'perfil'}
            ]
        });
        $('#datatable-usuarios-parceiros').on( 'draw.dt', function () {
            $('.delete-usuario').on('click', function() {
                let id = $(this).data('id');
                var route = "{{ route('parceiros.remover-usuario') }}";
                var data = {
                    _token: "{{ csrf_token() }}",
                    parceiro_id: $('#parceiro_id').val(),
                    user_id: id
                };
                confirmacao(route, data, 'POST');
            });
        });
        EVENTO_SWEET_ALERT.dispatcher.on('sweetAlertFinalizado',function(){
            $('#datatable-usuarios-parceiros').DataTable().ajax.reload();
        });
    }


</script>
@endpush
