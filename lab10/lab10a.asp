<%
iColor = Request.QueryString("Color")

Response.Write("<html><head><style>body{background-color: " & iColor & ";}</style></head><body>")

Dim lastVisit
lastVisit = Request.Cookies("lastVisit")

If lastVisit = "" Then
        Response.Write("<h1>This is your first time visiting this page. Welcome!</h1>")
Else
        Response.Write("<h1>You previously visited this page: " & lastVisit & "</h1>")
End If

Response.Cookies("lastVisit") = Now()
Response.Cookies("lastVisit").Expires = Date + 1

Response.Write("</body></html>")
%>
