<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>E-commerce category list</h2>
        <ol class="breadcrumb">
            <li>
                {{ link_to_route('dashboard', 'Home') }}
            </li>
            <li class="active">
                <strong>Category list</strong>
            </li>
        </ol>
    </div>
    <div class="ibox-title">
        <div class="ibox-tools">
            {{ link_to_route('dashboard.categories.create', 'Create new category',[],['class'=>'btn btn-primary btn-xs']) }}
        </div>
    </div>
</div>