<div>
{{--    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retailer</label>
    <input
        type="text"
        name="retailer"
        id="retailer"
        wire:model.live="search"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Find or add a retailer"
        required
    />
    @if($retailers)
    <div id="dropdown" class="bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
            @foreach($retailers as $retailer)
                <li>{{ $retailer->name }}</li>
            @endforeach
        </ul>
    </div>
   @endif--}}
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retailer</label>
        <div id="dropdown" class="bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
            <x-lwa::autocomplete
                name="retailer-name"
                wire:model-text="name"
                wire:model-id="retailerId"
                wire:model-results="retailers"
                :options="[
                    'text'=> 'name',
                    'auto-select' => true,
                    'allow-new' => true,
                    'load-once-on-focus' => true,
                    'inline' => false,
                    'inline-styles' => 'relative',
                    'overlay-styles' => 'absolute z-30',
                    'result-focus-styles' => 'bg-blue-500',
                ]
            " />
        </div>
{{--        <h1 class="font-bold">Selected Retailer</h1>
        <p>ID: {{ $retailer->id ?? '' }}</p>
        <p>Name: {{ $retailer->name ?? null }}</p>--}}
    </div>
</div>
