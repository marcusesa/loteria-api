class mybox ($hostname, $documentroot) {
    # Set paths
    Exec {
        path => ["/usr/bin", "/bin", "/usr/sbin", "/sbin", "/usr/local/bin", "/usr/local/sbin"]
    }

    include bootstrap
    include php
    include git

    class { "apache":
        hostname => $hostname,
        documentroot => $documentroot
    }
}
