 @props(['type', 'name', 'clabel' => '', 'grid' => 'col-12 col-md-6 col-lg-4', 'readonly' => false, 'value' => null])

 <div class="{{ $grid }} px-1 my-2">
     <label class="input-label d-block text-start font-16 color-secondary {{ $clabel }}"
         for="{{ $name }}">{{ $slot }}</label>
     <input type="{{ $type }}" value="{{ $value }}" {{ !empty($readonly) ? 'readonly' : '' }}
         name="{{ $name }}" id="{{ $name }}" class="form-control">
        @error($name)
             <div class="invalid-feedback d-block">
                 {{ @$message }}
             </div>
         @enderror
 </div>
