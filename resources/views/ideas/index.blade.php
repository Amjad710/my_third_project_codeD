<x-layout title="index">
   
    @if ($ideas->count())
    
    <div class="mt-6 text-white">
        <h2>Your Ideas :</h2>
        <ul class="mt-6 grid grid-cols-2 gap-x-6 gap-y-4" >
            @foreach ($ideas as $idea )
                <a href="/ideas/{{ $idea->id }}" class="card bg-neutral text-neutral-content w-96">
                    <div class="card-body">
                        <h2 class="card-title">{{ $idea->description }}</h2>
                    </div>
                </a>
            @endforeach
        </ul>
    </div>
    @else
    <a href="/ideas/create"> Create</a>
    @endif
    <a href="/ideas/create"> Create</a>
</x-layout>