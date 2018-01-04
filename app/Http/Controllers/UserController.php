<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $table_name = 'users';
        $title = ['Users'];
        $return_route = 'visits.app.users.index';
        $sort_column = "$table_name.id";
        $sort_az_za = 'asc';
        if ($_REQUEST) {
            $sort_column = (string)($_REQUEST['sort_column']);
            $sort_az_za = (string)($_REQUEST['sort_az_za']);
        };
        $columns = [
                "$table_name.id as id", "$table_name.name as name", "$table_name.email", "$table_name.created_at", "$table_name.updated_at"
            ];
        $aliases = [
                [
                    'name' => 'IDs',
                    'field' => 'id',
                    'sort' => 1
                ],
                [
                    'name' => 'name',
                    'field' => 'name',
                    'sort' => 1
                ],
                [
                    'name' => 'Email',
                    'field' => 'email',
                    'sort' => 1
                    ],
                [
                    'name' => 'Created at',
                    'field' => 'created_at',
                    'sort' => 1
                ],
                [
                    'name' => 'Updated At',
                    'field' => 'updated_at',
                    'sort' => 1
                ]
        ];
        $record_set = DB::table($table_name)
        ->orderby($sort_column, $sort_az_za)
        ->select($columns)
        ->paginate(10);
        $record_set->appends([
            'sort_column' => $sort_column,
            'sort_az_za' => $sort_az_za,
        ]);
        return view('return_route', [
            'result' => $record_set,
            'aliases' => $aliases,
            'title' => $title
        ]);
    }
}
