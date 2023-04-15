<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class CategoryComposer
{
    public $g_categories = null;

    public function compose(View $view): void
    {
        $view->with('g_categories', auth()->id() ? $this->getCategoriesList() : null);
    }

    private function getCategoriesList(): ?Collection
    {
        if (!$this->g_categories) {
            $this->g_categories = Category::select('id', 'title', 'parent_id', 'order', 'image')
                ->orderBy('order')
                ->get();
        }
        return $this->g_categories;
    }
}
