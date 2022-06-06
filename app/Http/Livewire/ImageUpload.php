<?php

namespace App\Http\Livewire;

use App\Models\Images;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


use Livewire\Component;

class ImageUpload extends Component
{
    use WithFileUploads;


    public $image;
    public $body;

    public function render()
    {
        return view('livewire.image-upload', ['images' => Images::all()]);
    }
    public function updated($field) {
        $this->validateOnly($field, [
            'body' => 'required|max:255'
        ]);
    }

    public function upload() {

        //dd($this->body);
        $this->validate([
            'image' => 'image', // 1MB Max
            'body' => 'required'
        ]);
 
       $url =  $this->image->store('images', 'public');

       Images::create([
           'image' => $url,
           'body' => $this->body
       ]);

       $this->body = '';

       $this->image = '';

     
    }

    
    public function deletePost($id) {
          //dd($id);
          $comment = Images::find($id);
          Storage::disk('public')->delete($comment->image);
          Images::destroy($id);
    }
}
