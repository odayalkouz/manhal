#!/usr/bin/perl -w
#################################################################
# ecpp_2.pl - Michael Karr
# Utility to parse and generate statistics from mail logs.
#
# Git: http://git.toolbox.hostgator.com/ec
# Wiki: https://gatorwiki.hostgator.com/Security/EC
# 
# Please submit all bug reports at http://bugs.hostgator.com
#
# (c) 2012 - HostGator.com, LLC.
#################################################################

# 20090321 - ecpp original version
# 20090327 - added exim counts and shortened sample output to a reasonable length - mkarr
# 20090328 - combined splits/regexs for 400% speed increase - mkarr
# 20090402 - corrected minor bug in cwd parse regex - mkarr
# 20090403 - added capturing/parsing of the rare 'A=fixed_plain:user' spam - jcarter
# 20090721 - added protocol checking to filter out false spamassassin results - mkarr
# 20090724 - fixed error where regex metachars in /etc/userdomains would kill script - mkarr
# 20090731 - fix a bug that caused errors in cwd parsing, and refactored a bit to increase speed -mkarr
# 20090806 - fixed fixed_plain auth regex - mkarr
# 20090909 - added "August" to the list of recognized months - mkarr
# 20091029 - added a few speedups to the progress code, preventing the large delay before startup - mkarr
# 20100329 - added handling of different time ranges - mkarr
# 20100421 - added version header in order to more quickly track deployment of script - mkarr
# 20100505 - updated usage message - mkarr
# 20100615 - added handling of compressed log if time period requested pre-dated normal log - mkarr
# 20100915 - added accurate (slow) counting of multiple addresses per individual email sent - mkarr
# 20100921 - switched accurate counting to default method - mkarr
# 20101123 - added "courier_login" handling - mkarr
# 20101208 - added "dovecot_login" handling - mkarr
# 20101215 - added handling for a blank "From" address - mkarr
# 20110217 - fixed bug in 'printsamples" causing incorrect splits in samples containing word 'for' - mkarr
# 20110218 - added plain variants of courier and dovecot auths - mkarr
# 20110317 - added option to check mail over an entire reseller - mkarr
# 20110324 - fixed bug in accurate counting of multiple addresses per individual email sent - mkarr
# 20110511 - added count of unique recipients - mkarr
# 20110527 - added count of email addresses - mkarr
# 20110527_2 - added email creation finding - mkarr
# 20110607 - changed default search period to 48 hours, updated usage message - mkarr
# 20110608 - forced input to lower case
# 20110610 - added functionality to search maillog for ip addresses used in imap/pop auths - mkarr
# 20110610 - added display of random recipient addresses - mkarr

# 20110617 - ecpp_2 original version (revised from the original ecpp) - mkarr
# 20110623 - implemented a new, faster parser - mkarr
# 20110624 - added bounce tracking - mkarr
# 20110627 - fixed a bug in the "H=..." parser regex, and divide by zero - mkarr
# 20110627_2 - added support for mailman - mkarr
# 20110628 - fixed another bug in "H=..." parser regex - mkarr
# 20110701 - added "days" option, fixed time sanity check - mkarr
# 20110705 - made tos message predef optional, bounce check tweak, fixed sample output - mkarr
# 20110707 - set imap/pop search as default, fix bug in mailman tracking - mkarr
# 20110713 - reworked time parsing for much faster results - mkarr
# 20110713_2 - added listing of top recipients and topics, changed up some sorting methods - mkarr
# 20110714 - added per domain hourly display if large amounts of mail are detected, improved gunzip speed - mkarr
# 20110715 - re-arrange output - mkarr
# 20110720 - switched to using non-breaking spaces in hourly charts (to preserver formatting in HTML) - mkarr
# 20110720_2 - added uniq recipient count to per domain hourly display - mkarr
# 20110801 - made maillog regex less specific, to capture cpanel users - mkarr
# 20110801_2 - added support for another kind of mailman log entry - mkarr
# 20110803 - fixed bug maillog regex - mkarr
# 20110808 - added another case for generic mailman reminder messages - mkarr
# 20110811 - added entire server checking when fed 'root' as an argument - mkarr
# 20110818 - fixed an issue on servers where the log_selector is set to "+all" - mkarr
# 20110906 - added support for internationalized mailman reminders. - mkarr
# 20110930 - excluded local ip address from maillog ip search - mkarr
# 20111001 - modfied 'H=' regex for another case that was found - mkarr
# 20111001_2 - fixed "undefined" errors when log entries do not contain recipient addresses - mkarr
# 20120227 - added a raw output clean version of the progress display when redirecting to a file - mkarr
# 20120328 - added support for the new dateext log archives - mkarr
# 20120518 - added "terse" option to output, to prevent huge output - mkarr
# 20120518_2 - fixed progress counter for gz files, due to changes in 'tell' on new boxes - mkarr
# 20120706 - Added detection of Squirrel Mail messages. - mkarr
# 20120710 - Tweaked recipient regex for some boxes with a custom log setup. - mkarr
# 20121022 - Moved back to regular space for hourly displays. - mkarr
# 20121022_2 - Implemented lowmem option. - mkarr
# 20121202 - Tweaked topic regex to catch escaped quotes. - mkarr
# 20121203 - Added unique bounce tracking. - mkarr
# 20130416 - Added additional email separators. - mkarr
# 20130606 - Updated directories for new home servers. - mkarr
# 20150612 - Added hostname check for TOS message - rdosogne

my $version = "20150612";

use strict;
use warnings;
use Time::Local;
use Time::localtime;
use POSIX qw(strftime);
use File::stat;
use Getopt::Long;
use IO::Uncompress::Gunzip;
use FileHandle;
use Sys::Hostname;

sub usage;
sub findmailcreation;
sub populatedomainmap;
sub populateownermap;
sub getsearchusers;
sub getfixedlogins;
sub mailcount;
sub eximlogstart;
sub processeximlogs;
sub recordsample;
sub addemail;
sub parseeximline;
sub commify;
sub printtotals;
sub formatsample;
sub printsamples;
sub printhourly;
sub printsendaddr;
sub printsendlog;
sub printcwd;
sub printsubs;
sub printrecaddr;
sub printexim;
sub printtosmessage;
sub printtimerange;
sub maillogstart;
sub processmaillogs;
sub parsemailline;
sub pseudoui;
sub get_homedir;

$| = 1; #turn on autoflush of stdout (allows progress code to work correctly)

# begin maincode

print "ecpp_2.pl - Version: $version - Michael Karr\n\n"; 

my $hostname = hostname();
my $starthours = 48;
my $endhours = 0;
my $days = 0;

