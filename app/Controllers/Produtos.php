<?php 
namespace App\Controllers;
// normal
// use CodeIgniter\Controller;
// parA API USA REstful\ResoucerController
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProdutosModel;
class Produtos extends ResourceController{
    private $produtosModel;   
 
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


}