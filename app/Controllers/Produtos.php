<?php 
namespace App\Controllers;
// normal
// use CodeIgniter\Controller;
// parA API USA REstful\ResoucerController
use CodeIgniter\RESTful\ResourceController;
//use App\Models\ProdutosModel;
use Exception;

class Produtos extends ResourceController{
    private $produtosModel;   
    private $token = '123456789abc';
 
    /*** Class constructor. */
    public function __construct()
    {
        $this->produtosModel = new \App\Models\ProdutosModel();
    }

    // ** serviço para lista todos os produtos (GET)
    public function list()
    {
        $data = $this->produtosModel->findAll();
        // retorna resposta->setaJeson vai retorna a resposta no formato Json
        return $this->response->setJSON($data);
        
    }
    //validador de tokem
    private function _validaToken()
    {
        // se na queisocao pegar o cabeçario toke for igual a variavel token retorna verdadeiro
        return $this->request->getHeaderLine('token') == $this->token;
    }
     
    // serviço  para inserir um novo produto(POST)
    public function create()
    {
        // resposta
        $response = [];

        // validar  o token
        if ($this->_validaToken() == true) {
            // pegar os dados (que veio da body da requisiçao) para salvar
            $newProduto['nome'] = $this->request->getPost('nome');
            $newProduto['valor'] = $this->request->getPost('valor');

            try {
                //como salva vai busca la em cima na variavel
                if($this->produtosModel->insert($newProduto)){
                    // se aconteu deu certo 
                    $response = [
                        'response' => 'success',
                        'msg' => 'Produto adcionado com sucesso'
                    ];
                }else{
                    $response = [
                        'response' => 'Error',
                        'msg' => 'Error ao salvar o produto',
                        'errors' => $this->produtosModel->errors() // retorna um arrry com os erros 
                    ];
                }
                
            } catch (Exception $e) {
               $response = [
                'response' => 'Error',
                'msg' => 'Error ao salvar o produto',
                'errors' => [
                    'exception' => $e->getMessage()
                    ]
               ];
            }
            
        }
        else {
            $response = [
                'response' => 'Error',
                'msg' => 'Token Invalido'
            ];
        }

        return $this->response->setJSON($response);

    }


}