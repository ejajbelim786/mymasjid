<div class="sb-sidenav-menu-heading">{{ _lang('NAVIGATIONS') }}</div>



<a class="nav-link" href="{{ route('dashboard') }}">

    <div class="sb-nav-link-icon"><i class="ti-dashboard"></i></div>

    {{ _lang('Dashboard') }}

</a>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contacts" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-id-badge"></i></div>

    {{ _lang('Members') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="contacts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('contacts.index') }}">{{ _lang('Members List') }}</a>

        <a class="nav-link" href="{{ route('contacts.create') }}">{{ _lang('Add New') }}</a>

        <a class="nav-link" href="{{ route('categories.index') }}">{{ _lang('Category') }}</a>
        
        <a class="nav-link" href="{{ route('contact_groups.index') }}">{{ _lang('Members Group') }}</a>

    </nav>

</div>

<!---

<a class="nav-link" href="{{ route('products.index') }}">

    <div class="sb-nav-link-icon"><i class="ti-shopping-cart"></i></div>

    {{ _lang('Products') }}

</a>



<a class="nav-link" href="{{ route('services.index') }}">

    <div class="sb-nav-link-icon"><i class="ti-agenda"></i></div>

    {{ _lang('Services') }}

</a>









<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase_orders" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-bag"></i></div>

    {{ _lang('Purchase') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="purchase_orders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('purchase_orders.index') }}">{{ _lang('Purchase Orders') }}</a>

        <a class="nav-link" href="{{ route('purchase_orders.create') }}">{{ _lang('New Purchase Order') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchase_returns" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-back-left"></i></div>

    {{ _lang('Return') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="purchase_returns" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('purchase_returns.index') }}">{{ _lang('Purchase Return') }}</a>

        <a class="nav-link" href="{{ route('sales_returns.index') }}">{{ _lang('Sales Return') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-shopping-cart-full"></i></div>

    {{ _lang('Sales') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="sales" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('invoices.create') }}">{{ _lang('Create Invoice') }}</a>

        <a class="nav-link" href="{{ route('invoices.index') }}">{{ _lang('Invoice List') }}</a>

        <a class="nav-link" href="{{ route('quotations.create') }}">{{ _lang('Create Quotation') }}</a>

        <a class="nav-link" href="{{ route('quotations.index') }}">{{ _lang('Quotation List') }}</a>

    </nav>

</div>

---->



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounts" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-credit-card"></i></div>

    {{ _lang('Accounts') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="accounts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('accounts.index') }}">{{ _lang('All Account') }}</a>

        <a class="nav-link" href="{{ route('accounts.create') }}">{{ _lang('Add New Account') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transactions" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-receipt"></i></div>

    {{ _lang('Transactions') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="transactions" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('income.index') }}">{{ _lang('Income/Deposit') }}</a>

        <a class="nav-link" href="{{ route('expense.index') }}">{{ _lang('Expense') }}</a>

        <a class="nav-link" href="{{ route('transfer.create') }}">{{ _lang('Transfer') }}</a>

        <a class="nav-link" href="{{ route('income.income_calendar') }}">{{ _lang('Income Calendar') }}</a>

        <a class="nav-link" href="{{ route('expense.expense_calendar') }}">{{ _lang('Expense Calendar') }}</a>

    </nav>

</div>

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#suppliers" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-truck"></i></div>

    {{ _lang('Donate Items') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="suppliers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('suppliers.index') }}">{{ _lang('Item List') }}</a>

        <a class="nav-link" href="{{ route('suppliers.create') }}">{{ _lang('Add New Items') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#recurring_transaction" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-wallet"></i></div>

    {{ _lang('Recurring Transaction') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="recurring_transaction" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('repeating_income.create') }}">{{ _lang('Add Repeating Income') }}</a>

        <a class="nav-link" href="{{ route('repeating_income.index') }}">{{ _lang('Repeating Income List') }}</a>

        <a class="nav-link" href="{{ route('repeating_expense.create') }}">{{ _lang('Add Repeating Expense') }}</a>

        <a class="nav-link" href="{{ route('repeating_expense.index') }}">{{ _lang('Repeating Expense List') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-bar-chart"></i></div>

    {{ _lang('Reports') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

      <a class="nav-link" href="{{ route('reports.account_statement') }}">{{ _lang('Account Statement') }}</a>

	  <a class="nav-link" href="{{ route('reports.income_report') }}">{{ _lang('Income Report') }}</a>

	  <a class="nav-link" href="{{ route('reports.expense_report') }}">{{ _lang('Expense Report') }}</a>

	  <a class="nav-link" href="{{ route('reports.transfer_report') }}">{{ _lang('Transfer Report') }}</a>

	  <a class="nav-link" href="{{ route('reports.income_vs_expense') }}">{{ _lang('Income VS Expense') }}</a>

	  <a class="nav-link" href="{{ route('reports.report_by_payer') }}">{{ _lang('Report by Payer') }}</a>

	  <a class="nav-link" href="{{ route('reports.report_by_payee') }}">{{ _lang('Report by Payee') }}</a>

	  <a class="nav-link" href="{{ route('reports.report_contacts') }}">{{ _lang('Member List Report') }}</a>

    </nav>

</div>





<!---

<div class="sb-sidenav-menu-heading">{{ _lang('Company Settings') }}</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staffs" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-user"></i></div>

    {{ _lang('Staff Management') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="staffs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('staffs.index') }}">{{ _lang('All Staff') }}</a>

        <a class="nav-link" href="{{ route('staffs.create') }}">{{ _lang('Add New') }}</a>

        <a class="nav-link" href="{{ route('roles.index') }}">{{ _lang('Staff Roles') }}</a>

        <a class="nav-link" href="{{ route('permission.index') }}">{{ _lang('Access Control') }}</a>

    </nav>

</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#company_settings" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-settings"></i></div>

    {{ _lang('Company Settings') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="company_settings" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('company.change_settings') }}">{{ _lang('Company Settings') }}</a>

        <a class="nav-link" href="{{ route('company_email_template.index') }}">{{ _lang('Email Template') }}</a>

        <a class="nav-link" href="{{ route('product_units.index') }}">{{ _lang('Product Unit') }}</a>

    </nav>

</div>

---->

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaction_settings" aria-expanded="false"

    aria-controls="collapseLayouts">

    <div class="sb-nav-link-icon"><i class="ti-credit-card"></i></div>

    {{ _lang('Transaction Settings') }}

    <div class="sb-sidenav-collapse-arrow"><i class="ti-angle-down"></i></div>

</a>

<div class="collapse" id="transaction_settings" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

    <nav class="sb-sidenav-menu-nested nav">

        <a class="nav-link" href="{{ route('chart_of_accounts.index') }}">{{ _lang('Income & Expense Types') }}</a>

        <a class="nav-link" href="{{ route('payment_methods.index') }}">{{ _lang('Payment Methods') }}</a>

        <a class="nav-link" href="{{ route('taxs.index') }}">{{ _lang('Tax Settings') }}</a>

    </nav>

</div>





