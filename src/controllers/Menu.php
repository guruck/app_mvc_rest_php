<?php
namespace App;
use Dao\Menu as MenuDao;
use Lib\Carregador as Carregador;
use Lib\Utils as Utils;
use Lib\Session as Session;
Session::sessionIsValid(true);
class Menu
{
  private $exception;

  public function index()
  {
    $this->exception = null;
    $menusAdmin = MenuDao::get();
    Carregador::loadTemplateView('menus', ['menusAdmin' => $menusAdmin,'exception' => $this->exception]);
  }

  public function delete($id)
  {
    $this->exception = null;
    try {
      MenuDao::deleteById($id);
      Utils::addSuccessMsg('Menu desativado com sucesso.');
    } catch(\Exception $e) {
      if(stripos($e->getMessage(), 'FOREIGN KEY')) {
        Utils::addErrorMsg('Não é possível excluir o menu.');
      } else {
        $this->exception = $e;
      }
    }
    header('location: /batata');
  }

  public function edit($id)
  {
    $this->exception = null;
    $registro = MenuDao::getOne(['id' =>$id]);
    $menuData = $registro->getValues();
    $data = 'nome: ' . $registro->name . '<br>nascimento: ' . $registro->pagina;
    $data .= '<br /><a href="' . route('batata.index') . '">Clique aqui para voltar para lista</a>';
    // Carregador::loadView('save_menu', $menuData + [ 'resultado' => $menuData ]);
    Carregador::loadTemplateView('save_menu', $menuData + [ 'resultado' => $data ]);
  }

  public function novo()
  {
    $this->exception = null;
    $menuData = [];
    Carregador::loadTemplateView('save_menu', $menuData + [ 'resultado' => $menuData ]);
  }

  public function update($id)
  {
    try {
      $dbMenu = new MenuDao($_POST);
      $dbMenu->update();
      Utils::addSuccessMsg('Menu alterado com sucesso!');
      header('location: /batata');
      exit();
    } catch(\Exception $e) {
      $exception = $e;
    } finally {
      $menuData = $_POST;
    }
    Carregador::loadView('save_menu', $menuData + ['exception' => $exception]);
  }

  public function save()
  {
    try {
      $dbMenu = new MenuDao($_POST);
      $dbMenu->insert();
      Utils::addSuccessMsg('Menu cadastrado com sucesso!');
      header('location: /batata');
      exit();
    } catch(\Exception $e) {
      $exception = $e;
    } finally {
      $menuData = $_POST;
    }
    Carregador::loadView('save_menu', $menuData + ['exception' => $exception]);
  }
}