<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->db_venda = $this->load->database('db_venda', true);
    }

    public function all_product(array $params = [])
    {
        $this->db_venda->select('id, nome, email');

        if (isset($params['id_perfil']) and !empty($params['id_perfil']))
        {
            $this->db_venda->where('id_perfil', $params['id_perfil']);
        }

        $query = $this->db_venda->get('t_vendedor');

        $retorno = [
            'num_rows' => $query->num_rows(),
            'result' => $query->result_array()
        ];

        return $retorno;
    }

    public function single_product(array $params = [])
    {
        $this->db_venda->select('nome, email');

        if (isset($params['id_perfil']) and !empty($params['id_perfil']))
        {
            $this->db_venda->where('id_perfil', $params['id_perfil']);
        }

        $query = $this->db_venda->get('t_vendedor');

        $retorno = [
            'num_rows' => $query->num_rows(),
            'result' => $query->row_array()
        ];

        return $retorno;
    }


    /**
     * 
     */
    public function new_product(array $params = [])
    {
        $sql = "INSERT INTO t_vendedor
                    ( nome, email )
                VALUES
                    ( '{$params['nome']}', '{$params['email']}' );";

        $this->db_venda->query($sql); //$sql = lastQuery($this->db_venda->last_query());

        // outro jeito de inserir
        $this->db_venda->insert('t_vendedor', $params);
    }


    /**
     * 
     */
    public function del_product(array $params = [])
    {
        // outro jeito de inserir
        $this->db_venda->where('email', $params['email']);
        $this->db_venda->delete('t_vendedor', $params);

        $sql = lastQuery($this->db_venda->last_query());
    }
}