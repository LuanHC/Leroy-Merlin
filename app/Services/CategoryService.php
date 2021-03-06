<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\BaseService;
use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Exception;

class CategoryService extends BaseService
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * ProductService constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array|null $include
     * @return Response
     */
    public function all($include)
    {
        try {
            $this->setParseInclude($include);
            $collection = $this->repository->all($include);
        } catch (RelationNotFoundException $e) {
            return $this->setStatus(500)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch (Exception $e) {
            return $this->setStatus(400)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        }

        return $this->setStatus(200)
            ->setMessage(__('messages.category.all'))
            ->collection($collection, new CategoryTransformer(), 'categories')
            ->success();
    }

    /**
     * @param array $data
     * @return Response
     */
    public function store(array $data)
    {
        try {
            $item = $this->repository->store($data);

        } catch (ModelNotFoundException $e) {
            return $this->setStatus(404)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch(Exception $e) {
            return $this->setStatus(400)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        }

        return $this->setStatus(201)
            ->setMessage(__('messages.category.store'))
            ->item($item, new CategoryTransformer(), 'category')
            ->success();
    }
    
    /**
     * @param array|null $include
     * @param $id
     * @return Response
     */
    public function show($include, $id)
    {
        try {
            $this->setParseInclude($include);
            $item = $this->repository->show($include, $id);

        } catch (ModelNotFoundException $e) {
            return $this->setStatus(404)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch (RelationNotFoundException $e) {
            return $this->setStatus(500)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch (Exception $e) {
            return $this->setStatus(400)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        }

        return $this->setStatus(200)
            ->setMessage(__('messages.category.show'))
            ->item($item, new CategoryTransformer(), 'category')
            ->success();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Response
     */
    public function update(array $data, $id)
    {
        try {
            $item = $this->repository->update($data, $id);
        
        } catch (ModelNotFoundException $e) {
            return $this->setStatus(404)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch(Exception $e) {
            return $this->setStatus(400)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        }

        return $this->setStatus(200)
            ->setMessage(__('messages.category.update'))
            ->item($item, new CategoryTransformer(), 'category')
            ->success();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);

        } catch (ModelNotFoundException $e) {
            return $this->setStatus(404)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        } catch(Exception $e) {
            return $this->setStatus(400)
            ->error(
                $e->getMessage(),
                $e->getLine(),
                $e->getCode()
            );
        }

        return $this->setStatus(200)
            ->setMessage(__('messages.category.destroy'))
            ->success();
    }
}
