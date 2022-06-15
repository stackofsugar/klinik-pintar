<a class="row g-0 profile-item @if ($ptype == '1') acc-profile-edit @endif"
    data-kp-fieldname="{{ $fieldname }}" href="javascript:void(0)">
    <div class="col row g-0">
        <div class="col-lg-2 col-md-3 col-12 fw-bold">{{ $key }}</div>
        <div class="item-value col-md col-12 text-break">{{ $value }}</div>
    </div>
    <div class="col-2 col-sm-1 d-flex justify-content-end align-items-center"><i class="bi bi-caret-right-fill"></i></div>
</a>
@if ($havebreak == '1')
    <hr class="my-0 mx-2">
@endif
