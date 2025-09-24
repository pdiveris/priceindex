<div>
    <input wire:model.live="search" type="text" placeholder="Search retailers..."/>
    <ul>
        @foreach($retailers as $retailer)
            <li>{{ $retailer->name }}</li>
        @endforeach
    </ul>
</div>
