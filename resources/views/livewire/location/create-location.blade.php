<form class="grid grid-cols-12 gap-4" wire:submit.prevent='save'>
    <div class="box p-4 col-span-8">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" wire:model='name' type="text" class="form-control w-full" placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="pg" class="form-label">Plantation Group</label>
            <select name="" wire:model='pg' id="" class="form-control bg-white">
                <option value="" selected>Pilih PG</option>
                @foreach ($pgOption as $item)
                <option value="{{ $item->pg }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="area" class="form-label">Wilayah for PG: {{ $pg }}</label>
            <select name="" wire:model='area' id="" class="form-control bg-white">
                <option value="" selected>Pilih PG</option>
                @foreach ($areaOption as $item)
                <option value="{{ $item->area }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full flex justify-end">
            <button type="submit" class="btn btn-primary relative">Create</button>
        </div>
    </div>
</form>
