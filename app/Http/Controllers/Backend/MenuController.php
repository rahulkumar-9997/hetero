<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Page;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('items')->get();
        return view('backend.pages.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.menu.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);
        $data = [];
        $data['name'] = $validated['name'];
        $data['location'] = $validated['location'] ?? null;
        Menu::create($data);
        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('backend.pages.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);
        $data = [];
        $data['name'] = $validated['name'];
        $data['location'] = $validated['location'] ?? null;
        $menu->update($data);
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->items()->delete();
        $menu->delete();
        
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function displayMenuItem(Menu $menu){
        $pages = Page::where('is_active', true)->get();
        $menuItems = $menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
        
        return view('backend.pages.menu-items.index', compact('menu', 'pages', 'menuItems'));
    }

    public function storeItem(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'icon' => 'nullable|string|max:255',
            'target' => 'nullable|in:_self,_blank',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'short_desc' => 'nullable|string|max:500',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $safeTitle = Str::slug($data['title']);
                $image = $request->file('image');
                $destinationPath = public_path('upload/menu-item');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                $filename = $safeTitle . '-' . uniqid() . '.webp';
                $img = Image::make($image->getRealPath())->encode('webp', 75);
                $img->save($destinationPath . '/' . $filename);
                $data['image'] = $filename;
            }

            $menu->items()->create([
                'title' => $data['title'],
                'short_content' => $data['short_desc'] ?? null,
                'image' => $data['image'] ?? null,
                'url' => $data['type'] === 'url' ? $data['url'] : null,
                'route' => $data['type'] === 'route' ? $data['route'] : null,
                'page_id' => $data['type'] === 'page' ? $data['page_id'] : null,
                'parent_id' => $data['parent_id'] ?? null,
                'icon' => $data['icon'] ?? null,
                'target' => $data['target'] ?? '_self',
            ]);
            DB::commit();
            return redirect()->route('menus.items', $menu->id)
                ->with('success', 'Menu item added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to store menu item: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function editItem(Menu $menu, MenuItems $item)
    {
        $pages = Page::where('is_active', true)->get();
        $menuItems = $menu->allItems;        
        return view('backend.pages.menu-items.edit', compact('menu', 'item', 'pages', 'menuItems'));
    }

    public function updateItem(Request $request, Menu $menu, MenuItems $item)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'icon' => 'nullable|string|max:255',
            'target' => 'nullable|in:_self,_blank',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'short_desc' => 'nullable|string|max:500',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $destinationPath = public_path('upload/menu-item');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                if ($item->image && File::exists(public_path($item->image))) {
                    File::delete(public_path($item->image));
                }
                $safeTitle = Str::slug($data['title']);
                $filename = $safeTitle . '-' . uniqid() . '.webp';
                $img = Image::make($image->getRealPath())->encode('webp', 75);
                $img->save($destinationPath . '/' . $filename);
                $data['image'] = $filename;
            } else {
                $data['image'] = $item->image;
            }
            $data['url'] = $data['type'] === 'url' ? $data['url'] : null;
            $data['route'] = $data['type'] === 'route' ? $data['route'] : null;
            $data['page_id'] = $data['type'] === 'page' ? $data['page_id'] : null;
            $data['short_content'] = $data['short_desc'] ?? null;
            unset($data['short_desc'], $data['type']);
            $item->update($data);
            DB::commit();
            return redirect()->route('menus.items', $menu->id)
                ->with('success', 'Menu item updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Menu item update failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroyItem(Menu $menu, MenuItems $item)
    {
        $item->delete();
        return redirect()->route('menus.items', $menu->id)
            ->with('success', 'Menu item deleted successfully.');
    }

    public function orderItems(Request $request, Menu $menu)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:menu_items,id,menu_id,'.$menu->id,
            'order.*.order' => 'required|integer',
            'order.*.parent_id' => 'nullable|exists:menu_items,id,menu_id,'.$menu->id,
        ]);

        try {
            MenuItems::updateOrder($request->order);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
