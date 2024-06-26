<?php

class AccountController extends Controller
{
    public function signupAction()
    {
        return $this->render(array(
            'user_name' => '',
            'password'  => '',
            '_token' => $this->generateCsrfToken('account/signup'),
        ));
    }

    public function registerAction()
    {
        //このメソッドもう少しカプセル化できそう
        if (!$this->request->isPost()){
            $this->forward404();
        }

        $token = $this->request->getPost('_token');
        if(!$this->checkCsrfToken('account/signup', $token)){
            return $this->redirect('/account/signup');
        }

        $user_name = $this->request->getPost('user_name');
        $password = $this->request->getPost('password');

        $errors = array();

        //バリデーション処理のテストコード書きたい
        if(!strlen($user_name)){
            $errors[] = 'ユーザIDを入力してください';
        } else if (!preg_match('/^\w{3,20}$/', $user_name)){
            $errors[] = 'ユーザIDは半角英数およびアンダースコアを3～20文字以内で入力してください';
        } else if (!$this->db_manager->get('User')->isUniqueUserName($user_name)){
            //次これの検証から！
            $errors[] = 'ユーザIDは既に使用されています';
        }

        if(!strlen($password)){
            $errors[] = 'パスワードを入力してください';
        }else if(4 > strlen($password) || strlen($password) > 30){
            $errors[] = 'パスワードは4～30文字以内で入力してください';
        }

        if(count($errors) === 0){
            $this->db_manager->get('User')->insert($user_name, $password);
            $this->session->setAuthenticated(true);

            $user = $this->db_manager->get('User')->fetchByUserName($user_name);
            $this->session->set('user', $user);

            return $this->redirect('/');
        }

        return $this->render(array(
            'user_name' => $user_name,
            'password'  => $password,
            'errors'    => $errors,
            '_token'    => $this->generateCsrfToken('account/signup'),
        ), 'signup');
    }
}