<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'id' => $row[0],
            'title' => $row[1],
            'url_clean' => $row[2],
            'content' => $row[3],
            'posted' => $row[4],
            'category_id' => $row[5],


        ]);
    }
}
