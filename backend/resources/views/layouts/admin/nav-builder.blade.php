<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/sale_erp_logo.png') }}" width="auto" height="auto" alt="SaleERP Logo">
    <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/sale_erp_logo.png') }}" width="auto" height="auto" alt="SaleERP Logo">
    <span class="brand-name">Sales ERP</span>
</div>
<ul class="c-sidebar-nav nav-admin">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.home')}}">
            <i class="cil-speedometer c-sidebar-nav-icon"></i>
            Top
        </a>
    </li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown abc">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            <span>データ管理</span>
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.reportManagement')}}">
                    全営業マン報告管理
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.saleReportHistory.index')}}">
                    営業マン毎の営業成績
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.sales-chart.index')}}">
                    指標ごとの営業マン成績
                </a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown abc">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            <span>営業マン管理</span>
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.user.list')}}">
                    営業マン一覧
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.user.getRegister')}}">
                    新規登録
                </a>
            </li>
        </ul>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
{{-- 
<script>
    var elements = document.getElementsByClassName('report-managerment');
    elements[0].addEventListener('click', function(){
        var url = this.getAttribute("data-href");
        window.location.href = url
        return false;
    }, false);
</script> --}}