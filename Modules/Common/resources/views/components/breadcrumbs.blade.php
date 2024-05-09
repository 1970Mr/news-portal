<!-- BEGIN BREADCRUMB -->
<div class="col-md-12">
    <div class="breadcrumb-box shadow">
        <ul class="breadcrumb">
            @if(!$noprefix)
                <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.index') }}">پیشخوان</a></li>
            @endif
            {{ $slot }}
        </ul>
        <div class="breadcrumb-left">
            {{ jalalian()->now()->format('l، Y/m/d') }}
            <i class="icon-calendar"></i>
        </div><!-- /.breadcrumb-left -->
    </div><!-- /.breadcrumb-box -->
</div><!-- /.col-md-12 -->
<!-- END BREADCRUMB -->