my $resellermode = 0;
my $findemailcreate = 0;
my $imappopips = 1;
my $tos = 0;
my $terse = 1;
my $lowmem = 0; # skip recording of recipient/topic/sender info for memory/cpu constrained servers

# grab the timezone offset, so that we can make timegm work right (it's much faster than timelocal)

my @time = CORE::localtime(time);
my $offset = timegm(@time) - timelocal(@time);

# grab command line options

GetOptions ('shours|s|hours|h=i' => \$starthours, 
            'ehours|e=i' => \$endhours,
            'days|d=i' => \$days,
            'reseller|r' => \$resellermode,
            'create|c' => \$findemailcreate,
            'ips|i=i' => \$imappopips,
            'tosmessage|tos' => \$tos,
            'terse|t=i' => \$terse,
            'lowmem|l|fast|f' => \$lowmem);
            
if (!exists $ARGV[0]) { #quick check to make sure we have an argument
    usage();
} elsif ($findemailcreate) {
    findmailcreation($ARGV[0]);
} else {
    mailcount($ARGV[0], $starthours, $endhours, $days, $resellermode, $imappopips, $tos);    
}

exit 0;

# end maincode

sub usage {
print <<EOU;
No argument provided.

Default usage, assumes you wish to parse the last 48 hours of logs:

   # ec <username>
   # ec <domain>

Parse the last <hours> hours worth of logs:

   # ec -h <hours> <user or domain>
   # ec --hours=<hours> <user or doman>

Parse between the last <start hours> and <end hours> marks:

   # ec -s <start hours> -e <end hours> <user or doman>
   # ec --shours=<start hours> --ehours=<end hours> <user or doman>
   
Parse for the last <days> day period:

   # ec -d <days>
   # ec --days=<days>

Search across all users for a reseller:

   # ec --reseller <reseller account>
   # ec -r <reseller account>

Search for the log excerpt and creation time of an email address: 

   # ec -c <email address> 

Some example use cases:

   # ec teammast
   # ec --hours=48 teammast
   # ec -s 48 -e 24 teammast
   # ec -h 48 -r mrowner
   # ec -c alex\@rugbysuccess.com
   
EOU
}

sub findmailcreation {
    my $emailaddress = $_[0];
    my $cparchlogp = "/usr/local/cpanel/logs/archive";
    my @cplogs= ("/usr/local/cpanel/logs/access_log");

    my ($emailuser, $emaildomain) = ($emailaddress =~ /^([^@]*)[\+@](.*)$/);
    
    if ($emailuser && $emaildomain) {
        print "Finding the creation time of: $emailaddress\n";
        print "User: $emailuser\n";
        print "Domain: $emaildomain\n\n";
        
        # add archived cpanel logs to list

        opendir(my $archivedh, $cparchlogp);
        
        while(my $file = readdir($archivedh)) {
            if ($file =~ /access_log-.*?\.gz/) {
                push (@cplogs, "$cparchlogp/$file");
            }
        }
        
        closedir($archivedh);
        
        @cplogs = sort { stat($b)->mtime <=> stat($a)->mtime } @cplogs;
        
        # search through logs for creation
        
        my $createrex = "addpop&email=$emailuser&password=__HIDDEN__&quota=[^&]*&domain=$emaildomain&";
        my $found = 0;        
        
        foreach my $file (@cplogs) {
            print "Processing: $file\n";
            
            my $progress = -1;
            my $filesize = stat($file)->size;
            
            my $fh = new FileHandle;
            $fh->open("<$file");
            
            my $fhp;
            
            if ($file =~ /^.*?\.gz$/) {
                $fhp = new IO::Uncompress::Gunzip $fh;
            } else {
                $fhp = $fh;
            }
            
            my $istty = (-t STDOUT);
            
            while(my $line = <$fhp>) {
                if($line =~ /$createrex/) {
                    print "\nCreation of email address found: \n\n$line";
    
                    $found = 1;
                    last;
                }
    
                if (int((tell($fh) / $filesize) * 100 ) > $progress){ #prevent a billion slow i/o calls
                    $progress = int((tell($fh) / $filesize) * 100 );
                    
                    if ($istty) {
                        print "\r               \rProgress: $progress%"; #replace prev line with new progress
                    } else {
                        if (($progress == 0) || ($progress % 10 == 0)) {
                            print "$progress%";
                        } else {
                            print ".";
                        }
                    }
                }
            }

            $fh->close();

            print "\n";

            if ($found) {
                last;
            }
        }



    } else {
        print "Invalid email address provided.\n";
    }
}

# populate user2domain and domain2user maps

sub populatedomainmap {
    my $userpath = "/etc/userdomains";
    
    my %user2domain = (); # hash of arrays for user -> domains map
    my %domain2user = (); # hash for domain -> user map

    open (USERDOMAINS, $userpath) or die;

    while (my $line = <USERDOMAINS>) {
        chomp($line); # Kill trailing whitespace/newline
        my @temp = split(": ", $line); # userdomains format is "domain.com: user"

        $domain2user{ $temp[0] } = $temp[1];
        push @{ $user2domain{ $temp[1]} }, $temp[0];
    }

    close (USERDOMAINS);
    
    return (\%user2domain, \%domain2user);
}

sub populateownermap {
    my %owner2user = (); # hash for owner -> user map
    my $tuopath = "/etc/trueuserowners";
    
    open (TUOWNER, $tuopath) or die;

    while (my $line = <TUOWNER>) {
        chomp($line); # Kill trailing whitespace/newline

        if ($line =~ /^.*?:\s.*?$/) {
            my @temp = split(": ", $line); # trueuserowners format is "user: owner"

            push @{ $owner2user{ $temp[1]} }, $temp[0];
        }
    }

    close (TUOWNER);

    return %owner2user;
}

sub getsearchusers {
    my ($baseowner, $reseller, $user2domain_r) = @_;
    my @searchusers;
    
    # if reseller mode was specified, add sub-accounts to checklist, otherwise just add the user
    
    if ($baseowner eq "root") { # if we are root, add all the users to the list
        print "Entire Server Mode.\n";
        
        for my $user (keys %{$user2domain_r}) {
            push (@searchusers, $user);
        }
    } elsif ($reseller) {
        print "Reseller Mode.\n";
    
        my %owner2user = populateownermap();
    
        if (!(exists $owner2user{$baseowner})) {
            print "$baseowner does not appear to be a reseller.\n";
        } else {    
            foreach (@{$owner2user{$baseowner}}) {
                push(@searchusers, $_);
            }
        }
    } else {
        print "Single User Mode.\n";
    
        push (@searchusers, $baseowner);
    }
    
    return @searchusers;
}

