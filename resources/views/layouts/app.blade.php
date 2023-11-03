<!--
=========================================================
* Soft UI Dashboard PRO - v1.1.0
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-dashboard-pro
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

    @include('../admins/layouts/head')

    <body class="g-sidenav-show  bg-gray-100">
        @include('../admins/layouts/aside')
        <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('../admins/layouts/navbar')
        </div>

        {{ $slot }}

        @include('../admins/layouts/scripts')
        @push('scripts')
    </body>

</html>
