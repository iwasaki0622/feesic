<?php
/**
 * Index Controller
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Index extends \Fuel\Core\Controller_Template
{
	public function action_index()
	{
        $this->template->title = 'Feesic';
        $this->template->content = ViewModel::forge('index/index');
	}

    public function action_login()
	{
        $this->template->title = 'Login';
        $this->template->content = ViewModel::forge('index/login');
	}

    public function action_404()
    {
        $this->template->title = 'そのページは見つかりません';
        $this->template->content = ViewModel::forge('index/404');
    }
}
