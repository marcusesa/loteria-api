class git {
    # Install git
    package { "git":
        ensure => latest,
        require => Exec['apt-get update']
    }

}
