<?php

namespace App\Models;

use App\Core\Db;

class Menu extends Db
{
    protected Int $id;
    protected String $name;
    protected $items;
    protected Bool $active;

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getItems()
    {
        return $this->items;
    }
    public function getActive(): bool
    {
        return $this->active;
    }
    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
    public function setActive($active)
    {
        $this->active = $active;
    }
    public function findMenuById($id)
    {
        return $this->read(["id" => $id]);
    }
    public function findMenuByName($name)
    {
        return $this->read(["name" => $name]);
    }
    public function getActiveMenu()
    {
        return $this->read(["active" => true]);
    }
    public function getActiveMenuById($id)
    {
        return $this->read(["id" => $id, "active" => true]);
    }
    public function deleteMenuById(Int $id)
    {
        return $this->delete(["id" => $id]);
    }
}
