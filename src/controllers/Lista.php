<?php
namespace App;
use Dao\Cadastro as Cadastro;
use Lib\Carregador as Carregador;
use Lib\Session as Session;
Session::sessionIsValid();
class Lista
{
  
  private $registros;
  public function index()
  {
      $this->registros = Cadastro::get();
      $data = array_map(function($row){
        //var_dump($row);
        return '<tr><td>' . $row->nome . '</td><td>' . $row->nascimento . '</td><td><a href="' . route('lista.show', $row->id ) . '">Detalhes</a></td></tr>';

      }, $this->registros);
      
      $table = '<table width="100%"><thead><tr><td>Nome</td><td>nascimento</td><td>Ações</etd></tr></thead>';
      $table .= '<tbody>'. implode('', $data) .'</tbody></table>';
      $table .= '<br />' ; // . var_dump($_SESSION);
      Carregador::loadTemplateView('home', [ 'resultado' => $table ]);
    }
    
  public function teste(){
      $data = 'phpinfo()';


      Carregador::loadTemplateView('home', [ 'resultado' => '$data' ]);
  }
  public function icones(){
      $data = 'phpinfo()';


      Carregador::loadTemplateView('icones', [ 'resultado' => '$data' ]);
  }

  public function show($id) 
  {
    $registro = Cadastro::getOne(['id'=>$id]);
    $data = 'nome: ' . $registro->nome . '<br>nascimento: ' . $registro->nascimento;
    $data .= '<br /><a href="' . route('lista.index') . '">Clique aqui para voltar para lista</a>';
    Carregador::loadTemplateView('home', [ 'resultado' => $data ]);
  }

}