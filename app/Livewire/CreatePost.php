<?php

namespace App\Livewire;

use Domain\Page\Models\Page;
use Livewire\Component;

class CreatePost extends Component
{
    public $title;

    public function save()
    {


        return to_route('yy')
            ->with('status', 'Post created!');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
