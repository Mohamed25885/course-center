 @props(['placeholder' => '', 'name', 'grid' => 'col-12 col-md-6'])

 <div class="{{ $grid }}">
     <div class="input input-wrapper">
         <textarea name="{{ $name }}" id="" placeholder="{{ $placeholder }}" class="form-control input-item"
             cols="30" rows="5">{{ $slot }}</textarea>
         @error($name)
             <div class="invalid-feedback d-block">
                 {{ @$message }}
             </div>
         @enderror
     </div>
 </div>
