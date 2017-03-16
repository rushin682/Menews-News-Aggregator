$(document).ready(function(){
    $("#homepage").addClass("current");
     /*var t =$("#Home").html();
     $("#box").html(t);*/
    $("button").click(function(){
        var sidebar = $(this).attr('class');
        if(sidebar=="mv"){
          var x = $(this).html();
        var e = $("#"+x).html();
        $("#box").html(e);
        $(".current").removeClass("current");
        $(this).addClass("current");
        }
        else if(sidebar=="mh"){
            var x=$(this).html();
            if(x=="Login") {
            var log=document.getElementById("popup1");
            log.style.display="initial";
            log.style.opacity="1";             
            }
            else if(x=="SignUp"){
                var log=document.getElementById("popup2");
                log.style.display="initial";
                log.style.opacity="1";
            }
             else if(x=="ContactUs"){
             var log=document.getElementById("popup3");
                 log.style.display="initial";
                log.style.opacity="1";
             }
        }
    });
});
    
        function LValidate()
    {
        //validate
    }
    function SValidate()
    {
        
    }
        function Cancel(hellid)
    {
         //var c = $(this).attr('id');
        //$("#box").html(c);
        //if(c==".Lcancel"){
        if(hellid == "Lcancel"){
            var log=document.getElementById("popup1");
            log.style.display="none";
            log.style.opacity="0";
        }
              
    //    }
        else if(hellid == "Scancel"){
            var log=document.getElementById("popup2");
            log.style.display="none";
            log.style.opacity="0";
        }
        else if(hellid == "Ccancel"){
            var log=document.getElementById("popup3");
            log.style.display="none";
            log.style.opacity="0";
        }
        
    }

        