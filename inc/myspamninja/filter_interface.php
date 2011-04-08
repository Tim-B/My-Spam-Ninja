<?php

interface sn_filter{

    public function runFilter($user);

    public function emailFound();

    public function usernameFound();

    public function ipFound();

    public function filterError();

}

?>