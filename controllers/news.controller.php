<?php

    class NewsController extends Controller{

        public function __construct($data = array()){
            parent::__construct($data);
            $this->model = new News();
        }

        public function index(){
            $this->data['news'] = $this->model->getList();
        }

        public function view(){
            $params = App::getRouter()->getParams();

            if ( isset($params[0]) ){
                $alias = strtolower($params[0]);
                $this->data['new1'] = $this->model->getByAlias($alias);
            }
        }

        public function admin_index(){
            $this->data['news'] = $this->model->getList();
        }

        public function admin_add(){
            if ( $_POST ){
                $result = $this->model->save($_POST);
                if ( $result ){
                    Session::setFlash('Page was saved.');
                } else {
                    Session::setFlash('Error.');
                }
                Router::redirect('/admin/news/');
            }
        }

        public function admin_edit(){

            if ( $_POST ){
                $id = isset($_POST['id']) ? $_POST['id'] : null;
                $result = $this->model->save($_POST, $id);
                if ( $result ){
                    Session::setFlash('Page was saved.');
                } else {
                    Session::setFlash('Error.');
                }
                Router::redirect('/admin/news/');
            }

            if ( isset($this->params[0]) ){
                $this->data['new1'] = $this->model->getById($this->params[0]);
            } else {
                Session::setFlash('Wrong news id.');
                Router::redirect('/admin/news');
            }
        }

        public function admin_delete(){
            if ( isset($this->params[0]) ){
                $result = $this->model->delete($this->params[0]);
                if ( $result ){
                    Session::setFlash('New was deleted.');
                } else {
                    Session::setFlash('Error.');
                }
            }
            Router::redirect('/admin/news/');
        }

    }