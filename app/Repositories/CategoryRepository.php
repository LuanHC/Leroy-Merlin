<?php

namespace App\Repositories;

interface CategoryRepository 
{
	function all($include);

	function show($include, $id);

	function store(array $attributes);

	function update(array $attributes, $id);

	function destroy($id);
}
