class apache ($hostname, $documentroot) {
    # Install apache
    package { "apache2":
        ensure => latest,
        require => Exec['apt-get update']
    }

    # Enable the apache service
    service { "apache2":
        enable => true,
        ensure => running,
        require => Package["apache2"],
        subscribe => [
            File["/etc/apache2/sites-available/010-project"]
        ]
    }

    # Set the configuration
    file { "/etc/apache2/sites-available/010-project":
        ensure => present,
        source => "puppet:///modules/apache/project_vhost.conf",
        replace => false,
        require => Package['apache2'],
    }

    # Set the hostname and documentroot
    exec { "apache.hostname":
        command => "echo \"ServerName localhost\" >> /etc/apache2/httpd.conf",
        unless => "grep ServerName /etc/apache2/httpd.conf",
        require => Package['apache2'],
        notify  => Service["apache2"]
    }

    exec { "apache.project.hostname":
        command => "sed -i 's/ServerName __HOSTNAME__/ServerName $hostname/' /etc/apache2/sites-available/010-project",
        onlyif => "grep \"ServerName __HOSTNAME__\" /etc/apache2/sites-available/010-project",
        require => File['/etc/apache2/sites-available/010-project']
    }

    exec { "apache.project.documentroot":
	command => "sed -i 's/__DOCUMENTROOT__/$documentroot/g' /etc/apache2/sites-available/010-project",
        onlyif => "grep \"DocumentRoot /vagrant/__DOCUMENTROOT__\" /etc/apache2/sites-available/010-project",
        require => File['/etc/apache2/sites-available/010-project']
    }

    exec { "apache.enable.virtualhosts":
        command => "/usr/sbin/a2dissite 000-default && /usr/sbin/a2ensite 010-project && /etc/init.d/apache2 reload",
        require => File['/etc/apache2/sites-available/010-project'],
    }
}
