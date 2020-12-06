    
    @if (Session::has('sucesso'))
        <div class="alert alert-success margin-top-100" role="alert">
           {{ Session::get('sucesso') }}
        </div>
    @endif

    @if (Session::has('aviso') && (!Session::has('sucesso') and !Session::has('erro')))
        <div class="alert alert-warning margin-top-100" role="alert">
           {{ Session::get('aviso') }}
        </div>
    @endif

    @if (Session::has('erro'))
        <div class="alert alert-danger margin-top-100" role="alert">
           {{ Session::get('erro') }}
        </div>
    @endif