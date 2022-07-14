<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-4">
    <form method="POST" action="{{ route('cutter.store') }}">
        <div class="form-group">
            <label for="NewLink">Link</label>
            <input type="text" class="form-control" id="NewLink" placeholder="link" name="link">
            <small id="link" class="form-text text-muted">Raw link</small>
        </div>
        <div class="form-group">
            <label for="LimitCount">Limit count</label>
            <input type="number" class="form-control" id="LimitCount" placeholder="0....9" name="limit">
        </div>
        <div class="form-group">
            <label for="LifeDateTime">Lifetime</label>
            <input type="datetime-local" class="form-control" id="LifeDateTime" name="life_time">
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable margin5">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Errors:</strong> Please check below for errors
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="jumbotron">
            <div class="row"><h4>Link lists</h4></div>
            @foreach($links as $link)
                <div class="row">
                    <div class="form-group">
                        <label for="NewLink">[{{$link->life_time}}] [{{$link->limit??"x"}}] {{ $link->link }}</label><br>
                        <a href="{{ url()->to($link->hash) }}" target="_blank">
                            <small id="link" class="form-text text-muted">{{ url()->to($link->hash) }}</small>
                        </a>
                    </div>
                </div>
            @endforeach
    </div>
    </div>

</div>

<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Button trigger modal -->
</body>


</html>