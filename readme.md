# zaoub/dependo-php-client
Check the integrity of the packages and if they are in weaknesses they can be sent to the zaoub application as an executable task.

## Install via composer
```bash
$ composer require zaoub/dependo-php-client
```

## Auto Check of packages
```bash
vendor/bin/zaoubdependo --keys="<secret_key>" --send="yes"
```
- keys: If you are going to send automatically, you must specify the secret key.
- send: Confirm sending results (yes | no).

## Check of packages
```bash
vendor/bin/zaoubdependo
```

Example of results:-
```
███████╗ █████╗  ██████╗ ██╗   ██╗██████╗     ███████╗███████╗ ██████╗██╗   ██╗██████╗ ██╗████████╗██╗   ██╗
╚══███╔╝██╔══██╗██╔═══██╗██║   ██║██╔══██╗    ██╔════╝██╔════╝██╔════╝██║   ██║██╔══██╗██║╚══██╔══╝╚██╗ ██╔╝
  ███╔╝ ███████║██║   ██║██║   ██║██████╔╝    ███████╗█████╗  ██║     ██║   ██║██████╔╝██║   ██║    ╚████╔╝
 ███╔╝  ██╔══██║██║   ██║██║   ██║██╔══██╗    ╚════██║██╔══╝  ██║     ██║   ██║██╔══██╗██║   ██║     ╚██╔╝
███████╗██║  ██║╚██████╔╝╚██████╔╝██████╔╝    ███████║███████╗╚██████╗╚██████╔╝██║  ██║██║   ██║      ██║
╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═════╝     ╚══════╝╚══════╝ ╚═════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝      ╚═╝
- Dependo tool: Check the integrity of the packages.
------------------------------------------------------------------------------------------------------------
Checking...
Number of vulnerability packets: 3
------------------------------------------------------------
Vendor: laravel/framework
Version: v5.1.12
Advisories:-
    Title: Exploit of encryption failure vulnerability
    Cve:
    ----
    Title: Cookie serialization vulnerability
    Cve:
    ----
    Title: Timing attack vector for remember me token
    Cve: CVE-2017-14775
------------------------------------------------------------
Vendor: swiftmailer/swiftmailer
Version: v5.4.1
Advisories:-
    Title: Remote Code Execution when using the mail transport
    Cve: CVE-2016-10074
------------------------------------------------------------
Vendor: symfony/http-foundation
Version: v2.7.3
Advisories:-
    Title: CVE-2018-11386: Denial of service when using PDOSessionHandler
    Cve: CVE-2018-11386
    ----
    Title: CVE-2018-14773: Remove support for legacy and risky HTTP headers
    Cve: CVE-2018-14773
    ----
    Title: CVE-2019-10913: Reject invalid HTTP method overrides
    Cve: CVE-2019-10913
------------------------------------------------------------

You want sent this result to zaoub app? (Y\N):
```

> The possibility of sending the weak packets is not effective yet