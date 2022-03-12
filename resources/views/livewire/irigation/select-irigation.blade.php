@slot('title')
MyGIS
@endslot
<div class="grid w-full grid-cols-12 gap-3">
    <div class="intro-y col-span-12 xl:col-span-8">
        <div class="box w-full px-4 py-6">
            <div class="mb-3 w-full">
                <label for="pg" class="form-label">Plantation Group</label>
                <select id="pg" name="pg" wire:model='pg' type="text" class="form-control w-full"
                    placeholder="Plantation Group">
                    <option value="">Pilih</option>
                    @foreach ($pgOptions as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-ful">
                @if ($pg == null)
                <button type="submit" disabled class="btn btn-primary">Create</button>
                @else

                <a href="{{route('irigation.create', [
                'id' => $pg
                ])}}" class="btn btn-primary">Create</a>
                @endif
            </div>
        </div>
    </div>
</div>
