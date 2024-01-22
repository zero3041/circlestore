<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Http\Controllers\web\CategoryController;

class GlobalComposer
{
    public $category ;
    public function __construct(CategoryController $categories)
    {
        $this->category = $categories->getMenuByname('laptop');
    }
    public function compose(View $view)
    {
        $view->with([
            'category'=> $this->category,
        ]);
    }
}
