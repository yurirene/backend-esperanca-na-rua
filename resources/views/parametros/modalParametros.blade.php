<div class="modal fade" id="parametroModal"
    tabindex="-1" role="dialog" aria-labelledby="parametroModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="parametroModal">Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'configuracoes.parametros.update']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label>Valor</label>
                    <input class="form-control" type="text" name="valor" id="valor_modal" />
                </div>
                <input type="hidden" name="valor_id" id="id_valor_modal"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="addParametroModal"
    tabindex="-1" role="dialog" aria-labelledby="addParametroModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addParametroModal">Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'configuracoes.parametros.store']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        {!! Form::label('valor', 'Usuários') !!}
                        {!! Form::text('valor',null, [
                            'id' => 'valor',
                            'class' => 'form-control',
                            'required' => 'required',
                        ]) !!}
                        <input type="hidden" name="parametro_id" id="id_parametro_modal" value="0" />
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

    $('#parametroModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var valor = button.data('valor')
        $('#valor_modal').val(valor);
        $('#id_valor_modal').val(id);
    });

    $('#addParametroModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        $('#id_parametro_modal').val(id);
    });

    EVENTO_SWEET_ALERT.dispatcher.on('sweetAlertFinalizado',function(){
        location.reload();
    });
</script>
@endpush
