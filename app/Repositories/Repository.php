<?php
  namespace App\Repositories;

  abstract class Repository {
    protected $model;
    protected $app;

    public function __construct($app) 
    {
      $this->app = $app;
      $this->makeModel();
    }

    abstract function model();

    public function makeModel()
    {
      $model = $this->app->make($this->model());
      return $this->model = $model;
    }
  }