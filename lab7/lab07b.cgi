#!/usr/bin/perl -wT 
use strict; 
use CGI 'standard'; 
use CGI::Carp qw(warningsToBrowser fatalsToBrowser); 
use File::Basename;

$CGI::POST_MAX = 1024 * 5000;
my $cgi = CGI->new;

my $first_name     = $cgi->param('firstName');
my $last_name      = $cgi->param('lastName');
my $street         = $cgi->param('Street');
my $city           = $cgi->param('City');
my $postal_code    = $cgi->param('postalCode');
my $province       = $cgi->param('prov');
my $phone_number   = $cgi->param('phoneNumber');
my $email          = $cgi->param('email');
my $safe_filename_characters = "a-zA-Z0-9_.-";
my $upload_dir = "/home/pslay/public_html/picture";


my $query = new CGI; my $filename = $query->param("photoFile");
if (!$filename) { print $query->header ( ); print "There was a problem uploading your photo (try a smaller file)."; exit; };
my ($name, $path, $extension) = fileparse ( $filename, '\..*' ); $filename = $name . $extension;
$filename =~ tr/ /_/; $filename =~ s/[^$safe_filename_characters]//g;
if ( $filename =~ /^([$safe_filename_characters]+)$/ ) { $filename = $1; } else { die "Filename contains invalid characters"; };
my $upload_filehandle = $query->upload("photoFile");
open (UPLOADFILE, ">$upload_dir/$filename") or die "$!"; 
binmode UPLOADFILE; while (<$upload_filehandle>) { print UPLOADFILE; } close UPLOADFILE;

my $valid          = 1;
my $error_message  = '';
my $photo_url      = "https://www2.cs.torontomu.ca/~pslay/picture/$filename";

if ($phone_number !~ /^\d{10}$/) {
    $valid = 0;
    $error_message .= "Invalid phone number. ";
}

if ($postal_code !~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/) {
    $valid = 0;
    $error_message .= "Invalid postal code format. ";
}

if ($email !~ /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) {
    $valid = 0;
    $error_message .= "Invalid email format. ";
}

# Output the HTML header
print $cgi->header,
      $cgi->start_html(-title => 'User Registration Result', -style => {'src' => 'https://www2.cs.ryerson.ca/~pslay/lab07b.css'});

# Display the result
if ($valid) {
    print "<div class='container'>";
    print "<div class='title'>Registration Successful</div>";
    print "<form>";
    print "<div class='user-details'>";
    print "<div class='input-box'><span class='details'>First Name:</span> <p>$first_name</p></div>";
    print "<div class='input-box'><span class='details'>Last Name:</span> <p>$last_name</p></div>";
    print "<div class='input-box'><span class='details'>Street:</span> <p>$street</p></div>";
    print "<div class='input-box'><span class='details'>City:</span> <p>$city</p></div>";
    print "<div class='input-box'><span class='details'>Postal Code:</span> <p>$postal_code</p></div>";
    print "<div class='input-box'><span class='details'>Province:</span> <p>$province</p></div>";
    print "<div class='input-box'><span class='details'>Phone Number:</span> <p>$phone_number</p></div>";
    print "<div class='input-box'><span class='details'>Email:</span> <p>$email</p></div>";
    print "<div class='input-box'><span class='details'>Photograph:</span> <img src='$photo_url' width='500' height='600'></img></div>";

    print "</div>";
    print "</form>";
    print "</div>";
} else {
    print "<div class='title'>Registration Failed</div>";
    print "<p>Error: $error_message</p>";
}

print "</div>";  # Close container
print $cgi->end_html;
