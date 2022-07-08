<?php
 
namespace App;
use Lib\Session as Session;
Session::sessionIsValid();
class Cliente
{
    protected $clientes = [
        ['id' => 1, 'nome' => 'Antônio Silva', 'telefone' => '119990000'],
        ['id' => 2, 'nome' => 'João Silva', 'telefone' => '158999999'],
        ['id' => 3, 'nome' => 'Maria Silva', 'telefone' => '119999001'],
        ['id' => 4, 'nome' => 'Marta Santos', 'telefone' => '189990001'],
        ['id' => 5, 'nome' => 'Paulo Moura', 'telefone' => '1799990002'],
    ];
 
    public function index()
    {
         
        $data = array_map(function($row){
             
            return '<tr><td>' . $row['nome'] . '</td><td>' . $row['telefone'] . '</td><td><a href="' . route('clientes.show', $row['id']) . '">Detalhes</a></td></tr>';
 
        }, $this->clientes);
 
        echo "<h1>Listagem</h1><br /><hr>";
        $table = '<table width="100%"><thead><tr><td>Nome</td><td>Telefone</td><td>Ações</etd></tr></thead>';
        $table .= '<tbody>'. implode('', $data) .'</tbody></table><br><a href="/">home</a>';
        echo $table;

        //var_dump($data);
 
    }
 
    public function show($id) 
    {
        foreach($this->clientes as $row)
        {
            if($row['id'] == $id)
            {
                $cliente = $row;
            }
        }
 
        echo "<h1>Detalhes:</h1><br /><hr>";
        $data = 'nome: ' . $cliente['nome'] . '<br>telefone: ' . $cliente['telefone'];
        $data .= '<br /><a href="' . route('clientes.index') . '">Clique aqui para voltar para lista</a>';
        echo $data;
 
    }
  
}