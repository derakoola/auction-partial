<div class="row" id="FirstRow">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
              اطلاعات کاربر

            </header>
            <table class="table table-striped border-top" id="sample_1">
                    <tbody>

                    <tr>
                        <td>نام</td><td class="hidden-phone" style="">{{$user['firstName'] }}</td>
                    </tr>
                    <tr>
                        <td>نام خانوادگی</td><td class="hidden-phone" style="">{{$user['lastName']}}</td>
                    </tr>
                    <tr>
                        <td>ایمیل</td><td class="hidden-phone" style="">{{$user['_email'] }}</td>
                    </tr>
                    <tr>
                        <td>نام کاربری</td>
                        <td class="hidden-phone" style="">{{$user['username'] }}</td>
                    </tr>
                    <tr>
                        <td>شماره تماس</td>
                        <td class="hidden-phone" style="">{{$user['_phone'] }}</td>
                    </tr>
                    </tbody>
            </table>
        </section>
    </div>
</div>
