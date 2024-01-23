#!/usr/local/bin/ruby -w
require 'cgi'

cgi = CGI.new

# Retrieve form data
city = cgi.params['city'][0].capitalize
province = cgi.params['province'][0].capitalize
country = cgi.params['country'][0].capitalize
url = cgi.params['URL'][0]

# Generate HTML page
puts "Content-type: text/html\n\n"
puts "<html>"
puts "<head>"
puts "<style>"
puts "body { font-family: Arial, sans-serif; text-align: center; }"
puts ".title { font-size: 2em; color: #fff; background-color: #333; padding: 10px; }"
puts "img { width: 100%; height: auto; }"
puts "</style>"
puts "</head>"
puts "<body>"
puts "<div class='title'>#{city}, #{country}</div>"
puts "<img src='#{url}' alt='City Image'>"
puts "</body>"
puts "</html>"
