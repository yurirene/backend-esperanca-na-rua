{{-- Message --}}
@if (session()->has('sucesso'))
    <script>
        toastr.success('{{session()->get("sucesso")}}', 'Sucesso!')
    </script>
@endif
@if(session()->has('erro'))
    <script>
        toastr.error('{{session()->get("erro")}}', 'Erro!')
    </script>
@endif
