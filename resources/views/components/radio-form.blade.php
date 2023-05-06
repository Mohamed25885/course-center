 @props(['name', 'values', 'parentClass' => '', 'checked' => null])
 <div class="col-md-12 col-lg-6 px-1 order-lg-6 my-2 tagser-radio {{ $parentClass }} {{ $name }}">
     <label class="input-label d-block text-start color-secondary"
         for="id-{{ $name }}">{!! $slot !!}</label>
     <div class="radio-group">
         @foreach ($values as $key => $value)
             <div class="form-check  form-check-inline">
                 <input class="form-check-input" @checked($checked === $key) value="{{ $key }}"
                     type="radio" name="{{ $name }}" id="radio-{{ $name }}-{{ $key }}">
                 <label class="form-check-label font-16" for="radio-{{ $name }}-{{ $key }}">
                     {{ $value }}
                 </label>
             </div>
         @endforeach
         @error($name)
             <div class="invalid-feedback d-block">
                 {{ @$message }}
             </div>
         @enderror
     </div>

 </div>
