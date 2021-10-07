<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageController extends CI_Controller {

    public function postImage(){
        $title = $this->input->post('title');
        $config['upload_path'] = './assets/';
		$config['max_size'] = 5048;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

        if ($this->upload->do_upload('photo')){
            $fileName = $this->upload->data()['file_name'];
            
            $data = [
                'title' => $title,
                'image' => $fileName
            ];
            $query = $this->db->insert('image', $data);  

            if ($query) {
				$output['code'] = '1';
				$output['message'] = 'Behasil Memposting';
			}else {
				$output['code'] = '0';
				$output['message'] = 'Gagal Memposting';
			}
        }

        $this->output
		->set_content_type('application/json')
		->set_output(json_encode($output));	
    }

}

