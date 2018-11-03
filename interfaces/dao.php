<?php

interface Dao
{
    public function get($id);
    public function getAll();
    public function add($entity);
    public function update($entity);
    public function delete($id);
}