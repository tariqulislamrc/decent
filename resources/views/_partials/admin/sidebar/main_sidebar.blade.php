{{-- Dashboard --}}
<li data-placement="bottom" title="Go to home">
    <a class="app-menu__item {{ Request::is('home') ? ' active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{_lang('dashboard')}}</span></a>
</li>

@if (!Request::is('admin/report*'))

    @can('employee.view')
        {{-- Employee --}}
        <li data-placement="bottom" title="Employee all System" class="treeview {{ Request::is('admin/employee*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">{{_lang('Employee')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                
                {{-- Employee Shift --}}
                @can('employee_shift.view')
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-shift*') ? 'active':''}}" href="{{ route('admin.employee-shift.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Shift')}}</a></li>
                @endcan
                
                @can('employee_category.view')
                    {{-- Employee Document Type --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-category*') ? 'active':''}}" href="{{ route('admin.employee-category.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Category')}}</a></li>
                @endcan

                @can('employee-designation.view')
                    {{-- Designation Type --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/employee/designation*') ? 'active':''}}"
                            href="{{ route('admin.designation.index') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Designation')}}</a></li>
                @endcan

                @can('employee_departmeent.view')
                    {{-- Employee Department --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/employee/department*') ? 'active':''}}"
                            href="{{ route('admin.employee.department.index') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Employee Department')}}</a></li>
                @endcan

                @can('employee_document_type.view')
                    {{-- Employee Document Type --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/employee-document-type*') ? 'active':''}}"
                            href="{{ route('admin.employee-document-type.index') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Employee Document Type')}}</a></li>
                @endcan

                @can('employee_list.view')
                {{-- Employee list --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-list*') ? 'active':''}}"
                        href="{{ route('admin.employee-list.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee')}}</a></li>
                @endcan

                @can('employee_id_card.view')
                    {{-- Employee Id Card --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-id-card*') ? 'active':''}}"
                                        href="{{ route('admin.employee-id-card.id_card') }}"><i
                                class="icon fa fa-circle-o"></i>
                            {{_lang('Employee Id Card')}}</a></li>
                @endcan

                @can('employee_leave_type.view')

                {{-- Employee Leave Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-leave-type*') ? 'active':''}}"
                        href="{{ route('admin.employee-leave-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Leave Type')}}</a></li>
                @endcan

                @can('employee_leave.view')
                    {{-- Employee Leave Type --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-leave*') ? 'active':''}}"
                                        href="{{ route('admin.employee-leave.view') }}"><i
                                class="icon fa fa-circle-o"></i>
                            {{_lang('Employee Leave')}}</a></li>
                @endcan

                @can('employee_payhead.view')
                    {{-- Employee Payhead Type --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-pay-head*') ? 'active':''}}"
                                        href="{{ route('admin.employee-pay-head.index') }}"><i
                                class="icon fa fa-circle-o"></i>
                            {{_lang('Employee Payhead')}}</a></li>
                @endcan
            </ul>
        </li>
    @endcan

    {{-- holiday --}}
    @can('holiday.view')
        <li data-placement="bottom" title="Department"><a class="app-menu__item {{ Request::is('admin/holiday*') ? ' active' : '' }}" href="{{ route('admin.holiday.index') }}"><i class="app-menu__icon fa fa-calendar" aria-hidden="true"></i><span class="app-menu__label">{{_lang('Holiday')}}</span></a></li>
    @endcan

    {{-- Employee Attendance --}}
    @can('employee_attendance.view')
        <li class="treeview {{ Request::is('admin/attendance*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">{{_lang('Attendance')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('employee_attendance_type.view')
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/attendance-attendance-type*') ? 'active':''}}" href="{{ route('admin.attendance-attendance-type.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Attendance Type')}}</a></li>
                @endcan
                            
                @can('employee_attendance.view')
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/attendance-employee-attendance*') ? 'active':''}}" href="{{ route('admin.attendance-employee-attendance.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Attendance')}}</a></li>
                @endcan
            </ul>
        </li>
    @endcan

    {{-- Employee Payroll --}}
    @can('employee_payroll.view')
            <li data-placement="bottom" title="Employee PayRoll System"><a class="app-menu__item {{ Request::is('admin/payroll*') ? ' active' : '' }}" href="{{ route('admin.payroll.view') }}"><i class="app-menu__icon fa fa-calculator" aria-hidden="true"></i><span class="app-menu__label">{{_lang('Payroll')}}</span></a></li>
    @endcan

    @can('production.view')
        {{-- User Section--}}
        <li class="treeview {{ Request::is('admin/production*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-stumbleupon"></i><span class="app-menu__label">{{_lang('Production')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('production_category.view')
                    {{-- Category --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-category*') ? 'active':''}}"
                            href="{{ route('admin.production-category.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Category')}}</a></li>
                @endcan
                @can('production_brands.view')
                    {{-- Brands --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/production-brands*') ? 'active':''}}"
                                        href="{{ route('admin.production-brands.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Brand')}}</a></li>
                @endcan
                @can('production_variation.view')
                    {{-- Variation Template --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-variation*') ? 'active':''}}"
                            href="{{ route('admin.production-variation.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Variation')}}</a></li>
                @endcan
                @can('production_ingredients.view')
                    {{-- Ingredients Categor --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-ingredients-category*') ? 'active':''}}"
                            href="{{ route('admin.production-ingredients-category.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Ingredients Category')}}</a></li>
                @endcan
                @can('unit.view')
                    {{-- Production Unit --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/production-unit*') ? 'active':''}}"
                                        href="{{ route('admin.production-unit.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Unit')}}</a></li>
                @endcan

                @can('production-raw-materials.view')
                    {{-- Production Raw Materials --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-raw-materials*') ? 'active':''}}"
                            href="{{ route('admin.production-raw-materials.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Raw Materials')}}</a></li>
                @endcan
                
                @can('production_product.view')
                    {{-- Production Product --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/production-product*') ? 'active':''}}"
                                        href="{{ route('admin.production-product.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Production Product')}}</a></li>
                @endcan
                @can('production-raw-materials.view')
                    {{-- Production Work Order --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-work-order*') ? 'active':''}}"
                            href="{{ route('admin.production-work-order.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Work Order')}}</a></li>
                @endcan
                @can('production_wop_materials.view')
                    {{-- Production wop Materials --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-wop-materials*') ? 'active':''}}"
                            href="{{ route('admin.production-wop-materials.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('WOP Materials')}}</a></li>
                @endcan

                @can('production_purchase.view')
                    {{-- Production Purchase --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/production-purchase*') ? 'active':''}}"
                            href="{{ route('admin.production-purchase.index') }}"><i
                                class="icon fa fa-circle-o"></i> {{_lang('Purchase List')}}</a></li>
                @endcan
            </ul>
        </li>
    @endcan


    @can('expense.view')
        {{-- Expense Section--}}
        <li class="treeview {{ Request::is('admin/department*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-pie-chart"
                                                                         aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('Department')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('expenseCategory.view')
                    {{-- Expense Category--}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/department') ? 'active':''}}"
                           href="{{ route('admin.department.index') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Department')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- Expense --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/department/report/create') ? 'active':''}}"
                           href="{{ route('admin.report.create') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Product Report')}}
                        </a>
                    </li>
                @endcan
                @can('expenseCategory.view')
                    {{-- Expense --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/department/report/material*') ? 'active':''}}"
                           href="{{ route('admin.department.material.report') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Material Report')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('expense.view')
        {{-- Expense Section--}}
        <li class="treeview {{ Request::is('admin/request*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"
                                                                         aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('Store')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('expenseCategory.view')
                    {{-- Expense Category--}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/request') ? 'active':''}}"
                           href="{{ route('admin.request.index') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('All Request')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- Expense --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/request/create') ? 'active':''}}"
                           href="{{ route('admin.request.create') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Send Store Request')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('setting.view')
        {{-- Settings --}}
        <li class="treeview {{ Request::is('admin/setting*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">{{_lang('Settings')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('setting.view')
                    {{-- General Settings --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/general-setting*') ? 'active':''}}"
                            href="{{ route('admin.setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('General Settings')}}</a></li>
                @endcan

                @can('system_configuration.view')
                    {{-- System Configuration --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/system-setting*') ? 'active':''}}"
                            href="{{ route('admin.system.setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('System Configuration ')}}</a></li>
                @endcan

                @can('mail_configuration.view')
                    {{-- Mail Configuration --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/mail-setting*') ? 'active':''}}"
                            href="{{ route('admin.mail.setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Mail Configuration ')}}</a></li>
                @endcan

                @can('sms_configuration.view')
                    {{-- SMS Configuration --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/sms-setting*') ? 'active':''}}"
                            href="{{ route('admin.sms.setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('SMS Configuration ')}}</a></li>
                @endcan

                @can('module_configuration.view')
                    {{-- Module Configuration --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/module-setting*') ? 'active':''}}"
                            href="{{ route('admin.module.setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Module Configuration ')}}</a></li>
                @endcan

                @can('id_card_template.view')
                    {{-- Module Configuration --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/setting/id-card-template*') ? 'active':''}}"
                            href="{{ route('admin.id-card-template') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Id Card Template ')}}</a></li>
                @endcan

                @can('member_setting.view')
                    {{-- Member Settings Configuration --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/member*') ? 'active':''}}"
                                        href="{{ route('admin.member-setting') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('Member')}}</a></li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('client.view')
        {{-- Database Backup --}}
        <li><a class="app-menu__item {{ Request::is('admin/client') ? ' active' : '' }}"
               href="{{ route('admin.client.index') }}"><i class="app-menu__icon fa fa-user-o"></i><span
                    class="app-menu__label">{{_lang('Client')}}</span></a></li>
    @endcan


        <li class="treeview {{ Request::is('admin/sale*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-minus-circle" aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('Sale Pos')}}</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li class="mt-1">
                    <a class="treeview-item {{Request::is('admin/sale/pos/create') ? 'active':''}}" href="{{ route('admin.sale.pos.create') }}">
                        <i class="icon fa fa-circle-o"></i>
                        {{_lang('Pos')}}
                    </a>
                </li>

                <li class="mt-1">
                    <a class="treeview-item {{Request::is('admin/sale/add') ? 'active':''}}" href="{{ route('admin.sale.add') }}">
                        <i class="icon fa fa-circle-o"></i>
                        {{_lang('Add Sale')}}
                    </a>
                </li>
                <li class="mt-1">
                    <a class="treeview-item {{Request::is('admin/admin/sale/pos') ? 'active':''}}" href="{{ route('admin.sale.pos.index') }}">
                        <i class="icon fa fa-circle-o"></i>
                        {{_lang('All Sale')}}
                    </a>
                </li>

                <li class="mt-1">
                    <a class="treeview-item {{Request::is('admin/admin/return') ? 'active':''}}" href="{{ route('admin.sale.return.index') }}">
                        <i class="icon fa fa-circle-o"></i>
                        {{_lang('Sale Return List')}}
                    </a>
                </li>
            </ul>
        </li>

        @can('language.view')
        {{-- Language --}}
        <li><a class="app-menu__item {{ Request::is('admin/language*') ? ' active' : '' }}"
               href="{{ route('admin.language') }}"><i class="app-menu__icon fa fa-language"
                                                       aria-hidden="true"></i><span
                    class="app-menu__label">{{_lang('language')}}</span></a></li>
    @endcan

    @can('user.view')
        {{-- User Section--}}
        <li class="treeview {{ Request::is('admin/user*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                                                                                       data-toggle="treeview"><i
                    class="app-menu__icon fa fa-user-times"></i><span
                    class="app-menu__label">{{_lang('role_and_permission')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('role.view')
                    {{-- Role & Permission --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/user/role*') ? 'active':''}}"
                                        href="{{ route('admin.user.role') }}"><i class="icon fa fa-circle-o"></i>
                            {{_lang('role_permission')}}</a></li>
                @endcan

                @can('user.view')
                    {{-- User --}}
                    <li class="mt-1"><a
                            class="treeview-item {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}"
                            href="{{ route('admin.user.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('user')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('marketing.view')
        {{-- User Section--}}
        <li class="treeview {{ Request::is('admin/emailmarketing*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-envelope"></i><span
                    class="app-menu__label">{{_lang('Email Marketing')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('role.view')
                    {{-- Role & Permission --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/emailmarketing/template*') ? 'active':''}}"
                            href="{{ route('admin.emailmarketing.template.index') }}"><i
                                class="icon fa fa-circle-o"></i>
                            {{_lang('Email Template')}}</a></li>
                @endcan

                @can('user.view')
                    {{-- User --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/emailmarketing/media*') ?'active':''}}"
                            href="{{ route('admin.emailmarketing.media.index') }}"><i
                                class="icon fa fa-circle-o"></i>{{_lang('Media')}}</a>
                    </li>
                @endcan

                @can('user.view')
                    {{-- User --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/emailmarketing/sendmail/create') ?'active':''}}"
                            href="{{ route('admin.emailmarketing.sendmail.create') }}"><i
                                class="icon fa fa-circle-o"></i>{{_lang('Send Mail')}}</a>
                    </li>
                @endcan

                @can('user.view')
                    {{-- User --}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/emailmarketing/email-history') ?'active':''}}"
                            href="{{ route('admin.emailmarketing.email_history') }}"><i
                                class="icon fa fa-circle-o"></i>{{_lang('Email History')}}</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan


    @can('eCommerce.view')
        {{-- eCommerce Section--}}
        <li class="treeview {{ Request::is('admin/eCommerce*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">{{_lang('E-Commerce')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- All Ecommerce page main banner --}}
                @can('page_banner.view')
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/page-banner*') ? 'active':''}}" href="{{ route('admin.eCommerce.page-banner.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Page Banner')}}</a></li>
                @endcan


                @can('role.view')
                    {{-- Add Slider  --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/slider*') ? 'active':''}}" href="{{ route('admin.eCommerce.slider.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('All Slider')}}</a></li>
                @endcan

                @can('role.view')
                    {{-- Home Page Image  --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/home-page*') ? 'active':''}}" href="{{ route('admin.eCommerce.home-page.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Home Page')}}</a></li>
                @endcan

                @can('role.view')
                    {{-- Add Coupons --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/coupons*') ? 'active':''}}" href="{{ route('admin.eCommerce.coupons.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('All Coupons')}}</a></li>
                @endcan

                @can('role.view')
                    {{-- Add Coupons --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/shipping-charge*') ? 'active':''}}" href="{{ route('admin.eCommerce.shipping-charge.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Shipping Charge')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Privacy Policy--}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/privacy-policy/index*') ? 'active':''}}" href="{{ route('admin.eCommerce.privacy-policy.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Privacy Policy')}}</a></li>
                @endcan

                @can('role.view')
                    {{--about us --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/about-us/index*') ? 'active':''}}" href="{{ route('admin.eCommerce.about-us.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('About Us')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Our Team--}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/our-team*') ? 'active':''}}"
                                        href="{{ route('admin.eCommerce.our-team.index') }}"><i
                                class="icon fa fa-circle-o"></i>{{_lang('Our Team')}}</a></li>
                @endcan
                @can('role.view')
                    {{--Our workspace--}}
                    <li class="mt-1"><a
                            class="treeview-item {{Request::is('admin/eCommerce/our-workspace*') ? 'active':''}}"
                            href="{{ route('admin.eCommerce.our-workspace.index') }}"><i
                                class="icon fa fa-circle-o"></i>{{_lang('Our Workspac')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Contact Message --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/contact-msg*') ? 'active':''}}" href="{{ route('admin.eCommerce.contact-msg.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Contact Message')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Product Rating --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/product-rating*') ? 'active':''}}" href="{{ route('admin.eCommerce.product-rating.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Product Rating')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Term and Condition --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/terams-conditions/index*') ? 'active':''}}" href="{{ route('admin.eCommerce.terams-conditions.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Terms & Conditions')}}</a></li>
                @endcan

                @can('role.view')
                    {{--Seo --}}
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/seo/index*') ? 'active':''}}" href="{{ route('admin.eCommerce.seo.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('SEO')}}</a></li>
                @endcan

                {{--Ecommerce Orders --}}
                @can('ecommerce_order.view')
                    <li class="mt-1"><a class="treeview-item {{Request::is('admin/eCommerce/orders*') ? 'active':''}}" href="{{ route('admin.eCommerce.order.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('Orders')}}</a></li>
                @endcan

            </ul>
        </li>
    @endcan


    @can('expense.view')
        {{-- Expense Section--}}
        <li class="treeview {{ Request::is('admin/smsmerketing*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-commenting"
                                                                         aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('SMS Marketing')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('expenseCategory.view')
                    {{-- Expense Category--}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/smsmerketing/sendsms*') ? 'active':''}}"
                           href="{{ route('admin.smsmerketing.sendsms.create') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Send Sms')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- Expense --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/smsmerketing/sms-history') ? 'active':''}}"
                           href="{{ route('admin.smsmerketing.sms_history') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Sms History')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('expense.view')
        {{-- Expense Section--}}
        <li class="treeview {{ Request::is('admin/expense*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-minus-circle"
                                                                         aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('Expense')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('expenseCategory.view')
                    {{-- Expense Category--}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/expense/category') ? 'active':''}}"
                           href="{{ route('admin.expense.category.index') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Expense Category')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- Expense --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/expense/ex') ? 'active':''}}"
                           href="{{ route('admin.expense.ex.index') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Expense')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('backup.view')
        {{-- Database Backup --}}
        <li><a class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}"
               href="{{ route('admin.backup') }}"><i class="app-menu__icon fa fa-database"></i><span
                    class="app-menu__label">{{_lang('backup')}}</span></a></li>
    @endcan

    <li><a target="_blank" class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}"
           href="https://fontawesome.com/v4.7.0/icons/"><i class="app-menu__icon fa fa-font-awesome"></i><span
                class="app-menu__label">{{_lang('Font Awosome')}}</span></a></li>


                
            {{-- Account Section--}}
        <li class="treeview {{ Request::is('admin/accounting*') ? ' is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-minus-circle" aria-hidden="true"></i>
                <span class="app-menu__label">{{_lang('Accounting')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('expenseCategory.view')
                    {{-- Expense Category--}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/accounting/account*') ? 'active':''}}"
                           href="{{ route('admin.accounting.account.index') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Account List')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- payment accunt --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/accounting/payment/account') ? 'active':''}}"
                           href="{{ route('admin.accounting.payment_account') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Payment Account')}}
                        </a>
                    </li>
                @endcan

                @can('expenseCategory.view')
                    {{-- payment accunt --}}
                    <li class="mt-1">
                        <a class="treeview-item {{Request::is('admin/accounting/cashflow') ? 'active':''}}"
                           href="{{ route('admin.accounting.cashflow') }}">
                            <i class="icon fa fa-circle-o"></i>
                            {{_lang('Cashflow')}}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

@endif
<li><a class="app-menu__item {{ Request::is('admin/report') ? ' active' : '' }}"
       href="{{ route('admin.report.index') }}"><i class="app-menu__icon fa fa-registered"></i><span class="app-menu__label">{{_lang('Report')}}</span></a></li>
@if (Request::is('admin/report*'))
    <li class="treeview {{ Request::is('admin/report/depertment*') ? ' is-expanded' : '' }}">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-sort-amount-desc" aria-hidden="true"></i>
            <span class="app-menu__label">{{_lang('Department Report')}}</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="mt-1">
                <a class="treeview-item {{Request::is('admin/report/depertment/product/report') ? 'active':''}}"
                   href="{{ route('admin.report.depertment.product_report') }}">
                    <i class="icon fa fa-circle-o"></i>
                    {{_lang('Product Report')}}
                </a>
            </li>
            <li class="mt-1">
                <a class="treeview-item {{Request::is('admin/report/depertment/raw-material/report') ? 'active':''}}"
                   href="{{ route('admin.report.depertment.raw_material_report') }}">
                    <i class="icon fa fa-circle-o"></i>
                    {{_lang('Material Report')}}
                </a>
            </li>
            <li class="mt-1">
                <a class="treeview-item {{Request::is('admin/report/depertment/product/report-details') ? 'active':''}}"
                   href="{{ route('admin.report.depertment.product_report_details') }}">
                    <i class="icon fa fa-circle-o"></i>
                    {{_lang('Product Report Details')}}
                </a>
            </li>
            <li class="mt-1">
                <a class="treeview-item {{Request::is('admin/report/depertment/raw-material/report-details') ? 'active':''}}"
                   href="{{ route('admin.report.depertment.raw_material_report_details') }}">
                    <i class="icon fa fa-circle-o"></i>
                    {{_lang('Material Report Details')}}
                </a>
            </li>
            <li class="mt-1">
                <a class="treeview-item {{Request::is('admin/report/depertment/store-material/report') ? 'active':''}}"
                   href="{{ route('admin.report.depertment.store_material_report') }}">
                    <i class="icon fa fa-circle-o"></i>
                    {{_lang('Store Material Report')}}
                </a>
            </li>
        </ul>
    </li>

    {{-- Ecommerce Report --}}
    <li><a class="app-menu__item {{ Request::is('admin/report/eCommerce-report') ? ' active' : '' }}" href="{{ route('admin.report.eCommerce-report.index') }}"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">{{_lang('eCommerce Report')}}</span></a></li>
@endif
