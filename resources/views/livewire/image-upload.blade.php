<div>
    <!-- <h1>Add An Image</h1>
    <br>
    <button class="button" wire:click='upload'>Uplaod</button>
    <td class="border px-4 py-2"><img src="{{ asset('storage/images/2lEfbZlku4IxTtSWTTNgHfZdYKFa1ESN8yFdDoch.jpg') }}" height="200" width="200"></td> -->
    <form action="" wire:submit.prevent="upload">
        <input type="file" wire:model="image">
        <br>
        <input type="text" placeholder="add comment" wire:model.lazy="body">
        <br>
        <button type="submit">Add comments</button>
    </form>
    @foreach($images as $image )
    <p>{{$image->body}}</p>
    <img src="{{ asset('storage/'.$image->image) }}" height="200" width="200">
    <button wire:click="deletePost({{$image->id}})">x</button>

    @endforeach
</div>
/