class bootstrap {
    # This makes puppet and vagrant shut up about the puppet group
    group { "puppet":
        ensure => "present",
    }

    # Ensure we are up to date
    exec { "apt-get update":
        command => "apt-get update",
    }
    
    # Load repos
    exec { "add-php-repo-deb":
        command => "echo 'deb http://ppa.launchpad.net/ondrej/php5/ubuntu precise main' >> /etc/apt/sources.list",
        unless => "grep \"deb .*ondrej/php5\" /etc/apt/sources.list 2>/dev/null",
        before => Exec["apt-get update"]
    }
  	
    exec { "add-php-repo-deb-src":
        command => "echo 'deb-src http://ppa.launchpad.net/ondrej/php5/ubuntu precise main' >> /etc/apt/sources.list",
        unless => "grep \"deb-src .*ondrej/php5\" /etc/apt/sources.list 2>/dev/null",
        before => Exec["apt-get update"]
    }

    exec { "add-php-repo-key":
        command => "apt-key adv --keyserver keyserver.ubuntu.com --recv-keys E5267A6C",
        unless => "apt-key list | grep E5267A6C 2>/dev/null",
        before => Exec["apt-get update"]
    }

    # Common packages
    $commonPackages = ["curl", "wget", "unzip", "make"]
    package { $commonPackages:
        ensure => latest,
        require => Exec['apt-get update'],
    }
}
