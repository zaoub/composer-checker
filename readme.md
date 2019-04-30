# zaoub/composer-checker
Check the integrity of the packages and if they are in weaknesses they can be sent to the zaoub application as an executable task.

### Check of packages
```bash
.\vendor\bin\zchecker
```

Example of results:-
```
Checking...
Number of vulnerability packets: 1
------------------------------------------------------------
Title: CVE-2019-10913: Reject invalid HTTP method overrides
Version: v4.2.4
Cve ID: CVE-2019-10913
------------------------------------------------------------
You want sent this result to zaoub app? (Y\N):
```

> The possibility of sending the weak packets is not effective yet