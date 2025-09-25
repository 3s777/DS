<?php

namespace App\Livewire;

use Livewire\Component;
//use App\Models\Post;

class CreatePost extends Component
{
    public $title = '';

    public $content = '';

    public function save()
    {
//        Post::create(
//            $this->only(['title', 'content'])
//        );

        session()->flash('status', 'Post successfully updated.');

        return $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
