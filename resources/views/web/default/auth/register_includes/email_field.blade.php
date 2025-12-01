<div class="form-group">
    <label class="input-label" for="email">{{ trans('auth.email') }} {{ !empty($optional) ? "(". trans('public.optional') .")" : '' }}:</label>
    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Differnt Email For Instructor Account" id="email" >

    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
