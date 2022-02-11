;<?php die(); ?>
; To prevent accidental public access, file uses php extension and die command.
; This file should still ALWAYS be placed in a non-public directory.
; These lines will be ignored when read as a .ini file, since they are comments.

[database]
db_host     = localhost
db_username = portfolio_user
db_password = portfolio_user_pass
db_name     = Portfolio

[blog_config]
posts_per_page = 1

[projects_config]
posts_per_page = 8
