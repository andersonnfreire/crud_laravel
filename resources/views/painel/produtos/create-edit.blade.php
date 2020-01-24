@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">
    Gestão de Produto
</h1>
@if(isset($errors) && count($errors) > 0)

<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>

@endif


@if(isset($produto))
<form class="form" method="post" action="{{ url("/painel/$produto->id/update/")}}">
    {!! method_field('PUT') !!}
@else
    <form class="form" method="post" action="{{url("/painel/create/store")}}">
@endif
    {!! csrf_field() !!}
    <div class="form-group">

        <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{$produto->name or old('name')}}">
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="active" value="1" @if(isset($produto) && $produto->active =='1')checked @endif> Ativo?
        </label>
    </div>
    <div class="form-group">
        <input type="text" name="number" placeholder="Número:" class="form-control"value="{{$produto->number or old('number')}}">
    </div>
    <div class="form-group">
        <select name="category" class="form-control">
            <option value="">Escolha a categoria </option>
            @foreach($categorys as $category)
            <option value="{{$category}}"                    
                    @if(isset($produto) && $produto->category == $category)
                        selected
                    @endif
                    >{{$category}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <textarea name="description" placeholder="Descrição" class="form-control">{{$produto->description or old('description')}}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>


@endsection