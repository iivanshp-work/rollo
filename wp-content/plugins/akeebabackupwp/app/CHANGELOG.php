<?php die();?>
Akeeba Solo 7.0.2
================================================================================
~ Log the full path to the computed site's root, without <root> replacement
# [HIGH] Core (free of charge) version only: the PayPal donation link included a tracking pixel. Changed to donation link, without tracking.
# [MEDIUM] Integrated restoration: sanity checks were not applied, resulting in extraction errors
# [MEDIUM] WebDav post-processing engine: first backup archive was always uploaded on the remote root, ignoring any directory settings
# [HIGH] Restoration will fail if a table's name is a superset of another table's name e.g. foo_example_2020 being a superset of foo_example_2.

Akeeba Solo 7.0.1
================================================================================
- pCloud: removing download to browser (cannot work properly due to undocumented API restrictions)
# [HIGH] An error about not being able to open a file with an empty name occurs when taking a SQL-only backup but there's a row over 1MB big
# [LOW] Notice in Control Panel when maximum error reporting is enabled
# [LOW] Backup log file did not appear correctly (but you could still download it)
# [LOW] Redirections for the legacy frontend backup method should be to remote.php, not index.php
# [LOW] Dark Mode: modal close icon was invisible both in the backup software and during restoration
# [LOW] Dark Mode: some interface elements (e.g. footer, modal chrome) would always appear in their Light Mode scheme
# [LOW] Fixed automatically filling DropBox tokens after OAuth authentication

Akeeba Solo 7.0.0
================================================================================
+ Remove TABLESPACE and DATA|INDEX DIRECTORY table options during backup
# [MEDIUM] Fetching update information could result in an exception if the latest available version cannot be installed on this site
# [LOW] FTP and SFTP connection tests were always failing
# [LOW] Fixed applying quotas for obsolete backups

Akeeba Solo 7.0.0.rc1
================================================================================
+ Upload to OVH now supports Keystone v3 authentication, mandatory starting mid-January 2020
- Remove obsolete "Use IFRAMEs instead of AJAX" option
# [HIGH] An error in an early backup domain could result in a forever-running backup
# [HIGH] DB connection errors wouldn't result in the backup failing, as it should be doing
# [HIGH] Manage remotely stored files: Fetch to server would fail after the first batch of downloads

Akeeba Solo 7.0.0.b3
================================================================================
+ Common PHP version warning scripts
+ Reinstated support for pCloud after they fixed their OAuth2 server
~ Improved Dark Mode
~ Improved PHP 7.4 compatibility
~ Clearer message when setting decryption fails in CLI backup script
~ Replace JavaScript eval() with JSON.parse()
# [HIGH] The database dump was broken with some versions of PCRE (e.g. the one distributed with Ubuntu 18.04)
# [HIGH] The integrated restoration was broken

Akeeba Solo 7.0.0.b2
================================================================================
- Removed pCloud support
+ ANGIE: Options to remove AddHandler lines on restoration
# [MEDIUM] Fixed OAuth authentication flow
# [LOW] Configuration wizard will always prompt to the user

Akeeba Solo 7.0.0.b1
================================================================================
+ Amazon S3 now supports Bahrain and Stockholm regions
+ Amazon S3 now supports Intelligent Tiering, Glacier and Deep Archive storage classes
+ Google Storage now supports the nearline and coldline storage classes
+ Manage Backups: Improved performance of the Transfer (re-upload to remote storage) feature.
+ Windows Azure BLOB Storage: download back to server and download to browser are now supported
+ New OneDrive integration supports both regular OneDrive and OneDrive for Business
+ pCloud support
+ Support for Dropbox for Business
+ Minimum required PHP version is now 5.6.0
~ Common version numbering among all of our backup products means this version is 7, not 4
~ All views have been converted to Blade for easier development and better future-proofing
~ The integrated restoration feature is now only available in the Professional version
~ The front-end legacy backup API and the Remote JSON API are now available only in the Professional version
~ The Site Transfer Wizard is now only available in the Professional version
~ SugarSync integration: you now need to provide your own access keys following the documentation instructions
~ Backup error handling and reporting (to the log and to the interface) during backup has been improved.
~ The Test FTP/SFTP Connection buttons now return much more informative error messages.
~ Manage Backups: much more informative error messages if the Transfer to remote storage process fails.
~ The backup and log IDs will follow the numbering you see in the left hand column of the Manage Backups page.
~ Manage Backups: The Remote File Management page is now giving better, more accurate information.
~ Manage Backups: Fetch Back To Server was rewritten to gracefully deal with more problematic cases.
~ Removed AES encapsulations from the JSON API for security reasons. We recommend you always use HTTPS with the JSON API.
# [HIGH] Changing the database prefix would not change it in the referenced tables inside PROCEDUREs, FUNCTIONs and TRIGGERs
# [HIGH] Backing up PROCEDUREs, FUNCTIONs and TRIGGERs was broken
# [HIGH] Manage Backups: would not show Transfer Archive for qualifying backups not fully uploaded to remote storage.
# [MEDIUM] Database only backup of PROCEDUREs, FUNCTIONs and TRIGGERs does not output the necessary DELIMITER commands to allow direct import
# [MEDIUM] BackBlaze B2: upload error when chunk size is higher than the backup archive's file size
# [LOW] Manage Backups: the Remote Files Management dialog's size was off by several pixels
# [LOW] Manage Backups: downloading a part file from S3 beginning with text data would result in inline display of the file instead of download.
# [LOW] Disabled menu items (e.g. Backup Now) page confused people; removed them to prevent confusion