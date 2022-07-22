<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Quick_link extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dahboard()
    {
        redirect(site_url() . 'Dashboard_v2/Dashboard');
    }
}
