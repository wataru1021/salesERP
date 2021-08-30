<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/sale_erp_logo_minimize.png') }}" width="auto"
        height="auto" alt="SaleERP Logo">
    <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/sale_erp_logo_minimize.png') }}" width="auto"
        height="auto" alt="SaleERP Logo">
    <span class="brand-name">Sales ERP</span>
</div>
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('logout') }}">
            <i class="cil-account-logout c-sidebar-nav-icon"></i>
            ログアウト
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('dailyReport.create') }}">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            本日の日報
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('sale.reportHistories') }}">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            過去の成績
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('sales.appointments.getCreate') }}">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            予定を追加する
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('sales.appointments.index') }}">
            <i class="cil-calculator c-sidebar-nav-icon"></i>
            アポイント管理
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('sales.changePassword.index')}}">
            <i class="cil-sync c-sidebar-nav-icon"></i>
            パスワード変更
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized"></button>
</div>
