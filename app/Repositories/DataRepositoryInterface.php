<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:18
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface DataRepositoryInterface extends RepositoryInterface
{
    public function getTypes();

    public function getTypesByFatherId(int $id):?array;

    public function getTypesByFatherIdAndPaginate(int $id, int $per_page = 12):LengthAwarePaginator;

}