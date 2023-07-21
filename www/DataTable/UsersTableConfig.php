<?php

namespace App\DataTable;

use App\DataTable\Abstract\DataTableAbs;


class UsersTableConfig extends DataTableAbs
{
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getConfig(): array
    {

        return [
            "config" => [
                "class" => "userTable",
                "id" => "userTable",
            ],
            "headers" => [
                "firstname" => "Firstname",
                "lastname" => "Lastname",
                "email" => "Email",
                "role" => "Roles",
            ],
            "tbody" => [
                "firstname" => "firstname",
                "lastname" => "lastname",
                "email" => "email",
                "role" => "role",
            ],
            "data" => $this->users,
            "actions" => [
                "delete" => "/bdfy-admin/users/delete?id=",
                "edit" => "/bdfy-admin/users/edit?id=",
            ]
        ];
    }
}
