<div class="col-md-12">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="stat-box use-cyan shadow">
                <a href="{{ route(config('app.panel_prefix', 'panel') . '.users.index') }}">
                    <div class="stat">
                        <div class="counter-down" data-value="{{ $dataCounts['users_count'] }}"></div>
                        <div class="h3">کاربران</div>
                    </div><!-- /.stat -->
                    <div class="visual">
                        <i class="icon-people"></i>
                    </div><!-- /.visual -->
                </a>
            </div><!-- /.stat-box -->
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 col-6">
            <div class="stat-box use-blue shadow">
                <a href="{{ route(config('app.panel_prefix', 'panel') . '.articles.index') }}">
                    <div class="stat">
                        <div class="counter-down" data-value="{{ $dataCounts['articles_count'] }}"></div>
                        <div class="h3">اخبار</div>
                    </div><!-- /.stat -->
                    <div class="visual">
                        <i class="icon-globe"></i>
                    </div><!-- /.visual -->
                </a>
            </div><!-- /.stat-box -->
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 col-6">
            <div class="stat-box use-green shadow">
                <a href="{{ route(config('app.panel_prefix', 'panel') . '.categories.index') }}">
                    <div class="stat">
                        <div class="counter-down" data-value="{{ $dataCounts['categories_count'] }}"></div>
                        <div class="h3">دسته‌بندی‌ها</div>
                    </div><!-- /.stat -->
                    <div class="visual">
                        <i class="icon-grid"></i>
                    </div><!-- /.visual -->
                </a>
            </div><!-- /.stat-box -->
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 col-6">
            <div class="stat-box use-purple shadow">
                <a>
                    <div class="stat">
                        <div class="counter-down" data-value="{{ $articlesVisitsCount['all'] }}"></div>
                        <div class="h3">بازدیدکنندگان</div>
                    </div><!-- /.stat -->
                    <div class="visual">
                        <i class="icon-eye"></i>
                    </div><!-- /.visual -->
                </a>
            </div><!-- /.stat-box -->
        </div><!-- /.col-lg-3 -->
    </div><!-- /.row -->


</div><!-- /.col-md-12 -->
