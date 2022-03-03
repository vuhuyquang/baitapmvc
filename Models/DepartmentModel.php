<?php

class DepartmentModel extends BaseModel
{
    const TABLE = 'departments';

    public function get($select = ['*'], $pages = null)
    {
        return $department = $this->getAll(self::TABLE, $select, $pages);
    }

    // public function all($select = ['*'])
    // {
    //     return $department = $this->getAll(self::TABLE, $select);
    // }

    public function findById($id)
    {
        return $this->find(self::TABLE, $id);
    }

    public function insert($data)
    {
        $this->create(self::TABLE, $data);
    }

    public function update($id, $data = [])
    {
        $this->updateData(self::TABLE, $id, $data);
    }

    public function delete($id)
    {
        $this->destroy(self::TABLE, $id);
    }

    public function count()
    {
        return $this->countItem(self::TABLE);
    }
}

?>