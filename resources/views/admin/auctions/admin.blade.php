<div id="alert" class="alert alert-success" style="display: none;position: fixed;top:0px;left:0px;z-index: 1000000;"> </div>

<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    درج دسته بندی
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="post" id="AddAdminForm">
                            {{csrf_field()}}
                            <div class="form-group {{ $errors->has('userId') ? ' has-error' : '' }}">
                                <label for="userId" class="control-label col-lg-2">نام کاربر</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('userId') ? ' error' : '' }}"
                                           name="user" id="user" type="text" value="{{ old('user') }}">
                                    <input type="hidden" name="userId" id="userId" value="{{ old('userId') }}">

                                    @if ($errors->has('userId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userId') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="permissions" class="control-label col-lg-2">دسترسی ها</label>
                                <div class="col-lg-10">
                                    <select multiple class="form-control m-bot15 {{ $errors->has('permissions') ? ' error' : '' }}"
                                            name="permissions[]">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getPermissions() as $key=>$permission)
                                            <option value="{{$key}}"
                                            >{{$permission}}</option>

@endforeach
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('permissions') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-danger" type="submit">ذخیره</button>
                                    <button class="btn btn-default" type="button">انصراف</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>

{{--<script>--}}
    {{--@foreach(\App\Helpers\Admin\AdminHelper::getPermissions() as $permission)--}}

    {{--$('#permissions').append('<option> {{$permission}}</option>');--}}
    {{--@endforeach--}}

{{--</script>--}}
    <script type="text/javascript">
        $('#user').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        {{--var per = [];--}}
                        {{--var permissions = [];--}}

                                {{--@foreach(\App\Helpers\Admin\AdminHelper::getPermissions() as $permission)--}}
                        {{--var permissions = $permission;--}}
                        {{--$.each(item._permissions, function (permissions) {--}}
                            {{--if (permissions == '{{$permission}}') {--}}

                                {{--per = '<option> {{$permission}} </option>'--}}
                            {{--}--}}
                            {{--else {--}}
                                {{--per = '<option> {{$permission}} </option>';--}}

                            {{--}--}}
                        {{--});--}}
                        {{--@endforeach--}}

                        {{--$('#permissions').append(per);--}}
                        console.log(json);
                        response($.map(json, function (item) {
                             $('#userId').val(item._id);
                            return {
                                label: item.firstName + ' ' + item.lastName,
                                value: item.firstName + ' ' + item.lastName,
                            }
                        }));
                    }
                });
            },
//                select: function (item) {
//                    $('#userId').val(item.firstName + ' ' + item.lastName);
//                }
        });
    </script>

    <script>
        // this is the id of the form
        $("#AddAdminForm").submit(function(e) {

            var url =  '{{url('admin/auctions/admin/add' , $auction_id)}}';

            $.ajax({
                type: "POST",
                url: url,
                data: $("#AddAdminForm").serialize(), // serializes the form's elements.
                success: function (response) {
                    $('#alert').html(response);
                    $('#alert').css('display','block');
                },
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    </script>