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
                "firstname" => "Nom",
                "lastname" => "Prénom",
                "email" => "Email",
                "role" => "Role",
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
