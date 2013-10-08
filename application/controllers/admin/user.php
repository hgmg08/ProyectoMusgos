<?php

class User extends CI_Controller {

	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$user= $this->em->find('entities\User', $this->session->userdata('uid'));
			
			$this->twiggy->set('role', $user->getRole()->getName());
			$this->twiggy->set('username', $user->getUsername());
			$this->twiggy->set('users', json_encode($this->populate_grid()));
			$this->twiggy->set('roles', json_encode($this->em->getRepository("entities\Role")->getAll()));
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/users')->display();	
		}
		else {
			redirect('');
		}
	}
	
	private function populate_grid()
	{
		$result = $this->em->getRepository("entities\User")->getAll();
		$users = array();

		foreach ($result as $r) {
			$users[] = array(
				'id' => $r['id'],
				'User' => $r['username'],
				'Name' => $r['name'],
				'Email' => $r['email'],
				'Role' => $this->em->find('entities\User', $r['id'])->getRole()->getName(),
				'rid' => $this->em->find('entities\User', $r['id'])->getRole()->getId()
			);
		}
		
		return $users;
	}

	public function persist_user()
	{
		$id = $this->input->post("id");
		$op = $this->input->post("op");
		$name = $this->input->post("name");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$email = $this->input->post("email");
		$rid = $this->input->post("role");
		
		$user = $this->em->getRepository('entities\User')->findOneBy(array('username' => $username));
		$role = $this->em->find('entities\Role', $rid);
		
		if ($op == 0) {
			if (!$user) {
				$user = new entities\User;
				$user->setName($name);
				$user->setUsername($username);
				$user->setPassword(sha1($password));
				$user->setEmail($email);
				$user->setRole($role);
				$this->em->persist($user);
				$this->em->flush();
				echo true;	
			}
			else {
				echo false;
			}
		}
		
		else {
			$user = $this->em->find('entities\User', $id);
			$user->setName($name);
			$user->setUsername($username);
			if (!empty($password)) {
				$user->setPassword(sha1($password));
			}
			$user->setEmail($email);
			$user->setRole($role);
			$this->em->persist($user);
			$this->em->flush();
			echo true;	
		}
	}
}

?>