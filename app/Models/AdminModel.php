<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model{
    protected $table = 'admins';

    protected $primaryKey = 'admin_ID';

    protected $allowedFields = ['admin_ID', 'email', 'password', 'username', 'level'];
    protected $beforeInsert = ['beforeInsert'];

    
    protected function beforeInsert(array $data)
{
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
}
    
}


?>