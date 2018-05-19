<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/

	public function index($indice=null)
	{
		$this->db->select('*');
		$dados['usuarios'] = $this->db->get('usuario')->result();

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		switch ($indice) {
			case '1':
			$data['msg'] = 	"Usuário cadastrado com sucesso.";
			$this->load->view('includes/msg_sucesso', $data);
			break;
			case '2':
			$data['msg'] = 	"Não foi possível cadastrar o usuário";
			$this->load->view('includes/msg_erro', $data);
			break;
			case '3':
			$data['msg'] = 	"Usuário excluído com sucesso.";
			$this->load->view('includes/msg_sucesso', $data);
			break;
			case '4':
			$data['msg'] = 	"Não foi possível exclui o usuário";
			$this->load->view('includes/msg_erro', $data);
			break;
			case '5':
			$data['msg'] = 	"Usuário atualizado com sucesso.";
			$this->load->view('includes/msg_sucesso', $data);
			break;
			case '6':
			$data['msg'] = 	"Não foi possível atualizar o usuário";
			$this->load->view('includes/msg_erro', $data);
			break;
		}

		$this->load->view('listar_usuario', $dados);
		$this->load->view('includes/html_footer');
	}

	public function cadastro()
	{
		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('cadastro_usuario');
		$this->load->view('includes/html_footer');
	}

	public function cadastrar()
	{
		$data['nome'] = $this->input->post('name');
		$data['cpf'] = $this->input->post('cpf');
		$data['email'] = $this->input->post('email');
		$data['senha'] = md5($this->input->post('password'));
		$data['status'] = $this->input->post('status');
		$data['nivel'] = $this->input->post('nivel');
		$data['endereco'] = $this->input->post('endereco');

		if ($this->db->insert('usuario', $data)) {
			redirect('usuario/1');
		} else {
			redirect('usuario/2');
		}
	}

	public function atualizar($id=null)
	{
		$this->db->where('idUsuario', $id);
		$data['usuario'] = $this->db->get('usuario')->result();

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('editar_usuario', $data);
		$this->load->view('includes/html_footer');
	}

	public function salvar_atualizacao()
	{
		$id = $this->input->post('idUsuario');
		$data['nome'] = $this->input->post('name');
		$data['cpf'] = $this->input->post('cpf');
		$data['email'] = $this->input->post('email');
		$data['status'] = $this->input->post('status');
		$data['nivel'] = $this->input->post('nivel');
		$data['endereco'] = $this->input->post('endereco');

		$this->db->where('idUsuario', $id);

		if ($this->db->update('usuario', $data)) {
			redirect('usuario/5');
		} else {
			redirect('usuario/6');
		}
	}

	public function excluir($id=null)
	{
		$this->db->where('idUsuario', $id);

		if ($this->db->delete('usuario')) {
			redirect('usuario/3');
		} else {
			redirect('usuario/4');
		}
	}
}
