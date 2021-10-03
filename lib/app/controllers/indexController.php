<?php

class indexController{
  public function index() {
    return view::load('index');
  }
  public function save() {
    print idate::datetime();
  }
}