sub getfixedlogins {
    my ($sur, $u2sr) = @_;
    
    my @searchusers = @{$sur};
    my %user2domain = %{$u2sr};
   
    my %fixedloginsh;

    foreach my $user (@searchusers) {
        $fixedloginsh{$user} = undef;
    
        print "\nEmail accounts per domain owned by $user:\n";
    
        foreach my $domain (@{$user2domain{$user}}) {
            my $count = 0;
    
            if(open(SHADOW, "< ".get_homedir($user)."/etc/$domain/shadow")) {
                while (<SHADOW>) {
                    $count++;
                }
                
                close(SHADOW);
            }
    
            print "\t$domain: $count\n";
    
            $fixedloginsh{$domain} = undef;
        }
    }

    return \%fixedloginsh;
}

sub mailcount {
    my ($arg, $starthours, $endhours, $days, $reseller, $imappopips, $tos) = @_;
            
    # check to see if the argument were were provided us a user or domain
    
    my $baseowner; 
    
    my ($user2domainr, $domain2userr) = populatedomainmap();
    my %user2domain = %{$user2domainr};
    my %domain2user = %{$domain2userr};
    
    $arg = lc($arg);    
    
    if (exists ($user2domain{$arg}) || ($arg eq "root")) {
        $baseowner = $arg;
    
        print "$arg is a USER.\n";
    } elsif (exists $domain2user{$arg}) {
        $baseowner = $domain2user{$arg};
        
        print "$arg is a DOMAIN.\n";
        print "$arg is owned by USER $domain2user{$arg}\n";
    } else {
        print "$arg appears to be nothing useful, quitting.\n";
        return;
    }
    
    if ($days) {
        $starthours = ($days * 24);
        $endhours = 0;
    }     
    
    if ($endhours > $starthours) { #sanity check
        print "Invalid time range, ends before it starts. Assuming you were confused, swapping.\n";
        
        ($starthours, $endhours) = ($endhours, $starthours);
    }
    
    my $currentTime =  time;
    my $endTime = $currentTime - ($endhours * 3600);
    my $startTime = $currentTime - ($starthours * 3600);    
    

    my @searchusers = getsearchusers($baseowner, $reseller, \%user2domain);
    my $fixedlogins_r = getfixedlogins(\@searchusers, \%user2domain);
    
    print "\n";
    
    my %ipaddr; # ip addresses logging in via POP/IMAP
    
    if ($imappopips) {
        my ($ipaddr_r) = processmaillogs(\@searchusers, $fixedlogins_r, $startTime, $endTime);
        %ipaddr = %{$ipaddr_r};
    }    
    
    my ($totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r, $saddr_r, $mid_r, $bcnt_r, $bcnt_h_r, 
        $cwd_r, $sub_r, $usercnt_r, $userraddr_r, $bcnt_rec_r) 
        = processeximlogs(\@searchusers, $fixedlogins_r, \%ipaddr, $startTime, $endTime);

    my $totec = ${$totec_r}; # total email count
    my $trec = ${$trec_r}; # true email count (multiple recipients separated)
    my @fsp = @{$fsp_r}; # first samples
    my @lsp = @{$lsp_r}; # last samples
    my %cnt = %{$cnt_r}; # per user count
    my %raddr = %{$raddr_r}; # receiving addresses
    my %slog = %{$slog_r}; # sender logins
    my %saddr = %{$saddr_r}; # sender addresses
    my %mid = %{$mid_r};

    my %cwd = %{$cwd_r}; # current working directories
    my %sub = %{$sub_r}; # subjects
    my %usercnt = %{$usercnt_r}; # per user count
    my %userraddr = %{$userraddr_r}; #per user count recipients

    my %bcnt = %{$bcnt_r};
    my %bcnt_h = %{$bcnt_h_r};
    my %bcnt_rec = %{$bcnt_rec_r};


    print "\n"; print '-' x25 . "\n\n";
    
    pseudoui($baseowner); print "\n";
    
    if ($tos && $hostname =~ /\.(hostgator|websitewelcome)\.com$/) {
        printtosmessage();
    }
    
    print '-' x25 . "\n\n";
    
    printtimerange($startTime, $endTime);
    printtotals($trec, \%raddr, \%bcnt, \%bcnt_rec);
    printhourly(\%cnt, \%bcnt_h, \%usercnt, \%slog, \%userraddr);

    unless($lowmem) {
        printsendaddr(\%saddr);
        printsendlog(\%slog);
    }

    printcwd(\%cwd);

    unless($lowmem) {
        printrecaddr(\%raddr);
        printsubs(\%sub);
    }

    printsamples(\@fsp, \@lsp);
    printexim(\%saddr);
}

sub eximlogstart {
    my ($file) = @_;
    
    my $fh = new FileHandle;
    $fh->open("<$file");
    
    my $fhp;
    
    if ($file =~ /^.*?\.gz$/) {
        $fhp = new IO::Uncompress::Gunzip $fh;
    } else {
        $fhp = $fh;
    }
    
    my $time;
                
    while(my $line = <$fhp>) {
        if ($line =~ /(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})\s/) {
            $time = timelocal($6, $5, $4, $3, $2 - 1, $1);
            last;
        }
    }
    
    $fh->close();

    return $time;
}

