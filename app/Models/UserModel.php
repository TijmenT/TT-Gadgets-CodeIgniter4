<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $primaryKey = 'customer_id';
    protected $table = 'customers';
    protected $allowedFields = ['email', 'password', 'firstname', 'lastname', 'street', 'zipcode', 'city'];
    protected $beforeInsert = ['beforeInsert'];

    
    protected function beforeInsert(array $data)
{
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
}
    
}


?>