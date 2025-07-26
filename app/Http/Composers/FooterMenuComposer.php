<?php
namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
class FooterMenuComposer
{
    public function compose(View $view)
    {
        $footerMenu = Menu::with(['items.children'])
            ->where('location', 'Footer')
            ->first();
        //dd($footerMenu->toJson(JSON_PRETTY_PRINT));
        $view->with('footerMenu', $footerMenu);       
    }
}
