<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Produtos extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Produtos_model', 'produto');
    }


	public function index_get()
	{
        $params = [
            'id_product' => $this->get('id_product', false),
            'id_seller' => $this->get('id_seller', false)
        ];
        //echo '<pre>'; print_r($params);

        //$result = $this->produto->single_product($params);
        $result = $this->produto->all_product($params);

        if (empty($result['result']))
        {
            $this->response([ 'status' => false, 'message' => 'Not found' ], REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            $this->response([ 'status' => true, 'message' => 'Success', 'data' => $result ], REST_Controller::HTTP_OK);
        }
    }
    
    
	public function index_post()
	{
        $params = [
            //'id_product' => $this->post('id_product', false),
            //'id_seller' => $this->post('id_seller', false),
            'nome' => $this->post('nome', false),
            'email' => $this->post('email', false),
        ];
        echo '<pre>'; print_r($params);

        $result = $this->produto->new_product($params);
    }

    
	public function index_put()
	{
        $params = [
            'id_product' => $this->put('id_product', false),
            'id_seller' => $this->put('id_seller', false)
        ];
        echo '<pre>'; print_r($params);
	}
    

	public function index_delete()
	{
        $params = [
            'id_product' => $this->delete('id_product', false),
            'id_seller' => $this->delete('id_seller', false)
        ];
        echo '<pre>'; print_r($params);
	}
}
