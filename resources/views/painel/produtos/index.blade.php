@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">
    Listagem dos Produtos
</h1>

<a href="{{url('/painel/create')}}" class="btn btn-primary">Cadastrar</a>
<table class="table table-striped">
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th width='100px'>Ações</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>
            <a href="{{url("/painel/$product->id/edit")}}" class="actions actions-over edit"> 
                <i class="fas fa-edit"></i>
            </a>
            <a href="" > 
                
            </a>
            <a href="{{route('produtos.show',$product->id)}}" class="actions actions-over delete"> 
                <i class="fas fa-low-vision"></i>
            </a>
        </td>
    </tr>
    @endforeach
</table>
{!! $products->links() !!}

@endsection