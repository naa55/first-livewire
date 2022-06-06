<div>
    <h1>Add Comment</h1>
    @error('newComment') <span style="color: red;">{{$message}}</span> @enderror
    <div>
        @if(session()->has('message'))
            <div style="color: green;">
                {{session('message')}}
            </div>
        @endif
    </div>
    <section>
        @if($image)
        <img src="{{$image}}" width="200" height="200" alt="">
        @endif
        <input type="file" id="image" wire:change="$emit('fileChoosen')">
    </section>
    <form action="" wire:submit.prevent="addComment">
        <input type="text" placeholder="add comment" wire:model.lazy="newComment">
        <button type="submit">Add comments</button>
    </form>
    @foreach($comments as $comment)
    <div>
        <div>
          {{$comment->user->name}}
        </div>
        <div>
           {{$comment->body}}
           <button wire:click="remove({{$comment->id}})">x</button>
        </div>
    </div>
    @endforeach

    {{$comments->links()}}
</div>


<script>
window.livewire.on('fileChoosen', () => {
    let inputField = document.getElementById('image');
    let file  = inputField.files[0];
    let reader = new FileReader();

    reader.onloadend = () => {
        //console.log();
        window.livewire.emit('fileUpload',reader.result)
    }

    reader.readAsDataURL(file);
})
</script>
