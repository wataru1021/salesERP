<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/sale_erp_logo_minimize.png') }}" width="auto" height="auto" alt="SaleERP Logo">
    <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/sale_erp_logo_minimize.png') }}" width="auto" height="auto" alt="SaleERP Logo">
    <span class="brand-name">Sales ERP</span>
</div>
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href= "{{ route('logout') }}">
            <i class="cil-account-logout c-sidebar-nav-icon"></i>
            ログアウト
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>