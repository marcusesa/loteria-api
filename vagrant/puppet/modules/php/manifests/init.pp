class php {
    # Install PHP packages
    $phpPackages = ["php5", "php5-cli", "php5-dev", "php5-curl", "php5-xdebug", "libapache2-mod-php5"]

    package { $phpPackages:
        ensure => latest,
        require => [Exec['apt-get update']],
    }
}
