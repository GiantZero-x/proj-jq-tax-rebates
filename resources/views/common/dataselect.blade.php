<div class="col-sm-{{ $col ?? 4 }} m-t-xs">
    <div class="form-group">
<label for="{{ $var }}" class="col-sm-4 control-label necessary_front">{{ $label }}</label>
        <div class="col-sm-8">
            {{ Form::select($var, ${$var}, $obj ? $obj->{$var} : '', [
                'id' => $var,
                'class' => 'form-control',
                'data-parsley-required',
                'data-parsley-trigger' => 'change',
                $disabled,
            ])}}
        </div>
    </div>
</div>