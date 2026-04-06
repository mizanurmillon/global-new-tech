<style>
    .metric-card {
        background: white;
        border: #DFE1E7 1px solid;
        padding: 15px 15px;
    }

    .icon-align {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        padding: 20px;
        border-radius: 8px;
        border: #DFE1E7 solid 1px;
    }
</style>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="rounded-lg metric-card">
            <div class="simgle_monitor_count metric-label d-flex justify-content-between">
                <div class="icon-align"><i class="fa fa-users fa-lg text-primary"></i></div>
                <div><a href="{{ route('admin.team.index') }}"><i class="fa fa-arrow-right fa-lg text-muted2"></i></a></div>
            </div>
            <h4 class="metric-value counter mt-2">{{ number_format($total_users ?? 0) }}</h4>
            <small class="text-muted2">Total Members</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="rounded-lg metric-card">
            <div class="simgle_monitor_count metric-label d-flex justify-content-between">
                <div class="icon-align"><i class="fas fa-building fa-lg text-primary"></i></div>
                <div><a href="{{ route('admin.brands.index') }}"><i class="fa fa-arrow-right fa-lg text-muted2"></i></a></div>
            </div>
            <h4 class="metric-value counter mt-2">{{ number_format($total_brands ?? 0) }}</h4>
            <small class="text-muted2">Total Brands</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="rounded-lg metric-card">
            <div class="simgle_monitor_count metric-label d-flex justify-content-between">
                <div class="icon-align"><i class="fas fa-blog fa-lg text-primary"></i></div>
                <div><a href="{{ route('admin.blogs.index') }}"><i class="fa fa-arrow-right fa-lg text-muted2"></i></a></div>
            </div>
            <h4 class="metric-value counter mt-2">{{ number_format($total_blogs ?? 0) }}</h4>
            <small class="text-muted2">Total Blogs Posted</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="rounded-lg metric-card">
            <div class="simgle_monitor_count metric-label d-flex justify-content-between">
                <div class="icon-align"><i class="fa-solid fa-screwdriver-wrench fa-lg text-primary"></i></div>
                <div><a href="{{ route('admin.services.index') }}"><i class="fa fa-arrow-right fa-lg text-muted2"></i></a></div>
            </div>
            <h4 class="metric-value counter mt-2">{{ number_format($total_services ?? 0) }}</h4>
            <small class="text-muted2">Total Services</small>
        </div>
    </div>
</div>
