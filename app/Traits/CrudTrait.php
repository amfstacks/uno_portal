<?php
namespace App\Traits;

trait CrudTrait
{
    public function create($data)
    {
        return $this->insert($data);
    }

    public function updateItem($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteItem($id)
    {
        return $this->delete($id);
    }
}