<?php

namespace App\repositoryinterface;


use Illuminate\Http\Request;

interface CustomerInterface
{


    public function all();
    public function create($data);
    public function store($id);
    public function edit($id);
    public function update(Request $request,$id);
    public function destroy($id);
    public function get_by_id($id);


}


