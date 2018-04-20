

function RequestEventsCalendar(Y)
{
    $("#EventDlg").empty();
    $("#EventDlg").append(
"    <div class=\"FWindow\" style=\"width:960px; height:600px; top:80px; left:100px;\">\n" +
"        <nav class=\"navbar navbar-dark bg-primary mb-3\">"+
"            <a id=\"CalTitle\" href=\"#\" class=\"navbar-brand\">Janvier "+Y+" </a>"+
"            <div class=\"d-flex flex-row align-items-center justify-content-between mx-sm-3\">"+
// "                <h2 id=\"E-ThisMonth\">"+Y+"</h2>"+
"                <div>"+
"                    <a id=\"btnPrevMonth\" href=\"#\" class=\"btn btn-primary\">&lt;</a>"+
"                    <a id=\"btnNextMonth\" href=\"#\" class=\"btn btn-primary\">&gt;</a>"+
"                    <a id=\"E-C-Close\" href=\"#\" class=\"btn btn-primary\">X</a>"+
"                </div>"+
"            </div>"+
"        </nav>"+
"        <div id=\"EnvDlg__Calendar-Grid\">"+
"            <br><p class=\"color-light\">TestController...</p>"+
"        </div>"+
"    </div>"
    );
    $("#E-C-Close").click(function(){
        $("#EventDlg").empty();
        console.log("Calendar Window Closed.");
        return false;
    });

    $("#btnNextMonth").click(function(){
        console.log("Next Month...");
    });

    $("#btnPrevMonth").click(function(){
        console.log("Previous Month...");
    });
}

$(document).ready(function(){
    $("#MainTitle").click(function(){
        RequestEventsCalendar("2018");
    })
});
