<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                لیست پیشنهاد دهنده ها

            </header>
            <table class="table table-striped border-top" id="sample_1">
                <thead>
                <tr>
                    <th style="width: 8px;">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bidders as $bidder)
                    <tr class="odd gradeX" id="{{$bidder['user']['userId']}}">
                        <td>
                        <td>{{ $bidder['user']['firstName']}}</td>
                        <td class="hidden-phone" style="">{{$bidder['user']['lastName'] }}</td>

                        <td class="hidden-phone">
                            <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
