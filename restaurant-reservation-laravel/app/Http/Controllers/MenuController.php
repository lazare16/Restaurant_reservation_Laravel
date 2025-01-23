<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'availability' => 'required|boolean',
        ]);

        $menu = Menu::create($data);
        return response()->json($menu, 201);
    }

    public function show(Menu $menu)
    {
        return $menu;
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'category' => 'string',
            'availability' => 'boolean',
        ]);

        $menu->update($data);
        return response()->json($menu, 200);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(null, 204);
    }
}
