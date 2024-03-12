<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Commonlib
    {

        private $_CI;

        public function __construct()
        {

            $this->_CI = & get_instance();
        }

    }
    