<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 15:31
 */

namespace App\Http\Controllers;


use App\Repositories\DataRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DataController extends Controller
{
    private $dataRepository;
    /**
     * DataController constructor.
     */
    public function __construct(DataRepositoryInterface $dataRepository)
    {
        $this->dataRepository = $dataRepository;
    }

    public function index():string
    {
        return view('data.index', ['types'=> $this->dataRepository->getTypes()]);
    }

    public function read(int $id):LengthAwarePaginator
    {
        return $this->dataRepository->getTypesByFatherIdAndPaginate($id, request()->input('per_page', 12));
    }

    public function save(Request $request, int $id)
    {
        $father_id = $id;

        $params = $request->only('name', 'key') + compact('father_id');

        if ('edit' === $request->oper) {
            $this->dataRepository->update($params, $request->id);
        } elseif ('del' === $request->oper) {
            $this->dataRepository->delete($request->id);
        } else {
            $this->dataRepository->save($params);
        }
    }
}