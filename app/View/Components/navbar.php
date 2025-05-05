<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navbar extends Component
{
    public $open;

    public function __construct()
    {
        $this->open = \App\Models\Pembukaan::first();
    }

    public function render(): View|Closure|string
    {
        return view('components.navbar', [
            'open' => $this->open
        ]);
    }
}
