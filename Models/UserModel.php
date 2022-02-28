<?php

class UserModel extends BaseModel
{
    const TABLE = 'users';

    /**
     * Lấy danh sách
     */
    public function get($select = ['*'])
    {
        return $this->getAll(self::TABLE, $select);
    }

    /**
     * Lấy danh sách
     */
    public function join($table1, $table2, $column1, $column2)
    {
        return $this->innerJoin($table1, $table2, $column1, $column2);
    }

    /**
     * Tìm theo id
     */
    public function findById($id)
    {
        return $this->find(self::TABLE, $id);
    }

    // id của phòng ban
    public function findWhere($column , $id)
    {
        return $this->findByColumn(self::TABLE, $column, $id);
    }

    /**
     * Thêm mới
     */
    public function insert($data)
    {
        $this->create(self::TABLE, $data);
    }

    /**
     * Sửa
     */
    public function update($id, $data = [])
    {
        $this->updateData(self::TABLE, $id, $data);
    }

    public function delete($id)
    {
        $this->destroy(self::TABLE, $id);
    }
}

?>