<?php
namespace Dao;

class Cadastro extends Model{

  protected static $tableName = '`cadastro`';
  protected static $columns = ['id', 'nome', 'nascimento', 'email', 'site', 'filhos', 'salario'];

}