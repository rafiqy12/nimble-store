<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
    }

    // DASHBOARD
    public function dashboard()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Nimble | User Dashboard';
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout');
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    // // USERS
    // public function users()
    // {
    //     $this->load->model('Admin_users_models');
    //     $query['users'] = $this->Admin_users_models->get_users();
    //     $query['total_users'] = $this->Admin_users_models->count_users();
    //     $data['header_title'] = 'Nimble | User Dashboard';
    //     $this->load->view('templates/admin_header', $data);
    //     $this->load->view('templates/dashboard_layout');
    //     $this->load->view('admin/users/users', $query);
    //     $this->load->view('templates/admin_footer');
    // }

    // public function add_user()
    // {
    //     $data['header_title'] = 'Nimble | User Dashboard';
    //     $this->load->view('templates/admin_header', $data);
    //     $this->load->view('templates/dashboard_layout');
    //     $this->load->view('admin/users/add_user');
    //     $this->load->view('templates/admin_footer');
    // }

    public function update_user()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Nimble | User Dashboard';
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout');
        $this->load->view('user/user/update_user', $data);
        $this->load->view('templates/admin_footer');
    }   

    public function update_user_action()
    {
        $id = $this->session->userdata('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $province = $this->input->post('province');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $subdistrict = $this->input->post('subdistrict');
        $street = $this->input->post('street');
        $description = $this->input->post('description');
        $zip_code = $this->input->post('zip_code');

        $user = $this->Admin_model->get_users_by_id($id)->row_array();
        $picture_old = $user['profile_picture'];

        $config['upload_path'] = './public/uploads/users';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('picture')) {
            $picture = $this->upload->data('file_name');
        } else {
            $picture = $picture_old;
            $error = $this->upload->display_errors();
        }

        $data = array(
            'full_name' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'gender' => $gender,
            'address_province' => $province,
            'address_city' => $city,
            'address_district' => $district,
            'address_subdistrict' => $subdistrict,
            'street_name' => $street,
            'address_description' => $description,
            'zip_code' => $zip_code,
            'profile_picture' => $picture
        );

        $this->Admin_model->update_user($data, $id);

        if ($this->db->affected_rows()) {
            redirect('user/dashboard');
        } else {
            redirect('user/update_user');
        }
    }

    // // PRODUCTS
    // public function products()
    // {
    //     $this->load->model('Admin_model');
    //     $query['products'] = $this->Admin_model->get_product();
    //     $query['count_all_products'] = $this->Admin_model->count_all_products();
    //     $data['header_title'] = 'Nimble | User Dashboard';
    //     $this->load->view('templates/admin_header', $data);
    //     $this->load->view('templates/dashboard_layout');
    //     $this->load->view('admin/products/products', $query);
    //     $this->load->view('templates/admin_footer');
    // }

    // public function add_product()
    // {
    //     $data['header_title'] = 'Nimble | User Dashboard';
    //     $this->load->view('templates/admin_header', $data);
    //     $this->load->view('templates/dashboard_layout');
    //     $this->load->view('admin/products/add_product');
    //     $this->load->view('templates/admin_footer');
    // }

    // public function add_product_action()
    // {
    //     $name = $this->input->post('name');
    //     $description = $this->input->post('description');
    //     $price = $this->input->post('price');
    //     $stock = $this->input->post('stock');
    //     $category = $this->input->post('category');
    //     $size = $this->input->post('size');
    //     $color = $this->input->post('color');
    //     $brand = $this->input->post('brand');

    //     $config['upload_path'] = './public/uploads';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('picture')) {
    //         $picture = $this->upload->data('file_name');
    //     } else {
    //         $picture = null;
    //         $error = $this->upload->display_errors();
    //     }

    //     $data = array(
    //         'name' => $name,
    //         'description' => $description,
    //         'price' => $price,
    //         'stock' => $stock,
    //         'category_id' => $category,
    //         'size_id' => $size,
    //         'color_id' => $color,
    //         'brand' => $brand,
    //         'image_url' => $picture
    //     );
    //     $this->Admin_model->add_product($data);

    //     if ($this->db->affected_rows()) {
    //         redirect('Admin/products');
    //     } else {
    //         redirect('Admin/add_product');
    //     }
    // }

    // public function update_product($id)
    // {
    //     $data['header_title'] = 'Nimble | User Dashboard';
    //     $data['product'] = $this->Admin_model->get_product_by_id($id)->row_array();
    //     $this->load->view('templates/admin_header', $data);
    //     $this->load->view('templates/dashboard_layout');
    //     $this->load->view('admin/products/update_product', $data);
    //     $this->load->view('templates/admin_footer');
    // }

    // public function update_product_action()
    // {
    //     $id = $this->input->post('id');
    //     $name = $this->input->post('name');
    //     $description = $this->input->post('description');
    //     $price = $this->input->post('price');
    //     $stock = $this->input->post('stock');
    //     $category = $this->input->post('category');
    //     $size = $this->input->post('size');
    //     $color = $this->input->post('color');
    //     $brand = $this->input->post('brand');

    //     $product = $this->Admin_model->get_product_by_id($id)->row_array();
    //     $old_picture = $product['image_url'];

    //     $config['upload_path'] = './public/uploads';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('picture')) {
    //         $picture = $this->upload->data('file_name');
    //     } else {
    //         $picture = $old_picture;
    //     }

    //     $data = array(
    //         'name' => $name,
    //         'description' => $description,
    //         'price' => $price,
    //         'stock' => $stock,
    //         'category_id' => $category,
    //         'size_id' => $size,
    //         'color_id' => $color,
    //         'brand' => $brand,
    //         'image_url' => $picture
    //     );
    //     $this->Admin_model->update_product($data, $id);

    //     if ($this->db->affected_rows()) {
    //         redirect('Admin/products');
    //     } else {
    //         redirect('Admin/update_product/' . $id);
    //     }
    // }

    // public function delete_product($id_product)
    // {
    //     $this->Admin_model->delete_product($id_product);
    //     if ($this->db->affected_rows()) {
    //         redirect('Admin/products');
    //     } else {
    //         echo "Data gagal dihapus";
    //     }
    // }

    // COMMENTS
    public function comments()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Nimble | Dashboard';
        $data['comments'] = $this->Admin_model->get_comments_by_user_id();
        $data['count_comments_by_user_id'] = $this->Admin_model->count_comments_by_user_id();
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout');
        $this->load->view('User/comments/comments', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_comment()
    {
        $data['header_title'] = 'Nimble | User Dashboard';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout');
        $this->load->view('user/comments/add_comment');
        $this->load->view('templates/admin_footer');
    }

    public function update_comment_user($id)
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Nimble | User Dashboard';
        $data['comment'] = $this->Admin_model->get_comment_by_id($id)->row_array();
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/comments/update_comment');
        $this->load->view('templates/admin_footer');
    }

    public function update_add_comment_action_user()
    {
        $comment_id = $this->input->post('id');
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        $comment = $this->input->post('comment');
        $rating = $this->input->post('rating');



        $data = array(
            'product_id' => $product_id,
            'user_id' => $user_id,
            'comment' => $comment,
            'rating' => $rating
        );

        $this->Admin_model->update_comment($data, $comment_id);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success','Comment updated successfully.');
            redirect("user/comments");
        } else {
            $this->session->set_flashdata('error', 'Failed to delete your comment. Please try again.');
            redirect("user/comments");
        }
    }

    
    public function delete_comment($id)
    {
        $this->Admin_model->delete_comment($id);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success','Comment added successfully.');
            redirect("user/comments");
        } else {
            // Jika insert gagal
            $this->session->set_flashdata('error', 'Failed to save your comment. Please try again.');
            redirect("user/comments");
    }
    }
}
