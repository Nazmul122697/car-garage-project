$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $("#modal").on("shown.bs.modal", function() {});
});

//Common Create modal
$(".remark_modal").on('click',function(e){
    console.log('hello');
    var link = $(this).attr("link");
    var heading =$(this).attr("data-title");
    var id =$(this).attr("data-id");
    $.ajax({
        url: link,
        type: "get",
        data: {
            id : id
        },
        beforeSend:function(){

            //add spinner here
        },
        success: function (html) {
            // console.log(html);
            $("#modal_body").html(html);
            $("#modal_heading").html(heading);

        }
    });
});





