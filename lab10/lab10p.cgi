#!/usr/bin/python
import cgi, cgitb

form = cgi.FieldStorage()

city = form.getvalue('city').capitalize()
province = form.getvalue('province').capitalize()
country = form.getvalue('country').capitalize()
url = form.getvalue('URL')

print 'Content-type:text/html\n\n'
print '<html>'
print '<head><style> body { font-family: Arial, sans-serif; text-align: center; } .title { font-size: 2em; color: #fff; background-color: #333; padding: 10px; } img { width: 80%; height: auto; border: 10px solid #4CAF50; } </style> </head>'
print '<body>'
print '<div class="title">%s %s %s</div>' % (city, province, country)
print '<img src="{}">'.format(url)
print '</body></html>'