sub processeximlogs {
    my ($searchusers_r, $fixedlogins_r, $ipaddr, $startTime, $endTime) = @_;
    my @searchusers = @{$searchusers_r};

    # specify logs to search
        
    my @eximlogs = @{findlogs('/var/log', 'exim_mainlog((-\d{8})|(\.\d))?(\.gz)?')};

    # setup hashes, arrays, and variables for collected data
                
    my $totec = 0; # total email count
    my $trec = 0; # true email count (multiple recipients separated)
    my @fsp; # first samples
    my @lsp; # last samples
    my %cnt; # per user count
    my %raddr; # receiving addresses
    my %slog; # sender logins
    my %saddr; # sender addresses
    my %mid; # exim mail ids
    my %cwd; # current working directories
    my %sub; # subjects
    my %usercnt; #per user count
    my %userraddr; #per user count recipients
    my %m_rec; #per id recipients

    my %bcnt; # bounces 
    my %bcnt_h; # hourly bounces
    my %bcnt_rec; # bounced recipients
    my $lastStart = $endTime;
    foreach my $file (@eximlogs) {
        if (my $eximt = eximlogstart($file)) {
            print "Processing '$file'.\n";
            
            # makes sure the log contains the time we want to check 
            
            if ($startTime < $eximt) {
                print "Start time pre-dates log, ";
                
                if ($endTime < $eximt) {
                    print "checking next log.\n";
                    next;
                } else {
                    print "but end time is present, checking anyways.\n";
                }                    
            }
            
            # open file and parse lines
            
            my $progress = -1;
            my $new_progress = -1;
            my $filesize;
            
            # this is totally a hack, but way faster than the pure perl way of doing it
            my $old_env = $ENV{'LC_ALL'} || '';
            $ENV{'LC_ALL'} = 'C';            
            my $fh;
            
            if ($file =~ /^.*?\.gz$/) {
                open($fh, "-|", 'zgrep','-F','-e','<=','-e','cwd=',$file);
                my $gziplist=`gzip -l $file`;
                $gziplist=~/.\n\s*\d*\s*(\d*)/;
                $filesize=$1;
            } else {
                open($fh, "-|", 'grep','-F','-e','<=','-e','cwd=',$file);
                $filesize = stat($file)->size
            }
            $ENV{'LC_ALL'} = $old_env;
            my $istty = (-t STDOUT);
            my $pos = 0;
            my $lineTime = 0;
            while (my $line = <$fh>) {
                parseeximline(\$line, $startTime, $endTime, $fixedlogins_r, $ipaddr, \$totec, \$trec, \@fsp, \@lsp, \%cnt, \%raddr, \%slog,
                              \%saddr, \%mid, \%bcnt, \%bcnt_h, \%cwd, \%sub, \%usercnt, \%userraddr, \%m_rec, \%bcnt_rec, \$lineTime);

                #$pos += length($line);
                #my $new_progress = int(($pos / $filesize) * 100);
                $new_progress = int(100*($lineTime - $eximt)/($lastStart - $eximt)) if ($lineTime >= $eximt && $lastStart > $eximt);
                if ($new_progress > $progress){ #prevent a billion slow i/o calls
                    $progress = $new_progress;
                    
                    if ($istty) {
                        print "\r               \rProgress: $progress%"; #replace prev line with new progress
                    } else {
                        if ($progress % 10 == 0) {
                            print "$progress%";
                        } else {
                            print ".";
                        }
                    }
                }
            }
            if ($istty) {
                print "\r               \rProgress: 100%"; # finalize 100% since new way doesn't always get to 100
            } else {
                print "100%";
            }            
            $fh->close();
            
            print "\n";    

            if ($startTime >= $eximt) {
                last; # start time is in current log, we are done checking
            } else {
                $lastStart = $eximt;
            }
        } 
    }
    
    return (\$totec, \$trec, \@fsp, \@lsp, \%cnt, \%raddr, \%slog, \%saddr, \%mid, \%bcnt, \%bcnt_h,
            \%cwd, \%sub, \%usercnt, \%userraddr, \%bcnt_rec);
}

sub findlogs {
    my ($directory, $rex) = @_;
    my @files;
    
    opendir(my $dh, $directory);
    
    while(my $file = readdir($dh)) {
        if ($file =~ /$rex/) {
            push (@files, $directory.'/'.$file);
        }
    }
    
    closedir($dh);

    @files = sort {stat($b)->mtime <=> stat($a)->mtime} @files;    
    return \@files;
}

sub recordsample {
    my ($fsp_r, $lsp_r, $time, $line_r) = @_;
    
        my @sample = ($time, $line_r);
    
    if ((scalar @{$fsp_r}) <= 0){
        push @{$fsp_r}, \@sample;   
    } else {
        if ($time <= ${${$fsp_r}[0]}[0]) {
            unshift @{$fsp_r}, \@sample;
        } elsif ($time >= ${${$fsp_r}[-1]}[0]) {
            push @{$fsp_r}, \@sample;
        } else {
            for (my $i = 0; $i < (scalar @{$fsp_r}); $i++) {
                if ($time <= ${${$fsp_r}[$i]}[0]) {
                    splice (@{$fsp_r}, $i, 0, \@sample);
                    last;
                }
            }
        }
        
        if ((scalar @{$fsp_r}) > 5){
            pop @{$fsp_r};
        }
    }
    
    if ((scalar @{$lsp_r}) <= 0){
        push @{$lsp_r}, \@sample;   
    } else {
        if ($time <= ${${$lsp_r}[0]}[0]) {
            unshift @{$lsp_r}, \@sample;
        } elsif ($time >= ${${$fsp_r}[-1]}[0]) {
            push @{$lsp_r}, \@sample;
        } else {
            for (my $i = 0; $i < (scalar @{$lsp_r}); $i++) {
                if ($time <= ${${$lsp_r}[$i]}[0]) {
                    splice (@{$lsp_r}, $i, 0, \@sample);
                    last;
                }
            }
        }
        
        if ((scalar @{$lsp_r}) > 5){
            shift @{$lsp_r};
        } 
    }
}

