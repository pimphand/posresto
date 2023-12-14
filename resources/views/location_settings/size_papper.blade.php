@extends('layouts.app')
@section('title', "Kertas Nota")

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kertas Nota</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    {!! Form::open(['url' => action([\App\Http\Controllers\LocationSettingsController::class, 'settingSizePaper']),
    'method' => 'get', 'id' => 'size_papper_form' ]) !!}
    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', "Ukuran Kertas" . ':*') !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::radio('size_paper','57,37', ['class' => 'form-control',
                        'placeholder' => __('lang_v1.char_per_line_help')]); !!}
                        {!! Form::label('char_per_line',"Kertas Thermal 57×37 mm" . ':*') !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::radio('size_paper','58,40', ['class' => 'form-control',
                        'placeholder' => __('lang_v1.char_per_line_help')]); !!}
                        {!! Form::label('char_per_line',"Kertas Thermal 58×40 mm" . ':*') !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::radio('size_paper','58,50', ['class' => 'form-control',
                        'placeholder' => __('lang_v1.char_per_line_help')]); !!}
                        {!! Form::label('char_per_line',"Kertas Thermal 58×50 mm" . ':*') !!}
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('wifi', "Password Wifi") !!}
                        {!! Form::text('wifi',$wifi->value, ['class' => 'form-control',
                        'placeholder' => "password wifi minimal 8 karakter"]); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('instagram', "Instagram") !!}
                        {!! Form::text('instagram',$instagram->value, ['class' => 'form-control',
                        'placeholder' => "masukan nama instagram"]); !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    </div>
                </div>


            </div>
            <div class="col-sm-12">
                <button type="button" id="save" class="btn btn-primary pull-right">@lang('messages.save')</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</section>
<!-- /.content -->
@endsection

@section('javascript')
<script>
    $("#save").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $('#size_papper_form')[0].action,
            data: {
                size_paper:'size_paper',
                size_paper_value:$('input[name="size_paper"]:checked').val(),
                wifi:$('input[name="wifi"]').val(),
                instagram:$('input[name="instagram"]').val(),

            },
            success: function (response) {
                
            }
        });
    });

    if ($('input[name="size_paper"]').val() == "{{ isset($data) ?:$data->panjang }},{{ isset($data) ?:$data->lebar }}") {
        $('input[name="size_paper"]').prop('checked', true);
    }
</script>
@endsection