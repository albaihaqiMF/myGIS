<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index()
    {
        $data = [];

        $nodes = Node::all();

        foreach ($nodes as $value) {
            $node = $value->sensors;
            $data[] = [
                'name' => $value->name,
                'data' => $node
            ];
        }
        // return $data;

        return view('node.list', compact('data'));
    }
}
