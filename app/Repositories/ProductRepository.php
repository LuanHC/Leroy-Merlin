<?php

namespace App\Repositories;

interface ProductRepository 
{
	function all($include);

	function show($include, $id);

	function store($attributes);

	function update(array $attributes, $id);

	function destroy($id);
}
