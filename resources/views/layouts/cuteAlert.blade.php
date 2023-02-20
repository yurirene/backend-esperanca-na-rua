
@if (session()->has('nao_autorizado'))
    <script>
        cuteAlert({
            type: "error",
            title: "Acesso Não Autorizado!",
            message: "Se você insistir seu IP será bloqueado",
            buttonText: "Entendi!",
            img: 'img/error.svg'
        })
    </script>
@endif
