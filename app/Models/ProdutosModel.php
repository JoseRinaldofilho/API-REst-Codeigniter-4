<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    /**
     * espenho do banco de dados tabela produtos
     *
     * @var string
     */
    protected $table      = 'produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'valor']; //campo obrigatorio
    protected $validationRules = [
        'nome' => 'require|min_length[3]|is_unique[produtos.nome]' // min_length(quantidad letras) is_unique que sejaunico
         
    ]; // regras de validação
}
