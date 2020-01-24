<?php

namespace App\Http\Controllers\Painel;


use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\ProductFormRequest;
use App\Model\Produto;
class ProdutoController extends Controller {

    private $product;
    private $totalPage = 3;

    public function __construct(Produto $product) {

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = 'Site do Anderson';
        $products = $this->product->paginate($this->totalPage);
        return view('painel.produtos.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = 'Cadastro de Produtos';
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        return view('painel.produtos.create-edit', compact('title', 'categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request) {
        //dd($request->all());
        //dd($request->only('name','number'));
        //dd($request->except(['_token']));
        //dd($request->input('name'));
        //pega todos os dados do formulario
        $dataform = $request->all();

        $dataform['active'] = (!isset($dataform['active'])) ? 0 : 1;


        /* $message = 
          [
          'name.required'=> 'O campo nome é de preenchimento obrigatório',
          'number.numeric'=> 'Precisa ser apenas números!',
          'number.required'=> 'O campo número é de preenchimento obrigatório!',
          ];
          //valida dados

          //$this->validate($request, $this->product->getRules());
          $validate = validator($dataform,$this->product->getRules(),$message);

          if($validate->fails())
          {
          return redirect()
          ->route('produtos.create')
          ->withErrors($validate)
          ->withInput();
          }
         */
        //Faz cadastro
        
        $insert = $this->product->create([
                'name' => $dataform['name'],
                'number' => $dataform['number'],
                'active' => $dataform['active'], 
                'category' => $dataform['category'],
                'description' => $dataform['description']
              ]);

        if ($insert) {
            return redirect("/painel");
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $produto = $this->product->find($id);
        $title = "Produto: {$produto->name}";
        return view('painel.produtos.show', compact('produto','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //recupera o produto pelo seu id
        $produto = $this->product->find($id);

        $title = 'Editando dados do produto: {$produto->name}';
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.produtos.create-edit', compact('title', 'categorys','produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProduto(ProductFormRequest $request, $id) {
        //Recupe todos os dados do formulário
        $dataform = $request->all();
        //dd($dataform);
        //verifica se o produto está ativado
        $dataform['active'] = (!isset($dataform['active'])) ? 0 : 1;
       
        //recupe o item para editar
        $produto = $this->product->find($id);
        //altera os itens
         //dd($produto);
        $update = $produto->update([
          'name' => $dataform['name'],
          'number' => $dataform['number'],
          'active' => $dataform['active'], 
          'category' => $dataform['category'],
          'description' => $dataform['description'],      
          ]);
        //verifica se os dados foram alterados
        
        if($update)
        {
            return redirect("/painel");
        }
        else
        {
            return redirect("/painel/$id/edit")->with(['errors'=>'Falha ao editar']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $produto = $this->product->find($id);
        $delete = $produto->delete();
        
        if($delete)
        {
            return redirect()->route('produtos.index');
        }
        else
        {
            return redirect()->route('produtos.show',$id)->with(['errors'=>'Falha ao deletar']);
        }
    }

    public function testes() {
        /*
          $prod = $this->product;
          $prod->name = 'Nome do Produto';
          $prod->number = 1212312;
          $prod->active = 1;
          $prod->category = 'eletronicos';
          $prod->description = 'Description do produto aqui';
          $insert = $prod->save();

          if($insert)
          {
          return 'Inserindo com sucesso';
          }
          else
          {
          return 'Falha ao inserir';
          }
         * 
         */
        /*
          $insert = $this->product->create([
          'name' => 'Nome do Produto',
          'number' => 4454354,
          'active'=> false,
          'category'=> 'eletronicos',
          'description'=> 'Descricao',

          ]);
          if($insert){
          return "Inserido com sucesso, ID:{ $insert->id }";
          }else
          {
          return 'Falha ao inserir';
          } */
        /*
          $prod = $this->product->find(4);
          //dd($prod -> name);
          $prod->name = 'Update2';
          $prod->number = 10;
          $update = $prod->save();
          if($update)
          {
          return 'Alterado com sucesso';
          }
          else
          {
          return 'Não foi alterado';
          } */
        /*
          $prod = $this->product->find(5);
          $update = $prod->update([
          'name' => 'Atualizado',
          'number' => 1087,
          ]);

          if($update)
          {
          return 'Alterado com sucesso';
          }
          else
          {
          return 'Falha ao alterar';
          } */
        /* $prod = $this->product->where('number',10)
          ->update([
          'name' => 'Atualizado Original',
          'number' => 10879,
          ]);

          if($prod)
          {
          return 'Alterado com sucesso';
          }
          else
          {
          return 'Falha ao alterar';
          }
         */
        $prod = $this->product
                ->where('number', 1087)
                ->delete();

        if ($prod) {
            return 'Deletado com sucesso2';
        } else {
            return 'Falha ao deletar';
        }
    }

}
