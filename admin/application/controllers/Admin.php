<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->load->model('User_model');
		$this->load->model('DataMaster_model');
		$this->load->model('Menu_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get_where('dashboard', ['id'=>1])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function registration()
	{
		$this->form_validation->set_rules('name','Name', 'required|trim');
	    $this->form_validation->set_rules('email','Email', 'required|trim|valid_email|is_unique[user.email]',[
	    	'is_unique' => 'this email has already registered!'
	    ]);
	    $this->form_validation->set_rules('username','Username', 'required|trim|is_unique[user.username]',[
	    	'is_unique' => 'this Username has already registered!'
	    ]);
	    $this->form_validation->set_rules('password1','Password', 'required|trim|min_length[3]', [
	    	'matches' => 'password dont match!',
	    	'min_length' => 'password too short!'
	    ]);
	    $this->form_validation->set_rules('role_id','Role', 'required|trim');
	    $this->form_validation->set_rules('gender','Gander', 'required|trim');
	    $this->form_validation->set_rules('place_of_birth','Place of Birth', 'required|trim');
	    $this->form_validation->set_rules('birthday','Birth Day', 'required|trim');
	    $this->form_validation->set_rules('phone_number','Phone Number', 'required|trim');
	    $this->form_validation->set_rules('address','Address', 'required|trim');
	    $this->form_validation->set_rules('religion_id','Religion', 'required|trim');
	    // 
	    $this->form_validation->set_rules('password2','Confrim Password', 'required|trim|matches[password1]');
	    if ($this->form_validation->run() == false) {
	    	redirect('Admin/dataUser');
	    } else{
	    	$data =[
	    		'name' => htmlspecialchars($this->input->post('name', true)),
	    		'username' => htmlspecialchars($this->input->post('username', true)),
	    		'email' => htmlspecialchars($this->input->post('email', true)),
	    		'gender' => htmlspecialchars($this->input->post('gender', true)),
	    		'place_of_birth' => htmlspecialchars($this->input->post('place_of_birth', true)),
	    		'birthday' => htmlspecialchars($this->input->post('birthday', true)),
	    		'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
	    		'address' => htmlspecialchars($this->input->post('address', true)),
	    		'religion_id' => htmlspecialchars($this->input->post('religion_id', true)),
	    		'image' => 'default.svg',
	    		'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
	    		'role_id' => htmlspecialchars($this->input->post('role_id', true)),
	    		'is_active' => 0,
	    		'date_created' => time(),
	    	];
	    	$token = base64_encode(random_bytes(32));
	    	$user_token = [
	    		'email' => $this->input->post('email', true),
	    		'token' => $token,
	    		'date_created' => time()
	    	];
	    	$this->db->insert('user', $data);
	    	$this->db->insert('user_token', $user_token);
	    	// $this->_sendEmail($token, 'verify');
	    	$user = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->row_array();

	    	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
	    		Congratulation! The Account has been created!
	    		</div>');
	    	redirect('Admin/dataUser');
	    }
	}

	public function role()
	{
		$data['title'] = "Role Management";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else{
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Role Added!
				</div>');
			redirect('admin/role');
		}
	}

	public function dataUser()
	{
		$data['title'] = "Data User";
		$data['role'] = $this->db->get('user_role')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	    $data['agama'] = $this->db->get('agama')->result_array();
		$this->db->select('*, user_role.id AS rid, user.id AS uid');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$data['user_data'] = $this->db->get()->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data-user', $data);
		$this->load->view('templates/footer');
	}

	public function setRole()
	{
		$this->db->set('role_id', $this->input->post('role_id'));
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user');
		// $input = array('role_id' => $this->input->post('role_id'));
		// $id = $this->input->post('id');
		// $this->User_model->update()
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Set User Role Successfull!
			</div>');
		redirect('admin/dataUser');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = "Role Access";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else{
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Access Changed!
			</div>');
	}

	public function getUpdateRole(){
		echo json_encode($this->Admin_model->getRoleById($this->input->post('id')));
	}
	public function getUserData(){
		echo json_encode($this->Admin_model->getUserById($this->input->post('id')));
	}
	public function updateRole(){
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/role');
		} else{
			$data = array('role' => $this->input->post('role'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Role Updated!
				</div>');
			redirect('admin/role');
		}
	}

	public function deleteRole($id)
	{
		$this->db->where('role_id', $id);
		$this->db->delete('user');

		$this->db->where('role_id', $id);
		$this->db->delete('user_access_menu');
		
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role Deleted!
			</div>');
		redirect('admin/role');
	}

	public function strukturOrganisasi()
	{
		$data['title'] = "Struktur Organisasi";
		$data['struktur'] = $this->db->get('struktur')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/struktur-organisasi', $data);
			$this->load->view('templates/footer');
		} else{
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/struktur-organisasi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('struktur', [
						'nama' => $this->input->post('nama'),
						'jabatan' => $this->input->post('jabatan'),
						'parent_id' => $this->input->post('atasan'),
						'foto' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						New Organization Structure Added!
						</div>');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				}
				redirect('Admin/strukturOrganisasi');
			}
		}
	}

	public function updateStruktur()
	{
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Position', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		$struktur = $this->db->get_where('struktur', ['id' => $this->input->post('id')])->row_array();
		if ($this->form_validation->run() == false) {
			redirect('Admin/strukturOrganisasi');
		} else{
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['upload_path'] = './assets/img/struktur-organisasi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$old_image = $struktur['foto'];
					if ($old_image !='default.jpg') {
						unlink(FCPATH.'assets/img/struktur-organisasi/'.$old_image);
					} 
					$new_image = $this->upload->data('file_name');
					$this->db->set('foto', $new_image);
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					redirect('Admin/strukturOrganisasi');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('struktur', [
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'parent_id' => $this->input->post('atasan'),
				]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Structure Updated!
				</div>');
			redirect('Admin/strukturOrganisasi');
		}
	}

	public function deleteStruktur($id)
	{
		$this->db->delete('struktur', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Structure Deleted!
			</div>');
		redirect('Admin/strukturOrganisasi');
	}

	public function pengumuman()
	{
		$data['title'] = "Pengumuman";
		$data['pengumuman'] = $this->db->get('pengumuman')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/pengumuman', $data);
			$this->load->view('templates/footer');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/pengumuman';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('pengumuman', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						New Announcement Added!
						</div>');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				}
				redirect('Admin/pengumuman');
			}
		}
	}

	public function updatePengumuman()
	{
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$pengumuman = $this->db->get_where('pengumuman', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting pengumuman ini! karena Anda bukan penulisnya.
			</div>');
			redirect('Admin/pengumuman');
		} elseif ($this->form_validation->run() == false) {
			redirect('Admin/pengumuman');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/pengumuman';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $pengumuman['thumbnail'];
					if ($old_image !='default.jpg') {
						unlink(FCPATH.'assets/img/pengumuman/'.$old_image);
					} 
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					redirect('Admin/pengumuman');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pengumuman', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Announcement Updated!
				</div>');
			redirect('Admin/pengumuman');
		}
	}

	public function deletePengumuman($id)
	{
		$this->db->delete('pengumuman', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Announcement Deleted!
			</div>');
		redirect('Admin/pengumuman');
	}

	public function Berita()
	{
		$data['title'] = "Berita";
		$data['berita'] = $this->db->get('berita')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/berita', $data);
			$this->load->view('templates/footer');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/berita';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('berita', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						New News Added!
						</div>');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				}
				redirect('Admin/berita');
			}
		}
	}

	public function updateBerita()
	{
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$berita = $this->db->get_where('berita', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting berita ini! karena Anda bukan penulisnya.
			</div>');
			redirect('Admin/berita');
		} elseif ($this->form_validation->run() == false) {
			redirect('Admin/berita');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/berita';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $berita['thumbnail'];
					if ($old_image !='default.jpg') {
						unlink(FCPATH.'assets/img/berita/'.$old_image);
					} 
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					redirect('Admin/berita');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('berita', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				News Updated!
				</div>');
			redirect('Admin/berita');
		}
	}

	public function deleteBerita($id)
	{
		$this->db->delete('berita', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			News Deleted!
			</div>');
		redirect('Admin/berita');
	}

	public function notulensi()
	{
		$data['title'] = "Notulensi";
		$data['notulensi'] = $this->db->get('notulensi')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/notulensi', $data);
			$this->load->view('templates/footer');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/notulensi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('notulensi', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						New News Added!
						</div>');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				}
				redirect('Admin/notulensi');
			}
		}
	}

	public function updateNotulensi()
	{
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$notulensi = $this->db->get_where('notulensi', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting notulensi ini! karena Anda bukan penulisnya.
			</div>');
			redirect('Admin/notulensi');
		} elseif ($this->form_validation->run() == false) {
			redirect('Admin/notulensi');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/notulensi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $notulensi['thumbnail'];
					if ($old_image !='default.jpg') {
						unlink(FCPATH.'assets/img/notulensi/'.$old_image);
					} 
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					redirect('Admin/notulensi');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('notulensi', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				News Updated!
				</div>');
			redirect('Admin/notulensi');
		}
	}

	public function deleteNotulensi($id)
	{
		$this->db->delete('notulensi', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			News Deleted!
			</div>');
		redirect('Admin/notulensi');
	}

	public function peraturan()
	{
		$data['title'] = "Peraturan";
		$data['peraturan'] = $this->db->get('peraturan')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/peraturan', $data);
			$this->load->view('templates/footer');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/peraturan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('peraturan', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						New News Added!
						</div>');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				}
				redirect('Admin/peraturan');
			}
		}
	}

	public function updatePeraturan()
	{
		$this->form_validation->set_rules('judul', 'Title', 'trim|required');
		$this->form_validation->set_rules('isi', 'Content', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$peraturan = $this->db->get_where('peraturan', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting peraturan ini! karena Anda bukan penulisnya.
			</div>');
			redirect('Admin/peraturan');
		} elseif ($this->form_validation->run() == false) {
			redirect('Admin/peraturan');
		} else{
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './assets/img/peraturan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $peraturan['thumbnail'];
					if ($old_image !='default.jpg') {
						unlink(FCPATH.'assets/img/peraturan/'.$old_image);
					} 
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					redirect('Admin/peraturan');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('peraturan', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				News Updated!
				</div>');
			redirect('Admin/peraturan');
		}
	}

	public function deletePeraturan($id)
	{
		$this->db->delete('peraturan', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			News Deleted!
			</div>');
		redirect('Admin/peraturan');
	}

	public function musrembang()
	{
		$data['title'] = "Data Musrembang";
		$data['musrembang'] = $this->db->get('musrembang')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('program', 'Program', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/musrembang', $data);
			$this->load->view('templates/footer');
		} else{
			$this->db->insert('musrembang', [
				'program' => $this->input->post('program'),
				'kegiatan' => $this->input->post('kegiatan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume_lokasi' => $this->input->post('volume_lokasi'),
				'pengusul' => $this->input->post('pengusul'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Musrembang Added!
				</div>');
			redirect('Admin/musrembang');
		}
	}

	public function updateMusrembang()
	{
		$this->form_validation->set_rules('program', 'Program', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('Admin/musrembang');
		} else{
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('musrembang', [
				'program' => $this->input->post('program'),
				'kegiatan' => $this->input->post('kegiatan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume_lokasi' => $this->input->post('volume_lokasi'),
				'pengusul' => $this->input->post('pengusul'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Musrembang Updated!
				</div>');
			redirect('Admin/musrembang');
		}
	}

	public function deleteMusrembang($id)
	{
		$this->db->delete('musrembang', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Musrembang Deleted!
			</div>');
		redirect('Admin/musrembang');
	}

	public function getUpdateMusrembang(){
		echo json_encode($this->Admin_model->getMusrembangById($this->input->post('id')));
	}
	public function getUpdatePengumuman(){
		echo json_encode($this->Admin_model->getPengumumanById($this->input->post('id')));
	}
	public function getUpdateBerita(){
		echo json_encode($this->Admin_model->getBeritaById($this->input->post('id')));
	}
	public function getUpdateNotulensi(){
		echo json_encode($this->Admin_model->getNotulensiById($this->input->post('id')));
	}
	public function getUpdatePeraturan(){
		echo json_encode($this->Admin_model->getPeraturanById($this->input->post('id')));
	}
	public function getUpdateStruktur($id = null){
		echo json_encode($this->Admin_model->getStrukturById($id));
	}
	
}