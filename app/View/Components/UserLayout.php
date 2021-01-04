<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserLayout extends Component
{
    public $title;

    /**
     * Create the component instance.
     *
     * @param string $title
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('layouts.user');
    }
}
