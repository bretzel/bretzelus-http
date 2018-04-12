
function RequestEventsCalendar(Y)
{
    $("#EventDlg").empty();
    $("#EventDlg").append(
        "    <div class=\"FWindow\" style=\"width:960px; height:600px; top:80px; left:100px;\">\n" +
        "        <nav class=\"navbar navbar-dark color-dark mb-3\">\n" +
        "            <a id=\"CalTitle\" href=\"#\" class=\"navbar-brand\">&Eacute;v&eacute;nement:</a>\n" +
        "        </nav>\n" +
        "        <div id='#Window-Cal"+Y+"-With-Events'></div>"+
        "    </div>"
    );
    $("#Window-Cal"+Y+"-With-Events").append(" <p id='Clickable'>#Window-Cal"+Y+"-With-Events</p>");

    $("#MSG").click(function(){$("#EventDlg").empty()});

}

$(document).ready(function(){
    $("#MainTitle").click(function(){
        RequestEventsCalendar("2018");
    })
});
