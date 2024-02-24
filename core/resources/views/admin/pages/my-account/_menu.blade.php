<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/myProfile') }}">
            <i class="ri ri-user-line"></i>
            My Profile
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ri ri-file-list-line"></i>
            Biodata
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/socialLinks') }}">
            <i class="ri ri-global-line"></i>
            Social Links
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/cv') }}">
            <i class="ri ri-file-mark-line"></i>
            CV
        </a>
    </li>
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('admin/myAgency') }}">--}}
{{--            <i class="far fa-user"></i>--}}
{{--            My Agency--}}
{{--        </a>--}}
{{--    </li>--}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/changePassword') }}">
            <i class="ri ri-key-2-line"></i>
            Change Password
        </a>
    </li>
</ul>
