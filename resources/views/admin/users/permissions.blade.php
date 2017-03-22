@if($permissions)
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            دسترسی های کاربر

        </header>
        <ul class="list-group">
            @foreach($permissions as $key=>$permission)
            <li class="list-group-item">{{$permission}}</li>
           @endforeach
        </ul>

    </section>
</div>
    @else
<p>این کاربر هیچ دسترسی ندارد</p>
    @endif