<?php

namespace App\Http\Livewire;

use App\Models\Comments as ModelsComments;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class Comments extends Component

{

    // public $comments;
    use WithPagination;

    use WithFileUploads;

    public $newComment;

    public $userId = 2;

    public $image;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($image) {
        $this->image = $image;
        //dd($image);
    }


    // public function mount() {
    //     $incomments = ModelsComments::latest()->get();

    //     $this->comments = $incomments;
    // }

    public function updated($field) {
        $this->validateOnly($field, [
            'newComment' => 'required|max:255'
        ]);
    }


    public function addComment() {
        $this->validate([
            'newComment' => 'required|max:255',
        ]);

       $filename = '';
       if($this->image) {
           $filename = $this->image->store('uploads', 'public');
       } else {
           $filename = null;
       }


        $createdComment = ModelsComments::create(
            [
                'body' => $this->newComment,
                'user_id' => 2,
                'image' => $filename

            ]);
        $this->newComment = '';

        session()->flash('message', 'Comment added successfully :)');
    }

    // public function storeImage() {
    //     if(!$this->image) return null;



    // }
    public function remove($id) {
        //  return back();
        //$comment = ModelsComments::find($id);
        ModelsComments::destroy($id);
        session()->flash('message', 'Comment deleted successfully :)');

    }

    public function render()
    {
        return view('livewire.comments', ['comments'=>ModelsComments::latest()->paginate(2)]);
    }
}
