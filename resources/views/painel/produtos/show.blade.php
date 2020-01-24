@extends('painel.templates.template')

@section('content')

<h1 class="title-pg">

    Produto: <b>{{$produto->name}}</b>
</h1>
@if(isset($errors) && count($errors) > 0)

    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
@endif
<form class="form" method="post" action="{{route('produtos.destroy', $produto->id)}}">
    {!! method_field('DELETE') !!}
    {!! csrf_field() !!}
    <p><b>Ativo:</b>{{$produto->active}}</p>
    <p><b>Number:</b>{{$produto->number}}</p>
    <p><b>Categoria:</b>{{$produto->category}}</p>
    <p><b>Descriçao:</b>{{$produto->description}}</p>

    <hr>
    
    <div class="form-group">
        <button type="submit" class="btn btn-danger">Deletar Produto : {{$produto->name}}</button>
    </div>
</form>

@endsection