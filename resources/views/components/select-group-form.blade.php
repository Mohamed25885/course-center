@props(['name', 'grid' => 'col-12 col-md-6', 'values',  'selected' => null])

<div class="{{ $grid }}">
    <div class="input input-wrapper">
        @if ($slot)
            <label for="{{ $name }}" class="font-14">
                {{ $slot }}
            </label>
        @endif
        <select name="{{ $name }}" id="{{ $name }}" class="my-select form-control input-item">
            <option value="" disabled selected></option>
            @foreach ($values as $group => $data)
                <optgroup label="{{$group}}">
                    @foreach ($data as $key=>$value)
                        <option value="{{ $key }}" @selected($key == $selected)>{{ $value }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
         @error($name)
             <div class="invalid-feedback d-block">
                 {{ @$message }}
             </div>
         @enderror
    </div>
</div>