sub addemail {
    my ($line_r, $time, $user, $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
        $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r) = @_;
    
    recordsample($fsp_r, $lsp_r, $time, $line_r);
    
    ${$line_r} =~ /^(.*(?:(?:from\s<[^>]*>)|(?:T=\"[^\"]*\"))\sfor\s)(.*)$/;
    my @emails = split(/\s/, $2);;

    foreach (@emails) {
        unless($lowmem) {
            ${$raddr_r}{$_} += 1;
        }

        ${$userraddr_r}{$user}{$_} += 1;
        push (@{$m_rec_r->{$id}}, $_);
    }
    
    ${$cnt_r}{strftime("%Y-%m-%d", CORE::localtime($time))}{localtime($time)->hour} += @emails;
    ${$usercnt_r}{$user}{strftime("%Y-%m-%d", CORE::localtime($time))}{localtime($time)->hour} += @emails;
    ${$trec_r} += @emails;
    ${$slog_r}{$user} += @emails;

    unless($lowmem) {
        if ($sender eq "<>") {
            ${$saddr_r}{"Blank Sender"} += @emails;
        } else {
            ${$saddr_r}{$sender} += @emails;
        }
    }

    ${$totec_r}++;
    
    push (@{${$mid_r}{$id}}, strftime("%Y-%m-%d", CORE::localtime($time)));
    push (@{${$mid_r}{$id}}, localtime($time)->hour);
    
    unless($lowmem) {
        if (${$line_r} =~ /(T=\".*?(?<!\\)\"\s)/) {
            ${$sub_r}{$1} += @emails;
        } else {
            ${$sub_r}{'Blank Subject'} += @emails;
        }
    }
}

sub addbounce {
    my ($line_r, $id, $bounceid, $bcnt_r, $bcnt_h_r, $mid_r, , $m_rec_r, $bcnt_rec_r) = @_;

    ${$bcnt_r}{$id}++;
    ${$bcnt_h_r}{${$mid_r}{$bounceid}[0]}{${$mid_r}{$bounceid}[1]}++;
    map {$bcnt_rec_r->{$_}++} @{$m_rec_r->{$bounceid}};
}

sub parseeximline {
    my ($line_r, $startt, $endt, $flh_r, $ipaddr, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
        $saddr_r, $mid_r, $bcnt_r, $bcnt_h_r, $cwd_r, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r, $bcnt_rec_r, $linetime_r) = @_;
    
    if (${$line_r} =~ /<=/) { # is this an outbound email?
        if (${$line_r} =~ /^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})\s(\[\d{1,8}\]\s)?(\w{6}\-\w{6}\-\w{2})\s<=\s/gc) { # grab time and id
            my $time = timegm($6, $5, $4, $3, $2 - 1, $1) - $offset; 
            ${$linetime_r} = $time;                   
            my $id = $8;
            
            if(($time >= $startt) & ($time <= $endt)) { # only count within the specified time range
                if (${$line_r} =~ /\G((?:[^\s]*[\+@][^\s]*)|(?:<>))\s/gc) { # do we have a sender?
                    my $sender = $1;
                    
                    if (${$line_r} =~ /\G(H=([^\s]*\s)?((\([^\(]*\)\s)?\[([^\]]*)\]))(:\d{1,5})?\s/gc) { # is this a remote user?
                        my $helo = $1;
                        my $ip = $5;
                        
                        if (${$line_r} =~ /(A=(fixed|courier|dovecot)_(login|plain):(([^\+@%:\s]*)|([^\+@%:\s]*[\+@%:]([^\+@%:\s]*))))\s/) { # do we have a valid authenticator?
                            my $auth = $1;
                            my $euser;
                            
                            if ($5) {
                                $euser = $5;
                            } elsif ($7) {
                                $euser = $7;
                            } else {
                                return;
                            }
                                                        
                            if (exists ${$flh_r}{$euser}) {
                                addemail($line_r, $time, $auth, $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                         $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                return;
                            } else {
                                return;
                            }
                        } else { # ipaddress tracking for imap/pop users goes here
                            if (exists ${$ipaddr}{$ip}) {
                                addemail($line_r, $time, $helo, $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                         $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                return;   
                            } elsif ($sender =~ /^(.*?)-bounces[\+@](.*?)$/) { # were we sent from a bounce address?
                                my $blist = $1;
                                my $bdomain = $2;
    
                                if (exists ${$flh_r}{$bdomain}) { # did the domain belong the the user?
                                    if (${$line_r} =~ /id=mailman/) { # did the email belong to mailman?
                                        addemail($line_r, $time, "Mailman:$blist\@$bdomain", $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                                 $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                        return;
                                    } elsif ($ip eq "127.0.0.1") { # are we a local email, if so, and we have a "bounces" address, we are probably mailman
                                        addemail($line_r, $time, "Mailman:$blist\@$bdomain", $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                                 $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                    }
                                    else {
                                        return;
                                    }
                                } elsif($blist eq "mailman") {
                                    if (${$line_r} =~ /T="([^\s]*)\s.*?\s([^\s]*)"/) { # catch generic mailman reminder messages
                                        my $mdomains = $1;
                                        my $mdomaine = $2;
                                        
                                        if (exists ${$flh_r}{$mdomains}) { # does it belong to a domain we own?
                                            addemail($line_r, $time, "Generic Mailman Reminder:$mdomains", $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                                 $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                        } elsif (exists ${$flh_r}{$mdomaine}) {
                                            addemail($line_r, $time, "Generic Mailman Reminder:$mdomaine", $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                                 $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                                        } else {
                                            return;
                                        }
                                    } else {
                                        return;
                                    }
                                } else {
                                    return;
                                }                        
                            } else {
                                return;
                            } 
                        }
                    } elsif (${$line_r} =~ /\G(U=([^\s]*))\s/gc) { # is this a local user?
                        my $euser = $2;
                        my $login = $1;
                        
                        if (exists ${$flh_r}{$euser}) {
                            if (${$line_r} =~ /id=[^\s]*squirrel@/) {
                                addemail($line_r, $time, 'Webmail', $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                         $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                            } else {
                                addemail($line_r, $time, $login, $sender, $totec_r, $trec_r, $fsp_r, $lsp_r, $cnt_r, $raddr_r, $slog_r,
                                         $saddr_r, $mid_r, $id, $sub_r, $usercnt_r, $userraddr_r, $m_rec_r);
                            }
                            return;
                        } else {
                            return;
                        }
                        
                    } elsif (${$line_r} =~ /\GR=(\w{6}\-\w{6}\-\w{2})\s/gc) { # is this a returned mail?
                        my $bounceid = $1;
                        
                        if (exists ${$mid_r}{$bounceid}) { # is it one that we sent?
                            addbounce($line_r, $id, $bounceid, $bcnt_r, $bcnt_h_r, $mid_r, $m_rec_r, $bcnt_rec_r);
                            return;
                        } else {
                            return;
                        } 
                    }                   
                }
            }
        }
    } elsif (${$line_r} =~ /cwd=/) { # is this a cwd line?
        if (${$line_r} =~ /^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})\scwd=(\/home\d?\/([^\/\s]*)([^\s]*)?)\s/gc) { # grab time and path
            my $time = timegm($6, $5, $4, $3, $2 - 1, $1) - $offset;                    
            
            my $cwdp = $7;
            my $cuser = $8;
            
            if(($time >= $startt) & ($time <= $endt)) { # only count within the specified time range
                if (exists ${$flh_r}{$cuser}) {
                    ${$cwd_r}{$cwdp}++;                
                } else {
                    return;
                }
            }
        }
    }
}

sub commify { #commify (add commas to a number in a string)
    my $text = reverse $_[0];
    $text =~ s/(\d\d\d)(?=\d)(?!\d*\.)/$1,/g;
    return scalar reverse $text
}

sub printtotals {
    my ($trec, $raddr_r, $bcnt_r, $bcnt_rec_r) = @_;
    
    my $percent = 0;

    if ($trec > 0) {
        $percent = (scalar(keys %{$bcnt_r})/$trec)*100;
    }

    print "User sent approximately ".commify($trec)." messages to ".commify(scalar(keys %{$raddr_r}))." unique recipients.\n";
    print "There were ".scalar(keys %{$bcnt_r})." bounces on ".scalar(keys %{$bcnt_rec_r})." unique addresses, ".int($percent)." percent of the emails sent.\n\n"; 
}

sub formatsample {
    my ($sample) = @_;
    my $fsample;
    
    if ($sample =~ /^(.*(?:(?:from\s<[^>]*>)|(?:T=\"[^\"]*\"))\sfor\s)(.*)$/)  {
        my @emails = split(/\s/, $2);
    
        if (@emails > 5) {
            $fsample = $1;
            
            my $i = 0;
            while ($i < 5) {
                $fsample = $fsample."$emails[$i] ";
                $i++;
            }
            $fsample = $fsample."... ".(@emails - 5)." additional email addresses removed.\n";
        } else {
            $fsample = $sample;
        }
    } else {
        $fsample = $sample;
    }

    return $fsample;
}

sub printsamples {
    my ($fsp_r, $lsp_r) = @_;

    print "Selected email samples:\n";
    print "-----------------------\n\n";
    
    print "First 5 Entries:\n\n";
    foreach my $samp_r (@{$fsp_r}) {
        my $samp = ${${$samp_r}[1]};
        print formatsample($samp);
    }
    print "\n";
    
    print "Last 5 Entries:\n\n";
    foreach my $samp_r (@{$lsp_r}) {
        my $samp = ${${$samp_r}[1]};
        print formatsample($samp);
    }
    print "\n";
}

sub pnbs {
    my ($text, $size) = @_;
    
    # return padleft($text, $size, "\xc2\xa0");  # unicode non breaking space
    return padleft($text, $size, ' ');  # normal space
}

sub padleft {
    my ($text, $size, $fill) = @_;
    
    if (($size - length($text)) <= 0) {
        return $text;
    } else {
        return ($fill x ($size - length($text))).$text;
    } 
}

sub printhourly {
    my ($cnt_r, $bcnt_h_r, $usercnt_r, $slog_r, $userraddr_r) = @_;
    my $indthresh = 500; # threshold for displaying domain count
    
    print "Hourly mail volume for the entire account:\n\n";

    for my $d (sort {$a cmp $b} keys %{$cnt_r}) { #print numbers of emails sent, grouped into days and hours
        print "$d\n";
        print "-" x30 . "\n";
                
        print pnbs("Hour",4).pnbs("Volume",10).pnbs("Bounces",10).pnbs("%",6)."\n";

        print "-" x30 . "\n";
    
        for my $h (sort {$a <=> $b} keys %{${$cnt_r}{$d}}) {
            my $chour = ${$cnt_r}{$d}{$h};
            my $cbounce = 0;
            
            if (exists ${$bcnt_h_r}{$d}{$h}) {
                $cbounce = ${$bcnt_h_r}{$d}{$h};
            }
            
            my $percent;
            
            if ($chour <= 0) {
                $percent = 100;
            } else {
                $percent = ($cbounce/$chour)*100;
            }
            
            print pnbs($h,4).pnbs(commify($chour),10).pnbs(commify($cbounce),10).pnbs(int($percent),6)."\n";
        }
    
        print "\n";
    }

    my %udomains;
    my %udomainrecs;
    
    for my $u (keys %{$usercnt_r}) {
        my $udomain;
      
        if ($u =~ /(^.*?[\+@](.*?)$)/) {
            $udomain = $2;
        } elsif ($u =~ /(^U=(.*?)$)/) {
            $udomain = $1;
        } else {
            next; # this really shouldnt ever happen, but we should capture it anyways
        }
   
        for my $d (keys %{${$usercnt_r}{$u}}) {
            for my $h (keys %{${$usercnt_r}{$u}{$d}}) {
                $udomains{$udomain}{$d}{$h} += ${$usercnt_r}{$u}{$d}{$h};
            }
        }
        
        for my $r (keys %{${$userraddr_r}{$u}}) {
            $udomainrecs{$udomain}{$r} = ${$userraddr_r}{$u}{$r};
        }
    }

    if (scalar keys %udomains > 1) { # don't bother with the excess hourly display if there is only one user sending mail
        for my $u (sort {$udomains{$a} <=> $udomains{$b}} keys %udomains) {
            my $total = 0;
            
            for my $d (keys %{$udomains{$u}}) { # total up emails sent
                for my $h (keys %{$udomains{$u}{$d}}) {
                    $total += $udomains{$u}{$d}{$h};
                }
            }        
            
            if ($total > $indthresh) { # if the account has sent more than the threshold
                print "\nThe '$u' account/domain was detected as sending large amounts of email.\n";
                print "The account/domain sent ".commify($total)." emails to ".commify((scalar (keys %{$udomainrecs{$u}})))." unique recipients. Displaying hourly mail:\n\n";    
                
                for my $d (sort {$a cmp $b} keys %{$udomains{$u}}) { #print numbers of emails sent, grouped into days and hours
                    print "$d\n";
                    print "-" x14 . "\n";
                    
                    print pnbs("Hour",4).pnbs("Volume",10)."\n";
                    
                    print "-" x14 . "\n";
                
                    for my $h (sort {$a <=> $b} keys %{$udomains{$u}{$d}}) {
                        print pnbs($h,4).pnbs(commify($udomains{$u}{$d}{$h}),10)."\n";
                    }
                
                    print "\n";
                }        
            }    
        }
    }
}

sub printsendaddr {
    my ($saddr_r) = @_;
    
    if (%{$saddr_r}) { #only print out email addresses if there are any (there should be)
        print "Email addresses sent from:\n";
        print "--------------------------\n";
        
        my @s = sort {int (${$saddr_r}{$b}) <=> int(${$saddr_r}{$a})} keys %{$saddr_r};

        if ($terse && (scalar(@s) > 15)) { # trim long displays
            for (my $i = 0; $i < 15; $i++) {
                my $c = shift @s;
                print "$c: " . commify(${$saddr_r}{$c}) . "\n";
            }

            print "\nThere were ".scalar(@s)." additional sender addresses trimmed.\n";
        } else {
            for my $c (@s) {
                print "$c: " . commify(${$saddr_r}{$c}) . "\n";
            }
        }
    
        print "\n";
    }
}

sub printsendlog {
    my ($slog_r) = @_;
    
    if (%{$slog_r}) { #only print out logins if there are any
        print "Logins used to send mail:\n";
        print "-------------------------\n";

        my @l = sort {int (${$slog_r}{$b}) <=> int(${$slog_r}{$a})} keys %{$slog_r};

        if ($terse && (scalar(@l) > 15)) { # trim long displays
            my %new_slog;

            for my $c (@l) { # collapse randomized HELO strings
                if ($c =~ /(H=([^\s]*\s)?((\([^\(]*\)\s)?\[([^\]]*)\]))(:\d{1,5})?/) {
                    $new_slog{"H=(...) [$5]"} += ${$slog_r}{$c};
                } else {
                    $new_slog{$c} += ${$slog_r}{$c};
                }
            }

            @l = sort {int ($new_slog{$b}) <=> int($new_slog{$a})} keys %new_slog;

            if (scalar(@l) > 15) { # trim long displays
                for (my $i = 0; $i < 15; $i++) {
                    my $c = shift @l;
                    print "$c: " . commify($new_slog{$c}) . "\n";
                }

                print "\nThere were ".scalar(@l)." additional logins trimmed.\n";
            } else {
                for my $c (@l) {
                    print "$c: " . commify($new_slog{$c}) . "\n";
                }
            }
        } else {
            for my $c (@l) {
                print "$c: " . commify(${$slog_r}{$c}) . "\n";
            }
        }
    
        print "\n";
    }
}

sub printcwd {
    my ($cwd_r) = @_;
    
    if (%{$cwd_r}) { #only print out cwd stats if there are any
        print "Current working directories:\n";
        print "----------------------------\n";
    
        for my $c (sort {int (${$cwd_r}{$b}) <=> int(${$cwd_r}{$a})} keys %{$cwd_r}) {
            print "$c: " . commify(${$cwd_r}{$c}) . "\n";
        }
    
        print "\n";
    }
}

sub printsubs {
    my ($subs_r) = @_;
    
    if (%{$subs_r}) { #only print out subjects if there are any (there should be)
        print "Top subjects:\n";
        print "-------------\n";
    
        # sort subjects
        
        my @subss = sort {int (${$subs_r}{$b}) <=> int(${$subs_r}{$a})} keys %{$subs_r};

        if (scalar @subss <= 10) {
            foreach my $sub (@subss) {
                print "$sub: ${$subs_r}{$sub}\n";
            }
        } else {
            for (my $i = 0; $i < 10; $i++) {
        	    print "$subss[$i]: ${$subs_r}{$subss[$i]}\n";
            }    
        }
    
        print "\n";
        
        print "Total number of discrete subjects: " . scalar keys(%{$subs_r}) . "\n\n";
    }
}

sub printrecaddr {
    my ($raddr_r) = @_;
    
    if (%{$raddr_r}) { #only print out email addresses if there are any (there should be)
        my @k = sort {int (${$raddr_r}{$b}) <=> int(${$raddr_r}{$a})} keys %{$raddr_r};
        
        print "Random recipient addresses:\n";
        print "---------------------------\n";
   
        if (scalar @k <= 10) {
            foreach my $addr (@k) {
                print "$addr\n";
            }
        } else {
            for (my $i = 0; $i < 10; $i++) {
        	    print $k[rand @k] . "\n";
            }    
        }
    
        print "\n";
        
        print "Top recipients:\n";
        print "---------------\n";
        
        if (scalar @k <= 10) {
            foreach my $addr (@k) {
                print "$addr: ${$raddr_r}{$addr}\n";
            }
        } else {
            for (my $i = 0; $i < 10; $i++) {
        	    print "$k[$i]: ${$raddr_r}{$k[$i]}\n";
            }    
        }
           
        print "\n";
    }
}

sub printexim {
    my ($saddr_r) = @_;
        
    my @queue = `exim -bpr`;
    my $queuemails = 0;
    
    foreach (@queue) {
        $_ =~ s/^\s+|\s+$//g; # kill whitespace and newlines
        if (exists ${$saddr_r}{$_}) {
            $queuemails++;
        }
    }
    
    print "Emails currently in queue:\n";
    print "--------------------------\n";
    print "User: $queuemails, Total: ";
    
    print `exim -bpc`;
    print "\n";
}

sub printtosmessage {
print <<EOF;
Hi,

An account under your control was recently found to be sending out emails at a rate faster than 500 messages/hour, which resulted in the actions indicated above. As outlined in both our terms of service and general mail policies, the maximum number of messages an account is permitted to send is 500 per hour. We will review the content of the messages being sent from your account; if they appear to be spam or otherwise violate additional HostGator rules, your account may not be eligible for unsuspension. If your actions were unintentional, the content of your messages are found not to be spam, and this incident was simply an oversight of our rules, you may have the option of upgrading to dedicated servers. Continuing this type of mail volume on shared servers, however, will not be an option. The 500 mails/hour rule was put in place for our shared servers simply because it is important to us that they are not blacklisted. High volumes of mail from any account jeopardizes that goal. We welcome your response to this issue. Should you be able to assure us this issue will not recur in the future, we may be able to reinstate this account on a shared server, or assist you in upgrading your account to a dedicated system (with the assumption your messages are not found to have violated our anti-spam policies).

Our mail rules may be found here: http://www.hostgator.com/mailpolicy.shtml (and) http://www.hostgator.com/tos.shtml

Note: If you have a catchall enabled as well as boxtrapper, this could account for your enormous mail volume. Each spam message that arrives in your mailbox generates a second wasteful message to verify the original spam. If you intend to use boxtrapper, you MUST disable your catchall. Catchall service is no longer being offered, and only remains in place for our legacy customers. In situations like this, we may opt to disable your catchall to prevent further mail floods, if that is the cause of the spam or high mail volume.

EOF
}

sub printtimerange {
    my ($startTime, $endTime) = @_;
    
    my @monthsArr = ("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    my ($psec,$pmin,$phour,$pday,$pmon,$pyear) = CORE::localtime($startTime);
    my ($sec,$min,$hour,$day,$mon,$year) = CORE::localtime($endTime);
    
    printf "Mail Log Parsed from $monthsArr[$pmon] $pday, %d %02d:%02d:%02d to $monthsArr[$mon] $day, %d %02d:%02d:%02d\n\n", ($pyear + 1900), $phour, $pmin, $psec, ($year + 1900), $hour, $min, $sec;
}

sub maillogstart {
    my ($file) = @_;
    my %monthsRev = ("Jan"=>1, "Feb"=>2, "Mar"=>3, "Apr"=>4, "May"=>5, "Jun"=>6, "Jul"=>7, "Aug"=>8, "Sep"=>9, "Oct"=>10, "Nov"=>11, "Dec"=>12);
    
    my $fh = new FileHandle;
    $fh->open("<$file");
    
    my $fhp;
    
    if ($file =~ /^.*?\.gz$/) {
        $fhp = new IO::Uncompress::Gunzip $fh;
    } else {
        $fhp = $fh;
    }
    
    my $time;
                
    while(my $line = <$fhp>) {
        if ($line =~ /((\w{3})\s{1,2}(\d{1,2})\s(\d{2}):(\d{2}):(\d{2}))/) {
            $time = timelocal($6, $5, $4, $3, $monthsRev{$2} - 1, localtime->year() + 1900);
            last;
        }
    }
    
    $fh->close();

    return $time;
}

sub processmaillogs {
    my ($searchusers_r, $fixedlogins_r, $startTime, $endTime) = @_;
    my @searchusers = @{$searchusers_r};
    
    my %monthsRev = ("Jan"=>1, "Feb"=>2, "Mar"=>3, "Apr"=>4, "May"=>5, "Jun"=>6, "Jul"=>7, "Aug"=>8, "Sep"=>9, "Oct"=>10, "Nov"=>11, "Dec"=>12);
    my $year = localtime->year() + 1900;

    # specify logs to search
    
    my @maillogs = @{findlogs('/var/log', 'maillog((-\d{8})|(\.\d))?(\.gz)?')};

    # setup hashes, arrays, and variables for collected data
                
    my %ipaddr; # ip addresses logging in via POP/IMAP
    
    # grab the server's own ip address
    
    my $myip = `hostname -i`;
    chomp($myip);
    my $lastStart = $endTime;
    foreach my $file (@maillogs) {
        if (my $eximt = maillogstart($file)) {
            print "Processing '$file'.\n";
            
            # makes sure the log contains the time we want to check 
            
            if ($startTime < $eximt) {
                print "Start time pre-dates log, ";
                
                if ($endTime < $eximt) {
                    print "checking next log.\n";
                    next;
                } else {
                    print "but end time is present, checking anyways.\n";
                }                    
                    
            }
            
            # open file and parse lines
            
            my $progress = -1;
            my $new_progress = -1;
            my $filesize;
            
            # this is totally a hack, but way faster than the pure perl way of doing it
            
            my $fh;
            my $old_env = $ENV{'LC_ALL'} || '';
            $ENV{'LC_ALL'} = 'C';
            if ($file =~ /^.*?\.gz$/) {
                open($fh, "-|", 'zgrep','-F',': Login: ', $file);
                my $gziplist=`gzip -l $file`;
                $gziplist=~/.\n\s*\d*\s*(\d*)/;
                $filesize=$1;
            } else {
                open($fh, "-|", 'grep','-F',': Login: ', $file);
                $filesize = stat($file)->size
            }
            $ENV{'LC_ALL'} = $old_env;
            my $istty = (-t STDOUT);
            my $pos = 0;
            my $lineTime = 0;
            while (my $line = <$fh>) {
                parsemailline(\$line, $startTime, $endTime, \%monthsRev, $year, $fixedlogins_r, \%ipaddr, $myip,\$lineTime);

                $pos += length($line);
                $new_progress = int(100*($lineTime - $eximt)/($lastStart - $eximt)) if ($lineTime >= $eximt && $lastStart > $eximt);
                if ($new_progress > $progress){ #prevent a billion slow i/o calls
                    $progress = $new_progress;
                    
                    if ($istty) {
                        print "\r               \rProgress: $progress%"; #replace prev line with new progress
                    } else {
                        if (($progress == 0) || ($progress % 10 == 0)) {
                            print "$progress%";
                        } else {
                            print ".";
                        }
                    }
                }
            }
            if ($istty) {
                print "\r               \rProgress: 100%"; # finalize 100% since new way doesn't always get to 100
            } else {
                print "100%";
            }             
            
            $fh->close();
            
            print "\n";    

            if ($startTime >= $eximt) {
                last; # start time is in current log, we are done checking
            }
        } 
    }
    
    return (\%ipaddr);
}

sub parsemailline {
    my ($line_r, $startTime, $endTime, $monthsRev_r, $year, $fixedlogins_r, $ipaddr_r, $myip,$lineTime_r) = @_;
    
    if (${$line_r} =~ /((\w{3})\s{1,2}(\d{1,2})\s(\d{2}):(\d{2}):(\d{2})).*?Login: /gc) { # is this a login?
        my $logTime = timegm($6, $5, $4, $3, ${$monthsRev_r}{$2} - 1, $year) - $offset;
        ${$lineTime_r} = $logTime;
        if(($logTime >= $startTime) & ($logTime <= $endTime)) { # only count within the specified time range
            if (${$line_r} =~ /\Guser=<((.*?[\@+])?([^>]*))>.*?rip=([^,]*),/gc) { # do we have a user?
                my $user = $3; 
                my $ip = $4;
                
                if (($ip ne "127.0.0.1") && ($ip ne $myip)) { # ignore localhost entries
                    if (exists ${$fixedlogins_r}{$user}) {
                        ${$ipaddr_r}{$ip}++;
                    }
                }
            }
        }
    }
}

sub pseudoui {
    my ($user) = @_;    
    my $cuserpath = "/var/cpanel/users";
    my $netpath = "/etc/sysconfig/network";
        
    my $hostname;
    my $owner = undef;
    my $domain = undef;
    
    open(NETWORK, $netpath);
    while(my $line = <NETWORK>) {
        if ($line =~ m/HOSTNAME=([a-z0-9]*)/) {
           $hostname = $1;
            last;
        }
    }
    close(NETWORK);
    
    if ($user ne "root") {
        open(CUSERS, "$cuserpath/$user");
        while(my $line = <CUSERS>) {
            if ($line =~ m/OWNER=([a-z0-9]*)/) {
                $owner = $1;
                last;
            }
        }
        close(CUSERS);
        
        open(CUSERS, "$cuserpath/$user");
        while(my $line = <CUSERS>) {
            if ($line =~ m/DNS=(.*?)$/) {
                $domain = $1;
                last;
            }
        }
        close(CUSERS);
    }
    
    if ($owner) {
        if (!($owner eq "root") && !($owner eq $user)) {
            print "TOS/MAIL: $hostname: $owner($user)\n\n\n";
        } else {
            print "TOS/MAIL: $hostname: $user\n\n\n";
        }
    } else {
        print "TOS/MAIL: $hostname\n\n\n";
    }
    
    print "Reference: ecpp\n";
    print "   Server: $hostname\n";
    
    if ($domain) {
        print "   Domain: $domain\n";
    }
    
    print "     User: $user\n";
    
    if ($owner) {
        if (!($owner eq "root") && !($owner eq $user)) {
            print "    Owner: $owner\n";
        }
    }
}

sub get_homedir {
    my ($user) = @_;
    my @pwent = getpwnam($user);
    return $pwent[7];
}
