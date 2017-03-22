$(document).ready(function() {

    //animation
    $(".animUp").animate({top: "0", opacity: "1"}, 700, function () {
        $(".animLeft").animate({left: "0", opacity: "1"}, 700, function () {
            $(".animRight").animate({right: "0", opacity: "1"}, 700, function () {
                $(".animBottom").animate({bottom: "0", opacity: "1"}, 700);
            });
        });
    });

    // selecter plugin
    // $("select").selecter();

    $("input.iradio_flat").iCheck({radioClass: "iradio_flat", increaseArea: "20%"});
    $("input.icheckbox_flat").iCheck({checkboxClass: "icheckbox_flat", increaseArea: "0%"});
})