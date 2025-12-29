<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\PasswordResetTokenModel;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

use Codeigniter\Email\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function login_action()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response->setJSON([
                'status' => false,
                'msg' => 'Invalid request'
            ]);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->run($data)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $userModel = new UserModel();

        $user = $userModel->where('email', $data['email'])->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'msg' => 'Email not found',
                "color" => "danger",
            ]);
        }

        if (!password_verify($data['password'], $user['password'])) {
            return $this->response->setJSON([
                'status' => false,
                'msg' => 'Incorrect password',
                "color" => "danger",
            ]);
        }

        // ✅ Set session values
        __add__session('user_id', $user['id']);
        __add__session('fname', $user['fname']);
        __add__session('lname', $user['lname']);
        __add__session('email', $user['email']);
        __add__session('isLoggedIn', true);


        return $this->response->setJSON([
            'status' => true,
            'msg' => 'Login successful',
            "color" => "success",
            'user' => [
                'id' => $user['id'],
                'fname' => $user['fname'],
                'lname' => $user['lname'],
                'email' => $user['email'],
            ]
        ]);
    }



    public function logout()
    {
        __destroy__session();
        return redirect()->to(base_url('login'));
    }

    function saveLoginInfo($Id)
    {
        $loginmodel = new UserModel();
        $data_demo = [
            "id" => $Id,
            "ip" => __getIPAddress(),
            "login_time" => date("Y-m-d H:i:s")
        ];

        $last_id = $loginmodel->insert($data_demo);

        // Session Passing
        __add__session("__session__id__", $last_id);
    }

   
    public function signup()
    {
        return view('auth/signup');
    }


    public function register()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid request'
            ]);
        }

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'fname'    => 'required',
            'lname'    => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->run($data)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $userModel = new UserModel();

        $userData = [
            'fname' => $data['fname'],
            'lname'  => $data['lname'],
            'email'      => $data['email'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        if ($userModel->insert($userData)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Registration successful!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['database' => 'Failed to save user']
            ]);
        }
    }

    // public function forget()
    // {
    //     return view('admin/forget_password');
    // }

    // public function sendpasswordresetlink()
    // {
    //     $email = $this->request->getPost('email');
    //     $userModel = new UserModel();

    //     $user = $userModel->where('email', $email)->first();
    //     if ($user) {
    //         $id = $user['id'];
    //         $otp = rand(100000, 999999);
    //         $session = session();
    //         $session->set('otp', $otp);

    //         // Calculate and set the expiration time in the session.
    //         $expiration = Time::now()->addMinutes(15);
    //         $session->set('otp_expiration', $expiration);

    //         require_once "vendor/autoload.php";
    //         $mailUser = new PHPMailer(true);
    //         $mailUser->CharSet = "UTF-8";
    //         $mailUser->IsSMTP();
    //         $mailUser->SMTPAuth = true;
    //         $mailUser->SMTPSecure = "ssl";
    //         $mailUser->Host = "smtp.gmail.com";
    //         $mailUser->Port = 465;
    //         $mailUser->Username = "nilesh@techflux.in";
    //         $mailUser->Password = "Bhaleraon@9809";

    //         $mailUser->addAddress($email);
    //         $messageUser = [
    //             'subject' => 'Password Reset OTP',
    //             'message' => "Your OTP is: $otp",
    //         ];

    //         $mailUser->Subject = $messageUser['subject'];
    //         $mailUser->Body = $messageUser['message'];

    //         $userEmailSent = $mailUser->send();

    //         if ($userEmailSent) {
    //             return redirect()->to('otpverify?id=' . $id);
    //         }
    //     } else {
    //         $error = "Email not found. Please enter a valid email address.";
    //         return view('admin/forget_password', ['error' => $error]);
    //     }
    // }

    // public function otpverify()
    // {
    //     $adminId = $this->request->getGet('id');
    //     return view('admin/otpverify', ['adminId' => $adminId]);
    // }

    // public function verify()
    // {
    //     $userModel = new UserModel();
    //     $adminId = $this->request->getGet('id');
    //     $adminid = $this->request->getVar('adminid');
    //     $session = session();
    //     $storedOTP = $session->get('otp');

    //     $user = $userModel->where('id', $adminid)->first();
    //     // print_r($user);
    //     // exit;
    //     if ($user) {
    //         $id = $user['id'];
    //         $enteredOTP = $this->request->getVar('first') .
    //             $this->request->getVar('second') .
    //             $this->request->getVar('third') .
    //             $this->request->getVar('fourth') .
    //             $this->request->getVar('fifth') .
    //             $this->request->getVar('sixth');

    //         if ($enteredOTP == $storedOTP) {
    //             return redirect()->to("resetpassword/$adminid");
    //         } else {
    //             $error = "OTP is invalid.";
    //             return view('admin/otpverify', ['id' => $id, 'error' => $error]);
    //         }
    //     }
    // }

    // public function resetpassword($adminid = null)
    // {
    //     return view('admin/resetpassword', ['adminid' => $adminid]);
    // }

    // public function updateresetpassword()
    // {
    //     $newPassword = $this->request->getPost('password');
    //     $confirmedPassword = $this->request->getPost('confpassword');
    //     $adminid = $this->request->getPost('adminid');

    //     if ($newPassword === $confirmedPassword) {
    //         $userModel = new UserModel();
    //         $data = [
    //             'password' => $newPassword
    //         ];

    //         $userModel->update($adminid, $data);
    //         return redirect()->to('/');
    //     } else {
    //         $error = "Passwords do not match.";
    //         return view('admin/resetpassword', ['adminid' => $adminid, 'error' => $error]);
    //     }
    // }
}
